<template>
    <div>
        <h2 class="text-center">Car Components</h2>
        <div class="groups">
            <car-component-group v-for="(item, index) in storeState.carComponentGroups"
                                 v-bind:index="index"
                                 v-bind:key="item.name"
            ></car-component-group>
        </div>
    </div>
</template>

<script>
    import { store } from "../../store.js";
    import CarComponentGroupComponent from "./CarComponentGroupComponent";
    export default {
        data: function() {
          return {
              storeState: store.state
          }
        },
        components: {
            CarComponentGroupComponent
        }
    }
</script>
