<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\SystemController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
	// dd(session('user'));
	if(session("user")){
		return redirect()->route("system.index");
	}

    return view('welcome');
})->name('home');




Route::post("login", function(Request $request){
	$username =  $request->username;
	$password = $request->password;
	$data =  DB::select("SELECT * FROM system_user_tbl WHERE username = '$username'");
	if($data){
		if(Hash::check($password,$data[0]->password)){
			$data[0]->user = 1;
			$data[0]->station = 0;
			session(["user"  => $data[0]]);
			return back();
	    }
	}

	throw ValidationException::withMessages(['login_error' => 'Invalid username or password']);
})->name("login");



Route::middleware(['system_access'])->prefix("system")->name("system.")->group(function(){
	Route::get('index','SystemController@index')->name('index');
	Route::get('logout','SystemController@logout')->name('logout');

	Route::get('next_and_now','SystemController@next_and_now')->name('next_and_now');
	Route::get('interview_and_breaking','SystemController@interview_and_breaking')->name('interview_and_breaking');
	Route::get('scratch','SystemController@scratch')->name('scratch');


	Route::get('source_1_tbl','SystemController@source_1_tbl')->name('source_1_tbl');
	Route::get('next_and_now_tbl','SystemController@next_and_now_tbl')->name('next_and_now_tbl');
	Route::get('interview_and_breaking_source_tbl','SystemController@interview_and_breaking_source_tbl')->name('interview_and_breaking_source_tbl');
	Route::get('scratch_tbl','SystemController@scratch_tbl')->name('scratch_tbl');
	

	Route::get('source_1_text','SystemController@source_1_text')->name('source_1_text');
	Route::get('skype','SystemController@skype')->name('skype');
	Route::get('courtesy','SystemController@courtesy')->name('courtesy');
	Route::get('one','SystemController@one')->name('one');
	Route::get('two','SystemController@two')->name('two');
	Route::get('three','SystemController@three')->name('three');
	Route::get('four','SystemController@four')->name('four');




	Route::prefix("button")->name("button.")->group(function(){
		Route::post('save_source_1','SystemController@save_source_1')->name('save_source_1');
		Route::post('save_source_1_txt','SystemController@save_source_1_txt')->name('save_source_1_txt');
		Route::post('save_skype','SystemController@save_skype')->name('save_skype');
		Route::post('save_courtesy','SystemController@save_courtesy')->name('save_courtesy');
		Route::post('save_one','SystemController@save_one')->name('save_one');
		Route::post('save_two','SystemController@save_two')->name('save_two');
		Route::post('save_three','SystemController@save_three')->name('save_three');
		Route::post('save_four','SystemController@save_four')->name('save_four');
		Route::post('save_next_and_now','SystemController@save_next_and_now')->name('save_next_and_now');
		Route::post('save_interview_and_breaking','SystemController@save_interview_and_breaking')->name('save_interview_and_breaking');
		Route::post('save_scratch','SystemController@save_scratch')->name('save_scratch');
	});


	Route::prefix("api")->name("api.")->group(function(){
		Route::get('get_data_source_1','SystemController@get_data_source_1')->name('get_data_source_1');
	});


});

Route::prefix("vmix_data_source")->name("vmix_data_source.")->group(function(){
	Route::get('get_source_excel','LinkController@get_source_excel')->name('get_source_excel');
	Route::get('get_source_text','LinkController@get_source_text')->name('get_source_text');
});