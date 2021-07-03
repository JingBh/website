import { NuxtConfig } from '@nuxt/types'

const config: NuxtConfig = {
  // Server-side rendering: https://go.nuxtjs.dev/ssr-mode
  ssr: true,

  // Target: https://go.nuxtjs.dev/config-target
  target: 'static',

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { hid: 'viewport', name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'theme-color', name: 'theme-color', content: '#213570' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    'bootstrap-icons/font/bootstrap-icons.css',
    'devicon/devicon.min.css',
    'tippy.js/dist/tippy.css',
    'tippy.js/animations/shift-away.css',
    '~/assets/scss/app.scss'
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
  ],

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/typescript
    '@nuxt/typescript-build'
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // Internationalization module (https://i18n.nuxtjs.org/)
    'nuxt-i18n'
  ],

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  },

  // Internationalization module configuration (https://i18n.nuxtjs.org/options-reference)
  i18n: {
    locales: [
      { code: 'zh', name: '🇨🇳 简体中文', iso: 'zh-CN', file: 'zh.json' },
      { code: 'en', name: '🇺🇸 English', iso: 'en', file: 'en.json' },
      { code: 'xi', name: '🇨🇳 Xiglish', file: 'xi.json' } // Xiglish - a custom language
    ],
    defaultLocale: 'zh',
    defaultDirection: 'ltr',
    lazy: true,
    langDir: 'locales/',
    detectBrowserLanguage: {
      onlyOnNoPrefix: true,
      cookieCrossOrigin: true
    },
    vuex: false,
    vueI18n: {
      fallbackLocale: 'zh'
    }
  }
}

export default config
