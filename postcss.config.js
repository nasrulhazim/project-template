const path = require('node:path');

module.exports = {
    resolve: {
        alias: {
            'tailwind.config.js': path.resolve(__dirname, 'tailwind.config.js'),
        },
    },
    optimizeDeps: {
        include: [
            path.resolve(__dirname, 'tailwind.config.js'),
        ]
    },
    plugins: {
        tailwindcss: {},
        autoprefixer: {},
    },
}
