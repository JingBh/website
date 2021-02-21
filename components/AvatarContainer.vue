<template>
  <div
    id="avatarContainer"
    class="container"
  >
    <img
      id="avatar"
      class="rounded-circle"
      :alt="$t('jingbhs-avatar')"
      src="../assets/images/avatar.png"
    >
    <h1 class="mt-3 fw-light">
      JingBh
    </h1>
    <span class="text-info fw-bold">♂</span>
    <span class="text-muted mx-1">/</span>
    <span>{{ $t('age', { age }) }}</span><br>
    <small><i class="bi-geo-alt text-orange" /> {{ $t('beijing') }}</small>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'nuxt-property-decorator'
import { DateTime } from 'luxon'

const birthday = DateTime.fromMillis(1073664000000)

@Component
export default class AvatarContainer extends Vue {
  get age (): number {
    return Math.floor(DateTime.local().diff(birthday, 'years').years)
  }
}
</script>

<style>
  #avatarContainer {
    padding-top: 20vh;
    text-align: center;
  }

  #avatar {
    width: 7rem;
    height: 7rem;
  }

  .text-orange {
    color: var(--bs-orange);
  }
</style>
