/* eslint-disable */
const path = require('path');
const config = require('./config');
const cssnanoConfig = {
  preset: ['default', { discardComments: { removeAll: true } }],
};

module.exports = ({ file, options }) => {
  return {
    parser: options.enabled.optimize ? 'postcss-safe-parser' : undefined,
    plugins: {
      cssnano: options.enabled.optimize ? cssnanoConfig : false,
      autoprefixer: options.enabled.optimize,
      'css-mqpacker': options.enabled.optimize ? { sort: true } : false,
      'postcss-flexbugs-fixes': options.enabled.optimize,
      tailwindcss: path.join(config.paths.assets, 'build/tailwind.js'),
    },
  };
};
