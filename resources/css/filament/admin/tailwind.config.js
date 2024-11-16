import preset from "../../../../vendor/filament/filament/tailwind.config.preset";

export default {
    presets: [preset],
    content: [
        "./app/Filament/**/*.php",
        "./resources/views/filament/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        './vendor/awcodes/filament-table-repeater/resources/**/*.blade.php',

    ],
    theme: {
        extend: {
            colors: {
                white: '#F3F4F6',
                platinum: '#E8E9EB',
                secondary: {
                    50: "rgba(var(--secondary-50), <alpha-value>)",
                    100: "rgba(var(--secondary-100), <alpha-value>)",
                    200: "rgba(var(--secondary-200), <alpha-value>)",
                    300: "rgba(var(--secondary-300), <alpha-value>)",
                    400: "rgba(var(--secondary-400), <alpha-value>)",
                    500: "rgba(var(--secondary-500), <alpha-value>)",
                    600: "rgba(var(--secondary-600), <alpha-value>)",
                    700: "rgba(var(--secondary-700), <alpha-value>)",
                    800: "rgba(var(--secondary-800), <alpha-value>)",
                    900: "rgba(var(--secondary-900), <alpha-value>)",
                },
                transitionTimingFunction: {
                    'ease-smooth': 'cubic-bezier(0.08, 0.52, 0.52, 1)',
                }
            },
        },
    },
};
