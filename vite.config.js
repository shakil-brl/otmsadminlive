import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import compression from 'vite-plugin-compression';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        compression({
            ext: '.gz', // Extension of compressed files
            threshold: 10240, // Minimum file size to compress (in bytes), adjust as needed
            algorithm: 'gzip', // Compression algorithm ('gzip', 'brotli', or 'deflate')
        }),
    ],
});
