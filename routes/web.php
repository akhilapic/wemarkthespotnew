<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'homepage'])->name('home');
Route::get('/', function () {
    return view('welcome');
});
Route::get('/fit-plans',[App\Http\Controllers\FitplansController::class, 'index']);
Route::get('/getdata_fit_plans',[App\Http\Controllers\FitplansController::class, 'getdata_fit_plans']);

Route::get('/fit-plans-detail/{tainerid}/{id}',[App\Http\Controllers\FitplansController::class, 'fit_plans_detail']);
Route::get('/payment-workout-by-yourself/{id}',[App\Http\Controllers\FitplansController::class, 'workout_payment']);
Route::get('/fit-plan-by-yourself-after-payment/{id}',[App\Http\Controllers\FitplansController::class, 'after_payment']);



//Route::get('/search_fitplans/{search}',[App\Http\Controllers\FitplansController::class, 'search_fitplans']);
Route::post('/search_fitplans',[App\Http\Controllers\FitplansController::class, 'search_fitplans'])->name("search_fitplans");
// Route::group(['middleware' => 'prevent-back-history'],function(){

Route::post('/filter_fitplans',[App\Http\Controllers\FitplansController::class, 'filter_fitplans'])->name("filter_fitplans");


//******************************website************************
/*
Route::group(['middleware'=>'firnesstrainer'],function(){
   
    Route::post('/leave_manage',[App\Http\Controllers\leaveManageController::class, 'leave_manage'])->name("leave_manage");
        Route::get('/getAllleave_manage',[App\Http\Controllers\leaveManageController::class, 'getAllleave_manage']);
         Route::get('/leaveonoff',[App\Http\Controllers\leaveManageController::class, 'leaveonoff']);
        
    Route::get('/trainer-edit-profile/{id}',[App\Http\Controllers\FitnessTrainerController::class, 'trainer_edit_profile']);

Route::get('/trainer-publishe-profile/{id}',[App\Http\Controllers\FitnessTrainerController::class, 'trainer_publishe_profile']);
    Route::get('/fitness_trainer_login_my_profile_view',[App\Http\Controllers\FitnessTrainerController::class, 'fitness_trainer_login_my_profile_view']);
    Route::Post('/website_trainer_edit',[App\Http\Controllers\FitnessTrainerController::class, 'website_trainer_edit'])->name('website_trainer_edit');
Route::Post('/website_trainer_change_password',[App\Http\Controllers\FitnessTrainerController::class, 'website_trainer_change_password'])->name('website_trainer_change_password');

///=--------------------------Set-Availability------------------------------------------------

Route::get('/Set-Availability',[App\Http\Controllers\SetAvailabilityController::class, 'index']);

Route::Post('/firness_trainer_time_slot',[App\Http\Controllers\SetAvailabilityController::class, 'firness_trainer_time_slot'])->name('firness_trainer_time_slot');

Route::Post('/edit_firness_trainer_time_slot',[App\Http\Controllers\SetAvailabilityController::class, 'edit_firness_trainer_time_slot'])->name('edit_firness_trainer_time_slot');

Route::Post('/add_firness_trainer_set_working_day',[App\Http\Controllers\SetAvailabilityController::class, 'add_firness_trainer_set_working_day'])->name('add_firness_trainer_set_working_day');


});
  */ 

Route::get('/aboutus', [App\Http\Controllers\AboutusController::class, 'index']);

//Route::get('/Be-a-Trainer', [App\Http\Controllers\FitnessTrainerController::class, 'index']);

//----------------------------fitness-trainer-data---------------------------

Route::post('/fitness-trainer-data',[App\Http\Controllers\FitnessTrainerController::class, 'fitness_trainer_data'])->name('fitness-trainer-data');

Route::post('/set_password_fitness_trainer',[App\Http\Controllers\FitnessTrainerController::class, 'set_password_fitness_trainer'])->name('set_password_fitness_trainer')->middleware('auth');


Route::post('/fitness_trainer_delall',[App\Http\Controllers\FitnessTrainerController::class, 'deleteAll'])->name('fitness_trainer_delall')->middleware('auth');

Route::get('/manage_business_del/{id}',[App\Http\Controllers\FitnessTrainerController::class, 'delete'])->name('manage_business_del')->middleware('auth');


Route::get('/manage_business_view/{id}',[App\Http\Controllers\FitnessTrainerController::class, 'fitness_trainer_view'])->name('manage_business_view')->middleware('auth');

Route::post('/manage_business_editt',[App\Http\Controllers\FitnessTrainerController::class, 'firness_trainer_update'])->name('manage_business_editt')->middleware('auth');

Route::post('/fitness_trainer_filter',[App\Http\Controllers\FitnessTrainerController::class, 'fitness_trainer_filter'])->name('fitness_trainer_filter')->middleware('auth');

Route::post('/fitness_trainer_signin',[App\Http\Controllers\FitnessTrainerController::class, 'checklogin'])->name('fitness_trainer_signin');

Route::get('/fitness-trainer-login-my-profile',[App\Http\Controllers\FitnessTrainerController::class, 'fitness_trainer_login_my_profile'])->name('fitness-trainer-login-my-profile');


Route::get('/fitness_trainer_logout',[App\Http\Controllers\FitnessTrainerController::class, 'fitness_trainer_logout']);





Route::get('/trainer-forgot-password',[App\Http\Controllers\FitnessTrainerController::class, 'trainer_forgot_password']);

Route::post('/firness_forget_passwordcheck',[App\Http\Controllers\FitnessTrainerController::class, 'firness_forget_passwordcheck'])->name('firness_forget_passwordcheck');

Route::get('/reset-password/{token}',[App\Http\Controllers\FitnessTrainerController::class, 'trainer_reset_password']);

Route::Post('/trainer_updatepassword',[App\Http\Controllers\FitnessTrainerController::class, 'trainer_updatepassword'])->name('trainer_updatepassword');


// Route::get('/emailverification', function () {
//    return view('Pages.email-verification');
// });




Route::get('/signin', function () {
       Session::forget('fitness_tranner_id');
   Session::forget('name');
   Session::forget('email');
   Session::forget('mobile_number');
   Session::forget('upload_doc');
   Session::forget('address');
    return view('/signin');
});

//******************************website************************

  
if(empty(session('user_id')) && empty(session('user_id')) && empty(session('user_id'))){
   Route::get('/login', [App\Http\Controllers\backend\Admin::class, 'index'])->name('login');
}else{
   Route::get('/', [App\Http\Controllers\backend\Admin::class, 'dashboard'])->middleware('auth');

}


Route::get('/dashboard', [App\Http\Controllers\backend\Admin::class, 'dashboard'])->middleware('auth'); 

//--------------------------------workout_plans---------------------------------
Route::get('workout_plans',[App\Http\Controllers\backend\workoutPlansController::class, 'index'])->middleware('auth');

Route::get('add_workout_plan',[App\Http\Controllers\backend\workoutPlansController::class, 'add_workout_plan_view'])->middleware('auth');
Route::post('/workout_plan_store',[App\Http\Controllers\backend\workoutPlansController::class, 'store'])->name('workout_plan_store')->middleware('auth');

Route::get('/workout_plans_del/{id}',[App\Http\Controllers\backend\workoutPlansController::class, 'delete'])->name('workout_plans_del')->middleware('auth');

Route::post('/workoutplansAll',[App\Http\Controllers\backend\workoutPlansController::class, 'deleteAll'])->name('workoutplansAll')->middleware('auth');
Route::any('/workout_plans_edit/{id}', [App\Http\Controllers\backend\workoutPlansController::class, 'edit'])->name('workout_plans_edit')->middleware('auth');

Route::post('/workout_plan_update',[App\Http\Controllers\backend\workoutPlansController::class, 'workout_plan_update'])->name('workout_plan_update')->middleware('auth');

Route::post('/workout_plans_active_desctive',[App\Http\Controllers\backend\workoutPlansController::class, 'workout_plans_active_desctive'])->name('workout_plans_active_desctive')->middleware('auth');

//--------------------------------FitnessTrainer Start---------------------------------
Route::get('manager_business',[App\Http\Controllers\FitnessTrainerController::class, 'getdata'])->middleware('auth');
Route::get('manager_category',[App\Http\Controllers\FitnessTrainerController::class, 'getdatacategory'])->middleware('auth');
// });
// if(empty(session('user_id')) && empty(session('user_id')) && empty(session('user_id'))){
//    Route::get('/login', [App\Http\Controllers\backend\Admin::class, 'index'])->name('login');
// }else{
//    Route::get('/', [App\Http\Controllers\backend\Admin::class, 'dashboard']);

// }

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/login', [App\Http\Controllers\backend\Admin::class, 'index'])->name('login');
Route::get('/', [App\Http\Controllers\backend\Admin::class, 'dashboard'])->middleware('auth');; 

Route::post('custom-login', [App\Http\Controllers\backend\Admin::class, 'customLogin'])->name('login.custom'); 
Route::get('signout', [App\Http\Controllers\backend\Admin::class, 'signOut'])->name('signout')->middleware('auth');



Route::post('/user_change_password', [App\Http\Controllers\backend\userController::class, 'user_change_password'])->name('user_change_password'); 
Route::post('/update_admin_profile', [App\Http\Controllers\backend\userController::class, 'update_admin_profile'])->name('update_admin_profile');  


Route::get('/fitness-survey', function () {
   return view('Pages.fitness-survey');
});
//user manage//



 Route::get('/add_user', [App\Http\Controllers\backend\userController::class, 'create'])->name('add_user')->middleware('auth');
 Route::post('store-data', [App\Http\Controllers\backend\userController::class, 'store'])->name('store-data')->middleware('auth');
 Route::get('/user_view/{id}', [App\Http\Controllers\backend\userController::class, 'userView'])->middleware('auth');
 Route::get('/user_edit/{id}', [App\Http\Controllers\backend\userController::class, 'edit'])->name('user_edit')->middleware('auth');
 Route::post('/update_data/', [App\Http\Controllers\backend\userController::class, 'updateData'])->middleware('auth');
 
 //Route::DELETE('/user_delete/{id}', [App\Http\Controllers\backend\userController::class, 'delete'])->name('user_delete');
 Route::get('/user_delete/{id}', [App\Http\Controllers\backend\userController::class, 'delete'])->name('user_delete')->middleware('auth');
//ravi sir
 //Route::post('/adminsignout', 'App\Http\Controllers\Api\userController@signUp'); 
 Route::post('/verify_otp', 'App\Http\Controllers\Api\userController@verifyOtp')->name('verify_otp');
//  Route::post('/fitness-survey_three', 'App\Http\Controllers\Api\userController@fitness_survey')->name('fitness-survey_three');  

 Route::post('/fitness_survey_one', 'App\Http\Controllers\Api\userController@fitness_one')->name('fitness_survey_one');
 Route::post('/fitness_survey_two', 'App\Http\Controllers\Api\userController@fitness_two')->name('fitness_survey_two');
 Route::post('/fitness_survey_three', 'App\Http\Controllers\Api\userController@fitness_survey')->name('fitness_survey_three');  


 Route::get('/membership', function () {
   return view('Pages.membership');
});


//=======================================wemarkthespot start===============================================================================
 
//admin panel

  Route::get('/user_list', [App\Http\Controllers\backend\userController::class, 'index'])->name('user_list')->middleware('auth'); 
 Route::get('/user-view/{id}', 'App\Http\Controllers\backend\userController@userview');
Route::post('/changeStatus/{id}', [App\Http\Controllers\backend\userController::class, 'changeStatus'])->name('changeStatus')->middleware('auth');


// end admin panel
 Route::get('/my-offers', 'App\Http\Controllers\MyoffersController@index');
// Route::get('my-offers',function(){
// return view('wemarkthespot.my-offers');
// });

Route::get('/subscriptions/', 'App\Http\Controllers\SubscriptionsController@index');
Route::get('/hotspot-updates', 'App\Http\Controllers\HotspotUpdatesController@index');
Route::get('/report-management', 'App\Http\Controllers\ReportManagementController@index');
Route::get('/community-reviews', 'App\Http\Controllers\CommunityReviewsController@index');

Route::get('/contact-us', 'App\Http\Controllers\ContactUsController@index');
//Route::get('/login', 'App\Http\Controllers\LoginController@index');
Route::get('/payment', 'App\Http\Controllers\PaymentsController@index');

// Route::get('/my-account', 'App\Http\Controllers\MyAccountController@index');
Route::get('/faqs', 'App\Http\Controllers\FaqsController@index');

Route::get('/emailverification/{token}','App\Http\Controllers\LoginController@emailverification');
Route::get('/otp-verifiction/{id}','App\Http\Controllers\LoginController@otp_verifiction');

// Route::get('report-management',function(){
//     return view('wemarkthespot.report-management');
// });
// Route::get('community-reviews',function(){
//     return view('wemarkthespot.community-reviews');
// });

// Route::get('contact-us',function(){
//     return view('wemarkthespot.contact-us');
// });
// Route::get('login',function(){
//     return view('wemarkthespot.login');
// });

// Route::get('payment',function(){
//     return view('wemarkthespot.payment');
// });
// Route::get('my-account',function(){
//     return view('wemarkthespot.my-account');
// });
// Route::get('faqs',function(){
//     return view('wemarkthespot.faqs');
// });

Route::get('/signin', 'App\Http\Controllers\LoginController@index')->name('signin');
Route::get('/signup', 'App\Http\Controllers\LoginController@signup');
Route::post('/signupuser', 'App\Http\Controllers\LoginController@signupuser')->name('signupuser');


Route::get('/websignout', 'App\Http\Controllers\LoginController@signout');
Route::get('/manage_business_edit/{id}',[App\Http\Controllers\FitnessTrainerController::class, 'fitness_trainer_edit'])->name('manage_business_edit')->middleware('auth');



Route::get('ac-change-password',function(){
    return view('wemarkthespot.ac-change-password');
});
Route::get('notifications',function(){
    return view('wemarkthespot.notifications');
});
Route::get('my-subscription',function(){
    return view('wemarkthespot.my-subscription');
});
// Route::get('otp-verifiction',function(){
//     return view('wemarkthespot.');
// });
Route::get('change-password',function(){
    return view('wemarkthespot.change-password');
});
Route::get('/my_profile', function()
{
   return View('Pages.my_profile');
});

// Route::get('/my_account', function()
// {
//    return View('wemarkthespot.my-account');
// });

Route::post('/verify_otp','App\Http\Controllers\LoginController@verifyOtp')->name('verify_otp');
Route::post('/manage_business_signin',[App\Http\Controllers\LoginController::class, 'checklogin'])->name('manage_business_signin');

Route::get('/my_account','App\Http\Controllers\LoginController@myaccount')->name('my_account');

  Route::Post('/my_profile_edit',[App\Http\Controllers\LoginController::class, 'my_profile_edit'])->name('my_profile_edit');
  Route::get('/add_category', [App\Http\Controllers\FitnessTrainerController::class, 'create'])->middleware('auth');

  Route::post('/category-data', [App\Http\Controllers\FitnessTrainerController::class, 'categorydata'])->name('category-data')->middleware('auth');
  Route::post('/category-edit', [App\Http\Controllers\FitnessTrainerController::class, 'categoryupdate'])->name('category-edit')->middleware('auth');

  
  Route::post('/category_status/{id}', [App\Http\Controllers\FitnessTrainerController::class, 'category_status'])->name('category_status')->middleware('auth');
 
  Route::get('/category_delete/{id}', [App\Http\Controllers\FitnessTrainerController::class, 'delete'])->name('category_delete')->middleware('auth');
  
  Route::get('/category_edit/{id}', [App\Http\Controllers\FitnessTrainerController::class, 'edit'])->name('category_edit')->middleware('auth');
  Route::get('/category-view/{id}', 'App\Http\Controllers\FitnessTrainerController@categoryview');
 
  Route::get('manage_sub_category',[App\Http\Controllers\FitnessTrainerController::class, 'getdatasubcategory'])->middleware('auth');
  Route::get('/add_sub_category', [App\Http\Controllers\FitnessTrainerController::class, 'add_sub_category'])->middleware('auth');
 Route::post('/subcategory-data', [App\Http\Controllers\FitnessTrainerController::class, 'subcategorydata'])->name('subcategory-data')->middleware('auth');
 Route::get('/subcategory-view/{id}', 'App\Http\Controllers\FitnessTrainerController@subcategoryview');
  
 Route::get('/subcategory_delete/{id}', [App\Http\Controllers\FitnessTrainerController::class, 'subcategory_delete'])->name('subcategory_delete')->middleware('auth');
  
 Route::get('/subcategory_edit/{id}', [App\Http\Controllers\FitnessTrainerController::class, 'subcategory_edit'])->name('subcategory_edit')->middleware('auth');
 Route::post('/subcategory-update', [App\Http\Controllers\FitnessTrainerController::class, 'subcategoryupdate'])->name('subcategory-update')->middleware('auth');
 
 Route::post('/subcategory_status/{id}', [App\Http\Controllers\FitnessTrainerController::class, 'subcategory_status'])->name('subcategory_status')->middleware('auth');
 
  //=======================================wemarkthespot AND===============================================================================
