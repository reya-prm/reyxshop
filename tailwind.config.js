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
            colors: {
                coral: {
                    DEFAULT: '#E8442A',
                    hover: '#CF3A21',
                },
                charcoal: '#111827',
                ash: '#F4F5F7',
                slate: '#6B7280',
                border: '#E5E7EB',
            },
            fontFamily: {
                sans: ['Plus Jakarta Sans', 'Inter', ...defaultTheme.fontFamily.sans],
            },
            borderRadius: {
                'card': '14px',
                'pill': '9999px',
            },
            boxShadow: {
                'floating': '0 10px 25px -5px rgba(0,0,0,0.08)',
                'hover': '0 20px 30px -10px rgba(0,0,0,0.12)',
            },
        },
    },

    plugins: [forms],
};
