const path = require('path');
const TerserPlugin = require('terser-webpack-plugin');

const TYPO3_PATH = '../';
const RESOURCES_PATH = path.resolve(__dirname, TYPO3_PATH, 'Resources');
const DIST_PATH = path.resolve(RESOURCES_PATH, 'Public/Dist');

module.exports = (env, argv) => {
  const isDev = argv.mode === 'development';
  
  return {
    entry: {
      main: path.resolve(RESOURCES_PATH, 'Public/JS/Src/main.js'),
      custom: path.resolve(RESOURCES_PATH, 'Public/JS/custom.js'),
      navigation: path.resolve(RESOURCES_PATH, 'Public/JS/mainnavigation-canvas-from-left-01.js')
    },
    output: {
      path: DIST_PATH,
      filename: 'js/[name].[contenthash:8].js',
      publicPath: '/typo3conf/ext/liepstypo3defaults/Resources/Public/Dist/'
    },
    module: {
      rules: [
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: ['@babel/preset-env']
            }
          }
        }
      ]
    },
    optimization: {
      minimize: !isDev,
      minimizer: [
        new TerserPlugin({
          terserOptions: {
            format: {
              comments: false,
            },
            compress: {
              drop_console: !isDev
            }
          },
          extractComments: false
        })
      ]
    }
  };
};
