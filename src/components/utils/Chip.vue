<template>
  <div
    class="chip shadow-sm"
    ref="chip"
  >
    <i
      v-if="icon"
      :class="icon"
    />
    {{ title }}
    <div
      v-if="details"
      class="chip-details"
    >
      <slot />
    </div>
  </div>
</template>

<script lang="ts">
import { Vue } from 'vue-class-component'
import tippy, { Instance } from 'tippy.js'

class Props {
  title!: string

  icon?: string
}

export default class Chip extends Vue.with(Props) {
  tippy: Instance | null = null

  get details (): boolean {
    return !!this.$slots.default
  }

  init () {
    if (this.tippy) {
      this.tippy.destroy()
    }
    if (this.details) {
      const ele = this.$refs.chip as HTMLDivElement
      this.tippy = tippy(ele, {
        allowHTML: true,
        animation: 'shift-away',
        appendTo: document.body,
        content (instance) {
          return instance.querySelector('.chip-details')?.innerHTML || ''
        },
        interactive: true,
        placement: 'auto',
        theme: 'chip'
      })
    }
  }

  updated () {
    this.init()
  }

  mounted () {
    this.init()
  }

  beforeUnmount () {
    if (this.tippy) {
      this.tippy.destroy()
    }
  }
}
</script>

<style lang="scss" scoped>
  .chip {
    display: inline-block;
    margin: 0.25rem;
    padding: 0.5rem 1rem;
    background: rgba(100, 100, 100, 0.15);
    border: var(--bs-secondary);
    font-size: 1rem;
    line-height: 1rem;
    border-radius: 1rem;
    vertical-align: middle;
    overflow-y: hidden;
    user-select: none;

    &:hover {
      cursor: pointer;
      background: rgba(100, 100, 100, 0.2);
    }

    .chip-details {
      display: none;
      user-select: auto;
    }
  }
</style>
