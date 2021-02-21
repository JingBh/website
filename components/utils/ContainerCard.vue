<template>
  <div class="container-card shadow">
    <h2 class="container-card-title fw-light text-center mt-2">
      <up-and-down-arrow />
      {{ title }}
    </h2>
    <div class="mt-4">
      <slot />
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue, Prop } from 'nuxt-property-decorator'

import UpAndDownArrow from './UpAndDownArrow.vue'

@Component({
  components: {
    UpAndDownArrow
  }
})
export default class ContainerCard extends Vue {
  @Prop(String) readonly title!: string
}
</script>

<style>
  .container-card {
    background-color: rgba(255, 255, 255, 0.47);
    border-radius: 1.5rem;
    padding: 1rem;
  }
</style>
