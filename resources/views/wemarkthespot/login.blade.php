<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
      <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title> Spot </title>
      <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
   </head>
   <body>
      <!-- header -->
      <header>
         <div class="container-fluid d-flex py-3">
            <a class="logo" href="index.html"><img src="{{asset('assets/images/logo.svg')}}"></a>
            <button class="backBTN ms-auto" onclick="history.go(-1); return false;"><span class="icon-close-2"></span></button>
         </div>
      </header>
      <main class="mt-0">
      <section class="loginSection">
         <div class="container-fluid">
            <div class="row gy-5">
               <div class="col-lg-6 d-none d-lg-block">
                  <img src="{{asset('assets//images/Address-amico.png')}}">
               </div>
               <div class="col-lg-5 offset-lg-1">
                  <div class="login mt-2 mt-lg-0">
                     <div class=" text-center mb-4">
                        <h1 class="title">Sign in</h1>
                        <p>Sign in to your account</p>
                        <span id="msg_error"></span>
                     </div>

                    
                     
                     <form action="javascript:void(0);" id="manage_business_signin" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                       <!--  <div class="thumb-up mb-5">
                           <div class="profile-box d-flex flex-wrap align-content-center">
                              <img class="profile-pic" src="{{asset('assets/images/user-thumb.png')}}">
                           </div>
                           <div class="p-image">
                              <button type="button" value="login" class="btn upload-button"><span class="icon-camera"></span></button>
                              <input class="file-upload" type="file" accept="image/*">
                           </div>
                        </div> -->
                        <div class="mb-3">
                           <label for="emailnumber" class="form-label">Email Address</label>
                           <input type="text" class="form-control" name="email" id="Email1" aria-describedby="emailHelp" placeholder="Enter Email">
                        </div>
                        <div class="mb-3">
                           <label for="password" class="form-label">Password</label>
                           <input type="password" class="form-control" name="password" id="Password1" placeholder="Enter Password">
                        </div>
                        <div class="mb-2 form-check ps-0">
                           <input type="checkbox" class="form-check-input" id="exampleCheck1">
                           <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                           <a class="forgot float-end" href="otp-verifiction.html">Forgot Password?</a>
                        </div>
                        <div class="w-50 mx-auto mt-5">
                           <button type="submit" class="btn btn-primary w-100">Sign In</button>
                        </div>
                     </form>
                     <p class="allredy-account my-4 text-center">Don't have an account? <a href="{{url('signup')}}">Sign Up</a></p>
                    
                  </div>
               </div>
            </div>
         </div>
      </section>
   </main>
      <!-- Scripts -->
      <script src="{{asset('assets/js/jquery.min.js')}} "></script>
      <script src="{{asset('assets/js/popper.min.js')}} "></script>
      <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('assets/js/custom.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
      <script>
         $("#manage_business_signin").validate({
rules: {
   password: {required: true,},
   email: {required: true,email: true,},  

   },

messages: {
   password: {required: "Please enter Password",},
   email: {required: "Please enter valid Email",email: "Please enter valid Email",},   

},
   submitHandler: function(form) {
      var formData= new FormData(jQuery('#manage_business_signin')[0]);
     
      // u = host_url+"manage_business_signin";
     
   jQuery.ajax({
         url: "{{route('manage_business_signin')}}",
         type: "post",
         cache: false,
         data: formData,
         processData: false,
         contentType: false,
         
         success:function(data) { 
         var obj = JSON.parse(data);
         if(obj.status==true){
            window.location.href= "{{route('my_account')}}";

         }
         else{
               //alert(obj.status);
             if(obj.status==false){
               if(obj.status==false)
               {
               //   alert(obj.message);
                  jQuery('#msg_error').html('');
                  jQuery('#msg_error').html(obj.message);
            //jQuery('#msg_error').css("display", "block");
            //    jQuery('#msg_error').css({'display','block','color':'red'});
              $("#msg_error").css({"display": "block", "color": "red"}); 
               }
               
               else
               {
                  jQuery('#msg_error').css("display", "none");
               }
               
            }
            else{
               jQuery('#mobile_number_error').html('');
               jQuery('#email_error').html('');
            }
         }
         }
      });
   }
});


      </script>
   </body>
</html>