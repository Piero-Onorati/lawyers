<template>

  <!-- Start Message Form -->
  <section class="my_container px-4 px-lg-5 py-5 mx-3">
   
    <!-- Success message -->
    <div v-if="success" class="alert alert-primary">Messagge send</div>

    <!-- FORM -->
    <form @submit.prevent="sendForm" >

      <!-- Start Row with TITLE + BUTTON -->
      <div class="row justify-content-center mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">

          <!-- TITLE -->
          <h3 class="text_bronze"><i class="bi bi-chat-dots-fill my_icon"></i>Message</h3>

          <!-- BUTTON -->
          <button type="submit" class="btn btn-submit">
            Submit
            <img :src="'/images/submit.png'" alt="">
          </button>

        </div>
      </div>
      <!-- End Row with TITLE + BUTTON -->

      <!-- Start Row with NAME + EMAIL ADRESS-->
      <div class="row justify-content-center">

        <!-- NAME -->
        <div class="col-12 col-lg-6">
          <div class="mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
                </div>
                <!-- <label for="your_name" class="form-label">Name</label> -->
                <input type="text" v-model="name" class="form-control" name="name" id="your_name" placeholder="What's your name?">
            </div>
            <p class="alert alert-danger my-2" v-for="(error,index) in errors.name" :key="index">{{error}}</p>
          </div>
        </div>

        <!-- EMAIL ADRESS -->
        <div class="col-12 col-lg-6">
          <div class="mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white"><i class="bi bi-envelope-fill"></i></span>
                </div>
                <!-- <label for="your_email" class="form-label">Email address</label> -->
                <input type="email" v-model="email" class="form-control" name="email" id="your_email" placeholder="Write your Email...">
            </div>
            <p class="alert alert-danger my-2" v-for="(error,index) in errors.email" :key="index">{{error}}</p>
          </div>
        </div>

      </div>
      <!-- End Row with NAME + EMAIL -->

      <!-- Start row with MESSAGE -->
      <div class="row justify-content-center">

        <!-- MESSAGE -->
        <div class="col-12">
          <!-- <label for="your_message" class="form-label">Example textarea</label> -->
          <textarea  v-model="text" class="form-control" name="text" id="your_text" rows="3" placeholder="Write me a message..."></textarea>
            <p class="alert alert-danger my-2" v-for="(error,index) in errors.text" :key="index">{{error}}</p>
        </div>

      </div>
      <!-- End row with MESSAGE -->
      
    </form>

  </section>
  <!-- End Message Form -->
  
</template>

<script>
export default {
    name:'MessageForm',
    props:{
      id:Number
    },

    data(){
      return{
        name:'',
        email:'',
        text:'',
        errors:{},
        sending:false,
        success:false,
        dismissSeconds:5
        // name_value: document.getElementById('your_name'),
        // address_value: document.getElementById('your_email'),
        // message_value: document.getElementById('your_text')
      }
    },

    methods:{
      sendForm(){
        this.sending=true;
        this.success=false;
        axios.post('/api/messages',{
          'name': this.name,
          'email': this.email,
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
            this.name="";
            this.email="";
            this.text="";
          }

        })
        .catch(error=>{
          console.log(error);
        })
      },

    }

}
</script>

<style lang="scss" scoped>

$lawblue: #2c4065;

.my_container {
  background-color: #D9D9D9;
  color: #ddd;
  border-radius: 0px 20px 20px 20px;
  overflow: hidden;
  box-shadow: -15px -15px 15px rgba(255, 255, 255, 0.2),15px 15px 15px rgba(0,0,0,0.1);

  form {
    .my_icon{
      padding-right:8px
    }
    
    .text_bronze{
      color:#b69d73
    }
    
    .btn-submit{
      background-color: #2c4065;
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

    & #your_name::placeholder,
    & #your_email::placeholder,
    & #your_text::placeholder{
      color: $lawblue;
      font-weight: 600;
      opacity: .8;
    }

    & #your_name,
    & #your_email,
    & #your_text {
      color: $lawblue;
    }

  }
}

</style>