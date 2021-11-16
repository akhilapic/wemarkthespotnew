<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Verification;
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\SMTP; 

use App\Models\Users;
use URL;

use PHPMailer\PHPMailer\Exception;
use Carbon\Carbon;
use DB;
use Hash;
use DateTime;
use Session;


class LoginController extends Controller
{
    public function index()
    {
         return view('wemarkthespot.login');
    }
    public function signup()
    {
        return view('wemarkthespot.signup');
    }


    public  function signupuser(request $request)
    {
       
        $Validation = Validator::make($request->all(),[
            'name' => 'required',
                'password' => 'required|min:5',
               
                'location'=>'required',
                'cpassword'=>'required',  
                'email' => 'required|email|unique:users',
                'business_type'=>'required',
                'upload_doc'=>'required',

                'termsconditions'=>'required'
        ], [
                'name.required' => 'Business Owner Name is required',
                'password.required' => 'Password is required',
                'location.required'=>"location is required",
                'cpassword.required'=>"Conform Password is required",
                'business_type.required'=>"Please Select business type",
                'upload_doc'=>"Upload Commercial License",
              //  'termsconditions'=>"Accepted Terms & Conditions"
            ]);

        if($Validation->fails())
        {
            return redirect('/signup')->withErrors($Validation)->withInput();    
        }
        else
        {
             $otp =  mt_rand(1000,9999);
        //   dd($request->file('image'));
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
                  $image_url=url('public/images/userimage.png');
              }
                // upload_doc
              
               $upload_doc ="";
               if($request->hasfile('upload_doc'))
              {
                $file_image=$request->file('upload_doc');
                $fileimage=md5(date("Y-m-d h:i:s", time())).".".$file_image->getClientOriginalExtension();
                $destination=public_path("upload_doc");
                $file_image->move($destination,$fileimage);
                $upload_doc=url('public/upload_doc').'/'.$fileimage;
              }
              else
              {
                $upload_doc= "";
              }
            
         

              $data = array(
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>isset($request->phone)? $request->phone : '',
                'country_code'=>isset($request->country_code)? $request->country_code : '',
                'location'=>isset($request->location) ? $request->location :'',
                'password'=>hash::make($request->password),
                'business_type'=>isset($request->business_type)? $request->business_type : 1,
                  'image'=>$image_url,
                  'upload_doc'=>$upload_doc,
                 'created_at'=>date("Y-m-d h:i:s", time()),
                  'updated_at'=>date("Y-m-d h:i:s", time()),
                  'email_verified'=>0
            );

            // $verify = new Verification();

            // $token = md5(date("Y-m-d h:i:s", time())); // mt_rand(100000,999999);
            // $verify->email=$request->email;
            // $verify->otp=$token;
            // $verify->verify_at=Carbon::now();

            // $subject="Verify your account";
            //  $url  = URL::to('/emailverification')."/".$token;

            //  $link = "<a target='_blank' href='".$url."'>Click Email Verification</a>";
            //  $message=$link;
              $date = date("Y-m-d h:i:s", time());
            $subject="Register Otp";
            $message = "Register Otp OTP ". $otp;
            $up_otp = ['otp'=>$otp,'email'=>$request->email, 'create_at'=>$date, 'update_at'=>$date];
            $upt_success = DB::table('password_otp')->insert($up_otp);
             if($this->sendMail($request->email,$subject,$message)){
                 //   return view('Pages.email-verification');
                  $id =Users::create($data)->id;


                 $result=array('status' => true,'message' =>"Send Email in your Email Address","last_id"=>$id);
     
            }else{
             $result=array('status' => false,'message' =>"Something Went Wrong");
          //  return view('signup');
        }
     }

        echo json_encode($result);
    }

    public function otp_verifiction($id){
        $user_data=Users::where('id',$id)->first();
     //   dd($user_data);
        return view('wemarkthespot.otp-verifiction',compact('user_data'));
    }
// public function emailverification($token)
//     {
//         return view('wemarkthespot.otp-verifiction',compact('token'));
//     }
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
}
