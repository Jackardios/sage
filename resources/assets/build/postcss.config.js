/* eslint-disable */

const cssnanoConfig = {
  preset: ['default', { discardComments: { removeAll: true } }],
};

module.exports = ({ file, options }) => {
  return {
    parser: options.enabled.optimize ? 'postcss-safe-parser' : undefined,
    plugins: {
      tailwindcss: true,
      autoprefixer: options.enabled.optimize,
      cssnano: options.enabled.optimize ? cssnanoConfig : false,
    },
  };
};
