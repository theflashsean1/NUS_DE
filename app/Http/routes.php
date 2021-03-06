<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Routing;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('/signup',[
    'uses' => 'UserController@postSignUp',
    'as' => 'signup'
]);



Route::post('/signin',[
    'uses'=>'UserController@postSignIn',
    'as'=>'signin'
]);

Route::get('/logout',[
    'uses'=>'UserController@getLogout',
    'as'=>'logout',
    'middleware'=>'auth'
]);

Route::get('/account',[
    'uses' => 'UserController@getAccount',
    'as'=>'account',
    'middleware' => 'auth'
]);
Route::post('/updateaccount',[
    'uses' => 'UserController@postSaveAccount',
    'as' => 'account.save'
]);

Route::get('/userimage/{filename}',[
    'uses' => 'UserController@getUserImage',
    'as' => 'account.image'
]);

/*
 * 'Semi-Static' Pages routes
 */
Route::get('/dea/pub',[
    'uses' => 'PublicController@getDeaContent',
    'as' => 'dea-pub'
]);
Route::get('/deg/pub',[
    'uses' => 'PublicController@getDegContent',
    'as' => 'deg-pub'
]);
Route::get('/publicimage/{filename}',[
    'uses' => 'PublicController@getPublicImage',
    'as' => 'public.image'
]);

Route::get('/contact',[
    'uses'=>'PublicController@getContact',
    'as' => 'contact'
]);
/*
 *  Post for DEA/DEG/Public
 */
Route::get('/progress/public', [
    'uses'=>'PostController@getProgressPublic',
    'as'=>'progress-pub',
]);
Route::get('/progress/DEA',[
    'uses'=>'PostController@getProgressDea',
    'as'=>'progress-dea',
    'middleware' => 'auth'
]);
Route::get('/progress/DEG',[
    'uses'=>'PostController@getProgressDeg',
    'as' => 'progress-deg',
    'middleware' => 'auth'
]);


Route::post('/createpost',[
    'uses'=>'PostController@postCreatePost',
    'as'=>'post.create',
    'middleware' => 'auth'
]);

Route::get('/delete-post/{post_id}',[
    'uses'=>'PostController@getDeletePost',
    'as'=>'post.delete',
    'middleware' => 'auth'
]);

Route::post('/edit', [
    'uses'=>'PostController@postEditPost',
    'as'=>'edit',
    'middleware'=>'auth'
]);

/*
 *  DEA page
 */
Route::get('/DEA/{dimension_id}/{configuration_id}/{material_id}/{prestretch}/{layer}/{page_num}',[
    'uses'=>'DeController@getDeaDashboard',
    'as' =>'deaDashboard',
    'middleware' => 'auth'
]);


Route::post('/createDEA',[
    'uses' => 'DeController@postCreateDea',
    'as' => 'post.createDEA',
    'middleware' =>'auth'
]);

Route::post('/searchDEA',[
    'uses' => 'DeController@postSearchDea',
    'as'=>'post.searchDEA',
    'middleware' => 'auth'
]);

Route::post('/deleteDEA',[
    'uses' => 'DeController@postDeleteDea',
    'as' => 'post.deleteDEA',
    'middleware' => 'auth'
]);

Route::post('/deaImage',[
    'uses' => 'DeController@postDeaImage',
    'as' => 'post.deaImage'
]);
Route::get('/getDeaImage/{filename}',[
    'uses' => 'DeController@getDeaImage',
    'as' => 'get.deaImage'
]);
Route::post('/deleteDeaImage',[
    'uses' => 'DeController@postDeleteDeaImage',
    'as' => 'post.deleteDeaImage'
]);
Route::post('/deaVisibility',[
    'uses' => 'DeController@postDeaVisibility',
    'as' => 'post.deaVisibility'
]);
Route::post('/deaToggleVisibility',[
   'uses' => 'DeController@postDeaToggleVisibility',
    'as' => 'post.deaToggleVisibility'
]);
/*
 *  DEG page
 */
Route::get('/DEG/{dimension_id}/{configuration_id}/{material_id}/{prestretch}/{layer}/{page_num}',[
    'uses'=>'DeController@getDegDashboard',
    'as' => 'degDashboard',
    'middleware' => 'auth'
]);

Route::post('/createDEG',[
    'uses' => 'DeController@postCreateDeg',
    'as' => 'post.createDEG',
    'middleware' => 'auth'
]);
Route::post('/searchDEG',[
    'uses' => 'DeController@postSearchDeg',
    'as' => 'post.searchDEG',
    'middleware' => 'auth'
]);
Route::post('/deleteDEG',[
    'uses' => 'DeController@postDeleteDeg',
    'as' => 'post.deleteDEG',
    'middleware' => 'auth'
]);

Route::post('/degImage',[
    'uses' => 'DeController@postDegImage',
    'as' => 'post.degImage'
]);
Route::get('/getDegImage/{filename}',[
   'uses' => 'DeController@getDegImage',
    'as' => 'get.degImage'
]);
Route::post('/deleteDegImage',[
    'uses' => 'DeController@postDeleteDegImage',
    'as' => 'post.deleteDegImage'
]);
Route::post('/degVisibility',[
    'uses' => 'DeController@postDegVisibility',
    'as' => 'post.degVisibility'
]);
Route::post('/degToggleVisibility',[
    'uses' => 'DeController@postDegToggleVisibility',
    'as' => 'post.degToggleVisibility'
]);
/*
 *  DE Common
 */
//Dimension
Route::post('/addDimension',[
    'uses' => 'DeController@postAddDimension',
    'as' => 'post.addDimension',
    'middleware' => 'auth'
]);
Route::post('/editDimension',[
    'uses' => 'DeController@postEditDimension',
    'as' => 'post.editDimension',
    'middleware' => 'auth'
]);
Route::post('/deleteDimension',[
    'uses' => 'DeController@postDeleteDimension',
    'as' => 'post.deleteDimension',
    'middleware' =>'auth'
]);


//Configuration
Route::post('/addConfiguration',[
    'uses' => 'DeController@postAddConfiguration',
    'as'=>'post.addConfiguration',
    'middleware' => 'auth'
]);
Route::post('/editConfiguration',[
    'uses' => 'DeController@postEditConfiguration',
    'as' => 'post.editConfiguration',
    'middleware' => 'auth'
]);
Route::post('/deleteConfiguration',[
    'uses' => 'DeController@postDeleteConfiguration',
    'as' => 'post.deleteConfiguration',
    'middleware' =>'auth'
]);

//Material
Route::post('/addMaterial', [
    'uses' => 'DeController@postAddMaterial',
    'as' => 'post.addMaterial',
    'middleware' => 'auth'
]);
Route::post('/editMaterial',[
    'uses' => 'DeController@postEditMaterial',
    'as' => 'post.editMaterial',
    'middleware' => 'auth'
]);
Route::post('/deleteMaterial',[
    'uses' => 'DeController@postDeleteMaterial',
    'as' => 'post.deleteMaterial',
    'middleware' =>'auth'
]);

/*
 * DEA Experiment page
 */
Route::get('/experimentDEA/{page_number}',[
    'uses' =>'ExperimentController@getDeaExperiment',
    'as'=>'deaExperiment',
    'middleware' => 'auth'
]);

/*
 * DEG Experiment page
 */
Route::get('/experimentDEG/{page_number}',[
    'uses' => 'ExperimentController@getDegExperiment',
    'as' => 'degExperiment',
    'middleware' => 'auth'
]);



/*
 * DE Experiment Common
 */
Route::post('/createExperiment',[
    'uses' => 'ExperimentController@postCreateExperiment',
    'as' => 'post.createExperiment',
    'middleware' => 'auth'
]);

Route::post('/deleteExperiment',[
    'uses' => 'ExperimentController@postDeleteExperiment',
    'as' => 'post.deleteExperiment',
    'middleware' => 'auth'
]);

Route::post('/experimentImage',[
    'uses' => 'ExperimentController@postExperimentImage',
    'as' => 'post.experimentImage'
]);

Route::post('/deleteExperimentImage',[
    'uses' => 'ExperimentController@postDeleteExperimentImage',
    'as' => 'post.deleteExperimentImage'
]);

//Equipment
Route::post('/createEquipment',[
    'uses' => 'ExperimentController@postCreateEquipment',
    'as'=>'post.createEquipment',
    'middleware' => 'auth'
]);
Route::post('/editEquipment',[
    'uses' => 'ExperimentController@postEditEquipment',
    'as' => 'post.editEquipment',
    'middleware' => 'auth'
]);
Route::post('/deleteEquipment',[
    'uses' => 'ExperimentController@postDeleteEquipment',
    'as' => 'post.deleteEquipment',
    'middleware' => 'auth'
]);
Route::get('/getEquipmentImage/{filename}',[
    'uses' => 'ExperimentController@getEquipmentImage',
    'as' => 'get.equipmentimage'
]);
Route::post('/equipmentImage',[
    'uses' => 'ExperimentController@postEquipmentImage',
    'as' => 'post.equipmentImage'
]);
Route::post('/deleteEquipmentImage',[
    'uses' => 'ExperimentController@postDeleteEquipmentImage',
    'as' => 'post.deleteEquipmentImage'
]);

Route::post('/equipmentToggleVisibility',[
    'uses' => 'ExperimentController@postEquipmentToggleVisibility',
    'as' => 'post.equipmentToggleVisibility'
]);
Route::post('/equipmentImageDelete',[
   'uses' => 'ExperimentController@postEquipmentDeleteImage',
    'as' => 'post.equipmentImageDelete'
]);

//Parameter
Route::post('/createParameter',[
    'uses' =>'ExperimentController@postCreateParameter',
    'as' => 'post.createParameter',
    'middleware' => 'auth'
]);
Route::post('/editParameter',[
    'uses' => 'ExperimentController@postEditParameter',
    'as' => 'post.editParameter',
    'middleware' => 'auth'
]);
Route::post('/deleteParameter',[
    'uses' => 'ExperimentController@postDeleteParameter',
    'as' => 'post.deleteParameter',
    'middleware' => 'auth'
]);
/*
 * Management Page
 */
Route::get('/management',[
    'uses' => 'ManagementController@getManagementDashboard',
    'as'=>'management',
    'middleware' => 'auth'
]);

Route::get('/equipmentImage/{filename}',[
    'uses' => 'ExperimentController@getEquipmentImage',
    'as' => 'get.equipmentImage'
]);
