/**
 * Очистка папки итоговой сборки (output.path)
 */
const HtmlWebpackPlugin = require('html-webpack-plugin');

const path = require('path');
/* eslint-enable */
const isProduction = process.env.NODE_ENV === 'production';

module.exports = {
  transpileDependencies: [
    'vuetify',
  ],

  devServer: {
    proxy: 'http://0.0.0.0',
  },
  productionSourceMap: false,
  outputDir: '../public',

  indexPath: '../resources/views/app.blade.php',

  configureWebpack: {
    devtool: isProduction ? false : 'inline-source-map',
    resolve: {
      alias: {
        '@': path.resolve(__dirname, './src'),
        Api: path.resolve(__dirname, './src/api'),
        Classes: path.resolve(__dirname, './src/classes'),
        Components: path.resolve(__dirname, './src/components'),
        Constants: path.resolve(__dirname, './src/constants'),
        UserComponents: path.resolve(__dirname, './src/components/auth/user'),
        Exceptions: path.resolve(__dirname, './src/exceptions'),
        Helpers: path.resolve(__dirname, './src/helpers'),
        Mixins: path.resolve(__dirname, './src/mixins'),
        Plugins: path.resolve(__dirname, './src/plugins'),
        Router: path.resolve(__dirname, './src/router'),
        Rules: path.resolve(__dirname, './src/rules'),
        Store: path.resolve(__dirname, './src/store'),
        Types: path.resolve(__dirname, './src/types'),
        Views: path.resolve(__dirname, './src/views'),
      },
    },

    plugins: [
      new HtmlWebpackPlugin({
        template: './src/assets/index.html',
        minify: {
          collapseWhitespace: isProduction,
        },
      }),
    ],
  },
};
