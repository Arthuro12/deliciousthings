import { defineConfig } from 'vite';
import path from "path";
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/styles.css', 
                'resources/css/website.scss',
                'resources/css/pages/home.scss',
                'resources/css/pages/landing.scss',
                'resources/css/pages/newsletter-confirmed.scss',
                'resources/css/platform.scss',
                'resources/js/third-party/alpinejs.ts',
                'resources/js/platform/app.ts',
            ],
            refresh: true,
        }),
        tailwindcss(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            "@css": path.resolve(__dirname, "./resources/css"),
        },
    }
});
