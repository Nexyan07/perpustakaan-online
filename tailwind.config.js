import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['InterVariable', ...defaultTheme.fontFamily.sans],
                body: [
                    'Inter', 
                    'ui-sans-serif', 
                    'system-ui', 
                    '-apple-system', 
                    'system-ui', 
                    'Segoe UI', 
                    'Roboto', 
                    'Helvetica Neue', 
                    'Arial', 
                    'Noto Sans', 
                    'sans-serif', 
                    'Apple Color Emoji', 
                    'Segoe UI Emoji', 
                    'Segoe UI Symbol', 
                    'Noto Color Emoji'
                    ],
                sans: [
                    'Inter', 
                    'ui-sans-serif', 
                    'system-ui', 
                    '-apple-system', 
                    'system-ui', 
                    'Segoe UI', 
                    'Roboto', 
                    'Helvetica Neue', 
                    'Arial', 
                    'Noto Sans', 
                    'sans-serif', 
                    'Apple Color Emoji', 
                    'Segoe UI Emoji', 
                    'Segoe UI Symbol', 
                    'Noto Color Emoji'
                    ],
            },
            colors: {
                primary: {"50":"#eff6ff","100":"#dbeafe","200":"#bfdbfe","300":"#93c5fd","400":"#60a5fa","500":"#3b82f6","600":"#2563eb","700":"#1d4ed8","800":"#1e40af","900":"#1e3a8a","950":"#172554"}
              },
            fontSize: {
                'h1-responsive': 'clamp(1.5rem, calc(7vw + 1rem), 5rem)',
                'h2-responsive': 'clamp(1.25rem, calc(6vw + 0.75rem), 4rem)',
                'h3-responsive': 'clamp(1rem, calc(5vw + 0.5rem), 3rem)',
                'h4-responsive': 'clamp(0.875rem, calc(4vw + 0.375rem), 2.5rem)',
                'h5-responsive': 'clamp(0.75rem, calc(3vw + 0.25rem), 2rem)',
                'h6-responsive': 'clamp(0.625rem, calc(2vw + 0.125rem), 1.5rem)',
            },
        },
    },
    plugins: [
        require('flowbite/plugin'),
        require('tailwind-scrollbar'),
    ],
    safelist: ["bg-red-500", "bg-green-500", "bg-blue-500", "bg-yellow-500", "bg-indigo-500", "bg-purple-500", "bg-pink-500", "bg-gray-500", "bg-orange-500"]
};
