import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Models/**/*.php', 
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#C41E3A', // красный
                    dark: '#A01830',
                },
                secondary: {
                    DEFAULT: '#FCD116', // желтый
                    dark: '#E5BC14',
                },
                accent: {
                    DEFAULT: '#003DA5', // синий
                    dark: '#003090',
                }
            }
        }
    },

    plugins: [forms],
};
