<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Verification;
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\SMTP; 
use App\Models\SubCategorys;
use App\Models\Categorys;
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
             $otp =  mt_rand(100000,999999);
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
                  'email_verified'=>0,
                  'role'=>99,
                  'status'=>1,
                  'approved'=>0,
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
            $mail->Username= "wemarkspot@gmail.com"; //"raviappic@gmail.com";
            $mail->Password="dwspcijqkcgagrzl";//"audnjvohywazsdqo";
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
        $email = $request->email;
         $otp=$request->digit1.$request->digit2.$request->digit3.$request->digit4.$request->digit5.$request->digit6;
        $otp = (int)$otp; 
        $date1=new DateTime(date('d-m-Y h:i:s',time()));
        $res=DB::table('password_otp')->where('email',$email)->first();
        
        if($res){
                // $date2=new DateTime($res->verify_at); 
                $res=DB::table('password_otp')->where('otp',$otp)->first(); 

                    if($res){
                             $res=DB::table('password_otp')->where('email',$email)->delete();  
                             $data = Users::where('email',$email)->update(['email_verified_at'=>$date1]);
                             $result=array('status'=>true,'message'=>'verify succesfully');                   
                               //yaha databse me entry hogi  user ki sari details          
                        
                        }else{   
                            $result=array('status'=>false,'message'=>'Wrong Otp ');
                        }     
        }else{
            $result=array('status'=>false,'message'=>'email not exits ');
        }
        echo json_encode($result);
      }


       public function checklogin(Request $request)
    {
       
        if($request->input())
        {
            $business  =  Users::where('email',$request->email)->first();
             
        if(!is_null($business))
        {
            if(!Hash::check($request->password, $business->password))
            {
                $result=array('status'=>false,'statuspsd'=> 'Invalid Password','check'=>"password");
            }
            else
            {
                $where =array('email'=>$request->email);
                $business  =  Users::where($where)->first();
              // dd($business);
                if($business->status==2)
                {
                    $request->session()->put('id', $business->id);
                    $request->session()->put('name', $business->name);
                    $request->session()->put('email', $business->email);
                    $request->session()->put('phone', $business->phone);
                    $request->session()->put('upload_doc', $business->upload_doc);
                    $request->session()->put('address', $business->business_type);
                     $request->session()->put('image', $business->image);
                     $result=array('status'=>true,'message'=>'Login succesfully');  
                }
                else
                {
                    $result=array('status'=>false,'message'=>'Your request is yet to be approved by Admin. You will receive a confirmation mail over registered mail id, once admin responds over your application.');  
                }
                 
            }
            
        }
        else
        {
            $result=array('status'=>false,'statusemail'=> 'Invalid Email address','check'=>"email");
        }
        echo json_encode($result);

        }
    }

    public function myaccount(Request $request){
        $user_id = session()->get('id');
            $account = Users::where('id', $user_id)->first();
          // dd($account);
           $categorylist =  Categorys::where('status',0)->get();
           $subcategorylist =  SubCategorys::where('status',0)->get();
           
        return view('wemarkthespot.my-account',compact('account','categorylist','subcategorylist'));
    }

    public function my_profile_edit(Request $request){
    //    dd($request->input());
        $validate = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required',
                'business_name'=>'required',
                'location' => 'required'
        ]);

        if($validate->fails()){
           $result = array('status'=>false, 'message'=>'Validation failed', 'error'=>$validate->errors());
        }
        else{
            $data = array();
            $user_id = session()->get('id');
          //  $user = new Users();
            $user = Users::where('id', $user_id)->first();
            
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
              else{
                  $image_url = $user->image;
              }
              $fileimage2="";
              $business_image_url='';
              if($request->hasfile('business_images'))
             {
               $file_image=$request->file('business_images');
               $fileimage2=md5(date("Y-m-d h:i:s", time())).".".$file_image->getClientOriginalExtension();
               $destination=public_path("images");
               $file_image->move($destination,$fileimage2);
               $business_image_url=url('public/images').'/'.$fileimage2;
             }
             else{
                 $business_image_url = isset($request->old_business_images) ? $request->old_business_images : $user->business->business_images;
             }
              
             
             $data['name']=isset($request->name)? $request->name:$user->name;
             $data['business_name']=isset($request->business_name) ? $request->business_name : $user->business_name;
             $data['email']=isset($request->email)? $request->email:$user->email;
             $data['country_code']=isset($request->country_code)? $request->country_code:$user->country_code;
             $data['phone']=isset($request->phone)? $request->phone:$user->phone;
             $data['location']=isset($request->location)? $request->location:$user->location;

             $data['opeing_hour']=isset($request->opeing_hour)? $request->opeing_hour:$user->opeing_hour;
             $data['closing_hour']=isset($request->closing_hour)? $request->closing_hour:$user->closing_hour;
             $data['business_type']=isset($request->business_type)? $request->business_type:$user->business_type;
             $data['image']=$image_url;
             $data['business_category']=isset($request->business_category)? $request->business_category:$user->business_category;
             $data['business_sub_category']=isset($request->business_sub_category)? $request->business_sub_category:$user->business_sub_category;
             $data['description']=isset($request->description)? $request->description:$user->description;
             $data['business_images']=$business_image_url;
                  $update = $user->where('id',$user_id) ->update($data);
                  if($update){
                          $result = array('status'=>true, 'message'=>'Profile update succesfully');
                        }else{
                               $result = array('status'=>false, 'message'=>'Something Went Wrong ');
                        }
              
        }
        echo json_encode($result);
    }

    public function signout()

    {
        Session::flush();
        return Redirect('signin');
    }
}
