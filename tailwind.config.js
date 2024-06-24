import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
        'custom-background': '#e4efeb', // Replace with your desired background color
        'custom-text': '#02241d', // Replace with your desired text color
      },
      fontFamily: {
        'kufam': ['Kufam', 'sans-serif'],
      },
        },
    },

    plugins: [forms],
};
