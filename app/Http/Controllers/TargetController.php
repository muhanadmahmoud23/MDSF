<?php

namespace App\Http\Controllers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class TargetController extends Controller
{
    public function importView(Request $request)
    {
        return view('excel.target');
    }

    public function import(Request $request)
    {
		
        $excelData = Excel::toArray([], $request->file('file')->store('files'))[0]; // store excell in array
        $excelColumnName = $excelData[0]; //get excel cloumn name 
		
        $excelColumnCount = count($excelData);
        $excelrowCount = count($excelColumnName);
		
	    //Get Date
	    $Current_month = date('m');
	    $Current_year = date('Y');

        $tableName = 'test_target_salesrep';
			
        //Trauncate Table
        $visitors = DB::table($tableName);
        $visitors->truncate();

		$NotAddedTables  = '';
		
        foreach ($excelColumnName as $column) {
			//Get Target Types
			$trim_beginning = substr( $column, 0, 5 );
			if(substr( $column, 0, 5 )  === "PROD_"){
			$trim_beginning = str_replace($trim_beginning, '', $column);
			$PROD_ID = str_replace('_TAR', '', $trim_beginning);
			$Target_type = DB::table('target_types')->where('target_scope','SalesMan')->where('PRODS_ID',$PROD_ID)->pluck('target_type_id')->first();
			$TargetTypes[] = [
				'PROD_NAME' => $column,
				'Target_type' => $Target_type,
			];
			}
			elseif($column == 'TISSUE_TON' || $column == 'BABY_DIAPERS' || $column == 'ADULT_TAR' || $column == 'CINDERLA_TAR'){
			if($column == 'TISSUE_TON'){
				$Target_type = 149;
			}elseif($column == 'BABY_DIAPERS' ){
				$Target_type = 150;
			}elseif($column == 'ADULT_TAR' ){
				$Target_type = 151;
			}elseif($column == 'CINDERLA_TAR'){
				$Target_type = 403;
			}
			$TargetTypes[] = [
				'PROD_NAME' => $column,
				'Target_type' => $Target_type,
			];
			}

		    // check if cloumn exist -- if(no) => add
            $isColExist = Schema::hasColumn($tableName, $column);
            if (!$isColExist) {
                $newColumnName = $column;
                Schema::table($tableName, function (Blueprint $table) use ($newColumnName) {
                    $table->decimal($newColumnName,12,3)->nullable();
                });
            }
        }

		
		if($excelData[0][0] == "BRANCH_CODE" && $excelData[0][1] == "SALESREP"){
		for($i = 1 ; $excelColumnCount > $i ; $i++){
			for($x = 2 ; $excelrowCount > $x ; $x++){
			
			$column = $excelColumnName[$x];
			$trim_beginning = substr($column, 0, 5 );
			
			$Target_type = null;
			
			if(substr( $column, 0, 5 )  === "PROD_"){
			$trim_beginning = str_replace($trim_beginning, '', $column);
			$PROD_ID = str_replace('_TAR', '', $trim_beginning);
			$Target_type = DB::table('target_types')->where('target_scope','SalesMan')->where('PRODS_ID',$PROD_ID)->pluck('target_type_id')->first();
			}elseif($column == 'TISSUE_TON' || $column == 'BABY_DIAPERS' || $column == 'ADULT_TAR' || $column == 'CINDERLA_TAR'){
			if($column == 'TISSUE_TON'){
				$Target_type = 149;
			}elseif($column == 'BABY_DIAPERS' ){
				$Target_type = 150;
			}elseif($column == 'ADULT_TAR' ){
				$Target_type = 151;
			}elseif($column == 'CINDERLA_TAR'){
				$Target_type = 403;
			}
			}

			if($Target_type !== null){
			DB::table($tableName)->insert([
			'SALESREP_ID' =>$excelData[$i][1],
			'TARGET_SALES' => $excelData[$i][$x],
			'TARGET_TYPE_ID' =>$Target_type,
			'MONTH' => $Current_month,
			'YEAR' => $Current_year,
			'BRANCH_CODE' => $excelData[$i][0]
			]);
			}
	
			}
					if($Target_type == null && $x == 3 ){$NotAddedTables .= '-' . $column . ' - ' ; }
		}
		if($NotAddedTables !== ''){
				return redirect()->back()->with('success',$NotAddedTables . 'Not added Succefully');	
		}else{
			return redirect()->back()->with('success', 'All Target Added Succefully');
		}
		}else{
			return redirect()->back()->with('success', 'SomeThing went wrong , Please Make Sure Branch if first column and SalesRep is second column');
		}
		
		if($excelData[0][0] == "BRANCH_CODE" && $excelData[0][1] == "SALESREP"){
		for ($i = 1; $i < $excelColumnCount; $i++) {
                $SalesReps[] = $excelData[$i][1];
				$Branch_codes[] = $excelData[$i][0];
        }
		for ($i = 1; $i < $excelColumnCount; $i++) {
            for ($x = 2; $x < $excelrowCount; $x++) {
                $TargetDetailsBySalesRep[$i] = $excelData[$i][$x];
           }
			
         //DB::table($tableName)->insert($TargetDetailsBySalesRep);
        }
		
		  for ($i = 0; $i < $excelColumnCount - 1; $i++) {
			DB::table('target_salesrep_test')->insert([
			'SALESREP_ID' => $SalesReps[$i],
			'TARGET_SALES' => 1,
			'TARGET_TYPE_ID' =>$TargetTypes[$i]['Target_type'] ,
			'MONTH' => $Current_month,
			'YEAR' => $Current_year,
			'BRANCH_CODE' => $Branch_codes[$i]
			]);

		}
		}else{
			return redirect()->back()->with('success', 'SomeThing went wrong , Please Make Sure Branch if first column and SalesRep is second column');
		}

		//dd($TargetTypes);
        //add data to table citites
        //for ($i = 1; $i < $excelColumnCount; $i++) {
            //for ($x = 0; $x < $excelrowCount; $x++) {
                //$TargetDetailsBySalesRep[$excelColumnName[$x]] = $excelData[$i][$x];
           // }
			
            //DB::table($tableName)->insert($TargetDetailsBySalesRep);
      //  }
		
		//Get Target Type
		
		
        return redirect()->back()->with('success', 'Please check taret_salesrep_test');
    }
}
