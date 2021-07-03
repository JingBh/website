<template>
  <div id="container">
    <switch-language />
    <avatar-container />
    <intro-container />
    <skills-card />
    <footer-container />
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'nuxt-property-decorator'

import SwitchLanguage from '~/components/SwitchLanguage.vue'
import AvatarContainer from '~/components/AvatarContainer.vue'
import IntroContainer from '~/components/IntroContainer.vue'
import SkillsCard from '~/components/SkillsCard.vue'
import FooterContainer from '~/components/FooterContainer.vue'

@Component({
  components: {
    SwitchLanguage,
    AvatarContainer,
    IntroContainer,
    SkillsCard,
    FooterContainer
  }
})
export default class IndexPage extends Vue {
}
</script>

<style>
  #container {
    min-height: 100vh;
    position: relative;
  }
</style>
