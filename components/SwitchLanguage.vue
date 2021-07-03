<template>
  <span ref="chip" class="chip switcher shadow-sm">
    <i class="bi bi-translate" />
    {{ $t('languages') }}
    <i class="bi bi-caret-down-fill" />
    <div class="chip-details">
      <div class="list-group">
        <nuxt-link
          v-for="locale in locales"
          :key="locale.code"
          :to="switchLocalePath(locale.code)"
          class="list-group-item list-group-item-action"
          exact
          active-class="active"
        >
          {{ locale.name }}
          <span class="check" style="display: none">✓</span>
        </nuxt-link>
      </div>
    </div>
  </span>
</template>

<script lang="ts">
import { Component, Ref, Vue } from 'nuxt-property-decorator'
import tippy, { Instance } from 'tippy.js'

import Chip from '~/components/utils/Chip.vue'

@Component({
  components: {
    Chip
  }
})
export default class SwitchLanguage extends Vue {
  @Ref('chip') readonly chip!: HTMLSpanElement

  tippy: Instance | null = null

  get locales () {
    return this.$i18n.locales
  }

  mounted () {
    this.tippy = tippy(this.chip, {
      allowHTML: true,
      animation: 'shift-away',
      appendTo: document.body,
      arrow: false,
      content (instance) {
        return instance.querySelector('.chip-details')?.innerHTML || ''
      },
      interactive: true,
      placement: 'bottom',
      theme: 'unpadded'
    })
  }

  beforeDestroy () {
    this.tippy?.destroy()
  }
}
</script>

<style lang="scss" scoped>
  .switcher {
    position: absolute;
    top: 1rem;
    right: 1rem;
  }

  .list-group .list-group-item {
    background: rgba(200, 200, 200, 0.35);
    backdrop-filter: blur(2px);

    &:hover {
      background: rgba(200, 200, 200, 0.4);
      color: var(--bs-dark);
    }

    &.active {
      background: rgba(200, 200, 200, 0.6);
      color: var(--bs-success);
      border: inherit;
      cursor: default;
      pointer-events: none;
    }
  }

  .chip {
    background: rgba(200, 200, 200, 0.3);
    backdrop-filter: blur(2px);

    &:hover {
      background: rgba(200, 200, 200, 0.4);
    }
  }
</style>
