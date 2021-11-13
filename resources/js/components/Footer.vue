<template>
  <footer class="py-3">
    <div class="container d-flex justify-content-between align-items-center">
      <!-- LOGO -->
      <div class="logo_box_footer">
        <router-link class="navbar-brand" :to="{name:'home'}">
          <img :src="'/images/logo.png'" alt="logo Boolawyer"
            title="Clicca qui per tornare alla home"> 
        </router-link>
      </div>

      <h6>&#169; Copyright, 2021</h6>

    </div>
  </footer>
</template>

<script>
export default {
  name:'Footer'

}
</script>

<style lang="scss">
  $lawblue: #2c4065;
  $lawbronze: #b69d73;
  $lawred: #83354c;
  $notwhite: #ddd;

footer{
  background-color: #f2f2f2;
  color: #2c4065;

  .footer-nav li>a {
    color: #2c4065;
    font-size: 1.2rem;
    font-weight: 300;

    &:hover {
      color: rgb(31, 40, 57);
    }
  }

  .logo_box_footer{
    & img{
      max-height: 2rem;
    }
  }
}
</style>