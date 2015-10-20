/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

import autoprefixer from 'autoprefixer';
import ExtractTextPlugin from 'extract-text-webpack-plugin';
import webpack from 'webpack';

import pkg from './package.json';

const SOURCE_PATH = './Resources/public',
  BUILD_PATH = './../../../../web',
  LICENSE =
`${pkg.name} - ${pkg.description}
Authors: ${pkg.authors[0].name} - ${pkg.authors[1].name}
Url: ${pkg.homepage}
License: ${pkg.license}`,
  config = {
    debug: false,
    devtool: 'eval',
    context: __dirname,
    entry: {
      app: `${SOURCE_PATH}/js/Kreta.js`,
      login: `${SOURCE_PATH}/js/Login.js`,
      vendors: [
        'backbone',
        'backbone-model-file-upload',
        'backbone.marionette',
        'classnames',
        'jquery',
        'lodash',
        'mousetrap',
        'react',
        'react-dom',
        'react-router'
      ]
    },
    output: {
      path: `${BUILD_PATH}/js`, filename: '[name].js'
    },
    module: {
      preLoaders: [
        {test: /\.js$/, exclude: /node_modules/, loaders: ['eslint']}
      ],
      loaders: [
        {test: /\.js$/, exclude: /node_modules/, loaders: ['babel']},
        {test: /\.(jpe?g|png|gif|ico)$/, loader: 'file?name=../images/[hash].[ext]'},
        {test: /\.svg$/, loader: 'svg-sprite?name=[name]_[hash].svg'},
        {test: /\.scss$/, loader: ExtractTextPlugin.extract(
          'style', 'css!postcss!sass?outputStyle=expanded&sourceComments=true'
        )}
      ]
    },
    resolve: {
      alias: {underscore: 'lodash'}
    },
    eslint: {configFile: '.eslint.yml'},
    postcss: [autoprefixer()],
    plugins: [
      new webpack.optimize.CommonsChunkPlugin('vendors', 'vendor.js'),
      new ExtractTextPlugin('../css/[name].css', {allChunks: false}),
      new webpack.BannerPlugin(LICENSE)
    ]
  };

if (process.env.NODE_ENV === 'production') {
  config.debug = false;
  config.devtool = 'source-map';
  config.plugins.push(new webpack.optimize.UglifyJsPlugin());
  config.module.loaders.push(
    {test: /\.css$/, loader: 'style-loader/useable!css-loader?minimize!postcss-loader'}
  );
}

export default config;
