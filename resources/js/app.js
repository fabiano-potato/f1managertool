var sprintf = require('sprintf-js').sprintf,
    vsprintf = require('sprintf-js').vsprintf;

import Vue from 'vue'
window.Vue = require('vue');
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import './store.js';

Vue.component('car-component-groups', require('./vue/components/CarComponentGroupsComponent').default);
Vue.component('car-component-group', require('./vue/components/CarComponentGroupComponent').default);
Vue.component('car-component', require('./vue/components/CarComponentComponent').default);
Vue.component('car-component-level', require('./vue/components/CarComponentLevelComponent').default);
Vue.component('car-component-level-stat', require('./vue/components/CarComponentLevelStatComponent').default);

