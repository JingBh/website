<template>
  <div class="container my-5">
    <container-card title="我的经历">
      <ul class="timeline">
        <li>
          <span />
          <h5 class="time">
            2015 年
          </h5>
          <div>
            <p>我接触到了 C++ 语言，但是由于当时年龄太小，并没有学懂。不过这是我首次接触到一个正经的编程语言（以前只有 Scratch）。</p>
          </div>
        </li>
        <li>
          <span />
          <h5 class="time">
            2017 年
          </h5>
          <div>
            <p>初二，我接触到了 <strong>Python</strong> 语言。经过一段时间的自学，我逐渐掌握了 Python 语言的基础用法。</p>
          </div>
        </li>
        <li>
          <span />
          <h5 class="time">
            2018 年
          </h5>
          <div>
            <p>
              我学习了 <strong>HTML</strong>、<strong>CSS</strong>、<strong>JavaScript</strong>、<strong>PHP</strong>、<strong>MySQL</strong> 等等，但当时我的水平很有限，还没有接触到各类框架，只知道这些语言最基础的用法。我尝试制作了一个<strong>网盘系统</strong>，成功实现了用户登录、文件存储（肯定要有）、预览和分享（参考百度网盘）。<del
                class="small text-muted"
              >话说初二的我怎么这么闲...</del>
            </p>
          </div>
        </li>
        <li>
          <span />
          <h5 class="time">
            2019 年
          </h5>
          <div>
            <p>我接触并学习了 <strong>thinkPHP</strong> 框架，并在其基础上写了许多小应用（不过后来都废弃了）。</p>
            <p>我在这段时间内为了维护服务器，也学习了 Linux 系统的用法。</p>
          </div>
        </li>
        <li>
          <span />
          <h5 class="time">
            2020 年
          </h5>
          <div>
            <p>
              我学习了 <strong>Laravel</strong> 框架，并通过 Laravel Mix 接触到了 <strong>Webpack</strong>，之后踩进前端大深坑，学习了 JavaScript
              的各种用法（<strong>ES6/7</strong>、<strong>TypeScript</strong>）和各种框架（<strong>Vue</strong>、<strong>Nuxt</strong>），并且由于这个坑太深了，我仍在学习中。
            </p>
          </div>
        </li>
        <li>
          <span />
          <h5 class="time">
            2021 年
          </h5>
          <div>
            <p class="text-secondary">
              嗯...这就是现在了
            </p>
          </div>
        </li>
      </ul>
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
export default class TimelineCard extends Vue {
}
</script>

<style lang="scss" scoped>
  @mixin shadow {
    box-shadow: 0 0 12px rgba(13, 202, 240, 0.8);
  }

  .timeline {
    list-style-type: none;
    position: relative;

    &:before {
      content: "";
      display: block;
      width: 0;
      height: calc(100% - 1rem);
      border-left: 2px dashed var(--bs-info);
      @include shadow;
      position: absolute;
      left: 10px;
    }

    li {
      margin: 1rem 20px 2rem 0;
      position: relative;
    }

    li > span {
      content: "";
      display: block;
      width: 0;
      height: calc(100% - 1rem);
      border-left: 2px solid var(--bs-info);
      @include shadow;
      position: absolute;
      top: 0;
      left: -22px;
    }

    li > span:before {
      top: -0.7rem;
      content: "";
      display: block;
      width: 15px;
      height: 15px;
      border-radius: 50%;
      background: var(--bs-white);
      border: 2px solid var(--bs-primary);
      @include shadow;
      position: absolute;
      left: -8.5px;
    }

    li > div {
      padding: 1.5rem 0 1rem;

      p:last-child {
        margin: 0;
      }
    }

    .time {
      position: absolute;
      top: -16px;
      font-weight: lighter;
    }
  }
</style>
