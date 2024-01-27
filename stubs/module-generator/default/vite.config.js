import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        outDir: '../../public/build-{module}',
        emptyOutDir: true,
        manifest: true,
    },
    plugins: [
        laravel({
            publicDirectory: '../../public',
            buildDirectory: 'build-{module}',
            input: [
                __dirname + '/resources/sass/app.scss',
                __dirname + '/resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});

//export const paths = [
//    'Modules/{module}/resources/sass/app.scss',
//    'Modules/{module}/resources/js/app.js',
//];