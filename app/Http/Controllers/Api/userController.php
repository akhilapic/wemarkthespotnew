<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\SMTP; 
use PHPMailer\PHPMailer\Exception;
use Carbon\Carbon;
use Validator;
use App\Models\User;
use App\Models\Fitness_survey;
use App\Models\Verification;
use Hash;
use DateTime;
use Session;




class userController extends Controller
{

    public function logincheck(Request $request)
    {
 date_default_timezone_set('Asia/Kolkata');
        $email = $request->email;
        
        if(!isset($email))
        {
            $result=array('status'=>false,'message'=> 'Email is required.');
        }
        else if(!isset($request->password))
        {
            $result=array('status'=>false,'message'=> 'Password is required.');
        }else{

            $password = md5($request->password);
            $emailExist =DB::table('users')->where('email', $email)->first();
            if(!empty($emailExist))
            {
                if($emailExist->email=$email)
                {
                     if(Hash::check($request->password, $emailExist->password))
                    {
                        $data['login_check']=1;
                        DB::table('users')->where('email', $email)->update($data);
                         $image_url=url('public/images/userimage.png');
                        $emailExist->image =  isset($emailExist->image)? $emailExist->image : $image_url ;
                        $result=array('status'=>true,'message'=> 'Login Successful.','data'=>$emailExist);     
                    }
                    else
                    {
                         $result=array('status'=>false,'message'=> 'Invalid Password');   
                    }
                }
                else
                {
                    $result=array('status'=>false,'message'=> 'Invalid Email address');   
                }    
            }
            else
            {
                $result=array('status'=>false,'message'=> 'User not registered');   
            }
            
        }
       echo json_encode($result);
    }

    //user register 
    public function userRegister(Request $request){
        date_default_timezone_set('Asia/Kolkata');
        $username = $request->username;
        $email = $request->email;
     

        $emailExist =DB::table('users')->where('email', $email)->count();
        $userExist =DB::table('users')->where('username', $username)->count();
         if($emailExist > 0){
            $result=array('status'=>false,'message'=> 'Email address already registered');
        }else{
              $username = $request->username;
            $email = $request->email;

            $image_url=url('public/images/userimage.png');
            $password = Hash::make($request->password);
             $otp =  rand(1000,9999);
                $date = date("Y-m-d h:i:s", time());
                 $data = ['username'=>$username,'name'=>$username,'image'=>$image_url,'email'=>$email,'password'=>$password,'status'=>1,'role'=>97];
            $updated = DB::table('temp_users')->where('email', $request->email)->first();
            $up_otp = ['otp'=>$otp,'email'=>$email, 'create_at'=>$date, 'update_at'=>$date];
            if(!empty($updated))
            {
                DB::table('temp_users')->where('email', $request->email)->delete();
                
                  DB::table('password_otp')->where('email', $request->email)->delete();
                  $subject="Register Otp";
                $message = "Register Otp OTP ". $otp;
            
                $update = DB::table('temp_users')->where('id', $request->id)->insert($data);
              $upt_success = DB::table('password_otp')->insert($up_otp);
            }
            else
            {
                  $subject="Register Otp";
                    $message = "Register Otp OTP ". $otp;
            
                $update = DB::table('temp_users')->where('id', $request->id)->insert($data);
                  $up_otp = ['otp'=>$otp,'email'=>$email, 'create_at'=>$date, 'update_at'=>$date];
                $upt_success = DB::table('password_otp')->insert($up_otp);
            }


               
               // dd($data);
               
                // $addUsers =User::create($data);
              
                // dd($upt_success);
                if($update){
                    $this->sendMail($request->email,$subject,$message);
                      $emailExist =DB::table('temp_users')->where('email', $email)->first();
                    $result=array('status'=>true,'message'=> 'OTP sent successfully.','data'=>$emailExist);
                }else{
                   $result=array('status'=>false,'message'=> 'Something went wrong. Please try again.');
                }
           
                
        }
       echo json_encode($result);
    }
    public function userRegisterold(Request $request){
         date_default_timezone_set('Asia/Kolkata');
        $Validation = Validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required',
               'email' => 'required|email|unique:users',
                
        ]);

       if($Validation->fails())
        {
              $result=array('status'=>false,'message'=> 'validate Failed.' ,'error'=>$Validation->errors());
        }
        else
        {
            $username = $request->username;
            $email = $request->email;
            $image_url=url('public/images/userimage.png');
            $password = Hash::make($request->password);
             $otp =  rand(1000,9999);
                $date = date("Y-m-d h:i:s", time());
                $data = ['username'=>$username,'name'=>$username,'image'=>$image_url,'email'=>$email,'password'=>$password,'status'=>1,'role'=>97];
                 $subject="Register Otp";
                $message = "Register Otp OTP ". $otp;
            

                $addUsers =User::create($data);
                $up_otp = ['otp'=>$otp,'email'=>$email, 'create_at'=>$date, 'update_at'=>$date];
                $upt_success = DB::table('password_otp')->insert($up_otp);
                if($addUsers){
                    $this->sendMail($request->email,$subject,$message);
                      $emailExist =DB::table('users')->where('email', $email)->first();
                    $result=array('status'=>true,'message'=> 'User added successfully.','data'=>$emailExist);
                }else{
                   $result=array('status'=>false,'message'=> 'Something went wrong. Please try again.');
                }
                
        }
 

        
       echo json_encode($result);
    }
   public function guestuser(Request $request)
     {
         //dd($request->input());
         date_default_timezone_set('Asia/Kolkata');
       
            $image_url=url('public/images/userimage.png');
         
         $username = $request->username;
        $email = $request->email;
        $password = Hash::make($request->password);
        $emailExist =DB::table('users')->where('email', $email)->count();
        $userExist =DB::table('users')->where('username', $username)->count();
         
        if(!isset($username))
        {
            $result=array('status'=>false,'message'=> 'Name is required.');
        }else if(!isset($email)){
            $result=array('status'=>false,'message'=> 'Email is required.');
        }else if(!isset($request->password)){
            $result=array('status'=>false,'message'=> 'Password is required.');
        }else if($emailExist > 0){
            $result=array('status'=>false,'message'=> 'Email is already exist.');
        }else if($userExist > 0){
            $result=array('status'=>false,'message'=> 'Username is already exist.');
        }else{
               $otp =  mt_rand(1000,9999);
            $date = date("Y-m-d h:i:s", time());
            $data = ['username'=>$username,'name'=>$username,'image'=>$image_url,'email'=>$email,'password'=>$password,'status'=>1,'created_at'=>$date, 'updated_at'=>$date,'role'=>96];
            // echo "<pre>";
            // print_r($data);
            // exit;
         //    $subject="Register Otp";
          //  $message = "Register Otp OTP ". $otp;
        

            $addUsers =DB::table('users')->insert($data);
  //$up_otp = ['otp'=>$otp,'email'=>$email, 'create_at'=>$date, 'update_at'=>$date];
    //$upt_success = DB::table('password_otp')->insert($up_otp);
            if($addUsers){
               // $this->sendMail($request->email,$subject,$message);
                $result=array('status'=>true,'message'=> 'Guest User added successfully.');
            }else{
                $result=array('status'=>false,'message'=> 'Something went wrong. Please try again.');
            }
        }
       echo json_encode($result);
    }
    //email verification otp
    
    public function emailSentOtp(Request $request) {
        $email = $request->email;
        $otp =  mt_rand(1000,9999);
        $date = date("Y-m-d h:i:s", time());
        $check_email = DB::table('email_otp')->where('email',$email)->count();

        $mail = new PHPMailer();
        $mail->SMTPDebug  = 0;  
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;    
        $mail->IsHTML(true);
        $mail->Username = "sakil.appic@gmail.com";
        $mail->Password ='APPICSOFTWARES';
        $mail->SetFrom("sakil.appic@gmail.com");
        $mail->Subject = "Email verification";
        $mail->Body="Email verification OTP ". $otp;
        $mail->AddAddress($email);

        if($check_email > 0){
            $up_otp = ['otp'=>$otp, 'create_at'=>$date, 'update_at'=>$date];
            $upt_success = DB::table('email_otp')->where('email', $email)->update($up_otp);
            if($upt_success){
                if($mail->Send()){
                    $result = array('status'=> 200, 'message'=>'Otp sent your email successfully');
                }
            }
            else{
                $result = array('status'=> 201, 'message'=>'Otp not sent');
            }
        }
        else{
            $gan_otp = ['email'=> $email, 'otp'=>$otp, 'create_at'=>$date, 'update_at'=>$date];
            $otp_success = DB::table('email_otp')->insert($gan_otp);
            
            if($otp_success){
                if($mail->Send()){
                    $result = array('status'=> 200, 'message'=>'Otp sent your email successfully');
                }
                else{
                    $result = array('status'=> 201, 'message'=>'Otp not sent');
                }
            }
            else{
                $result = array('status'=> 201, 'message'=>'Something is Wrong.');
            }
        }
            echo json_encode($result);
    }
     
    public function emailVerification(Request $request){
        $email = $request->email;
        $otp = $request->otp;
        
        $verify_otp = DB::table('email_otp')->where('email', $email)->where('otp', $otp)->first();
        $otp_expires_time = Carbon::now()->subMinutes(5);
      
        if($verify_otp->create_at < $otp_expires_time){
            $result = array('status'=> false, 'message'=>'OTP is unvalid.');
        }
        else{
            $result = array('status'=> true, 'message'=>'otp valid successfully.');
        }      
        echo json_encode($result);
    }


 public function forgotPassword(Request $request) {
     date_default_timezone_set('Asia/Kolkata');
        $email = $request->email;
        $otp =  mt_rand(1000,9999);
        $date = date("Y-m-d h:i:s", time());
        if(!empty($email))
        {
                $check_email =DB::table('users')->where('email', $email)->count();
   
            $subject="Forgot password";
            $message = "Forgot password OTP ". $otp;
            if($check_email > 0)
            {
        
                $this->sendMail($request->email,$subject,$message);
                // if($this->sendMail($email,$subject,$message))
                // {
                    $up_otp = ['otp'=>$otp, 'create_at'=>$date, 'update_at'=>$date,'email'=>$email];
                    $upt_success = DB::table('password_otp')->where('email', $email)->update($up_otp);
                    if($upt_success)
                    {
                        
                            $result = array('status'=> true, 'message'=>'Otp sent successfully');
                        
                    }
                    else
                    {
                         $upt_success2 = DB::table('password_otp')->insert($up_otp);
                         if($upt_success2)
                         {
                           $result = array('status'=> true, 'message'=>'Otp sent successfully'); 
                         }
                         else
                         {
                            $result = array('status'=> false, 'message'=>'Otp not Send');
                         }
                           
                    }
        //        }
               // else
               // {
               //          $result = array('status'=> false, 'message'=>'Otp not sent');
               // }
            }
            else
            {
                // $subject="Forgot password";
                // $message = "Forgot password OTP ". $otp;
                // if($this->sendMail($request->email,$subject,$message))
                // {
                //     $gan_otp = ['email'=> $email, 'otp'=>$otp, 'create_at'=>$date, 'update_at'=>$date];
                //     $otp_success = DB::table('password_otp')->insert($gan_otp);
                //     if($otp_success){
                //             $result = array('status'=> true, 'message'=>'Otp sent successfully');
                //     }else{
                //             $result = array('status'=> false, 'message'=>'Otp not sent');
                //         }
                // }
                // else
                // {
                //     $result = array('status'=> false, 'message'=>'Otp not sent');
                // }
                 $result = array('status'=> false, 'message'=>'Invalid Email Address');
            }
        }
        else
        {
            $result = array('status'=> false, 'message'=>'Email is required');
        }
        echo json_encode($result);
    }
    public function resendotp(Request $request) {
         date_default_timezone_set('Asia/Kolkata');
        $email = $request->email;
        $otp =  mt_rand(1000,9999);
        $date = date("Y-m-d h:i:s", time());
        if(!empty($email))
        {
                $check_email =DB::table('temp_users')->where('email', $email)->count();
   
            $subject="Resend Otp";
            $message = "Resend OTP ". $otp;
            if($check_email > 0)
            {
        
                $this->sendMail($request->email,$subject,$message);
                // if($this->sendMail($email,$subject,$message))
                // {
                    $up_otp = ['otp'=>$otp, 'create_at'=>$date, 'update_at'=>$date,'email'=>$email];
                    $upt_success = DB::table('password_otp')->where('email', $email)->update($up_otp);
                    if($upt_success)
                    {
                        
                            $result = array('status'=> true, 'message'=>'Otp sent successfully');
                        
                    }
                    else
                    {
                         $upt_success2 = DB::table('password_otp')->insert($up_otp);
                         if($upt_success2)
                         {
                           $result = array('status'=> true, 'message'=>'Otp sent successfully'); 
                         }
                         else
                         {
                            $result = array('status'=> false, 'message'=>'Otp not Send');
                         }
                           
                    }
        //        }
               // else
               // {
               //          $result = array('status'=> false, 'message'=>'Otp not sent');
               // }
            }
            else
            {
                // $subject="Forgot password";
                // $message = "Forgot password OTP ". $otp;
                // if($this->sendMail($request->email,$subject,$message))
                // {
                //     $gan_otp = ['email'=> $email, 'otp'=>$otp, 'create_at'=>$date, 'update_at'=>$date];
                //     $otp_success = DB::table('password_otp')->insert($gan_otp);
                //     if($otp_success){
                //             $result = array('status'=> true, 'message'=>'Otp sent successfully');
                //     }else{
                //             $result = array('status'=> false, 'message'=>'Otp not sent');
                //         }
                // }
                // else
                // {
                //     $result = array('status'=> false, 'message'=>'Otp not sent');
                // }
                 $result = array('status'=> false, 'message'=>'Invalid Email Address');
            }
        }
        else
        {
            $result = array('status'=> false, 'message'=>'Email is required');
        }
        echo json_encode($result);
    }
    public function get_allusers()
    {
         $get_allusers = DB::table('users')->where('role',97)->get();
         if(!empty($get_allusers))
         {
            $result= array('status'=>true,"data"=>$get_allusers);
         }
         else{
            $result= array('status'=>false,"message"=>"No Record Found");
         }
         echo json_encode($result);
    }
        
    public function passwordVerification(Request $request){
         date_default_timezone_set('Asia/Kolkata');
        $email = $request->email;
        $otp = $request->otp;
        $method = $request->method;

        $verify_otp = DB::table('password_otp')->where('email', $email)->where('otp', $otp)->first();
        // echo "<pre>";
        // // print_r($verify_otp);
        // // exit;
        if(!empty($verify_otp))
        {
           //    $otp_expires_time = Carbon::now()->subMinutes(5);
          $otp_expires_time=  date('m/d/Y h:i:s', time());
                if($verify_otp->create_at < $otp_expires_time){
                    $result = array('status'=> false, 'message'=>'OTP Expired.');
                }
                else{
                    DB::table('password_otp')->where('email',$email)->delete();
                      $user_data = DB::table('temp_users')->where('email', $email)->first();
                    //  dd($user_data);

                        $image_url=url('public/images/userimage.png');
                       $date = date("Y-m-d h:i:s", time());
                        if($method==1)
                        {
                            $updateData['email'] = $user_data->email;
                            $updateData['name'] = $user_data->name;
                            $updateData['username']=$user_data->username;
                            $updateData['country_code']=$user_data->country_code;
                            $updateData['password']=$user_data->password;
                            $updateData['role']=$user_data->role;
                            $updateData['image'] =  isset($user_data->image)? $user_data->image : $image_url ;
                             $updateData['created_at'] =   $date ;
                            $updateData['updated_at'] =   $date ;
                          //  dd($updateData);

                            DB::table('users')->insert($updateData);
                             DB::table('temp_users')->where('email',$email)->delete();
                           $insertedData =  DB::table('users')->where('email', $email)->first();
                            $result = array('status'=> true, 'message'=>'Signup  Successful.','data'=>$insertedData);
                        }
                        else
                        {
                              $insertedData =  DB::table('users')->where('email', $email)->first();
                                $result = array('status'=> true, 'message'=>'Password OTP verified.','data'=>$insertedData);        
                        }
                    
                }          
        }
        else
        {
            $result = array('status'=> false, 'message'=>'invalid Otp');
        }
     
        echo json_encode($result);
    }
    public function forgetpasswordVerification(Request $request){
         date_default_timezone_set('Asia/Kolkata');
        $email = $request->email;
        $otp = $request->otp;
        
        $verify_otp = DB::table('password_otp')->where('email', $email)->where('otp', $otp)->first();
        // echo "<pre>";
        // // print_r($verify_otp);
        // // exit;
        if(!empty($verify_otp))
        {
           //    $otp_expires_time = Carbon::now()->subMinutes(5);
          $otp_expires_time=  date('m/d/Y h:i:s', time());
                if($verify_otp->create_at < $otp_expires_time){
                    $result = array('status'=> false, 'message'=>'OTP Expired.');
                }
                else{
                    DB::table('password_otp')->where('email',$email)->delete();
                      $user_data = DB::table('users')->where('email', $email)->first();
                        $image_url=url('public/images/userimage.png');
                        $user_data->image =  isset($user_data->image)? $user_data->image : $image_url ;
                    $result = array('status'=> true, 'message'=>'Otp Valid Successfull.','data'=>$user_data);
                }          
        }
        else
        {
            $result = array('status'=> false, 'message'=>'invalid email or Otp');
        }
     
        echo json_encode($result);
    }

    public function passwordUpdate(Request $request){
         date_default_timezone_set('Asia/Kolkata');
        $email = $request->email;
        
        $newPassword = Hash::make($request->newPassword);
       // $confirmPassword = Hash::make($request->confirmPassword);
        
        if(!isset($email)){
            $result = array('status'=> false, 'message'=>'Email is required');
        }
        else if(!isset($request->newPassword)){
            $result = array('status'=> false, 'message'=>'New password is required');
        }
        else if(!isset($request->confirmPassword)){
            $result = array('status'=> false, 'message'=>'Confirm password is required');
        }

        else if(!Hash::check($request->confirmPassword, $newPassword)){
            $result = array('status'=> false, 'message'=>'password not match');
        }
        else{
           $date = date("Y-m-d h:i:s", time());
           $data =['password'=>$newPassword,'updated_at'=>$date]; 
           $pass_upde = DB::table('users')->where('email',$email)->update($data);
           if($pass_upde){
            $result = array('status'=> true, 'message'=>'Password reset successful.');
           }
           else{
            $result = array('status'=> false, 'message'=>'password not changed.');
           }
        }

        echo json_encode($result);
    }
    

    public function signUp(Request $request){
         date_default_timezone_set('Asia/Kolkata');
        $validate= Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            
        ]);
        if($validate->fails()){
            $result=array("status"=>false,"message"=>"Validation Failed","error"=>$validate->errors());
        }else{
               $res = User::where('email',$request->email)->first();
               if($res)
                {
                  $result=array("status"=>false,"message"=>"User  Already Register");                  
                }
                else
                {
                        $verify = new Verification();
                      
                        session(["name"=>$request->name]);
                        session(["email"=>$request->email]);
                        session(["phone"=>$request->phone]); 
                        session(["language"=>$request->language]); 
                        session(["password"=>$request->password]);                  
                     
                        $otp =  mt_rand(100000,999999);
                         $verify->email=$request->email;
                        $verify->otp=$otp;
                         $verify->verify_at=Carbon::now();
                         $verify->save();

                        $subject="Verify your account";
                         $message=$otp;
                         if($this->sendMail($request->email,$subject,$message)){
                             //   return view('Pages.email-verification');
                             $result=array('status' => true,'message' =>"Send Email in your Email Address");
                 
                        }else{
                         $result=array('status' => false,'message' =>"Something Went Wrong");
                      //  return view('signup');
                    }
                   

                        // $user->password=Hash::make($request->password);
                        // $user->save();
                        // $result=array("status"=>true,"message"=>"Send Otp In your Email Address ","data"=>$user);
                }
                echo json_encode($result);
            }
    }

    public function edit(Request $request)
    {
           $useData = DB::table('users')->where('id', $request->id)->first();
         
            if(!empty($useData))
            {

                 $result = array('status'=> true, 'data'=>$useData);
            }
            else
            {
                $result = array('status'=> false, 'message'=>'No Record Found');
            }
         echo json_encode($result);
    }

       public function profile_update(Request $request)
    {
         date_default_timezone_set('Asia/Kolkata');
        if(!empty($request->id))
        {
               $usreData = DB::table('users')->where('id', $request->id)->first();
             
               if(!isset($request->name)){
                    $result = array('status'=> false, 'message'=>'Name is required');
                }
                else if(!isset($request->country_code)){
                    $result = array('status'=> false, 'message'=>'Please Enter country_code');
                }
                else if(!isset($request->phone)){
                    $result = array('status'=> false, 'message'=>'phone Number is required');
                }
                else if(!isset($request->dob)){
                    $result = array('status'=> false, 'message'=>'Date of Birth is required');
                }
                else
                {
                     $fileimage="";
                       $image_url='';
                       if($request->hasfile('image'))
                      {
                        $file_image=$request->file('image');
                        $fileimage=md5(date("Y-m-d h:i:s", time())).".".$file_image->getClientOriginalExtension();
                        $destination=public_path("images");
                        $file_image->move($destination,$fileimage);
                        $image_url=url('public/images').'/'.$fileimage;
                     
                      }
                      else
                      {
                        $image_url= $usreData->image;
                      }
                      // echo $image_url;
                      // exit;
                      $updateData = array(
                        'name'=>isset($request->name)? $request->name : $usreData->name,
                       // 'email'=>isset($request->email)? $request->email : $usreData->email,
                        'phone'=>isset($request->phone)? $request->phone : $usreData->phone,
                        'dob'=>isset($request->dob)? $request->dob : $usreData->dob,
                        'country_code'=>isset($request->country_code)? $request->country_code : $usreData->country_code,
                          'image'=>$image_url,
                          'updated_at'=>date("Y-m-d h:i:s", time())
                    );
                       $updateRecord = DB::table('users')->where('id',$usreData->id)->update($updateData);
                       if($updateRecord){
                        $updatedeData = DB::table('users')->where('id', $request->id)->first();
                        $result = array('status'=> true, 'message'=>'Profile Update  successfully.','data'=>$updatedeData);
                       }
                       else{
                        $result = array('status'=> false, 'message'=>'Profile Update  Failed.');
                       }
                }

        }
        else
        {
             $result = array('status'=> false, 'message'=>'No Record Found');
        }
         echo json_encode($result);
    }
    

    public function sendMail($email,$stubject=NULL,$message=NULL){

        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions
        try {
            $mail->SMTPDebug = 0;   
            $mail->isSMTP();
            $mail->Host="smtp.gmail.com";
            $mail->Port=587;
            $mail->SMTPSecure="tls";
            $mail->SMTPAuth=true;
            $mail->Username="raviappic@gmail.com";
            $mail->Password="audnjvohywazsdqo";
            $mail->addAddress($email,"User Name");
            $mail->Subject=$stubject;
            $mail->isHTML();
            $mail->Body=$message;
            $mail->setFrom("raviappic@gmail.com");
            $mail->FromName="We Mark The Spot";
            
            if($mail->send())
            {   
                return 1;                 
            }
            else
            { 
                return 0;
            }

        } catch (Exception $e) {
             return 0;
        }
    }

    public function verifyOtp(Request $request){
         date_default_timezone_set('Asia/Kolkata');
        $email =  session("email");
        $otp=$request->digit1.$request->digit2.$request->digit3.$request->digit4.$request->digit5.$request->digit6;
        $otp = (int)$otp; 
        $date1=new DateTime(date('d-m-Y h:i:s',time()));
        $res=Verification::where('email',$email)->first();
        
        if($res){
            $date2=new DateTime($res->verify_at);   
            $differance=$date2->diff($date1);
            $diff=$differance->i;
            if($diff<=2){
                $res=Verification::where('otp',$otp)->first();
                    if($res){
                            Verification::where('email',$email)->delete();                     
                               //yaha databse me entry hogi  user ki sari details           
                            $user = new User();  
                            $user->name =  session("name");
                            $user->email = session("email");
                            $user->phone = session("phone");
                            $user->language = session("language");
                            $user->password = session("password");
                            $user->save();
                            
                        $result = array('status'=>true, 'message'=>'User Register Successfully');
                        
                        }else{   
                            $result=array('status'=>false,'message'=>'Wrong Otp ');
                        }
            }else{
                $result=array('status'=>false,'message'=>'Otp Expired' ,'time'=>$differance);
            }     
        }else{
            $result=array('status'=>false,'message'=>'email not exits ');
        }
        echo json_encode($result);
      }

    //   public function resendotp(Request $request]){
    //       'email' => 're'
    //   }


    

    public function fitness_one(Request $request){
        //dd($request->input());
        $request->session()->put('gender',$request->gender);
        //session(["gender"=>$request->gender]);
        $request->session()->put('weight',$request->weight);
        //session(["weight"=>$request->weight]);
   //    dd($request->input());
        if(!is_null($request->weight_lb)){
           // session(["weight_unit"=>$request->weight_unit]);
            $request->session()->put('weight_unit',$request->LB);
        }else{
            
            $request->session()->put('weight_unit',$request->KG);
        }
        //session(["height"=>$request->height]);
        $request->session()->put('height',$request->height);
        if(!is_null($request->height_cm)){
            $request->session()->put('height_unit',"CN");
        }else{
            if((!is_null($height_unit_ft)) && (!is_null($height_unit_in)) )
            {
                $request->session()->put('height_unit',"IN");
            }
           
        }
        // session(["height_unit"=>$request->height_unit]);
      //dd($request->input());
        return view('Pages.fitness-survey2');
    }
    public function fitness_two(Request $request){
       // dd($request->input());
        // session(["interest"=>$request->interest]);
        $request->session()->put('interest',$request->interest);
        // session(["bodyparts_work"=>$request->bodyparts_work]);
        $request->session()->put('bodyparts_work',$request->bodyparts_work);
        // session(["exercise"=>$request->exercise]);
        $request->session()->put('exercise',$request->exercise);
            // session(["height_unit"=>$request->height_unit]);
        return view('Pages.fitness-survey3');
    }

    public function fitness_survey(Request $request){
     
        $validate = Validator::make($request->all(),[
            'length_training' => 'required',
            'fitness_goal' => 'required',
            'diedt_impact' => 'required'
        ]);
        if($validate->fails()){
            $result = array('status'=>false, 'message'=>'Validation failed', 'error'=>$validate->errors());
        }
        else{
          //  dd($request->input());
            // session(["gender"=>$request->gender]);
            // session(["weight"=>$request->weight]);
            // session(["weight_unit"=>$request->weight_unit]);
          
            $fitness = new Fitness_survey();
            $fitness->gender = session()->get('gender');// session("gender");
            $fitness->weight = session()->get('weight');// session("weight");
            $fitness->weight_unit = session()->get('weight_unit');// session("weight_unit");
            $fitness->height = session()->get('height');// session("height");
            $fitness->height_unit = session()->get('height_unit');//  session("height_unit");
            $fitness->interest = session()->get('interest');// session("interest");
            $fitness->bodyparts_work = session()->get('bodyparts_work'); //session("bodyparts_work");
            $fitness->exercise = session()->get('exercise');//  session("exercise");
            $fitness->length_training = $request->length_training;
            $fitness->fitness_goal = $request->fitness_goal;
            $fitness->diedt_impact =   $request->diedt_impact;
            // dd($fitness);
            $fitness->save();
            
            if($fitness){
                Session::forget('gender');
                Session::forget('weight');
                Session::forget('weight_unit');
                Session::forget('height');
                Session::forget('height_unit');
                Session::forget('interest');
                Session::forget('exercise');
                Session::forget('exercise');
                // $url =url('membership');
                // $result = array('status'=>true, 'message'=>'Fitness Survey Successfully',
                //     "url"=>$url );
             
                return redirect()->to('membership');
            }
            else{
                $result = array('status'=>false, 'message'=>'Something Went Wrong');
            }
        }
        echo json_encode($result);
    }

}

              
     
// $data = array('gender' =>$request->gender, 'weight' =>$request->weight, 'weight_unit'=>$request->weight_unit,
// 'height'=>$request->height, 'height_unit'=>$request->height_unit, 'interest'=>$request->interest,
// 'bodyparts_work'=>$request->bodyparts_work, 'exercise'=>$request->exercise, 'length_training'=>$request->length_training,

// 'fitness_goal'=>$request->fitness_goal, 'diedt_impact'=>$request->diedt_impact);
// dd($data);