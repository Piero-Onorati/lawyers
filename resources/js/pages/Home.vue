<template>
  <section>
  
    <!-- HERO HOME -->
    <div class="hero_home">
      <div class="container">

        <div class="row align-items-center">

          <div id="welcome-text" class="col-12 col-md-6 hero_home_text">
            <span class="span_text my-2">Consulenza Legale</span>
            <h2 class="h2_text_light">Se hai un problema legale nella tua vita,</h2>
            <h3 class="h3_text">noi siamo disponibili</h3>
            <a href="#" class="btn border-light rounded-pill"><i class="bi bi-chat-fill"></i> get consultation</a>
          </div>

        </div>

      </div>

    </div>

    <!-- ABOUT SECTION -->
    <div class="about pb-5">
      <div class="container py-5">
        <div class="row align-items-center">
          <div class="col-12 col-md-7">
              <span class="span_text"><i class="bi bi-dot me-5"></i> who we are</span>
              <h2 class="h2_text_dark">We are here to fight against any violance with <strong>experience</strong></h2>
              <p class="p_text">Send your request to the right attorneys to help you. Selected for their experience, the lawyers will contact you directly to arrange a meeting and resolve your problem. All lawyers in our network are highly ranked and belong to independent law firms such as, Legal 500 and Chambers and Partners.</p>
          </div>
          <div class="col-12 col-md-5 justice_box text-center">
              <img :src="'/images/justice1.png'" alt="justice statue">
          </div>

        </div>

      </div>
     
      <div class="container rounded specialization_section">

      <!-- BUTTONS FOR ALL THE SPECIALIZATIONS -->
        <div class="row">
          <div class="col-12 col-md-8 px-5">
            <span class="span_text"><i class="bi bi-dot me-5"></i> what we do</span>
            <h2 class="h2_text_dark">Practice Areas</h2>
            <p>Lawyer Law Office, with its specialized staff and academician support, is divided into departments and continues to work systematically. Start your search by choosing a Specialization</p>
          </div>
        </div>
        <div class="row justify-content-center">

          <router-link 
            :to="{name:'lawyers', params:{id: item.id}}" 
            v-for="(item,index) in specializationsArray" :key="index"
            class="btn btn_spec m-2"> 
            <img :src="`/images/bg-spec-${index}.jpg`"  class="spec-bg" alt="">
            <img :src="`/images/spec-${index}.png`" alt="specializations icon">
            {{item.name}}
          </router-link>

        </div>
      </div>

    </div>

    <!-- MEDICI IN EVIDENZA -->
    <div class="sponsor_lawyers py-5">

       <div class="container">
         <div class="row">
            <div class="col-12 col-md-8">
              <span class="span_text"><i class="bi bi-dot me-5"></i> Attorneys</span>
              <h2 class="h2_text_dark">Best Attorneys</h2>
              <p class="p_text">Lawyer Law Office, with its specialized staff and academic support, is divided into departments and continues to work systematically.</p>
            </div>
          </div>
       </div>

      <div class="wrapper text-center container">

        <!-- Carousel -->
        <agile :key="lawyers.length" :slidesToShow="1" :dots="true" :infinite="true"  :navButtons="false" ref="carousel" :options="myOptions" :autoplay="true" :autoplay-speed="5000">
          <div class="slide my-3 p-4" v-for="(lawyer,index) in filteredLawyers" :key="index">
            <div class="card bg-transparent border-0">
            <!-- IMG -->
              <div class="img_box rounded overflow-hidden">
                <img v-if="lawyer.photo" :src="`http://localhost:8000/storage/` + lawyer.photo" :alt="lawyer.name" class="img-fluid" :title="lawyer.name">
                <img  v-else src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle m-auto" width="150">
              </div>

              <!-- Card Body -->
              <div class="my_card-body p-2">
                <!-- Movies name -->
                <h5>{{ lawyer.name }} {{lawyer.surname}}</h5>
                <div class="all-actions mt-3">
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
        </agile>

        <!-- LEFT button -->
        <!-- <button class="button btn_prev" @click="$refs.carousel.goToPrev()"><i class="bi bi-chevron-left"></i></button> -->
        <!-- RIGHT button -->
        <!-- <button class="button btn_next" @click="$refs.carousel.goToNext()"><i class="bi bi-chevron-right"></i></button>  -->

      </div>
    </div>
  
  </section>
</template>

<script>
import { VueAgile } from 'vue-agile';
export default {
  name:'Home',
  components:{
    agile: VueAgile,
  },
  data(){
    return{
      url:'http://localhost:8000/api/users',
      lawyers:[],
      urlSpec:'http://localhost:8000/api/specializations',
      specializationsArray:[],
      selectedSpec: null,
      myOptions: {

        responsive: [
          {
            breakpoint: 540,
            settings: {
              slidesToShow: 2
            }
          },
          {
            breakpoint: 1000,
            settings: {
              slidesToShow: 3
            }
          },
          {
            breakpoint: 1400,
            settings: {
              slidesToShow: 4
            }
          },
          
        ]
      }

    }
  },

  computed : {
    filteredLawyers : function (){
      return this.lawyers.filter((element)=>{
         return element.sponsors.length >= 1;
      });
    }
  },
  
  created(){
    // this.getUsers(1,this.selectedSpec, this.orderByNum, this.orderByVote);
    this.getSpecs();
    this.getSponsored();
    

  },

  methods:{
    // Get all the lawyers from the PI
    getSpecs(){
      axios
      .get(this.urlSpec)
      .then(response=>{
        this.specializationsArray = response.data.results;          
        // console.log(this.specializationsArray);
      })
    },
    getSponsored(){
      axios
      .get(this.url)
      .then(response=>{
         this.lawyers = response.data.results1;         
        console.log(this.lawyers);
      })
    },
  }

}
</script>

<style lang="scss">

  // Colors
  $lawblue: #2c4065;
  $darkblue:rgb(31, 40, 57);
  $verydarkblue:rgb(12, 20, 37);
  $lawbronze: #b69d74;
  $notwhite: #ddd;

  /* Typography */
  .span_text{
    text-transform:uppercase;
    color: #b69d73;
    font-weight:bold;
    font-size: 14px;

  }

  .span_text_carousel{
    text-transform:uppercase;
    color: white;
    font-weight:bold;
    font-size: 24px;
    text-shadow: 
      1.25px 1.25px  #2c4065,
      1px 1px        #2c4065,
      0.75px 0.75px  #2c4065,
      0.5px 0.5px    #2c4065,
      0.25px 0.25px  #2c4065;
  }

  .h2_text_light{
    color:#ddd;
    font-weight:bold;
    font-size: 40px;
  }

  .h2_text_dark{
    color:#2c4065;
    font-size: 26px;
    padding: 8px 0 16px 0;
  }

  .h3_text{
    font-style: italic;
    color:#b69d74;
    font-weight:bold;
    font-size: 36px;
  }

  .p_text{
    font-size: 14px;
    letter-spacing: 1px;
    line-height: 26px;
    color:#000223
  }

  #welcome-text {
    animation: slideInBelow 2s ease-out;
  }

  // Animations
  @keyframes slideInLeft {

    0% {
      opacity: 0;
      transform: translateX(-70px);
    }

    100% {
      opacity: 1;
      transform: translateX(0);
    }
  }

  @keyframes slideInRight {

    0% {
      opacity: 0;
      transform: translateX(50px);
    }

    // 95% {opacity: 1;
    //     transform: translateX(-5px);}

    100% {
      opacity: 1;
      transform: translateX(0);
    }
  }

  @keyframes slideInBelow {

    0% {
      opacity: 0;
      scale: 0;
      transform: translateY(50px);
    }

    100% {
      opacity: 1;
      scale: 1;
      transform: translateY(0);
    }
  }


  .hero_home{
    background-image: 
    linear-gradient(to bottom, 
      rgba(44, 64, 101, 0.5) 0%,
      rgba(31, 40, 57, 0.9) 100%),
      url('/images/hero.jpg');
    background-size: cover;
    background-position: top;
    overflow: hidden;
    height: 620px;
    width: 100%;

    .container{
      height: 100%;
      .row{
         height: 100%;
  
        .hero_home_text{
    
          a{
            text-transform: uppercase;
            border:1px solid white;
            color:white;
          }
        }
      }
    }

  }

  .specialization_section{
    background-color: #f2f3ed;

    .btn_spec{
      background-color: white;
      color: rgb(31, 40, 57);
      text-align: left;
      width:150px;
      overflow: hidden;
      position: relative;
      transition: all 0.3 ease-in;

      &:hover{
        background-color:#2c4065 ;
        color: white;
      }

      &:hover .spec-bg{
        display:block
      }

      .spec-bg{
        position:absolute;
        display: none;
        width: 100%;
        top:0;
        left: 0;
        height: 100%;
        opacity: 0.15;
        transition: all 0.3 linear;
      }

      img{
        width:40px;
        display: block;
      }
    }
  }
 
  .about{
    background-image:
    linear-gradient(to bottom, white 60%, $darkblue 40% 100%);
    overflow: hidden;
    min-height: 100vh;
  
    .justice_box{
      height:400px;
      width: 100%;
      img{
        height: 100%;
      }
    }

    .specialization_section{
      padding: 50px 0;
    }
  }

  .sponsor_lawyers{
    background-image: url('/images/globe.png');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: right top;


    .wrapper{
      position: relative;

      .agile__actions{
        padding-top:20px;

        button{
          background-color: #eee;
          border: none;
          border-radius: 50%;
          cursor: pointer;
          display: block;
          height: 10px;
          font-size: 0;
          line-height: 0;
          margin: 0 10px;
          padding: 0;
          transition-duration: .3s;
          width: 10px;

          &--current, &:hover{
            background-color: #888;
          }
        }
      }
    
      .slide {
        height: 300px;
        position: relative;

        &:hover .my_card-body{
          background-color: rgb(31, 40, 57);
          color:#d8bc8e;
        }
        
        .my_card-body {
          background-color:#2c4065;
          color: white;
          border-radius: 0px 5px 5px 5px;
          width:80%;
          transition: background-color 0.3s linear;
     
          &:hover{
            background-color:#b69d74;
            color: white;
            width:100%;
          }

          &:hover .all-actions{
            display: flex;
            
          }

          .all-actions{
            display: none;
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
          box-shadow: 0 1px 3px rgba(0,0,0,0.02), 0 1px 2px rgba(0,0,0,0.14);
          img {
            height: 100%;
            object-fit: cover;
          }

          &:hover img{
            height: 120%;
          }
        }
      }
    

      .button{
        background-color: white;
        width:50px;
        height: 50px;
        border-radius: 50% ;
        position: absolute;
        top: 50%;
        right:1%;
        opacity:0.6;
        &:hover{
          cursor: pointer;
          opacity:1
        }
          
      }
      .btn_prev{
        left:-8%;
      }
      .btn_next{
        right: -8%;
      }
    }

  }

</style>