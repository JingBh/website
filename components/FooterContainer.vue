<template>
  <div
    id="footer"
    class="container-fluid p-0 mt-3"
  >
    <footer>
      <div class="row justify-content-evenly">
        <div class="col-sm-auto text-sm-center">
          <h5>本站由 JingBh 设计制作</h5>
          <h6 class="mb-0">
            &copy; JingBh 2018-{{ year }}
          </h6>
          <hr class="my-3 d-sm-none">
        </div>
        <div class="col-sm-auto">
          <h6 class="mb-1">
            Source available at:
          </h6>
          <p class="mb-1">
            <a
              ref="repo-link"
              href="https://github.com/JingBh/website.git"
              target="_blank"
            >
              <i class="bi-github" />
              <strong class="mx-1">JingBh/website</strong>
            </a>
            <small class="text-muted">v{{ version }}</small>
          </p>
          <!--<p>
            Licensed under <a
              href="https://choosealicense.com/licenses/gpl-3.0"
              target="_blank"
            >GNU GPLv3</a>.
          </p>-->
        </div>
      </div>
      <!--<h5>友情链接</h5>
      <p class="small">
        <a class="text-dark" href="https://www.zhc7.top/" target="_blank" rel="noreferrer">ZHC</a>
      </p>-->
    </footer>
  </div>
</template>

<script lang="ts">
import { Component, Vue, Ref } from 'nuxt-property-decorator'
import { DateTime } from 'luxon'
import tippy, { followCursor, Instance, sticky } from 'tippy.js'

import { version } from '~/package.json'

@Component
export default class FooterContainer extends Vue {
  @Ref('repo-link') readonly repoLink!: HTMLLinkElement

  repoTippy: Instance | null = null

  get year (): number {
    return DateTime.local().year
  }

  get version (): string {
    return version
  }

  mounted () {
    this.repoTippy = tippy(this.repoLink, {
      arrow: false,
      content () {
        const img = document.createElement('img')
        img.className = 'shadow-lg'
        img.src = 'https://github-readme-stats.vercel.app/api/pin?username=JingBh&repo=website&show_owner=true'
        return img
      },
      followCursor: true,
      maxWidth: 'none',
      offset: [100, 20],
      placement: 'top',
      plugins: [followCursor, sticky],
      sticky: 'popper',
      theme: 'unpadded',
      touch: false
    })
  }

  beforeDestroy () {
    if (this.repoTippy) {
      this.repoTippy.destroy()
    }
  }
}
</script>

<style lang="scss">
#footer {
  position: relative;
  bottom: 0;
  background: rgba(255, 255, 255, 0.53);
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(255, 255, 255, 0.4) 40%, rgba(255, 255, 255, 0.53));

  footer {
    color: var(--bs-gray-dark);
    padding: 3.5rem 3.5rem 2.5rem;
    overflow-x: hidden;

    a {
      color: inherit;
    }
  }
}
</style>
