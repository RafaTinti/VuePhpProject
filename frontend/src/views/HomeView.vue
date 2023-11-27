
<template>
  <main>
    <h1>Home Page</h1>
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