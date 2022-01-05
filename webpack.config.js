const path = require('path');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const CopyWebpackPlugin = require('copy-webpack-plugin');
const imageminMozjpeg = require('imagemin-mozjpeg');

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
        modules: [
            "node_modules",
        ],
    },
    plugins: [
        new CopyWebpackPlugin({
            patterns: [
                {
                    from: 'resources/images',
                    to: 'images',
                },
            ],
        }),
        new ImageminPlugin({
            test: /\.(jpe?g|png|gif|svg)$/i,
            plugins: [
                imageminMozjpeg({
                    quality: 80,
                }),
            ],
        }),
    ],
};
