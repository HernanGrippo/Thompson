const path = require("path");
const Webpack = require("webpack");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CopyPlugin = require("copy-webpack-plugin");
const HandlebarsPlugin = require("handlebars-webpack-plugin");
const globalContent = require("./src/globalContent.js");

module.exports = (options) => {
  const dist = path.resolve(__dirname, "../public");

  let webpackConfig = {
    devtool: options.devtool,
    entry: {
      frontend: [
        "./src/assets/scripts/frontend.js",
        "./src/assets/styles/frontend.scss",
      ],
      backend: [
        "./src/assets/scripts/backend.js",
        "./src/assets/styles/backend.scss",
      ],
    },
    output: {
      path: dist,
      filename: !options.isProduction
        ? "./assets/scripts/[name].js"
        : "./assets/scripts/[name].[hash].js",
    },
    module: {
      rules: [
        {
          test: /\.js$/,
          include: /node_modules/,
          loader: "babel-loader",
          options: {
            presets: ["@babel/preset-env"],
          },
        },
        {
          test: /\.hbs$/,
          loader: "handlebars-loader",
        },
        {
          test: /\.scss$/i,
          use: [
            {
              loader: MiniCssExtractPlugin.loader,
              options: {},
            },
            "css-loader",
            "sass-loader",
          ],
        },
        {
          test: /\.css$/i,
          use: [
            {
              loader: MiniCssExtractPlugin.loader,
              options: {
                hmr: !options.isProduction,
                reloadAll: true,
              },
            },
            "css-loader",
          ],
        },
				{
					test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
					exclude: path.join(__dirname, "src", "assets/images"),
					use: [
						{
							loader: "file-loader",
							options: {
								name: "[name].[ext]",
                outputPath: 'assets/fonts',
                publicPath: '../../assets/fonts',
							},
						},
					],
				},
				{
					test: /\.(gif|jpg|png|svg)$/,
					exclude: path.join(__dirname, "src", "assets/fonts"),
					use: [
						{
							loader: "file-loader",
							options: {
								name: "[name].[ext]",
                outputPath: 'assets/images',
                publicPath: '../../assets/images',
							},
						},
					],
				},
      ],
    },
    resolve: {
      alias: {
        "@": path.resolve(__dirname, "src"),
      },
      extensions: [".ts", ".js"],
    },
    plugins: [
			new Webpack.ProvidePlugin({
				$: "jquery",
				jQuery: "jquery",
				"window.jQuery": "jquery",
				Tether: "tether",
				"window.Tether": "tether",
				Popper: ["popper.js", "default"],
			}),
      new CopyPlugin({
        patterns: [
          { from: "./src/assets/images", to: "./assets/images" },
          { from: "./src/assets/fonts", to: "./assets/fonts" },
          { from: "./src/assets/videos", to: "./assets/videos" },
        ],
      }),
      new CleanWebpackPlugin(),
      new MiniCssExtractPlugin({
        filename: !options.isProduction
          ? "./assets/styles/[name].css"
          : "./assets/styles/[name].[hash].css",
      }),
      new HandlebarsPlugin({
        entry: path.join(process.cwd(), "src", "pages", "*", "*.hbs"),
        output: path.join(dist, "[name].html"),
        partials: [
          path.join(process.cwd(), "src", "layouts", "**", "*.hbs"),
          path.join(process.cwd(), "src", "components", "**", "*.hbs"),
        ],
        helpers: {
          nameOfHbsHelper: Function.prototype,
          projectHelpers: path.join(process.cwd(), "src", "helpers", "*.js")
        },
        data: { global: globalContent },
      }),
    ],
    optimization: {
      splitChunks: {
        cacheGroups: {},
      },
    },
  };

  return webpackConfig;
};
