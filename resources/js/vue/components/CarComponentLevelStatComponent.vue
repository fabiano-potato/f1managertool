<template>
    <div class="stat-row">
        <span class="name">{{ name }}:</span>
        <span class="stat">{{ storeState.getCurrentStat(attr) }}</span>
        <span class="diff" v-if="!storeState.isActiveCarComponent(carComponentId)"
              :data-positive="isGreater(carComponentId, attr)"
              :data-negative="isLessThan(carComponentId, attr)">
                {{(isGreater(carComponentId, attr) ? "+" : "") + compare(carComponentId)[attr] }}
        </span>

        <div class="progress">
            <VueStackedProgressBar :list="this.getProgressBarData(carComponentId, attr)"></VueStackedProgressBar>
        </div>
    </div>
</template>

<script>
    import { store } from "../../store.js";
    import StackedProgressBar from 'vue-stacked-progress-bar';

    export default {
        props: ['carComponentId', 'attr', 'name'],
        data: function(){
            return {
                storeState: store.state
            }
        },
        components: {
          StackedProgressBar,
        },
        methods: {
            getProgressBarData(carComponentId, attr)
            {
                let currentValue = store.state.getCurrentStat(attr);
                let diffValue = this.compare(carComponentId)[attr];
                let diffColour = '#05f9b4';
                if (diffValue < 0) {
                    diffColour = 'red';
                    // Minus the diff from the current value to reduce the bar
                    currentValue = parseInt(currentValue) + parseInt(diffValue);
                    diffValue = diffValue * -1;
                }

                return [
                    { percentage: currentValue, color:'#b8b8b8' },
                    { percentage: diffValue, color: diffColour },
                ];
            },

            /**
             * Get whether the current attribute is greater than the current car's assigned component value of that attribute
             * @param carComponentId
             * @param attr
             */
            isGreater(carComponentId, attr)
            {
                return (this.compare(carComponentId)[attr] > 0);
            },

            /**
             * Get whether the current attribute is less than than the current car's assigned component value of that attribute
             * @param carComponentId
             * @param attr
             */
            isLessThan(carComponentId, attr)
            {
                return (this.compare(carComponentId)[attr] < 0);
            },

            /**
             * Compare a currently viewed CarComponent with the current car's active CarComponentLevel for this type
             * @param carComponentId
             */
            compare(carComponentId)
            {
                let nullObj = {
                    statPower: '-',
                    statAero: '-',
                    statGrip: '-',
                    statReliability: '-',
                    statPitStop: '-',
                }

                // Get the CarComponent (we need it for the type)
                let carComponent = store.state.carComponents[carComponentId];

                // Get the CarComponentLevel
                let carComponentLevel = store.state.getViewedCarComponentLevel(carComponentId);
                if (!carComponentLevel) {
                    return nullObj;
                }

                // Get current active componentLevel
                let activeCarComponentLevel = store.state.getActiveCarComponentLevel(carComponent.type);
                if (!activeCarComponentLevel) {
                    return nullObj;
                }

                return {
                    statPower: sprintf('%d', (carComponentLevel.statPower - activeCarComponentLevel.statPower)),
                    statAero: sprintf('%d', (carComponentLevel.statAero - activeCarComponentLevel.statAero)),
                    statGrip: sprintf('%d', (carComponentLevel.statGrip - activeCarComponentLevel.statGrip)),
                    statReliability: sprintf('%d', (carComponentLevel.statReliability - activeCarComponentLevel.statReliability)),
                    statPitStop: sprintf('%d.02', (carComponentLevel.statPitStop - activeCarComponentLevel.statPitStop)),
                }
            },
        }
    }
</script>
