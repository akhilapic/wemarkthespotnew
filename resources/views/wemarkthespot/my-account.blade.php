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
                           <li><a href="{{url('/websignout')}}">Sign Out</a></li>
                        </ul>
                     </div>
                  </aside>
               </div>
               {{session('message')}}

               <div class="col-md-8">
                  <h4 class="acTitle">My Profile</h4>
                 <form  action="" id="my_profile_edit" method="post" enctype="multipart/form-data">
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
                           <input type="text" class="form-control" name="name" value="{{$account->name}}" placeholder="Enter Business Owner Name">
                        </div>
                        <div class="col-md-6">
                           <label class="form-label">Business Name</label>
                           <input type="text" class="form-control" name="business_name"  value="{{$account->business_name}}" placeholder="Enter Business Name">
                        </div>
                        <div class="col-md-6">
                           <label class="form-label">Email</label>
                           <input type="text" class="form-control" name="email" value="{{$account->email}}" placeholder="Enter Email">
                        </div>
                        <div class="col-md-6">
                  <label class="form-label">Mobile Number</label>
                           <input type="text" class="form-control" name="phone" value="{{$account->phone}}" placeholder="Enter Phone Number">
                        </div>
                        <div class="col-md-6">
                           <label class="form-label">Opening Hours</label>
                           <input type="time" name="opeing_hour"  value="{{$account->opeing_hour}}" class="form-control without_ampm" value="">
                        </div>
                        <div class="col-md-6">
                           <label class="form-label">Closing Hours</label>
                           <input type="time" name="closing_hour" value="{{$account->closing_hour}}"  class="form-control without_ampm" value="">
                        </div>
                        <div class="col-md-12 iconinput">
                           <label for="location" class="form-label">Location</label>
                           <input type="text" class="form-control" name="location" value="{{$account->location}}" placeholder="Enter Location">
                           <span class="icon-gps"></span>
                        </div>
                        <div class="col-md-6">
                           <div><label class="form-label">Select Business Type</label></div>
                           <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="business_type" id="inlineRadio1" value="1" @if($account->business_type == '1') checked @endif>
                              <label class="form-check-label" for="inlineRadioOptions">Online Only</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="business_type" id="inlineRadio2" value="2"@if($account->business_type == '2') checked @endif>
                              <label class="form-check-label" for="inlineRadioOptions">Physical Location</label>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div><label class="form-label">Select Business Category</label></div>
                           <div class="form-check form-check-inline">
                              
                              <input class="form-check-input" type="radio" name="business_category" id="inlineRadio3" value="bar"
                               @if($account->business_category == 'bar') checked @endif>
                              <label class="form-check-label" for="inlineRadio3">Bar</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="business_category" id="inlineRadio4" value="casino"  @if($account->business_category == 'casino') checked @endif>
                              <label class="form-check-label" for="inlineRadio4">Casino</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="business_category" id="inlineRadio5" value="pub"
                              @if($account->business_category == 'pub') checked @endif>
                              <label class="form-check-label" for="inlineRadio5">Pub</label>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div><label class="form-label">Upload Commercial License</label></div>
                          @if('public/images/{{$account->image_url}}')
                        <img src="{{$account->image}}" style="width: 100px;height: 50px;">
                        @endif
                        </div>
                        <div class="col-md-6">
                           <div><label class="form-label">Business Images</label></div>
                          <input class="form-control" type="file" name="image" id="img" value="">
                        </div>
                       <!--  <div class="col-md-12">
                           <label for="location" class="form-label">Reason for not uploading commercial license</label>
                           <input type="text" class="form-control" placeholder="Type Reason">
                        </div> -->
                        <div class="col-md-12">
                           <label for="location" class="form-label">Short Description</label>
                           <textarea class="form-control" value="{{$account->description}}" name="description" placeholder="Type Short Description"></textarea>
                        </div>
                     </div>

                     <button type="submit" class="btn btn-primary mt-5 mb-2 px-4">Update Profile</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
   $("#my_profile_edit").validate({
      
   rules: {
      name: {required: true,},
      email: {required: true,email: true,},  
   
    
    //  termsconditions:{required: true}, 
      business_category:{required:true},
      phone:{ 
      
      minlength:10,
      maxlength:10
      }, 
      business_type:{
         required:true,
      },
      // address:{required:true},
   
      },
   
   messages: {
      name: {required: "Please enter name",},
      email: {required: "Please enter valid email",email: "Please enter valid email",},   
      phone: {required: "Please enter Mobile Number",},
      business_type:{required:"Please Select Business Type"},
   },
      submitHandler: function(form) {
         var formData= new FormData(jQuery('#my_profile_edit')[0]);
         formData.append("_token",$('meta[name="csrf-token"]').attr('content'));
        // u ="development/";
        
      jQuery.ajax({
            url: "my_profile_edit",
            type: "post",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            
            success:function(data) { 
               let obj  = JSON.parse(data); 
             alert(obj.last_id);
             // redirecturl = location.href='otp-verifiction/'+obj.last_id;
             // $("#okbtn").attr("onclick",redirecturl);

            if(obj.status==true){
               alert(obj.status);
               setTimeout(function(){
               $("#approval").modal('show');
             window.location.href = "{{route('my_account')}}";
          }, 1000);
            }
            else{
               
            }
            },
         });
      }
   });

</script>