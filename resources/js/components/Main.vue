<template>
  <main>
  
    <router-view></router-view>
   
  </main>
</template>

<script>
export default {
  name:'Main'
}
</script>

<style lang="scss" scoped>
main{
  min-height: calc(100vh - 100px);
  overflow: hidden;
  
}

</style>