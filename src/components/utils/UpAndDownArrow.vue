<template>
  <i class="bi-chevron-down" />
</template>

<style scoped>
  @keyframes up-and-down {
    0% {
      transform: translateY(-0.1rem);
    }

    10% {
      transform: translateY(0);
    }

    50% {
      transform: translateY(0.4rem);
    }

    90% {
      transform: translateY(0);
    }

    100% {
      transform: translateY(-0.1rem);
    }
  }

  i {
    display: inline-block;
    font-size: 130%;
    margin-right: 0.5rem;
    line-height: 0;
    animation: up-and-down 1.7s infinite linear;
  }
</style>
