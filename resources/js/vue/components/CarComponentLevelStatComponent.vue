<template>
    <tr class="compare">
        <th>{{ name }}:</th>
        <td class="text-right">{{ storeState.getViewedCarComponentLevel(carComponentId)[attr] }}</td>
        <td class="text-right">
            <span class="diff" v-if="!storeState.isActiveCarComponent(carComponentId)"
                :data-positive="isGreater(carComponentId, attr)"
                :data-negative="isLessThan(carComponentId, attr)">
                {{(isGreater(carComponentId, attr) ? "+" : "") + compare(carComponentId)[attr] }}
            </span>
        </td>
    </tr>
</template>

<script>
    import { store } from "../../store.js";

    export default {
        props: ['carComponentId', 'attr', 'name'],
        data: function(){
            return {
                storeState: store.state
            }
        },
        methods: {
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

<style>
    .compare .diff[data-positive^="true"] {
        color: green;
    }
    .compare .diff[data-negative^="true"] {
        color: red;
    }
</style>
