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
                     </div>
                    
                     
                     <form action="{{url('my-account')}}">
                        <div class="thumb-up mb-5">
                           <div class="profile-box d-flex flex-wrap align-content-center">
                              <img class="profile-pic" src="{{asset('assets/images/user-thumb.png')}}">
                           </div>
                           <div class="p-image">
                              <button type="button" value="login" class="btn upload-button"><span class="icon-camera"></span></button>
                              <input class="file-upload" type="file" accept="image/*">
                           </div>
                        </div>
                        <div class="mb-3">
                           <label for="emailnumber" class="form-label">Email Address</label>
                           <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email">
                        </div>
                        <div class="mb-3">
                           <label for="password" class="form-label">Password</label>
                           <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
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
   </body>
</html>