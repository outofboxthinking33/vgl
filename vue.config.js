// vue.config.js
module.exports = {
  filenameHashing: false,
  configureWebpack: {
    resolve: {
      alias: {
        'vue$': 'vue/dist/vue.esm.js'
      }
    }
  }
}