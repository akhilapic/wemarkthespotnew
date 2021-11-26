<?php

 $base_url =  URL::to('/');
?>
@include("inc/header");
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>

#eye1,#eye2 {
    position: absolute;
    right: 15px;
    top: 48px;
}
   </style>
    <main class="mt-lg-0">
      <section class="change-password">
         <div class="container-fluid">
            <div class="row gy-5">
               <div class="col-lg-6 p-5 p-lg-0">
                  <img src="{{asset('assets/images/Forgot-password.png')}}">
               </div>
               <div class="col-lg-5 offset-lg-1 d-flex align-items-center">
                  <div class="login w-100">
                     <div class=" text-center mb-4">
                        <h1 class="title">Forget Password</h1>
                     </div>
                     <span id="error_message" style="color:red"></span>
                     <form class="mt-100" action="" method="POST" id="forget_pasdform">
                     <input type="hidden" name="email" value="{{$user_data->email}}"/>   
                     <div class="mb-4" style="position:relative;">
                           <label for="password" class="form-label">New Password</label>
                           <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password">
                           <span class="fa fa-eye input_icon" id="eye1" style="cursor: pointer ;color: #9f9a9a;" data-name="password"></span>
                        </div>
                        <div class="mb-4" style="position:relative;">
                           <label for="password" class="form-label">Confirm New Password</label>
                           <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Enter Confirm Password">
                           <span class="fa fa-eye input_icon" id="eye2" style="cursor: pointer ;color: #9f9a9a;" data-name="password"></span>
                        </div>
                        <div class="w-50 mx-auto my-5">
                           <button type="submit" class="btn btn-primary w-100 mt-xl-5">submit</button>
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
                  <p id="msgotp">
                  </p>
                  <a class="btn btn-primary mt-4" id="btnok" href="" >Ok</a>
                
               </div>
            </div>
         </div>
      </div>
@include("inc/footer");
<script>
	$(function(){
  $("#eye1").on("click",function(){
		 	
			type=$("input[name='"+$(this).data("name")+"']").attr("type");
				  if(type=='password')
					{
						$("#eye1").removeClass("fa-eye");
						$("#eye1").addClass("fa-eye-slash");
						$("input[name='"+$(this).data("name")+"']").attr("type",'text');
					}
					else
					{
						$("#eye1").addClass("fa-eye");
						$("#eye1").removeClass("fa-eye-slash");
						$("input[name='"+$(this).data("name")+"']").attr("type",'password');
					}
        		
		  
		});
      $("#eye2").on("click",function(){
		 	

      //    type=$("input[id='"+$("#cpassword").data("name")+"']").attr("type");
            type= $("#cpassword").attr("type");
      //      alert(type);
          if(type=='password')
                {
                   $("#eye2").removeClass("fa-eye");
                   $("#eye2").addClass("fa-eye-slash");
                  // $("input[id='"+$("#cpassword").data("name")+"']").attr("type",'text');
                  $("#cpassword").attr("type",'text');
                }
                else
                {
                   $("#eye2").addClass("fa-eye");
                   $("#eye2").removeClass("fa-eye-slash");
                   $("#cpassword").attr("type",'password');
                }
               
         
       });

	});

    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
   $(function(){
   
   $("#forget_pasdform").validate({
      rules: {
        password: {
            required: true,
            minlength:5,
            maxlength:50
         },
         cpassword: {
            required: true,
            minlength:5,
            maxlength:50,
            equalTo: "#password"

         },
        
      },
      
      messages: {
        password: {required: "Please enter password",},
        cpassword: " Enter Confirm Password Same as Password"
        

      },
      submitHandler: function(form) {
         var formData= new FormData(jQuery('#forget_pasdform')[0]);
      formData.append("_token",$('meta[name="csrf-token"]').attr('content'));
        
      jQuery.ajax({
            url: "{{route('verify_forgetpassword')}}",
            type: "post",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            
            success:function(data) { 
            var obj = JSON.parse(data);
            
            if(obj.status==true){
               //  $("#staticBackdrop").modal('show');
               // $("#msgotp").text(obj.message);
                  $("#error_message").text(obj.message);
                  setTimeout(function(){ 
                     window.location.href=obj.url;

                   }, 2000);
             //   $("#btnok").attr("href",obj.url);
            }
            else{
               if(obj.status==false){
                  $("#error_message").text(obj.message);
               //      $("#staticBackdrop").modal('show');
               //  $("#msgotp").text(obj.message);
               //  $("#btnok").attr("href","#");
               }
             
            }
            }
         });
      }
   }); 
});
</script>