<template>

  <!-- Start Review Form -->
  <section class="my_container px-4 px-lg-5 py-5 mx-3">

    <!-- Success message -->
    <div v-if="success" class="alert alert-primary">The Review has been sent</div>

    <!-- FORM -->
    <form @submit.prevent="sendForm" >

      <!-- Start Row with TITLE + BUTTON -->
      <div class="row justify-content-between mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">

          <!-- TITLE -->
          <h3 class="text_bronze"><i class="bi bi-pencil-fill my_icon"></i>Review</h3>

          <!-- BUTTON -->
          <button type="submit" class="btn btn-submit">
            Submit
            <img :src="'/images/submit.png'" alt="">
          </button>

        </div>
      </div>
      <!-- End Row with TITLE + BUTTON -->

      <!-- Start Row with NAME + VOTE -->
      <div class="row align-items-center">

        <!-- NAME -->
        <div class="col-12 col-lg-6">
          <div class="mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
                </div>
               <!-- <label for="your_reviewer" class="form-label">Reviewer</label> -->
               <input type="text" v-model="reviewer" class="form-control" name="reviewer" id="your_reviewer" placeholder="What's your name?">
            </div>
           <p class="alert alert-danger my-2" v-for="(error,index) in errors.reviewer" :key="index">{{error}}</p>
          </div>
        </div>
       
        <!-- VOTE -->
        <div class="col-12 col-lg-6">
          <div class="mb-3">
            <div class="input-group"> 
              <!-- <label for="your_vote">Vote:</label> -->
              <b-form-rating v-model="vote" id="your_vote" name="vote" class="bg-transparent border-0 p-0 m-0" inline ></b-form-rating>
            </div>
            <p class="alert alert-danger my-2" v-for="(error,index) in errors.vote" :key="index">{{error}}</p>
          </div>
        </div>
        
      </div>
      <!-- End Row with NAME + VOTE -->

      <!-- Start row with TEXT -->
      <div class="row">

        <!-- TEXT -->
        <div class="col-12">
          <!-- <label for="your_message" class="form-label">Example textarea</label> -->
          <textarea  v-model="text" class="form-control" name="text" id="your_text" rows="3" placeholder="Write me a review..."></textarea>
            <p class="alert alert-danger my-2" v-for="(error,index) in errors.text" :key="index">{{error}}</p>
        </div>

      </div>
      <!-- End row with TEXT -->

    </form>

 </section>
  <!-- End  Review Form -->

</template>

<script>

export default {
    name:'ReviewForm',
    props:{
      id:Number
    },
    
    data(){
      return{
        reviewer:'',
        vote:'',
        text:'',
        errors:{},
        sending:false,
        success:false
      }
    },

  
    methods:{

      sendForm(){
          this.sending=true;
          this.success=false;
          axios.post('/api/reviews',{
              'reviewer': this.reviewer,
              'vote': this.vote,
              'text': this.text,
              'user_id':this.id
          })
          .then(response=>{
              if (!response.data.success) {
              this.errors=response.data.errors;
              this.success=false;
              } else {
              this.success=true;
              // console.log(response);
              this.sending=false;
              this.reviewer="";
              this.vote="";
              this.text="";
              }
          })
          .catch(error=>{
              console.log(error);
          })
      }

    }
  
}

</script>

<style lang="scss" scoped>

$lawblue: #2c4065;
 
.my_container {
  background-color: #2c4065;
  color: #ddd;
  border-radius: 20px 0px 20px 20px;
  overflow: hidden;
  box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);


   form {
    .my_icon{
      padding-right:8px
    }
     
    .text_bronze{
      color:#b69d73
    }

    .btn-submit{
  background-color: grey;
  color:white;
  transition: all 0.2s linear;
  img{
    padding-left:10px;
  }

  &:hover{
    background-color: rgb(31, 40, 57);
      color:#b69d74;
  }
    }

    
    & #your_reviewer::placeholder,
    & #your_vote::placeholder,
    & #your_text::placeholder{
      color: $lawblue;
      font-weight: 600;
      opacity: .8;
    }

    & #your_reviewer,
    & #your_text {
      color: $lawblue;
    }

    & #your_vote{
      color:#b69d74
    }

    & .btn-blue{
      font-size: 1rem;
    }
  }
  
}

</style>