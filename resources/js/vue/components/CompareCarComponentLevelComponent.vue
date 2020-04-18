<template>
    {{ compare(carComponentId) }}
</template>

<script>
    import { store } from "../../store.js";

    export default {
        props: ['carComponentId'],
        data: function(){
            return {
                storeState: store.state
            }
        },
        methods: {
            compare(carComponentId) {
                // Get the CarComponent
                let carComponent = store.state.carComponents[carComponentId];

                // Get current active componentLevel
                let activeCarComponent = store.state.getActiveCarComponentLevel(carComponent.type);

                return {
                    statPower: carComponent.statPower - activeCarComponent.statPower,
                    statAero: -2,
                    statGrip: 0,
                    statReliability: 1,
                    statPitStop: -0.03,
                }
            },

            /**
             * Get the currently viewed CarComponentLevel
             * @param carComponentId
             * @returns {*}
             */
            getViewedCarComponentLevel(carComponentId)
            {
                let carComponent = store.state.carComponents[carComponentId];
                return carComponent.carComponentLevels[this.getViewedComponentLevelValue(carComponentId)];
            },

            /**
             * Get the current viewed CarComponentLevel for a CarComponent
             * @param carComponentId
             * @returns {number|*|number}
             */
            getViewedComponentLevelValue(carComponentId)
            {
                if (!store.state.userCarComponents[carComponentId] || !store.state.userCarComponents[carComponentId].currentViewLevel)
                {
                    // default to level 1
                    return 1;
                }
                return store.state.userCarComponents[carComponentId].currentViewLevel;
            },
        },
    }
</script>
