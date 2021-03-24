const path = require('path');

module.exports = {
    mode: 'development',
    entry: ['./js/index.js', './scss/styles.scss'],
    devServer: {
        contentBase: __dirname,
        publicPath: '/dist/',
        port: 8080,
        host: '0.0.0.0',
        hot: true,
        disableHostCheck: true
    },
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, 'dist'),
    },

    // This packages the sass into a single CSS file called 'styles css' in the dist folder
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: [],
            },
            {
                
                test: /\.s[ac]ss$/i,
                exclude: /node_modules/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {outputPath: '../css/', name: 'newstyles.css'}
                    },
                    'sass-loader'
                ],
              },
        ],
    },
};