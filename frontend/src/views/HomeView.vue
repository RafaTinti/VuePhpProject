
<template>
  <main>
    <div class="mt-5 container">
      <div class="card mx-auto">
        <h2 class="text-center pt-5">Welcome</h2>
        <h4 class="text-center py-4">This App was made using Vue and PHP</h4>
        <h5 class="text-center">You can navigate using the nav bar at the top. </h5>
        <h5 class="text-center">Thank you for your time evaluating it. </h5>
        <h5 class="text-end m-5">Author: Rafael Tinti</h5>
      </div>
    </div>
  </main>
</template>

<script>
import { curPage } from '../main.js'

export default {
  name: "Home",
  data() {
    return {
      
    }
  },

  mounted() {
    curPage.setPage("Home");
  },

  methods: {
  }
}
</script>