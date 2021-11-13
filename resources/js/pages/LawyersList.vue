<template>
  <section>

    <!-- Start hero -->
    <div class="lawyers_hero">

      <!-- BUTTONS FOR ALL THE SPECIALIZATIONS -->
      <div class="row justify-content-center py-4">
        <button class="btn btn_spec btn-outline-light border-0 m-2 py-1" 
          v-for="(item,index) in specializationsArray" :key="'a'+ index" 
          @change="getUsers(1, selectedSpec)" 
          :class="(item.id == selectedSpec)?'selectedButton':''"
        >   
          <input type="radio" class="d-none" :id="'a' + index" :value="item.id" v-model="selectedSpec" name="specializations">
          <label :for="'a' + index">
            <img :src="`/images/spec-${index}.png`" alt="specializations icon" class="pt-1">
            {{item.name}}
          </label>
        </button>
      </div>

      <!-- FILTER BOTTON PER NUMBER AVERAGE_VOTE OF REVIEWS -->
      <div class="row justify-content-center pb-3">

        <!-- BUTTON ORDER BY NUMBER -->
        <button class="btn btn-bronze btn-outline-light mx-2 my-3" @click="getUsers(1, selectedSpec,orderByNum==true,orderByVote)">
          Order by number of Review
        </button>

        <!-- BUTTON ORDER BY VOTE -->
        <button class="btn btn-bronze btn-outline-light mx-2 my-3" @click="getUsers(1, selectedSpec,orderByNum, orderByVote==true)">
          Order by Average of Vote
        </button>

      </div>

    </div>
    <!-- End hero -->

    <div class="container py-4">

      <!-- LAWYERS -->
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      <div class="col px-5" v-for="lawyer in lawyers" :key='lawyer.id'>
        <div class="card my-3 bg-transparent border-0 text-center">

          <!-- Image -->
          <div class="img_box rounded overflow-hidden">
            <img v-if="lawyer.photo" :src="lawyer.photo" :alt="lawyer.name" class="img-fluid" :title="lawyer.name">
            <img  v-else :src="'/images/user.png'" alt="Admin" class="rounded-circle m-auto" width="150">
          </div>
         
         <!-- Card Body -->
          <div class="my_card-body p-3">
            <!-- Movies name -->
            <h5 class="lawyers_name">{{ lawyer.name }} {{lawyer.surname}}</h5>

            <div class="my-4">

              <!-- REVIEW NUMBER -->
              <h5 v-if="lawyer.reviews" class="bg-dark d-inline p-1 rounded">
                <span class="badge position-relative">Reviews</span>
                <span class="badge bg-secondary"> {{getNumberOfReview(lawyer.reviews)}}+</span>
              </h5>
              

              <div v-if="lawyer.reviews.length >= 1" class="mt-1 badge rounded-pill text-white position-relative mx-1">
                Voto: <span>{{getVoteReview(lawyer.reviews).toFixed(1)}}</span>
              </div>

            </div>

            <!-- <p  v-if="lawyer.services"  class="card-text">{{ truncate(lawyer.services,150)}}</p> -->
            

            <div class="all-actions">
              <div class="social-icons">
                <i class="bi bi-facebook"></i>
                <i class="bi bi-twitter mx-2"></i>
                <i class="bi bi-linkedin"></i>
              </div>
              <router-link :to="{name: 'lawyer-detail', params: { slug: lawyer.slug }}" class="btn btn-outline-light">
                DETAILS <i class="bi bi-arrow-right"></i>
              </router-link>
            </div>

          </div> 

        
        </div>
      </div>
      </div>

    </div>

    <!-- NAVIGATION POSTS -->
    <div class="container d-flex justify-content-center">
      <nav aria-label="page-navigation-example" class="navigation_posts">
        <ul class="pagination my-4">
          <li class="page-item" :class="{'disabled' : currentPage==1}">
            <button class="page-link "  @click="getUsers(currentPage-1)">Precedente</button>
          </li>
          <li class="page-item" 
            v-for="i in lastPage" :key="i" 
            :class="{'active': currentPage==i }"
            @click="getUsers(i)"
          >
            <span class="page-link ">{{i}}</span>
          </li>
          
          <li class="page-item" :class="{'disabled': currentPage == lastPage}" >
            <button class="page-link " @click="getUsers(currentPage + 1)">Successiva</button>
          </li>
        </ul>
      </nav>
    </div>

  </section>
</template>

<script>
export default {
  name:'LawyersList',
  props:{
    id:String
  },
  components:{
    
  },
  data(){
    return{
      url:'http://localhost:8000/api/users',
      lawyers:[],
      currentPage:1,
      lastPage:null,
      urlSpec:'http://localhost:8000/api/specializations',
      expand:false,
      specializationsArray:[],
      selectedSpec: this.id,
      orderByNum:null,
      orderByVote:null,
    }
  },

  created(){
    this.getUsers(1,this.selectedSpec, this.orderByNum, this.orderByVote);
    this.getSpecs();
    

  },

  methods:{

    // Get all the lawyers from the PI
    getUsers(PageUser,spec,numRev,avgRev){
      axios
      .get(this.url, {params:{
        page:PageUser,
        specialization:spec,
        numberOfReviews:numRev,
        avgVoteReviews:avgRev
      }})
      .then(response=>{
        this.lawyers = response.data.results.data;
        this.currentPage = response.data.results.current_page;
        this.lastPage = response.data.results.last_page;
        console.log(response.data.results.data);
        // console.log(response.data.results.current_page);
        // console.log(response.data.results.last_page);

      })
    },

    // Get all the lawyers from the PI
    getSpecs(){
      axios
      .get(this.urlSpec)
      .then(response=>{
        this.specializationsArray = response.data.results;          
        // console.log(this.specializationsArray);
      })
    },

    // Get the number of all reviews
    getNumberOfReview(array){
      let counter = 0;
      for (let i = 0; i < array.length; i++) {
        counter++;
      }

      return counter;
    },

    getVoteReview(array){
      let sum = 0;
      array.forEach(element => {
        sum += element.vote
      });
      var avg = sum/array.length;

      return avg ;
    },

    // truncate the services paragraph
    truncate(text,maxlength){
      if(text.length > maxlength) {
        return text.substr(0, maxlength) + '...';
      }
      return text;
    },


  },

}
</script>

<style lang="scss" scoped>
  // Colors
  $lawblue: #2c4065;
  $darkblue:rgb(31, 40, 57);
  $verydarkblue:rgb(12, 20, 37);
  $lawbronze: #b69d73;
  $notwhite: #ddd;


  .lawyers_hero{
    background-image: 
    linear-gradient(to bottom, 
      rgba(44, 64, 101, 0.6) 0%,
      rgba(31, 40, 57, 0.9) 100%),
      
    url('/images/court1.jpg');
    background-size: cover;
    background-position: center;
     overflow: hidden;

     
    .btn_spec{
      background-color: white;
      color: rgb(31, 40, 57);
      text-align: left;
      width:150px;
      overflow: hidden;
      position: relative;
      transition: all 0.3 ease-in;
      box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);

      &:hover{
        background-color:#2c4065 ;
        color: white;
      }


      img{
        width:40px;
        display: block;
      }
    }
    .selectedButton{
      background-color:rgb(31, 40, 57);
      color: #ddd;
      font-weight: bold;
      box-shadow: 0 1px 3px rgba(182, 158, 115 ,0.16), 0 1px 2px rgba(182, 158, 115,0.23);
    }

    .btn-bronze {
    background-color: rgba(182, 158, 115, 0.9);
    color: $lawblue;
    font-size: 1rem;
    font-weight: 600 !important;
    transition: all .8s;
    border:none;

    &:hover{
      background-color: $lawbronze;
      color: $lawblue;
      transform: scale(1.1);
      z-index: 1;
    }
  }
  }



  .card{
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    &:hover .my_card-body{
      background-color: $darkblue;
    }

    &:hover .my_card-body .lawyers_name{
      color:#b69d73;
    }
        
    .my_card-body {
      width: 100%;
      background-color:#2c4065;
      color: white;
      border-radius: 0px 0px 5px 5px;
      transition: all 0.3s linear;

      &:hover{
        background-color:#b69d74;
        color: white;
      }

      &:hover .lawyers_name{
        color:white;
      }

      .all-actions{
        display: flex;
        align-items: center;
        justify-content: space-between;
      
        .social-icons{
          font-size: 18px;

          i{

            &:hover{
              color:#ddd;
              cursor:pointer;
            }
          }

        }
      }

    }

    .img_box{
      background-color: whitesmoke;
      height: 200px;
      img {
      height: 100%;
      object-fit: cover;
      }

      &:hover img{
        height: 120%;
      }
    }
    
    

  }

</style>