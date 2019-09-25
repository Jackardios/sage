'use strict'; // eslint-disable-line

const { default: ImageminPlugin } = require('imagemin-webpack-plugin');
const imageminMozjpeg = require('imagemin-mozjpeg');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const glob = require('glob-all');
const PurgecssPlugin = require('purgecss-webpack-plugin');
const purgecssWordpress = require('purgecss-with-wordpress');

const config = require('./config');

class TailwindExtractor {
  static extract(content) {
    return content.match(/[A-z0-9-:\/]+/g) || [];
  }
}

module.exports = {
  plugins: [
    new ImageminPlugin({
      optipng: { optimizationLevel: 2 },
      gifsicle: { optimizationLevel: 3 },
      pngquant: { quality: '65-90', speed: 4 },
      svgo: {
        plugins: [
          { removeUnknownsAndDefaults: false },
          { cleanupIDs: false },
          { removeViewBox: false },
        ],
      },
      plugins: [imageminMozjpeg({ quality: 75 })],
      disable: config.enabled.watcher,
    }),
    new UglifyJsPlugin({
      uglifyOptions: {
        ecma: 5,
        output: {
          beautify: false,
          comments: false,
        },
        compress: {
          warnings: true,
          drop_console: true,
        },
      },
    }),
    new PurgecssPlugin({
      paths: glob.sync([
        'app/**/*.php',
        'resources/views/**/*.php',
        'resources/assets/scripts/**/*.js',
        'node_modules/slick-carousel/slick/slick.js',
      ]),
      extractors: [
        {
          extractor: TailwindExtractor,
          extensions: ['js', 'php'],
        },
      ],
      whitelist: purgecssWordpress.whitelist.concat([
        'fas',
        'fab',
        'far',
      ]),
      whitelistPatternsChildren: purgecssWordpress.whitelistPatterns.concat([
        /wp/,

        // libs
        /pswp/,
        /slick/,
        /^diamodal/,
        /^diacart/,

        // dynamic styles
        /^dynamic/,
        /^overflow/,
        /^content-modal/,
        /^wp-/,
        /^btn/,
        /^swiper/,
        /lazyload/,
        /in-view/,
        /active/,
        /focus/,

        //tailwind
        /overflow/,
        /text-gray/,
        /text-primary/,
        /text-secondary/,

        // font awesome
        /^fa-facebook/,
        /^fa-vk/,
        /^fa-telegram/,
        /^fa-whatsapp/,
        /^fa-viber/,
        /^fa-instagram/,
        /^fa-twitter/,
        /^fa-youtube/,
      ]),
    }),
  ],
};
