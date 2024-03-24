import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import scrollbar from 'tailwind-scrollbar';
import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            transitionProperty: {
                'width': 'width'
            },
            listStyleType: {
                // none: 'none',
                // disc: 'disc',
                // decimal: 'decimal',
                square: 'square',
                // roman: 'upper-roman',
            },
            colors: {
                paper: {
                    light: '#FBFCFF',
                    DEFAULT: '#FBFCFF',
                    dark: '#FBFCFF'
                },
                brand: {
                    50: '#D4EFFF',
                    200: '#95CFFF',
                    300: '#5FB7FF',
                    400: '#42A0ED',
                    500: '#0161FE',
                    600: '#1F54A3',
                    700: '#103772',
                    800: '#0C244A',
                    900: '#04152F',
                    DEFAULT: '#42A0ED'
                }
            },
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
                raleway: ['Raleway', ...defaultTheme.fontFamily.sans],
                sora: ['Sora', ...defaultTheme.fontFamily.sans],
                poppins: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, typography, scrollbar],
};
