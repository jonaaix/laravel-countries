import { defineConfig } from 'vitepress'

export default defineConfig({
  title: 'aaix/laravel-countries',
  description: 'Modernized Laravel country-data package — idempotent seeders, zero-touch install, ergonomic API.',
  base: '/laravel-countries/',
  lastUpdated: true,
  cleanUrls: true,

  head: [
    ['link', { rel: 'icon', href: '/laravel-countries/logo.webp', type: 'image/webp' }],
    ['meta', { name: 'theme-color', content: '#0f172a' }],
    ['meta', { property: 'og:image', content: 'https://jonaaix.github.io/laravel-countries/logo.webp' }],
  ],

  themeConfig: {
    logo: '/logo.webp',
    siteTitle: 'Laravel Countries',
    nav: [
      { text: 'Install', link: '/install' },
      { text: 'Seeding', link: '/seeding' },
      { text: 'Usage', link: '/usage' },
      { text: 'GitHub', link: 'https://github.com/jonaaix/laravel-countries' },
    ],

    sidebar: [
      {
        text: 'Get Started',
        items: [
          { text: 'Introduction', link: '/' },
          { text: 'Install', link: '/install' },
          { text: 'Seeding', link: '/seeding' },
        ],
      },
      {
        text: 'Reference',
        items: [
          { text: 'Usage & API', link: '/usage' },
          { text: 'Data Model', link: '/data-model' },
        ],
      },
    ],

    socialLinks: [
      { icon: 'github', link: 'https://github.com/jonaaix/laravel-countries' },
    ],

    search: {
      provider: 'local',
    },

    footer: {
      message: 'Released under the MIT License.',
      copyright: 'Copyright © Lucas Duarte (original) · Jonas Gnioui (fork maintainer)',
    },

    editLink: {
      pattern: 'https://github.com/jonaaix/laravel-countries/edit/master/docs/:path',
      text: 'Edit this page on GitHub',
    },
  },
})
