'use strict'; // eslint-disable-line

const path = require('path');
const CopyPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ESLintPlugin = require('eslint-webpack-plugin');
const StylelintPlugin = require('stylelint-webpack-plugin');


module.exports = {
	entry: ['./resources/scripts-main.js', './resources/styles-main.scss'],
	output: {
		filename: 'bundle.js',
		path: path.resolve(__dirname, 'assets'),
	},
	module: {
		rules: [
			{
				test:/\.s[ac]ss$/i,
				use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader']
			}
		]
	},
	plugins: [
		new CopyPlugin({
			patterns: [
				{ from: 'select2/dist', to: 'vendor/select2', context: 'node_modules' }
			]
		}),
		new MiniCssExtractPlugin({
			filename: 'bundle.css'
		}),
		new ESLintPlugin({
			context: path.resolve(__dirname, 'resources'),
		}),
		new StylelintPlugin({
			context: path.resolve(__dirname, 'resources'),
			formatter: 'verbose'
		}),
	],
};