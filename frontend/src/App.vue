<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { curPage } from './main.js'
</script>

<template>
  <header>
    <div>
      <nav class="navbar navbar-expand-lg bg-info"  data-bs-theme="dark">
        <div class="container-fluid" id="mainNav">
          <RouterLink class="navbar-brand fw-bold" to="/">VuePhpProject</RouterLink>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <RouterLink :class="{'nav-link' : true , active: (curPage.page === 'Home')}" aria-current="page" to="/">Home</RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink :class="{'nav-link' : true , active: (curPage.page === 'Customers')}" aria-current="page" to="/customers">Customers</RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink :class="{'nav-link' : true , active: (curPage.page === 'About')}" aria-current="page" to="/about">About</RouterLink>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <RouterView />
</template>

<style scoped>
#mainNav {
  max-width: 992px;
}
</style>
