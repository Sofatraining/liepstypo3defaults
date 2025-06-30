const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const TYPO3_PATH = '../';
const RESOURCES_PATH = path.resolve(__dirname, TYPO3_PATH, 'Resources');
const DIST_PATH = path.resolve(RESOURCES_PATH, 'Public/Dist');

module.exports = (env, argv) => {
  const isDev = argv.mode === 'development';
  
  return {
    entry: {
      layout: path.resolve(RESOURCES_PATH, 'Private/Scss/layout.scss'),
      liepstypo3defaults: path.resolve(RESOURCES_PATH, 'Public/Css/liepstypo3defaults.css')
    },
    output: {
      path: DIST_PATH,
      filename: 'js/[name].[contenthash:8].js', // Wird nicht genutzt, ist aber erforderlich
      publicPath: '/typo3conf/ext/liepstypo3defaults/Resources/Public/Dist/'
    },
    module: {
      rules: [
        {
          test: /\.(sa|sc|c)ss$/,
          use: [
            MiniCssExtractPlugin.loader,
            'css-loader',
            {
              loader: 'postcss-loader',
              options: {
                postcssOptions: {
                  plugins: [
                    'autoprefixer',
                    ['cssnano', {
                      preset: ['default', {
                        discardComments: { removeAll: true },
                        normalizeWhitespace: !isDev
                      }]
                    }]
                  ]
                }
              }
            },
            'sass-loader'
          ]
        }
      ]
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: 'css/[name].[contenthash:8].css'
      })
    ]
  };
};
