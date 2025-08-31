import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'dark-green': {
                    50: '#f0f9f4',
                    100: '#dcf2e3',
                    200: '#bbe5cc',
                    300: '#8dd1a8',
                    400: '#5bb57e',
                    500: '#3d9a5f',
                    600: '#2f7c4c',
                    700: '#2a623f',
                    800: '#254e35',
                    900: '#1f412d',
                    950: '#0f2316',
                },
                'dark-bg': {
                    50: '#f8f9fa',
                    100: '#f1f3f4',
                    200: '#e8eaed',
                    300: '#dadce0',
                    400: '#bdc1c6',
                    500: '#9aa0a6',
                    600: '#80868b',
                    700: '#5f6368',
                    800: '#3c4043',
                    900: '#202124',
                    950: '#0f1012',
                }
            },
        },
    },

    plugins: [forms],
};
