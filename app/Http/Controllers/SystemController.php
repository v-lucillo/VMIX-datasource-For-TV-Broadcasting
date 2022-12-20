<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;



class SystemController extends Controller
{
    public function index(Request $request){
    	session([
    		"active_page_sub" => 0,
            "active_tab" => 0,
    	]);

    	return view("system.index");
    }


    public function next_and_now(Request $request){
        session([
            "active_page_sub" => 0,
            "active_tab" => 1,
        ]);
        return view("system.next_and_now");
    }

    public function interview_and_breaking(Request $request){
        session([
            "active_page_sub" => 0,
            "active_tab" => 2,
        ]);
        return view("system.interview_and_breaking");
    }

    public function scratch(Request $request){
        session([
            "active_page_sub" => 0,
            "active_tab" => 3,
        ]);
        return view("system.scratch");
    }







    public function source_1_text(){
        session([
            "active_page_sub" => 1
        ]);
        $data = DB::select("SELECT data FROM source_1_text_tbl")[0]->data;
        return view("system.source_1_text",compact('data'));
    }


    public function skype(){
        session([
            "active_page_sub" => 2
        ]);
        $data = DB::select("SELECT data FROM skype_source_tbl")[0]->data;
        return view("system.skype",compact('data'));
    }

    public function courtesy(){
        session([
            "active_page_sub" => 3
        ]);
        $data = DB::select("SELECT data FROM courtesy_source_tbl")[0]->data;
        return view("system.courtesy",compact('data'));
    }


    public function one(){
        session([
            "active_page_sub" => 4
        ]);
        $data = DB::select("SELECT data FROM one_source_tbl")[0]->data;
        return view("system.one",compact('data'));
    }


    public function two(){
        session([
            "active_page_sub" => 5
        ]);
        $data = DB::select("SELECT data FROM two_source_tbl")[0]->data;
        return view("system.two",compact('data'));
    }

    public function three(){
        session([
            "active_page_sub" => 6
        ]);
        $data = DB::select("SELECT data FROM three_source_tbl")[0]->data;
        return view("system.three",compact('data'));
    }

    public function four(){
        session([
            "active_page_sub" => 7
        ]);
        $data = DB::select("SELECT data FROM four_source_tbl")[0]->data;
        return view("system.four",compact('data'));
    }









    public function save_source_1(Request $request){
    	$data =  $request->data;
    	foreach ($data as $key => $value) {
    		DB::table("source_1_tbl")->where("id",$key+1)->update($value);
    	}
    }

    public function save_next_and_now(Request $request){
        $data =  $request->data;
        foreach ($data as $key => $value) {
            DB::table("next_and_now_tbl")->where("id",$key+1)->update($value);
        }
    }

    public function save_interview_and_breaking(Request $request){
        $data =  $request->data;
        foreach ($data as $key => $value) {
            DB::table("interview_and_breaking_source_tbl")->where("id",$key+1)->update($value);
        }
    }

    public function save_scratch(Request $request){
        $data =  $request->data;
        foreach ($data as $key => $value) {
            DB::table("scratch_tbl")->where("id",$key+1)->update($value);
        }
    }











    public function save_source_1_txt(Request $request){
    	$data =  $request->data;
    	// dd($data);
    	DB::table("source_1_text_tbl")->where("id",1)->update([
    		"data" => $data
    	]);
    }


    public function save_skype(Request $request){
        $data =  $request->data;
        // dd($data);
        DB::table("skype_source_tbl")->where("id",1)->update([
            "data" => $data
        ]);
    }


    public function save_courtesy(Request $request){
        $data =  $request->data;
        // dd($data);
        DB::table("courtesy_source_tbl")->where("id",1)->update([
            "data" => $data
        ]);
    }

    public function save_one(Request $request){
        $data =  $request->data;
        // dd($data);
        DB::table("one_source_tbl")->where("id",1)->update([
            "data" => $data
        ]);
    }

    public function save_two(Request $request){
        $data =  $request->data;
        // dd($data);
        DB::table("two_source_tbl")->where("id",1)->update([
            "data" => $data
        ]);
    }


    public function save_three(Request $request){
        $data =  $request->data;
        // dd($data);
        DB::table("three_source_tbl")->where("id",1)->update([
            "data" => $data
        ]);
    }


    public function save_four(Request $request){
        $data =  $request->data;
        // dd($data);
        DB::table("four_source_tbl")->where("id",1)->update([
            "data" => $data
        ]);
    }








    private function get_data_source_1($table){
        $data = DB::select("SELECT * FROM $table");
        $data_holder = array();

        foreach ($data as $key => $value) {
            $val =  (array)$value;
            unset($val['id']);
            array_push($data_holder, $val);
        }

        return $data_holder;
    }





    public function source_1_tbl(){
        $data_cell = $this->get_data_source_1("source_1_tbl");
        return response()->json([
            "source" => $data_cell
        ]);
    }

    public function next_and_now_tbl(){
        $data_cell = $this->get_data_source_1("next_and_now_tbl");
        return response()->json([
            "source" => $data_cell
        ]);
    }

    public function interview_and_breaking_source_tbl(){
        $data_cell = $this->get_data_source_1("interview_and_breaking_source_tbl");
        return response()->json([
            "source" => $data_cell
        ]);
    }

    public function scratch_tbl(){
        $data_cell = $this->get_data_source_1("scratch_tbl");
        return response()->json([
            "source" => $data_cell
        ]);
    }

}
