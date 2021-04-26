const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#ffebef',
                    100: '#ffccd3',
                    200: '#f1999c',
                    300: '#e87175',
                    400: '#f34e53',
                    500: '#f83b39',
                    600: '#e93138',
                    700: '#d72632',
                    800: '#ca1e2b',
                    900: '#bb0c1e'
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
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
