<template>
  <div
    id="introContainer"
    class="container"
  >
    <div class="row justify-content-center">
      <div class="col-md-9 col-lg-7 col-xl-6">
        <p>{{ $t('profile-intro') }}</p>
      </div>
    </div>
    <div
      id="introButtons"
      class="row form-row justify-content-center text-center"
    >
      <div class="col-auto mt-3">
        <a
          class="btn btn-secondary"
          href="https://github.com/JingBh"
          target="_blank"
        ><i class="bi-github" />
          {{ $t('my-github-profile') }}
        </a>
      </div>
    </div>
  </div>
</template>

<style>
  #introContainer {
    margin-top: 1.5rem;
    position: relative;
  }
</style>
