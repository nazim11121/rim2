import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/frontend.css',
                'resources/js/booking/main.jsx',
            ],
            refresh: true,
        }),
        // Scoped to the booking widget entry only (via RefreshRegex) so the
        // React Fast Refresh preamble never loads on Blade/jQuery/Kaiadmin
        // pages that don't use it.
        react({ include: /booking\/.*\.jsx$/ }),
    ],
});
