export const store = {
    state: {
        carComponents: require('./carComponents.json'),
        carComponentGroups: require('./carComponentGroups.json'),
        cars: {
            1: {
                carComponents: {
                    "1": {
                        carComponentId: 2,
                        level: 1,
                    },
                    "2": {
                        carComponentId: 9,
                        level: 1,
                    },
                    "3": {
                        carComponentId: 20,
                        level: 1
                    },
                    "4": {
                        carComponentId: 26,
                        level: 1
                    },
                    "5": {
                        carComponentId: 36,
                        level: 1
                    },
                    "6": {
                        carComponentId: 41,
                        level: 1
                    },
                }
            }
        },
        // The current car user is viewing/configuring
        activeCar: 1,
        // The currently active and enabled (unlocked) car component levels. @see: initUserCarComponents()
        userCarComponents: {},

        /**
         * Initiate this class
         */
        init()
        {
            this.initUserCarComponents();
            return this;
        },

        /**
         * Initiate the userCarComponents
         */
        initUserCarComponents()
        {
            // Setup default state (required for reactive state).
            for(var id in this.carComponents) {
                this.userCarComponents[id] = {
                    currentEnabledLevel: 1,
                    currentViewLevel: 1,
                    currentUpgradePoints: 0,
                }
            }

            // Set non default user state.
            this.userCarComponents[3] = {
                currentEnabledLevel: 2,
                currentViewLevel: 4,
                currentUpgradePoints: 300,
            }
        },

        /**
         * Set the current enabled (highest unlocked) CarComponentLevel for a CarComponent
         * @param carComponentId
         * @param level
         */
        setEnabledCarComponentLevel(carComponentId, level)
        {
            // Default to the current viewed level
            level = this.getViewedCarComponentLevel(carComponentId).level;

            if (this.userCarComponents[carComponentId]) {
                this.userCarComponents[carComponentId].currentEnabledLevel = level;
            }
            else {
                this.userCarComponents[carComponentId] = {
                    currentEnabledLevel: level,
                    currentViewLevel: level,
                }
            }
        },

        /**
         * Set the active car component
         * @param carComponentId
         */
        setActiveCarComponent(carComponentId)
        {
            let carComponent = this.carComponents[carComponentId];
            if (!carComponent) {
                return false;
            }

            // Update the current car's active component for this component type
            this.cars[this.activeCar].carComponents[carComponent.type] = {
                carComponentId: carComponentId,
                level: this.getViewedCarComponentLevel(carComponentId).level,
            };

            // Update the enabled level for this user's car component
            this.setEnabledCarComponentLevel(carComponentId, this.getEnabledComponentLevelValue(carComponentId))
        },

        /**
         * Get the current viewed CarComponentLevel for a CarComponent
         * @param carComponentId
         * @returns {*}
         */
        getEnabledCarComponentLevel(carComponentId)
        {
            let carComponent = this.carComponents[carComponentId];
            return carComponent.carComponentLevels[this.getEnabledComponentLevelValue(carComponentId)];
        },

        /**
         * Get the current enabled (unlocked) CarComponentLevel for a CarComponent
         * @param carComponentId
         * @returns {number|*|number}
         */
        getEnabledComponentLevelValue(carComponentId)
        {
            if (!this.userCarComponents[carComponentId] || !this.userCarComponents[carComponentId].currentEnabledLevel)
            {
                // default to level 1
                return 1;
            }
            return this.userCarComponents[carComponentId].currentEnabledLevel;
        },

        /**
         * Get whether a CarComponent level is currently enabled for a user.
         * @param carComponentId
         * @param level
         * @returns {boolean}
         */
        isEnabledCarComponentLevel(carComponentId, level)
        {
            if (!level) {
                // Get the currently viewed level
                level = this.getViewedComponentLevelValue(carComponentId);
            }
            let enabledLevel = this.getEnabledComponentLevelValue(carComponentId);
            return (enabledLevel >= level);
        },

        /**
         * Get whether a CarComponentLevel is currently active on a car.
         * Note: Level isn't required as the greatest unlocked level (i.e. the current enabled) will always be used.
         * @param carComponentId
         * @returns {boolean}
         */
        isActiveCarComponent(carComponentId) {
            let carComponent = this.carComponents[carComponentId];
            // TODO: Implement getActiveCar()
            if (!carComponent || !this.activeCar || !this.cars[this.activeCar] || !this.cars[this.activeCar].carComponents[carComponent.type]) {
                return false;
            }
            return (this.cars[this.activeCar].carComponents[carComponent.type].carComponentId === carComponentId);
        },

        /**
         * Get the CarComponentLevel currently active on the selected car for a given type
         * @param type
         * @returns {*}
         */
        getActiveCarComponentLevel(type)
        {
            let activeCarComponentIds = this.cars[this.activeCar].carComponents[type];
            if (!activeCarComponentIds) {
                return null;
            }
            return this.carComponents[activeCarComponentIds.carComponentId].carComponentLevels[activeCarComponentIds.level];
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
    }.init(),
}
