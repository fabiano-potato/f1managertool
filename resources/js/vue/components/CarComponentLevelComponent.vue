<template>
<div class="car-component-level" :data-can-purchase="canUpgrade(carComponentId)">
    <i class="upgrade-indicator fa fa-angle-double-up" v-if="canUpgrade(carComponentId)"></i>
    <h3 class="title row text-center">
        <i class="prev fa fa-caret-down" v-on:click="browseDownComponentLevel(carComponentId)"
           :data-disabled="!(isComponentLevelBrowsable(carComponentId, -1))"></i>
        {{ name }}
        <i class="next fa fa-caret-up" v-on:click="browseUpComponentLevel(carComponentId)"
           :data-disabled="!(isComponentLevelBrowsable(carComponentId, 1))"></i>
    </h3>
    <div class="display-table">
        <div class="current-level-points">
            <div class="current-level">
                {{ storeState.getViewedCarComponentLevel(carComponentId).level }}
            </div>
            <div class="current-points">
                <span  v-if="!storeState.isEnabledCarComponentLevel(carComponentId)">
                    <input class="requiredPoints" type="text" value="0"
                           v-model="currentUpgradePoints"/>/{{ getRequiredUpgradePoints(carComponentId) }}*
                </span>
            </div>
        </div>
    </div>
    <table>
        <car-component-level-stat name="Power" attr="statPower" :carComponentId="carComponentId"></car-component-level-stat>
        <car-component-level-stat name="Aero" attr="statAero" :carComponentId="carComponentId"></car-component-level-stat>
        <car-component-level-stat name="Grip" attr="statGrip" :carComponentId="carComponentId"></car-component-level-stat>
        <car-component-level-stat name="Reliability" attr="statReliability" :carComponentId="carComponentId"></car-component-level-stat>
        <car-component-level-stat name="Pit Stop" attr="statPitStop" :carComponentId="carComponentId"></car-component-level-stat>
    </table>

    <div class="text-center d-block" v-if="!storeState.isActiveCarComponent(carComponentId)">
        <button v-on:click="storeState.setActiveCarComponent(carComponentId)">Assign to Car</button>
    </div>

    <div class="text-center d-block" v-if="storeState.isActiveCarComponent(carComponentId)">
        <button>Currently Assigned</button>
    </div>

    <div class="text-center purchase" v-if="!storeState.isEnabledCarComponentLevel(carComponentId)">
        <button class="d-block" v-on:click="purchase(carComponentId)">
            Purchase ${{ new Intl.NumberFormat('en-AU').format(getPurchasePrice(carComponentId)) }}
        </button>
    </div>
</div>
</template>

<script>
    import { store } from "../../store.js";
    import CarComponentLevelStat from "./CarComponentLevelStatComponent";

    export default {
        props: ['carComponentId'],
        data: function(){
            return {
                name: store.state.carComponents[this.carComponentId].name,
                currentUpgradePoints: store.state.userCarComponents[this.carComponentId].currentUpgradePoints,
                storeState: store.state
            }
        },
        methods: {
            /**
             * Update the Currently viewed componentLevel by +1
             * @param carComponentId
             * @returns {boolean}
             */
            browseUpComponentLevel(carComponentId)
            {
                return this.browseComponentLevel(carComponentId, 1);
            },

            /**
             * Update the Currently viewed componentLevel by -1
             * @param carComponentId
             * @returns {boolean}
             */
            browseDownComponentLevel(carComponentId)
            {
                return this.browseComponentLevel(carComponentId, -1);
            },

            /**
             * Update the Currently viewed componentLevel for a CarComponent
             * @param carComponentId
             * @param modifyValue
             * @returns {boolean}
             */
            browseComponentLevel(carComponentId, modifyValue)
            {
                let carComponent = store.state.carComponents[carComponentId];
                if (!carComponent) {
                    return false;
                }

                // Get the currently viewed level
                let currentLevel = store.state.getViewedComponentLevelValue(carComponentId);

                // Ensure the next level exists
                if (!store.state.carComponents[carComponentId].carComponentLevels[currentLevel + modifyValue]) {
                    return false;
                }

                // Update state for the CarComponentLevel
                if (store.state.userCarComponents[carComponentId]) {
                    store.state.userCarComponents[carComponentId].currentViewLevel = currentLevel + modifyValue;
                }
                else {
                    store.state.userCarComponents[carComponentId] = {
                        currentViewLevel: currentLevel + modifyValue,
                        currentEnabledLevel: 1, // default to 1
                    };
                }
            },

            /*
             * Get whether a CarComponentLevel is able to be browsed/incremented up or down
             */
            isComponentLevelBrowsable(carComponentId, modifyValue)
            {
                let carComponent = store.state.carComponents[carComponentId];
                if (!carComponent) {
                    return false;
                }

                // Get the currently viewed level
                let currentLevel = store.state.getViewedComponentLevelValue(carComponentId);

                // Ensure the next level exists
                if (!store.state.carComponents[carComponentId].carComponentLevels[currentLevel + modifyValue]) {
                    return false;
                }
                return true;
            },

            /**
             * Get the purchase price for a CarComponent level, calculated from the previous levels purchase prices.
             * @param carComponentId
             * @param level
             * @return int
             */
            getPurchasePrice(carComponentId, level)
            {
                let price = 0;
                if (!level) {
                    // Default to currently viewed level
                    level = store.state.getViewedComponentLevelValue(carComponentId);
                }

                // Loop through previous levels and calculate prices
                for (let i = level -1; i >= 1; i--) {
                    let carComponentLevel = store.state.carComponents[carComponentId].carComponentLevels[i];
                    price += carComponentLevel.upgradeCost;
                    if (store.state.isEnabledCarComponentLevel(carComponentId, i)) {
                        break; // Previous component level is already purchased, exit loop
                    }
                }

                return price;
            },

            /**
             * Get the required upgrade points, calculated from the previous level
             * @param carComponentId
             * @param level
             * @return int
             */
            getRequiredUpgradePoints(carComponentId, level)
            {
                let points = 0;
                if (!level) {
                    // Default to currently viewed level
                    level = store.state.getViewedComponentLevelValue(carComponentId);
                }

                // Loop through previous levels and calculate required upgrade points
                for (var i = level-1; i >= 1; i--) {
                    let carComponentLevel = store.state.carComponents[carComponentId].carComponentLevels[i];
                    points += carComponentLevel.requiredUpgradePoints;
                    if (store.state.isEnabledCarComponentLevel(carComponentId, i)) {
                        break;
                    }
                }

                return points;
            },

            /**
             * Whether user should be able to purchase component level
             * @param carComponentId
             * @param level
             * @return boolean
             */
            canPurchase(carComponentId, level)
            {
                return (this.currentUpgradePoints >= this.getRequiredUpgradePoints(carComponentId, level));
            },

            /**
             * Whether this CarComponent can be upgraded
             * @param carComponentId
             * @return boolean
             */
            canUpgrade(carComponentId)
            {
                let carComponentLevel = store.state.getEnabledCarComponentLevel(carComponentId);

                // Get next level and check if eligible for upgrade
                let nextCarComponentLevel = store.state.carComponents[carComponentId].carComponentLevels[carComponentLevel.level + 1];
                if (!nextCarComponentLevel) {
                    return false;
                }

                // Check Upgrade Points
                if (nextCarComponentLevel.requiredUpgradePoints > this.currentUpgradePoints) {
                    return false;
                }

                // TODO: Check Price

                return true;
            },

            /**
             * Purchase a level for a CarComponent
             * @param carComponentId
             * @param level
             */
            purchase(carComponentId, level)
            {
                // Set the level as enabled.
                store.state.setEnabledCarComponentLevel(carComponentId, level);

                // Subtract the upgrade points
                let requiredUpgradePoints = this.getRequiredUpgradePoints(carComponentId, level);
                if (requiredUpgradePoints > this.currentUpgradePoints) {
                    this.currentUpgradePoints = 0;
                    return;
                }
                this.currentUpgradePoints -= this.getRequiredUpgradePoints(carComponentId, level);
            }
        },
        components: {
          CarComponentLevelStat,
        }
    }
</script>
