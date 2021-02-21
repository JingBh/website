<template>
  <div class="container my-5">
    <container-card title="我的技能">
      <div class="row gy-4">
        <div class="col-md">
          <h4 class="fw-light">
            编程语言
          </h4>
          <hr>

          <p class="small text-muted mb-3">
            提示：
            <span class="d-inline d-md-none">
              点击这些小卡片可以查看更多内容
            </span>
            <span class="d-none d-md-inline">
              鼠标悬浮在这些小卡片上可以查看更多内容
            </span>
          </p>

          <h6>
            <i class="bi-award" />
            比较熟练的：
          </h6>

          <chip
            title="JavaScript"
            icon="devicon-javascript-plain colored"
          >
            <h6>比较熟悉的相关语言 / 运行时：</h6>
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
              比较熟悉的相关框架：
            </h6>
            <chip
              title="Vue.js"
              icon="devicon-vuejs-plain colored"
            />
            <chip title="Nuxt.js" />
            <chip title="Express.js" />

            <p class="small text-muted mt-2 mb-0">
              一开口就是老前端人了
            </p>
          </chip>

          <chip title="PHP">
            <h6>比较熟悉的相关框架：</h6>
            <chip
              title="Laravel"
              icon="devicon-laravel-plain colored"
            />
            <h6 class="mt-2">
              以前用过的相关框架：
            </h6>
            <chip title="ThinkPHP" />
          </chip>

          <chip
            title="Python"
            icon="devicon-python-plain"
          >
            <p>主要用来写一些小脚本，有时候也用来处理一些数据，没什么太了解的框架。</p>
            <chip title="Anaconda" />
            <chip title="pandas" />
          </chip>

          <h6 class="mt-2">
            <i class="bi-patch-exclamation" />
            不太熟练的：
          </h6>

          <chip
            title="Java"
            icon="devicon-java-plain colored"
          >
            <p>做久棋研究项目的时候临时学的，程度比较低。</p>
            <h6>尝试使用的框架：</h6>
            <chip title="Spring Boot" />
            <p class="text-muted mt-2 mb-0">
              然而并没太搞懂这东西怎么用...
            </p>
          </chip>

          <h6 class="my-2">
            <i class="bi-hand-thumbs-down" />
            一窍不通的：
          </h6>

          <chip title="会是什么呢？">
            <p class="text-danger fw-bold mb-0">
              可恶，除了 C / C++ 还能是什么！
            </p>
          </chip>
        </div>
        <div class="col-md">
          <h4 class="fw-light">
            服务器运维
          </h4>
          <hr>
          <p class="small text-muted">
            不管是前端人还是后端人，怎么能不会维护自己的网站服务器呢~
          </p>

          <h6>
            <i class="bi-award" />
            比较熟练的：
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
            只能说用过的：
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
            Linux 系统：
          </h6>
          <p>
            使用
            <chip
              title="Debian 系"
              icon="devicon-debian-plain colored"
            />
            比较熟练，自己服务器上常用的是
            <chip
              title="Ubuntu Server"
              icon="devicon-ubuntu-plain colored"
            />
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
