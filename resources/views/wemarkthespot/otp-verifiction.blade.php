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

                     <form action="{{url('change-password')}}">
                     <input type="hidden" name="email" value="{{$user_data->email}]">
                        <div class="my-5 d-flex justify-content-center">
                           <input type="number" class="form-control" required>
                           <input type="number" class="form-control" required>
                           <input type="number" class="form-control" required>
                           <input type="number" class="form-control" required>
                           <input type="number" class="form-control" required>
                           <input type="number" class="form-control" required>
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
@include("inc/footer");