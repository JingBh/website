<template>
  <div id="appContainer">
    <avatar-container />
    <intro-container />
    <info-card />
    <timeline-card />
    <footer-container />
  </div>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'

import AvatarContainer from './components/AvatarContainer.vue'
import IntroContainer from './components/IntroContainer.vue'
import InfoCard from './components/SkillsCard.vue'
import TimelineCard from './components/TimelineCard.vue'
import FooterContainer from './components/FooterContainer.vue'

@Options({
  components: {
    AvatarContainer,
    IntroContainer,
    InfoCard,
    TimelineCard,
    FooterContainer
  }
})
export default class App extends Vue {
}
</script>
