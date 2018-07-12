const path = require('path');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
  entry: ['./resources/js/index.js', './resources/sass/index.scss'],
  mode: 'development',
  output: {
    filename: 'app.js',
    path: path.resolve(__dirname, 'public/assets')
  },
  module: {
    rules: [{
      test: /\.(scss|sass)$/,
      loader: ExtractTextPlugin.extract(['css-loader', 'sass-loader'])
    }]
  },
  plugins: [
    new ExtractTextPlugin({
      filename: 'app.css',
      allChunks: true,
    })
  ]
}
