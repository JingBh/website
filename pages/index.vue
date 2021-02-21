<template>
  <div id="container">
    <avatar-container />
    <intro-container />
    <skills-card />
    <timeline-card />
    <footer-container />
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'nuxt-property-decorator'

import AvatarContainer from '~/components/AvatarContainer.vue'
import IntroContainer from '~/components/IntroContainer.vue'
import SkillsCard from '~/components/SkillsCard.vue'
import TimelineCard from '~/components/TimelineCard.vue'
import FooterContainer from '~/components/FooterContainer.vue'

@Component({
  components: {
    AvatarContainer,
    IntroContainer,
    SkillsCard,
    TimelineCard,
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
