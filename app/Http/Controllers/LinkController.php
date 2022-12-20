<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LinkController extends Controller
{
    //
    public function get_source_excel(Request $request){
        $table =  $request->table;
    	$data = DB::select("SELECT * FROM $table");
    	$data_holder = array();

    	$col_label =  ["A","B","C","D","E","F","G","H","I","J"];
    	foreach ($data as $key => $value) {
    		$val =  (array)$value;
    		unset($val['id']);
    		for($i = 0; $i < sizeof($val); $i++){
    			if($val[$i] == null){
    				$val[$i] = "";
    			}
    		}

    		$data_ret = [];
    		for($y = 0; $y < sizeof($col_label); $y++){
    			$data_ret[$col_label[$y]] = $val[$y];
    		}

            $counter = 0;
            foreach ($data_ret as $key => $value) {
                if($value == ""){
                    unset($data_ret[$key]);
                    $counter++;
                }
            }

            if($counter == 10){
                continue;
            }

    		array_push($data_holder, $data_ret);
    	}

    	return response()->json($data_holder);
    }


    public function get_source_text(Request $request){
        $table = $request->table;
    	return response()->json(
    		DB::select("SELECT data as TEXT FROM $table")
    	);
    }

    // public function a
}
