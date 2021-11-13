<template>
  <section>
    <div class="container">

      <!-- START CARD -->
      <div class="card">
        <!-- start row -->
        <div class="row">

          <!-- start left column -->
          <div class="col-12 col-md-5 col-lg-4 my_img_box text-center p-0">
            <!-- IMAGE PROFILE -->
            <img v-if="lawyer.photo" :src="lawyer.photo" :alt="lawyer.name">

          </div>
          <!-- end left column -->

          <!-- start right column -->
          <div class="col-12 col-md-7 col-lg-8 my_card_body p-0">

            <!-- Parte nome e cognome -->
            <h5 class="card-title card-header my_card_header rounded-start"> {{ lawyer.name }} {{ lawyer.surname }}</h5>

            <!-- parte dell'address -->
            <p class="card-text pt-4 px-4 d-block text-truncate"><i class="bi bi-house-door"></i> : {{ lawyer.address }}</p>

            <!-- parte del phone -->
            <p v-if="lawyer.phone" class="card-text px-4 d-block"><i class="bi bi-telephone"></i> : {{ lawyer.phone }}</p>
            <p v-else class="d-block m-4"><i class="bi bi-telephone"></i> : unavailable</p>

            <!-- parte della email -->
            <p class="card-text px-4 d-block"><i class="bi bi-envelope"></i> : {{ lawyer.email }}</p>
              
            <!-- Button trigger modal - Parte del CV  -->
            <p v-if="lawyer.cv" class="card-text px-4 d-block">
              <i class="bi bi-file-text"></i> : 
              <button  type="button" class="btn btn-light mx-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Show CV
              </button>
            </p>
            <p v-else class="card-text px-4 d-block"><i class="bi bi-file-text"></i> : unavailable</p>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">    
                    <h5 class="modal-title" id="exampleModalLabel">{{lawyer.name + " " + lawyer.surname}}</h5>
                    <button type="button" class="btn-close btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
                  </div>
                  <div class="modal-body">
                    <img v-if="lawyer.cv" :src="lawyer.cv" class="card-img-top">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- parte dei services -->
            <p v-if="lawyer.services" class="card-text px-4"> {{ lawyer.services }}</p>
            <small v-else class="d-block m-4">services: unavailable</small>

            <!-- SPECIALIZATIONS -->
            <div  v-if="lawyer.specializations" class="pl-4 pt-2">
              <h4 v-for="(specialization,index) in lawyer.specializations" :key="index" class="badge my_badge">{{specialization.name}}</h4>
            </div>
          </div>
          <!-- end right column -->

        </div>
        <!-- end row -->

      </div>
      <!-- END CARD -->

    </div>


    <div class="container-fluid forms">

      <div class="row">

        <!-- MESSAGE FORM -->
        <div class="col-12 col-md-6 col-lg-7">
          <MessageForm :id="lawyer.id"/>
        </div>

        <!-- REVIEW FORM -->
        <div class="col-12 col-md-6 col-lg-5">
          <ReviewForm :id="lawyer.id" />
        </div>

      </div>

    </div>


  </section>
</template>

<script>
import MessageForm from '../components/MessageForm.vue';
import ReviewForm from '../components/ReviewForm.vue'

export default {
    name: "SingleLawyer",
    components: {
      MessageForm,
      ReviewForm
    },
    data() {
      return {
        lawyer: [],

      }
    },
    mounted(){
      // console.log(this.$route.params.slug);
      axios.get('/api/user/'+ this.$route.params.slug)
        .then( response => {
          this.lawyer = response.data.results;
          // console.log(this.lawyer);
        } )
        .catch(error => {
          console.log(error);
        });

    },
    methods:{
      
  }

};
</script>

<style lang="scss" scoped>
// Colors
  $lawblue: #2c4065;
  $lawbronze: #b69d73;
  $lawred: #83354c;
  $notwhite: #ddd;

section{
  position: relative;
  padding-top: 50px ;
  &::before {    
    content: "";
    background-image: linear-gradient(to bottom, 
      rgba(255, 255, 255,0.4) 0%,
      rgba(221, 221, 221, 0.9) 100%),url('/images/lawyer.jpg');
    background-size: cover;
    position: absolute;
    
    top: 0px;
    right: 0px;
    bottom: 0px;
    left: 0px;
    opacity: 0.85;
    z-index: -1;
  }

  

  .container{
    .card{
    /* background-color: rgba(119, 119, 119, 0.8); */
    border:none;
    color: #ddd;
    overflow: hidden;
    box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);

    .my_card_header{
      background-color:rgb(102, 102, 102) ;
      border:none;
    }
  
    .my_card_body{
      background-color: rgba(141, 141, 141, 0.8);
      max-height: 420px;
    }

    .my_img_box{
      background-color: #ddd;
      height:420px;
      overflow: hidden;
      img{
        height: 100%;
      }
    }


    & h5 {
      color: $lawbronze;
      font-weight: 600;
      letter-spacing: 2px;
    }

    & .my_badge {
      background-color: $lawblue;
      padding: 8px;
      margin-right:10px
    }

    & .modal h5 {
      color: $lawblue;
    }
  }
  }

  .forms {
    padding: 50px 0;
  }
}
</style>