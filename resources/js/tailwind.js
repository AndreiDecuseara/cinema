import resolveConfig from 'tailwindcss/resolveConfig';
import tailwindConfig from '../../tailwind.config'; // Fix the path

const fullConfig = resolveConfig(tailwindConfig);

const screens = Object.fromEntries(Object.entries(fullConfig.theme.screens).filter(([key, item]) => typeof item === 'string'));

window.Tailwind = new function () {
    this.getScreens = () => ({xs: '1px', ...screens});

    this.getBreakpointValue = (value) => {
        return parseInt(this.getScreens()[value].slice(0, this.getScreens()[value].indexOf('px')));
    };

    this.getBreakpointOject = (breakpoint) => ({
        breakpoint: breakpoint,
        value: this.getBreakpointValue(breakpoint)
    });

    this.getCurrentBreakpoint = () => {
        let currentBreakpoint;
        let biggestBreakpointValue = 0;

        for (const breakpoint of Object.keys(this.getScreens())) {
            const breakpointValue = this.getBreakpointValue(breakpoint);

            if (breakpointValue > biggestBreakpointValue && window.innerWidth >= breakpointValue) {
                biggestBreakpointValue = breakpointValue;
                currentBreakpoint = breakpoint;
            }
        }
        return currentBreakpoint;
    };

    this.currentBreakpointIsGreaterThanOrEqualTo = (comparedBreakpoint) => {
        let current = this.getBreakpointOject(this.getCurrentBreakpoint());
        let compared = this.getBreakpointOject(comparedBreakpoint);

        return current.value >= compared.value;
    };

    this.currentBreakpointIsGreaterThan = (comparedBreakpoint) => {
        let current = this.getBreakpointOject(this.getCurrentBreakpoint());
        let compared = this.getBreakpointOject(comparedBreakpoint);

        return current.value > compared.value;
    };

    this.currentBreakpointIsLessThanOrEqualTo = (comparedBreakpoint) => {
        let current = this.getBreakpointOject(this.getCurrentBreakpoint());
        let compared = this.getBreakpointOject(comparedBreakpoint);

        return current.value <= compared.value;
    };

    this.currentBreakpointIsLessThan = (comparedBreakpoint) => {
        let current = this.getBreakpointOject(this.getCurrentBreakpoint());
        let compared = this.getBreakpointOject(comparedBreakpoint);


        return current.value < compared.value;
    };
};

window.tailwindAlpineData = () => ({
    tailwind: {
        currentBreakpoint: (Tailwind !== undefined ? Tailwind.getCurrentBreakpoint() : null),
        currentBreakpointIsGreaterThanOrEqualTo: Tailwind.currentBreakpointIsGreaterThanOrEqualTo,
        currentBreakpointIsGreaterThan: Tailwind.currentBreakpointIsGreaterThan,

        currentBreakpointIsLessThanOrEqualTo: Tailwind.currentBreakpointIsLessThanOrEqualTo,
        currentBreakpointIsLessThan: Tailwind.currentBreakpointIsLessThan
    }
})