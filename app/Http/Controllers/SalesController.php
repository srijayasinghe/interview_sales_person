<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Exception;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function addSalesPersonAction(){
        try{
            return view('sales.addSalesPerson');
        }catch(Exception $ex){
            //return exception message
            return response()->json([
            'success' =>  false,
            'message' => $this->defaultServerError . ' Error: ' . $ex->getMessage(),
            ], 500);
        }

    }

    public function listProductAction (){
        try{
            return view('sales.listSalesPerson');
        }catch(Exception $ex){
            //return exception message
            return response()->json([
            'success' =>  false,
            'message' => $this->defaultServerError . ' Error: ' . $ex->getMessage(),
            ], 500);
        }

    }


    public function editProductAction ($id){
        try{
            return view('sales.editSalesPerson',['id'=>$id]);
        }catch(Exception $ex){
            //return exception message
            return response()->json([
            'success' =>  false,
            'message' => $this->defaultServerError . ' Error: ' . $ex->getMessage(),
            ], 500);
        }
    }

    public function editFormProductAction ($id){
        try{
            $person = Person::find($id);
            return view('sales.editFromSalesPerson',['id'=>$id, 'person'=>$person]);
        }catch(Exception $ex){
            //return exception message
            return response()->json([
            'success' =>  false,
            'message' => $this->defaultServerError . ' Error: ' . $ex->getMessage(),
            ], 500);
        }
    }


}
