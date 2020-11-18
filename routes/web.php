<?php

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


	Route::resource('/orders', 'OrderController');
	Route::post('/paytm-callback', 'OrderController@paytmCallback');
	Route::get('/getbuy', 'OrderController@getBuy');


Route::get('/','UserController@index');
Route::get('plans','UserController@plans')->name('plans');
Route::get('privacyPolicy','UserController@privacyPolicy');
Route::get('termsConditions','UserController@termsConditions');
Route::get('refundPolicy','UserController@refundPolicy');
Route::get('aboutUs','UserController@aboutUs');
Route::match(['get','post'],'contactUs','UserController@contactUs');
Auth::routes(['verify' => true]);



/*USER SECTION*/

/*LOGIN SECTION*/
Route::match(['get','post'],'login','UserController@login');
Route::match(['get','post'],'register','UserController@register');
Route::get('confirmEmail/{id}/{token}','UserController@confirmEmail');
Route::match(['get','post'],'forgotPassword','UserController@forgotPassword');
Route::match(['get','post'],'passwordReset/{id}/{token}','UserController@passwordReset');

Route::middleware(['verified','user'])->group(function () {
	Route::get('dashboard', 'ReportController@dashboard');
	Route::post('addUserDefaultValues','ReportController@addUserDefaultValues');

	/*REPORTS SECTION*/
	Route::get('calculator', 'ReportController@calculator');
	Route::get('allReports', 'ReportController@allReports');
	Route::post('addReport','ReportController@addReport');
	Route::get('viewReport/{id}','ReportController@viewReport');
	Route::post('editReport','ReportController@editReport');
	Route::get('deleteReport/{id}','ReportController@deleteReport');
	Route::get('downloadReport/{type}/{id}','ReportController@downloadReport');
	Route::post('downloadMultipleReports','ReportController@downloadMultipleReports');

	/*CALCULATION SECTION*/
	Route::post('addCalculation','ReportController@addCalculation');
	Route::post('calculations','ReportController@calculations');

	/*SUBSCRIPTION SECTION*/
	Route::get('packages','Subscription@packages');
	Route::match(['get','post'],'buyProplix/{type}','Subscription@buyProplix');
	Route::get('transaction/{paymentId}/{subscriptionId}/{signature}/{type}','Subscription@transaction');
	Route::get('cancelSubscription/{id}','Subscription@cancelSubscription');
	Route::get('upgradeSubscription/{id}','Subscription@upgradeSubscription');


	/*PROFILE SECTION*/
	Route::match(['get','post'],'profile','UserController@profile');
	Route::match(['get','post'],'support','UserController@support');

});

/*ADMIN SECTION*/
Route::middleware(['admin'])->group(function () {
	Route::get('adminDashboard', 'AdminController@adminDashboard');
	Route::match(['get','post'],'adminProfile','AdminController@adminProfile');

	/*REPORTS SECTION*/
	Route::get('reports', 'AdminController@reports');
	Route::get('viewReportAdmin/{id}','AdminController@viewReportAdmin');
	Route::get('downloadReportsAdmin/{type}/{id}','AdminController@downloadReportsAdmin');
	Route::post('downloadMultipleReportsAdmin','AdminController@downloadMultipleReportsAdmin');

	/*USER SECTION*/
	Route::get('users','AdminController@users');
	Route::get('usersMembership','AdminController@usersMembership');
	Route::get('changeUserLoginStatus/{id}','AdminController@changeUserLoginStatus');

	/*COUPON SECTION*/
	Route::get('coupons','AdminController@coupons');
	Route::match(['get','post'],'addCoupon','AdminController@addCoupon');
	Route::match(['get','post'],'editCoupon/{id}','AdminController@editCoupon');
	Route::get('deleteCoupon/{id}','AdminController@deleteCoupon');

	/*USER SUBSCRIPTION CONTROLLED BY ADMIN*/
	Route::get('cancelUserSubscription/{userId}/{subscriptionId}','AdminController@cancelUserSubscription');



});
Route::match(['get','post'],'test','Subscription@test');
Route::match(['get','post'],'paytm','Subscription@paytm');
Route::match(['get','post'],'paytmSuccess','Subscription@paytmSuccess');
