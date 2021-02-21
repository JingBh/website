<template>
  <span
    ref="chip"
    class="chip shadow-sm"
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
  </span>
</template>

<script lang="ts">
import { Component, Vue, Prop, Ref } from 'nuxt-property-decorator'
import tippy, { Instance } from 'tippy.js'

@Component
export default class Chip extends Vue {
  @Prop(String) readonly title!: string

  @Prop(String) readonly icon: string | undefined

  @Ref('chip') readonly chip!: HTMLDivElement

  tippy: Instance | null = null

  get details (): boolean {
    return !!this.$slots.default
  }

  init () {
    this.uninit()
    if (this.details) {
      this.tippy = tippy(this.chip, {
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

  uninit () {
    if (this.tippy) {
      this.tippy.destroy()
    }
  }

  updated () {
    this.init()
  }

  mounted () {
    this.init()
  }

  beforeDestroy () {
    this.uninit()
  }
}
</script>

<style lang="scss">
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
