import { defineConfig } from 'vite';
import path from "path";
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/website.scss',
                'resources/js/third-party/alpinejs.ts',
                'resources/js/app.ts',
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
