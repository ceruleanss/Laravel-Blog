import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    safelist: [
        // Category Badge Backgrounds and Text
        'bg-blue-100', 'text-blue-800', 'border-blue-300', 'hover:bg-blue-200', 'dark:bg-blue-900/40', 'dark:text-blue-300',
        'bg-purple-100', 'text-purple-800', 'border-purple-300', 'hover:bg-purple-200', 'dark:bg-purple-900/40', 'dark:text-purple-300',
        'bg-emerald-100', 'text-emerald-800', 'border-emerald-300', 'hover:bg-emerald-200', 'dark:bg-emerald-900/40', 'dark:text-emerald-300',
        'bg-amber-100', 'text-amber-800', 'border-amber-300', 'hover:bg-amber-200', 'dark:bg-amber-900/40', 'dark:text-amber-300',
        'bg-rose-100', 'text-rose-800', 'border-rose-300', 'hover:bg-rose-200', 'dark:bg-rose-900/40', 'dark:text-rose-300',
        'bg-green-100', 'text-green-800', 'border-green-300', 'hover:bg-green-200', 'dark:bg-green-900/40', 'dark:text-green-300',
        'bg-red-100', 'text-red-800', 'border-red-300', 'hover:bg-red-200', 'dark:bg-red-900/40', 'dark:text-red-300',
        'bg-indigo-100', 'text-indigo-800', 'border-indigo-300', 'hover:bg-indigo-200', 'dark:bg-indigo-900/40', 'dark:text-indigo-300',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
