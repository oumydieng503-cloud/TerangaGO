import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['DM Sans', ...defaultTheme.fontFamily.sans],
                display: ['Syne', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                sand: {
                    50: '#FAF7F2',
                    100: '#F3EDE3',
                    200: '#E8DDD0',
                },
                terracotta: {
                    DEFAULT: '#C45C26',
                    600: '#A84A1E',
                    700: '#8C3D18',
                },
                forest: {
                    DEFAULT: '#2D6A4F',
                    600: '#245A42',
                    700: '#1B4A36',
                },
                charcoal: '#1C1917',
            },
            boxShadow: {
                warm: '0 4px 24px -4px rgba(196, 92, 38, 0.12)',
                card: '0 2px 16px -2px rgba(28, 25, 23, 0.08)',
            },
        },
    },

    plugins: [forms],
};
