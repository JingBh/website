<template>
  <div class="container my-5">
    <container-card :title="$t('my-skills')">
      <div class="row gy-4">
        <div class="col-md">
          <h4 class="fw-light" v-text="$t('programming-languages')" />

          <hr>

          <p class="small text-muted mb-3">
            {{ $t('hint') }}
            <span class="d-inline d-md-none" v-text="$t('chip-hint-click')" />
            <span class="d-none d-md-inline" v-text="$t('chip-hint-hover')" />
          </p>

          <h6>
            <i class="bi-award" />
            {{ $t('familiar-with') }}
          </h6>

          <chip title="JavaScript" icon="devicon-javascript-plain colored">
            <h6 v-text="$t('familiar-with-related-languages')" />

            <chip title="TypeScript" icon="devicon-typescript-plain colored" />

            <chip title="Node.js" icon="devicon-nodejs-plain colored" />

            <chip title="HTML" icon="devicon-html5-plain colored" />

            <chip title="CSS" icon="devicon-css3-plain colored" />

            <h6 class="my-2" v-text="$t('familiar-with-related-frameworks')" />

            <chip title="Vue.js" icon="devicon-vuejs-plain colored" />

            <chip title="Nuxt.js" icon="devicon-nuxtjs-plain colored" />

            <chip title="Express.js" icon="devicon-express-original colored" />

            <chip title="Socket.io" icon="devicon-socketio-original colored" />

            <h6 class="my-2" v-text="$t('familiar-with-styles-or-components')" />

            <chip title="Bootstrap" icon="devicon-bootstrap-plain colored" />

            <chip title="BootstrapVue" />

            <chip title="Vuetify" />

            <p class="small text-muted mt-2 mb-0" v-text="$t('meme-frontend')" />
          </chip>

          <chip title="PHP" icon="devicon-php-plain colored">
            <h6>{{ $t('familiar-with-related-frameworks') }}</h6>

            <chip title="Laravel" icon="devicon-laravel-plain colored" />

            <h6 class="mt-2" v-text="$t('used-once-frameworks')" />

            <chip title="ThinkPHP" />
          </chip>

          <chip title="Python" icon="devicon-python-plain colored">
            <p v-text="$t('skills-python-intro')" />

            <chip title="Anaconda" />

            <chip title="pandas" icon="devicon-pandas-original colored" />
          </chip>

          <h6 class="mt-2">
            <i class="bi-patch-exclamation" />
            {{ $t('not-familiar-with') }}
          </h6>

          <chip title="Java" icon="devicon-java-plain colored">
            <h6 class="mt-2" v-text="$t('familiar-with-related-languages')" />

            <chip title="Kotlin" icon="devicon-kotlin-plain colored" />

            <chip title="Android" icon="devicon-android-plain colored" />

            <h6 class="mt-2" v-text="$t('tried-to-use-frameworks')" />

            <chip title="Spring Boot" icon="devicon-spring-plain colored" />

            <p class="text-muted mt-2 mb-0" v-text="$t('tried-to-use-frameworks-intro')" />
          </chip>

          <h6 class="my-2">
            <i class="bi-hand-thumbs-down" />
            {{ $t('know-nothing') }}
          </h6>

          <chip :title="$t('what-could-it-be')">
            <p class="text-danger fw-bold" v-text="$t('what-could-it-be-intro')" />
            <p class="small text-muted mt-2 mb-0">
              <del v-text="$t('skills-assembly-intro')" />
            </p>
          </chip>
        </div>
        <div class="col-md">
          <h4 class="fw-light" v-text="$t('server-operation')" />

          <hr>

          <p class="small text-muted" v-text="$t('server-operation-intro')" />

          <h6>
            <i class="bi-award" />
            {{ $t('familiar-with') }}
          </h6>

          <chip title="Docker" icon="devicon-docker-plain colored" />

          <chip title="Nginx" icon="devicon-nginx-plain colored" />

          <chip title="Traefik" />

          <chip title="MySQL" icon="devicon-mysql-plain colored" />

          <h6 class="mt-2">
            <i class="bi-patch-question" />
            {{ $t('used-once') }}
          </h6>

          <chip title="PostgreSQL" icon="devicon-postgresql-plain colored" />

          <chip title="MongoDB" icon="devicon-mongodb-plain colored" />

          <h6 class="mt-2">
            <i class="devicon-linux-plain" />
            {{ $t('linux-os') }}
          </h6>
          <p>
            {{ $t('linux-os-intro-before') }}
            <chip :title="$t('linux-debian-family')" icon="devicon-debian-plain colored" />
            {{ $t('linux-os-intro-between') }}
            <chip title="Ubuntu Server" icon="devicon-ubuntu-plain colored" />
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
