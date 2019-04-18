/* eslint-disable */
const tailwindcssConfig = require('../../../tailwind');
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
      tailwindcss: tailwindcssConfig,
    },
  };
};
