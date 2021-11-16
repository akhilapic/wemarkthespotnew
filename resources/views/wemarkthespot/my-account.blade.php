<?php

 $base_url =  URL::to('/');
?>
@include("inc/header");
   <main class="my-accont">
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
                           <li class="active"><a href="{{url('my-account')}}">My Profile</a></li>
                           <li><a href="{{url('my-subscription')}}">My Subscription</a></li>
                           <li><a href="{{url('notifications')}}">Notifications</a></li>
                           <li><a href="{{url('ac-change-password')}}">Change Password</a></li>
                           <li><a href="{{url('faqs')}}">FAQs</a></li>
                           <li><a href="{{url('contact-us')}}">Contact Us</a></li>
                           <li><a href="{{url('/')}}">Sign Out</a></li>
                        </ul>
                     </div>
                  </aside>
               </div>
               <div class="col-md-8">
                  <h4 class="acTitle">My Profile</h4>
                  <form>
                     <div class="thumb-up mb-5">
                        <div class="profile-box d-flex flex-wrap align-content-center">
                           <img class="profile-pic" src="{{asset('assets/images/user-thumb.png')}}">
                        </div>
                        <div class="p-image">
                           <button type="button" value="login" class="btn upload-button"><span class="icon-camera"></span></button>
                           <input class="file-upload" type="file" accept="image/*">
                        </div>
                     </div>
                     <div class="row gy-4">
                        <div class="col-md-6">
                           <label class="form-label">Business Owner Name</label>
                           <input type="text" class="form-control" placeholder="Enter Business Owner Name">
                        </div>
                        <div class="col-md-6">
                           <label class="form-label">Business Name</label>
                           <input type="text" class="form-control" placeholder="Enter Business Name">
                        </div>
                        <div class="col-md-6">
                           <label class="form-label">Email</label>
                           <input type="text" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="col-md-6">
                           <label class="form-label">Phone Number</label>
                           <input type="text" class="form-control" placeholder="Enter Phone Number">
                        </div>
                        <div class="col-md-6">
                           <label class="form-label">Opening Hours</label>
                           <input type="time" class="form-control without_ampm" value="08:56">
                        </div>
                        <div class="col-md-6">
                           <label class="form-label">Closing Hours</label>
                           <input type="time" class="form-control without_ampm" value="08:56">
                        </div>
                        <div class="col-md-12 iconinput">
                           <label for="location" class="form-label">Location</label>
                           <input type="text" class="form-control" placeholder="Enter Location">
                           <span class="icon-gps"></span>
                        </div>
                        <div class="col-md-6">
                           <div><label class="form-label">Select Business Type</label></div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                              <label class="form-check-label" for="inlineRadio1">Online Only</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                              <label class="form-check-label" for="inlineRadio2">Physical Location</label>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div><label class="form-label">Select Business Category</label></div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                              <label class="form-check-label" for="inlineRadio3">Bar</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4">
                              <label class="form-check-label" for="inlineRadio4">Casino</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio5" value="option5">
                              <label class="form-check-label" for="inlineRadio5">Pub</label>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div><label class="form-label">Upload Commercial License</label></div>
                           <button type="button" class="ms-auto btn plusBTN"><span class="icon-plus"></span></button>
                        </div>
                        <div class="col-md-6">
                           <div><label class="form-label">Business Images</label></div>
                           <button type="button" class="ms-auto btn plusBTN"><span class="icon-plus"></span></button>
                           <button type="button" class="ms-auto btn plusBTN"><span class="icon-plus"></span></button>
                           <button type="button" class="ms-auto btn plusBTN"><span class="icon-plus"></span></button>
                        </div>
                        <div class="col-md-12">
                           <label for="location" class="form-label">Reason for not uploading commercial license</label>
                           <input type="text" class="form-control" placeholder="Type Reason">
                        </div>
                        <div class="col-md-12">
                           <label for="location" class="form-label">Short Description</label>
                           <textarea class="form-control" placeholder="Type Short Description"></textarea>
                        </div>
                     </div>

                     <button type="button" class="btn btn-primary mt-5 mb-2 px-4">Update Profile</button>
                  </form>
                 
               </div>
            </div>
         </div>
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
