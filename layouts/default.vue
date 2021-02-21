<template>
  <nuxt />
</template>

<script>
export default {
  head () {
    return {
      title: this.$t('title'),
      htmlAttrs: {
        lang: this.$i18n.locale
      },
      meta: [
        { hid: 'description', name: 'description', content: this.$t('description') }
      ]
    }
  }
}
</script>
