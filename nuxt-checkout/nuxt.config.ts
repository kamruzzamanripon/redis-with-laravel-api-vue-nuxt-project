// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-04-03',
  devtools: { enabled: true },
  css: ['~/assets/css/main.css'],

  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },

  runtimeConfig: {
    public: {
      axiosBaseURL: process.env.AXIOS_BASE_URL,
    },
  },

  plugins: ['~/plugins/axios.js'],
  ssr:true,
  modules: [
    '@sandros94/nuxt-stripe'
  ],
  stripe: {
    publishableKey: 'pk_test_51LHvgpCpHBofOJFTPf5PvQrnc6BTDdkAXvBNGJCbuCOe35hdyMAPjCLB1xOvyEQYJTwXIhcH2NocXVBkupzThKiq00dPtGXCdh', // required
    clientOptions: {
      apiVersion: '2022-11-15', // optional, default is '2022-11-15'
      /** other stripe-js options */
    }
    
  }
  
})