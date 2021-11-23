<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="{{url('/assets/old/images/favicon.ico')}}" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}" />

    <title> Spot </title>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    <!-- Custom -->
	<!-- <script src="{{url('/assets/js/jquery.min.js')}}"></script> -->
	<script src="{{asset('assets/js/customvalidation.js')}}"></script>
	<link href="{{asset('/assets/css/style.css')}}" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="{{asset('assets/build/css/intlTelInput.css')}}">
  <link rel="stylesheet" href="{{asset('assets/build/css/demo.css')}}">
</head>

   <body>
      <!-- header -->
   <header>
         <div class="container-fluid d-flex py-3">
            <a class="logo" href="{{url('/')}}"><img src="{{'assets/images/logo.svg'}}"></a>
            <button class="backBTN ms-auto" onclick="history.go(-1); return false;"><span class="icon-close-2"></span></button>

         </div>
      </header>
      <main class="mt-0">
         <section class="loginSection">
            <div class="container-fluid">
               <div class="row gy-5">
                  <div class="col-lg-6 d-none d-lg-block">
                     <img src="{{asset('assets/images/Address-amico.png')}}">
                  </div>
                  <div class="col-lg-5 offset-lg-1">
                     <div class="login mt-2 mt-lg-0">
                        <div class=" text-center mb-3">
                           <h1 class="title">Sign Up</h1>
                           <p>Create your own account</p>
                        </div>
   


                           <form  action="{{route('signupuser')}}" id="user_signup"   method="post" enctype="multipart/form-data">
                            @csrf
                           <div class="thumb-up mb-5">
                              <div class="profile-box d-flex flex-wrap align-content-center">
                                 <img class="profile-pic" src="{{asset('assets/images/user-thumb.png')}}">
                              </div>
                              <div class="p-image">
                                 <button type="button" value="login" class="btn upload-button"><span class="icon-camera"></span></button>
                                 <input class="file-upload" type="file" name="image" accept="image/*">
                              </div>
                           </div>
                           <div class="mb-3">
                              <label for="name" class="form-label">Business Owner Name</label>
                              <input type="text" class="form-control" id="name1" name="name"  value="{{old('name')}}" placeholder="Enter Business Owner Name">
                           </div>
                           @if($errors->has('name'))
                              <span class="error alert alert-dange">{{ $errors->first('name') }}</span>
                           @endif
                           <span id="error_name"></span>
                           <div class="mb-3">
                              <label for="email" class="form-label">Email</label>
                              <input type="email" class="form-control"  name="email" email="email" id="email" value="{{old('email')}}" placeholder="Enter Email">
                           </div>
                            @if($errors->has('email'))
                              <span class="error alert alert-dange">{{ $errors->first('email') }}</span>
                           @endif
                           <div class="mb-3">
                              <label for="phone-number" class="form-label">Phone Number <span>(Optional)</span></label>
                              <input type="hidden" name="country_code" id="country_code">
                              <input type="number" class="form-control" name="phone" id="phone"  value="{{old('phone')}}" placeholder="Enter Phone Number"/>
                           </div>
                             @if($errors->has('phone'))
                              <span class="error alert alert-dange">{{ $errors->first('phone') }}</span>
                           @endif
                           <div class="mb-3 iconinput">
                              <label for="location" class="form-label">Location</label>
                              <input type="text" class="form-control"  name="location"  value="{{old('location')}}" id="location" placeholder="Enter Location">
                              <span class="icon-gps"></span>
                           </div>
                            @if($errors->has('location'))
                              <span class="error alert alert-dange">{{ $errors->first('location') }}</span>
                           @endif
                           <div class="mb-3 iconinput">
                              <label for="location" class="form-label">Password</label>
                              <input type="password" id="password"  class="form-control" value="{{old('password')}}" name="password" id="password1" placeholder="Enter Password">
                           </div>
                            @if($errors->has('password'))
                              <span class="error alert alert-dange">{{ $errors->first('password') }}</span>
                           @endif
                           <div class="mb-3 iconinput">
                              <label for="location" class="form-label">Confirm Password</label>
                              <input type="password" class="form-control"  name="cpassword" id="cpassword" value="{{old('cpassword')}}" placeholder="Enter Confirm Password">
                           </div>
                            @if($errors->has('cpassword'))
                              <span class="error alert alert-dange" >{{ $errors->first('cpassword') }}</span>
                           @endif
                              <span class="error alert alert-dange" id="errorcpassword"></span>
                           <div class="mb-3">
                              <div><label for="businesType" class="form-label">Select Business Type</label></div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" checked name="business_type" id="inlineRadio31" value="1">
                                 <label class="form-check-label" for="inlineRadio3">Online Only</label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="business_type" id="inlineRadio41" value="2">
                                 <label class="form-check-label" for="inlineRadio4">Physical Location</label>
                              </div>
                           </div>

                           @if($errors->has('business_type'))
                              <span class="error alert alert-dange">{{ $errors->first('business_type') }}</span>
                           @endif

                           <div class="mb-3 d-flex">
                              <label for="businesType" class="form-label">Upload Commercial License <span style="color:red">*</span></label>
                              <button type="button" data-val="0" onclick="plusbtn()" class="ms-auto btn plusBTN" data-val="0"><span class="icon-plus"></span></button>
                              <span id="uploaddocerror"></span>
                           </div>
                           <input required  type="file" name="upload_doc" class="form-control" id="upload_docs"/>

                           <div class="mb-2 form-check ps-0">
                              @if($errors->has('termsconditions'))
                              <span class="error alert alert-dange">{{ $errors->first('termsconditions') }}</span>
                           @endif
                               <input type="checkbox" class="form-control" id="termsconditions"  name="termsconditions"/>
                             
                              <label class="form-check-label" for="termsconditions">I accept <a href="#">Terms & Conditions</a> & <a href="#">Privacy Policy</a></label>
                           </div>
                            @if($errors->has('upload_doc'))
                              <span class="error alert alert-dange">{{ $errors->first('upload_doc') }}</span>
                           @endif
                           <div class="w-75 mx-auto mt-5">
	<input type="submit" class="btn btn-primary w-100"  value="Sign Up" data-bs-toggle="modal" data-bs-target="#approval">
                            
                           </div>
                        </form>
                        <p class="allredy-account my-4 text-center">Already have an account? <a href="{{url('signin')}}">Sign In</a></p>
                        
                     
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </main>

     <!-- Modal -->
      <div class="modal" id="approval" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-body text-center" style="padding: 30px">
                  <h5>Please verify your Email Address ! </h5>
                  <p>After that admin will approve your account than you will be able to Sign In.</p>
                  <button type="button" id="okbtn" class="btn btn-primary mt-4" >Ok</button>
               </div>
            </div>
         </div>
      </div>

<!--   <div class="modal fade done_message" id="b_trainer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content pt-5 pb-5">
        <div class="modal-body text-center" style="padding: 30px">
                  <h5>Please verify your Email Address ! </h5>
                  <p>After that admin will approve your account than you will be able to Sign In.</p>
                  <button type="button" class="btn btn-primary mt-4" data-bs-dismiss="modal" aria-label="Close" >Ok</button>
               </div>
        <div class="modal-footer justify-content-center border-0">
          <button type="button" data-dismiss="modal" class="btn btn-xs btn-primary  fr" >Done</button>
        </div>
      </div>
    </div>
  </div> -->


    <!-- Scripts -->
	<script src="{{url('/assets/old/js/jquery.min.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    
	<!-- Bootstrap -->
	<script src="{{url('/assets/old/js/popper.min.js')}}"></script>
	<script src="{{url('/assets/old/js/bootstrap.min.js')}}"></script>

	<!-- Owl Carousel -->
	<script src="{{url('/assets/old/js/owl.carousel.min.js')}}"></script>

	<!-- Select 2 Js -->
	<script src="{{url('/assets/old/js/select2.min.js')}}"></script>

	<!-- Slick slider -->
	<script src="{{url('/assets/old/js/slick.js')}}"></script>

	<!-- Custom Js -->
	<script src="{{url('/assets/old/js/custom.js')}}"></script>
	    <script src="{{asset('assets/build/js/intlTelInput.js')}}"></script>

</body>

<script type="text/javascript">

$(document).ready(function() {

    
  var readURL = function(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('.profile-pic').attr('src', e.target.result);
          }
  
          reader.readAsDataURL(input.files[0]);
      }
  }
  

  $(".file-upload").on('change', function(){
      readURL(this);
  });
  
  $(".upload-button").on('click', function() {
     $(".file-upload").click();
  });

  
});


   function plusbtn()
   {
      $("#upload_docs").show();
      
   }
    $(function(){
      $("#upload_docs").hide();
      // $("#cpassword").on('keyup',function(){
      //    cpassword = parseInt($(this).val());
      //    password = parseInt($("#password").val());
      //    if(password!=cpassword)
      //    {
      //       $("#errorcpassword").text("Password Not Match");
      //       return false;
      //    }
      //    else
      //    {
      //        $("#errorcpassword").hide();
      //      // return false;
      //    }

      // });
        country_code =$(".iti__selected-flag").attr("title");
         const myArr = country_code.split(": ");
         c_code =myArr[1];
         $("#country_code").val(c_code);
         // console.log($("#country_code").val());
    
    $(".btn_submit_tranning").on("click",function(){
        country_code =$(".iti__selected-flag").attr("title");
         const myArr = country_code.split(": ");
         c_code =myArr[1];
         $("#country_code").val(c_code);
          console.log($("#country_code").val());
    
      });
    });

</script>
<style type="text/css">
    label.error {
    display: inline-block;
    width: 100%;
    clear: both;
    margin-top: 8px;
    color: #db0707;
}
</style>
<script>
	$("#user_signup").validate({
		
	rules: {
		name: {required: true,},
		email: {required: true,email: true,},  
	
		password:{required:true,
         minlength:5,
      },
    //  termsconditions:{required: true}, 
      cpassword:{
         required:true,
          minlength: 5,
          equalTo: "#password"
      },
		// specialization:{required:true},
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
		password: {required: "Please enter password",},
      business_type:{required:"Please Select Business Type"},
		 upload_doc:{required:"Please Upload Document"},
	},
		submitHandler: function(form) {
		   var formData= new FormData(jQuery('#user_signup')[0]);
		   formData.append("_token",$('meta[name="csrf-token"]').attr('content'));
		  // u ="development/";
		  
		jQuery.ajax({
				url: "signupuser",
				type: "post",
				cache: false,
				data: formData,
				processData: false,
				contentType: false,
			   
				success:function(data) { 
               let obj  = JSON.parse(data); 
				// alert(obj.last_id);
             redirecturl = location.href='otp-verifiction/'+obj.last_id;
             $("#okbtn").attr("onclick",redirecturl);

            if(obj.status==true){
            //   alert(obj.status);
					setTimeout(function(){
				   $("#approval").modal('show');
           //  window.location.href = "emailverification";
          }, 1000);
				}
				else{
					
				}
				}
			});
		}
	});

</script>
  <script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
      utilsScript: "{{asset('assets/build/js/utils.js')}}",
    });
  </script>

<script src="{{asset('assets/build/js/intlTelInput.js')}}"></script>
  <script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {

      utilsScript: "{{asset('assets/build/js/utils.js')}}",
    });
  </script>
</html>