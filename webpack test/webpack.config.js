module.exports = {
  //メインとなるjsファイル
  entry: `./src/index.js`,

  //ファイルの出力設定
  output: {
    //出力ファイルのディレクトリ名
    path: `${__dirname}/dist`,
    //出力ファイル名
    filename: "main.js"
  },

  //開発時にはdevelopment、公開時にはproduction
  mode: "development"
};