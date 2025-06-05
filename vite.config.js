import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import fs from 'fs';

export default defineConfig(({ mode }) => ({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/css/app.css'],
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
    ...(mode === 'development' && {
        server: {
            host: true,
            port: 3000,
            hmr: {
                host: 'personal-site.tisherd.local',
            },
            // https: {
            //     key: fs.readFileSync('./docker/nginx/ssl/l11.tisherd.local.key'),
            //     cert: fs.readFileSync('./docker/nginx/ssl/l11.tisherd.local.pem'),
            // },
        },
    }),
}));
