<template>

    <nav class="navbar navbar-expand-lg ">
            <div class="container">

                <!-- LOGO -->
                <div class="logo_box">
                    <router-link class="navbar-brand" :to="{name:'home'}">
                        <img :src="'/images/logo.png'" alt="logo Boolawyer"
                        title="Clicca qui per tornare alla home">    
                    </router-link>
                </div>

                <!-- TOGGLE -->
                <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="bi bi-three-dots-vertical"></i></span>
                </button>

                <!-- NAVBAR -->
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                    <ul class="navbar-nav header-nav">
                        <li class="nav-item">
                            <router-link :to="{name:'home'}" class="nav-link"><span>Boolawyers</span></router-link>
                        </li>
                        <!-- <li class="nav-item">
                            <router-link :to="{name:'lawyers'}" class="nav-link">Lawyers</router-link>
                        </li> -->
                    
                    </ul>

                    <ul  class="navbar-nav header-nav">
                        <li class="nav-item ">
                            <a href="http://127.0.0.1:8000/login" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item ">
                            <a href="http://127.0.0.1:8000/register" class="nav-link">Register</a>  
                        </li>
                    </ul>

                </div>
            </div>
    </nav>
  
</template>

<script>
export default {
    name:'Header'

}
</script>

<style lang="scss">
  $lawblue: #2c4065;
  $darkblue:rgb(31, 40, 57);
  $verydarkblue:rgb(12, 20, 37);

  $lawbronze: #b69d73;
  $lawred: #83354c;
  $dirtywhite:#f2f3ed;
  $notwhite: #ddd;


   nav.navbar {
       background-color: $verydarkblue;
   }

   .logo_box {
    color: $notwhite;
    text-shadow: 0 3px $lawblue;
    animation: slideInLeft 1s ease-out;

    & img{
      max-height: 2.5rem;
    }
  }

   .header-nav li>a,
   .header-nav li>a:link,
   .header-nav li>a:active {
       text-decoration: none;
       font-size: 1rem;
       color: $lawbronze;
       animation: slideInRight 1s ease-out;
       transition: .5s;
       &:hover {
           color:  $notwhite;
       }
       & span {
           font-size: 20px;
           font-weight: 500;
       }
   }

   span.navbar-toggler-icon {
       color: $lawbronze;
   }
</style>