<?php

 $base_url =  URL::to('/');
?>
@include("inc/header");
  <main class="mt-lg-0">
      <section class="otp-verification">
         <div class="container-fluid">
            <div class="row gy-5">
               <div class="col-lg-6 p-5 p-lg-0">
                  <img src="{{asset('assets/images/Forgot-password.png')}}">
               </div>
               <div class="col-lg-6 col-xl-5 offset-xl-1 d-flex align-items-center">
                  <div class="login text-center w-100">
                     <div class=" text-center">
                        <h1 class="title">OTP Verification</h1>
                        <p>We have send a verification code to your registered email address</p>
                     </div>
                     <form action="{{url('change-password')}}" id="verify_otp" method="post">
                        @csrf
                     <input type="hidden" name="email" value="{{$user_data->email}}">
                        <div class="my-5 d-flex justify-content-center">
                           <input type="text" name="digit1" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" required>
                           <input type="text" name="digit2" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');"  class="form-control" required>
                           <input type="text" name="digit3" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" required>
                           <input type="text" name="digit4" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" required>
                           <input type="text" name="digit5" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" required>
                           <input type="text" name="digit6" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" required>
                        </div>

                        <div class="w-50 mx-auto my-5">
                           <button type="submit" class="btn btn-primary w-100">Verify</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
      </main>
        <!-- Modal -->
      <div class="modal fade modelStyle show" id="staticBackdrop">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-body text-center">
                  <p>Your business will not be verified unless you include a 
                     commercial license
                  </p>
                  <button type="button" class="btn btn-primary mt-4" data-bs-dismiss="modal" aria-label="Close">Ok</button>
               </div>
            </div>
         </div>
      </div>
@include("inc/footer");
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
   $(function(){
   
   $("#verify_otp").validate({
      rules: {
         digit1: {
            required: true,
         },
         digit2: {
            required: true,
         },
         digit3: {
            required: true,
         },
         digit4: {
            required: true,
         },
         digit5: {
            required: true,
         },

         digit6: {
            required: true,
         },
      },
      
      messages: {
         digit1: {required: "Please enter otp",},
         digit2: {required: "Please enter otp",},
         digit3: {required: "Please enter otp",},
         digit4: {required: "Please enter otp",},
         digit5: {required: "Please enter otp",},
         digit6: {required: "Please enter otp",},

      },
      submitHandler: function(form) {
         var formData= new FormData(jQuery('#verify_otp')[0]);
      formData.append("_token",$('meta[name="csrf-token"]').attr('content'));
         // u ="development/wemarkthespot/";
        
      jQuery.ajax({
            url: "{{route('verify_otp')}}",
            type: "post",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            
            success:function(data) { 
            var obj = JSON.parse(data);
            
            if(obj.status==true){
               $(".result").text(obj.message);
               setTimeout(function(){
                   $("#b_trainer").modal('show');
                   window.location.href ="{{route('signin')}}" ;
               }, 1000);
            }
            else{
               if(obj.statusmobile_number==false){
                  jQuery('#mobile_number_error').html(obj.message);
                  jQuery('#mobile_number_error').css("display", "block");
               }
               else if(obj.statusemail==false){
                  jQuery('#email_error').html('');
                  jQuery('#email_error').html(obj.message);
                  jQuery('#email_error').css("display", "block");
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
});
</script>