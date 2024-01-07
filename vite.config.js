import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import flowbitePlugin from 'flowbite/plugin';

export default defineConfig({
    plugins: [
        flowbitePlugin({
            charts: true,
        }),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
