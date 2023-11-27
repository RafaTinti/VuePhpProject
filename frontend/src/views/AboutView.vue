<template>
  <div class="about">
    <h1>This is an about page</h1>
  </div>
</template>

<script>
import { curPage } from '../main.js'

export default {
  name: "About",
  data() {
    return {
      
    }
  },

  mounted() {
    curPage.setPage("About");
  },

  methods: {
  }
}
</script>
<style>
</style>
