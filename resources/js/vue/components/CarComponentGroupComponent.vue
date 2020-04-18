<template>
    <div class="row car-component-group">
        <div class="col">
            <h2 class="text-center">{{ group.name }}</h2>
            <div class="car-components row d-lg-flex justify-content-lg-center">
                <car-component v-for="(id) in group.carComponentIds"
                               v-bind:carComponentId="id"
                ></car-component>
            </div>
        </div>
    </div>
</template>

<script>
    import { store } from "../../store.js";
    import CarComponentComponent from "./CarComponentComponent";
    export default {
        props: ['index'],
        data: function(){
            return {
                group: store.state.carComponentGroups[this.index],
            }
        },
        components: {
            CarComponentComponent
        }
    }
</script>
