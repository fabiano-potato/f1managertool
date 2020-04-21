<template>
    <div class="car-component col col-sm-6 col-lg-3 col-xl"
         :data-active="storeState.isActiveCarComponent(carComponentId) ? 1 : 0">
        <div class="car-component-levels">
            <car-component-level-component
                :carComponentId="carComponentId"
                :level="1"
            ></car-component-level-component>
        </div>
    </div>
</template>

<script>
    import { store } from "../../store.js";
    import CarComponentLevelComponent from "./CarComponentLevelComponent";

    export default {
        props: ['carComponentId'],
        data: function(){
            return {
                storeState: store.state,
            };
        },
        components: {
            CarComponentLevelComponent
        }
    }
</script>
