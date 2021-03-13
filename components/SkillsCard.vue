<template>
  <div class="container my-5">
    <container-card :title="$t('my-skills')">
      <div class="row gy-4">
        <div class="col-md">
          <h4 class="fw-light">
            {{ $t('programming-languages') }}
          </h4>
          <hr>

          <p class="small text-muted mb-3">
            {{ $t('hint') }}
            <span class="d-inline d-md-none">
              {{ $t('chip-hint-click') }}
            </span>
            <span class="d-none d-md-inline">
              {{ $t('chip-hint-hover') }}
            </span>
          </p>

          <h6>
            <i class="bi-award" />
            {{ $t('familiar-with') }}
          </h6>

          <chip
            title="JavaScript"
            icon="devicon-javascript-plain colored"
          >
            <h6>{{ $t('familiar-with-related-languages') }}</h6>
            <chip
              title="TypeScript"
              icon="devicon-typescript-plain colored"
            />
            <chip
              title="Node.js"
              icon="devicon-nodejs-plain colored"
            />
            <chip
              title="HTML"
              icon="devicon-html5-plain colored"
            />
            <chip
              title="CSS"
              icon="devicon-css3-plain colored"
            />

            <h6 class="my-2">
              {{ $t('familiar-with-related-frameworks') }}
            </h6>
            <chip
              title="Vue.js"
              icon="devicon-vuejs-plain colored"
            />
            <chip title="Nuxt.js" />
            <chip title="Express.js" />

            <p class="small text-muted mt-2 mb-0">
              {{ $t('meme-frontend') }}
            </p>
          </chip>

          <chip title="PHP">
            <h6>{{ $t('familiar-with-related-frameworks') }}</h6>
            <chip
              title="Laravel"
              icon="devicon-laravel-plain colored"
            />
            <h6 class="mt-2">
              {{ $t('used-once-frameworks') }}
            </h6>
            <chip title="ThinkPHP" />
          </chip>

          <chip
            title="Python"
            icon="devicon-python-plain colored"
          >
            <p>{{ $t('skills-python-intro') }}</p>
            <chip title="Anaconda" />
            <chip title="pandas" />
          </chip>

          <h6 class="mt-2">
            <i class="bi-patch-exclamation" />
            {{ $t('not-familiar-with') }}
          </h6>

          <chip
            title="Java"
            icon="devicon-java-plain colored"
          >
            <p>{{ $t('skills-java-intro') }}</p>
            <h6>{{ $t('tried-to-use-frameworks') }}</h6>
            <chip title="Spring Boot" />
            <p class="text-muted mt-2 mb-0">
              {{ $t('tried-to-use-frameworks-intro') }}
            </p>
          </chip>

          <h6 class="my-2">
            <i class="bi-hand-thumbs-down" />
            {{ $t('know-nothing') }}
          </h6>

          <chip :title="$t('what-could-it-be')">
            <p class="text-danger fw-bold">
              {{ $t('what-could-it-be-intro') }}
            </p>
            <p class="small text-muted mt-2 mb-0">
              <del>{{ $t('skills-assembly-intro') }}</del>
            </p>
          </chip>
        </div>
        <div class="col-md">
          <h4 class="fw-light">
            {{ $t('server-operation') }}
          </h4>
          <hr>
          <p class="small text-muted">
            {{ $t('server-operation-intro') }}
          </p>

          <h6>
            <i class="bi-award" />
            {{ $t('familiar-with') }}
          </h6>
          <chip
            title="Docker"
            icon="devicon-docker-plain colored"
          />
          <chip title="Nginx" />
          <chip
            title="MySQL"
            icon="devicon-mysql-plain colored"
          />

          <h6 class="mt-2">
            <i class="bi-patch-question" />
            {{ $t('used-once') }}
          </h6>
          <chip
            title="PostgreSQL"
            icon="devicon-postgresql-plain colored"
          />
          <chip
            title="MongoDB"
            icon="devicon-mongodb-plain colored"
          />

          <h6 class="mt-2">
            <i class="devicon-linux-plain" />
            {{ $t('linux-os') }}
          </h6>
          <p>
            {{ $t('linux-os-intro-before') }}
            <chip
              :title="$t('linux-debian-family')"
              icon="devicon-debian-plain colored"
            />
            {{ $t('linux-os-intro-between') }}
            <chip
              title="Ubuntu Server"
              icon="devicon-ubuntu-plain colored"
            />
            {{ $t('linux-os-intro-after') }}
          </p>
        </div>
      </div>
    </container-card>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'nuxt-property-decorator'

import ContainerCard from './utils/ContainerCard.vue'
import Chip from './utils/Chip.vue'

@Component({
  components: {
    ContainerCard,
    Chip
  }
})
export default class SkillsCard extends Vue {
}
</script>
