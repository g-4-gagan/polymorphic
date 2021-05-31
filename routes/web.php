<?php

use Illuminate\Support\Facades\Route;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Staff;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/staff{id}/create',function($id){
	$staff = Staff::findOrFail($id);

	$staff->photos()->create(['path'=>'hello.jpeg']);
	return 'done';

});

Route::get('/staff{id}/photos',function($id){
	$staff = Staff::findOrFail($id);

	return $staff->photos;
});

Route::get('/staff{id}/update',function($id){
	$staff = Staff::findOrFail($id);

	$photo = $staff->photos()->whereId(1)->first();

	$photo->path = 'world.jpeg';

	$photo->save();

	return 'done';
});

Route::get('/staff{id}/delete',function($id){
	$staff = Staff::findOrFail($id);
	$staff->photos()->whereId(1)->delete();
	return 'done';
});

Route::get('/staff{id}/photo{id2}/assign',function($id,$id2){
	$staff = Staff::findOrFail($id);
	$photo = Photo::findOrFail($id2);

	$staff->photos()->save($photo);

	return "done";
});

Route::get('staff{id}/photo{id2}/unassign',function($id,$id2){
	$staff = Staff::findOrFail($id);
	$staff->photos()->whereId($id2)->update(['imageable_id'=>0,'imageable_type'=>'']);
	return "done";
});
