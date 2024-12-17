import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),

    ],
    server: {
        host: true,  // Включает прослушивание на всех интерфейсах
        port: 3000,
        hmr: {
            host: 'localhost', // Или ваш IP-адрес, если нужно
        },
    },
});
