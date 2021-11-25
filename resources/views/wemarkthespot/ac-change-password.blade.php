<?php

 $base_url =  URL::to('/');
?>
@include("inc/header");
 <main class="my-notification">
         <div class="container-fluid">
            <h1 class="title">Account Settings</h1>
            <div class="row gy-5">
               <div class="col-md-4 pe-lg-5">
                  <aside>
                     <div class="BoxShade UserBox mb-4">
                        <figure><img src="{{asset('assets/images/img-6.png')}}"></figure>
                        <p><strong>Royal Bar</strong></p>
                        <p class="rating">4.7 <span class="icon-star"></span></p>
                        <p class="verify">Verified</p>
                     </div>
                     <div class="BoxShade">
                        <ul>
                           <li><a href="{{url('my_account')}}">My Profile</a></li>
                           <li><a href="{{url('my-subscription')}}">My Subscription</a></li>
                           <li><a href="{{url('notifications')}}">Notifications</a></li>
                           <li class="active"><a href="{{url('ac-change-password')}}">Change Password</a></li>
                           <li ><a href="{{url('faqs')}}">FAQs</a></li>
                           <li ><a href="{{url('contact-us')}}">Contact Us</a></li>
                           <li><a href="{{url('/websignout')}}">Sign Out</a></li>
                        </ul>
                     </div>
                  </aside>
               </div>
               <div class="col-md-8">
                  <h4 class="acTitle">Change Password</h4>
                  <form>
                     <div class="mb-4">
                        <label class="form-label">Current Password</label>
                        <input type="text" class="form-control" placeholder="Enter Current Password">
                     </div>
                     <div class="mb-4">
                        <label class="form-label">New Password</label>
                        <input type="text" class="form-control" placeholder="Enter New Password">
                     </div>
                     <div class="mb-4">
                        <label class="form-label">Confirm Password</label>
                        <input type="text" class="form-control" placeholder="Enter Confirm Password">
                     </div>
                     <div class="text-center"><button type="submit" class="btn btn-primary mt-4">Update</button></div>
                  </form>
                  
               </div>
            </div>
         </div>
      </main>
  
@include("inc/footer");
