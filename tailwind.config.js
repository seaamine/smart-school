const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './resources/js/**/*.js',

    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    100: '#7367f01f',
                    200: '#9e95f5',
                    500: '#7367f0',
                    600: '#5e50ee',
                    800: '#4839eb',
                },
                secondary: {
                    200: '#9ca0a4',
                    500: '#82868b',
                    800: '#696d71',
                },
                success: {
                    200: '#48da89',
                    500: '#28c76f',
                    800: '#1f9d57',
                },
                warning: {
                    200: '#ffb976',
                    500: '#ff9f43',
                    800: '#ff8510',
                },
                danger: {
                    200: '#f08182',
                    500: '#ea5455',
                    800: '#e42728',
                },
                info: {
                    200: '#1ce7ff',
                    500: '#00cfe8',
                    800: '#00a1b5',
                },
                complementary: {
                    50: '#d6f5f4',
                    100: '#96e7e0',
                    200: '#26d7cb',
                    300: '#00c4b4',
                    400: '#00b4a1',
                    500: '#00a48e',
                    600: '#009780',
                    700: '#00866f',
                    800: '#00765f',
                    900: '#005840'
                }
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            boxShadow:{
                csh1: '0 14px 15px 0 rgb(34 41 47 / 5%)',
                csh2: '0 4px 24px 0 rgb(34 41 47 / 10%)',
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            backgroundColor: ['active'],
            textColor: ['active'],
            backgroundOpacity: ['active'],
            ringWidth: ['hover', 'active'],
            ringColor: ['hover', 'active'],
            ringOpacity: ['hover', 'active'],

        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
