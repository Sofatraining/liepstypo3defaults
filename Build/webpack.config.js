const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const { WebpackManifestPlugin } = require('webpack-manifest-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

const TYPO3_PATH = '../';
const RESOURCES_PATH = path.resolve(__dirname, TYPO3_PATH, 'Resources');
const DIST_PATH = path.resolve(RESOURCES_PATH, 'Public/Dist');

module.exports = (env, argv) => {
  const isDev = argv.mode === 'development';
  return {    entry: {
      main: [
        path.resolve(RESOURCES_PATH, 'Private/Scss/layout.scss'),
        path.resolve(RESOURCES_PATH, 'Public/JS/Src/main.js')
      ],
      custom: path.resolve(RESOURCES_PATH, 'Public/JS/custom.js')
    },
    output: {
      path: DIST_PATH,
      filename: 'js/[name].[contenthash:8].js',
      publicPath: '/typo3conf/ext/liepstypo3defaults/Resources/Public/Dist/',
      clean: true
    },
    devtool: isDev ? 'eval-source-map' : false,
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
        },
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
                    isDev ? null : 'cssnano'
                  ].filter(Boolean)
                }
              }
            },
            'sass-loader'
          ]
        },
        {
          test: /\.(woff|woff2|eot|ttf|otf)$/i,
          type: 'asset/resource',
          generator: {
            filename: 'fonts/[name].[hash:8][ext]'
          }
        },
        {
          test: /\.(png|svg|jpg|jpeg|gif)$/i,
          type: 'asset/resource',
          generator: {
            filename: 'images/[name].[hash:8][ext]'
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
      ],
      splitChunks: {
        cacheGroups: {
          vendor: {
            test: /[\\/]node_modules[\\/]/,
            name: 'vendors',
            chunks: 'all'
          }
        }
      }
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: 'css/[name].[contenthash:8].css'
      }),
      new CopyPlugin({
        patterns: [
          {
            from: path.resolve(RESOURCES_PATH, 'Public/Images'),
            to: path.resolve(DIST_PATH, 'images'),
            noErrorOnMissing: true
          }
        ]
      }),
      new WebpackManifestPlugin({
        fileName: 'asset-manifest.json'
      }),
      ...(isDev ? [
        new BrowserSyncPlugin({
          host: 'localhost',
          port: 3000,
          proxy: 'https://your-typo3-site.local',          files: [
            '../Resources/Private/**/*.html',
            '../Resources/Public/Css/**/*.css',
            '../Resources/Public/JS/**/*.js'
          ],
          notify: false
        })
      ] : [])
    ]
  };
};
