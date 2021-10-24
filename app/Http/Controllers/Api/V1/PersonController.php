<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use Illuminate\Http\Request;
use App\Interfaces\PersonInterface;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    public function createAction(Request $request, PersonInterface $personInterface){
        try{
            $personInterface->create($request);
            return redirect()->route('listSalesPerson');
        }catch(Exception $ex){
            //return exception message
            return response()->json([
            'success' =>  false,
            'message' => $this->defaultServerError . ' Error: ' . $ex->getMessage(),
            ], 500);
        }

    }

    public function updateAction(Request $request, PersonInterface $personInterface){
        try{
             $personInterface->update($request);
            return redirect()->route('listSalesPerson');
        }catch(Exception $ex){
            //return exception message
            return response()->json([
            'success' =>  false,
            'message' => $this->defaultServerError . ' Error: ' . $ex->getMessage(),
            ], 500);
        }

    }

    public function deleteAction($id,PersonInterface $personInterface){
        try{
            return $personInterface->delete($id);
        }catch(Exception $ex){
            //return exception message
            return response()->json([
            'success' =>  false,
            'message' => $this->defaultServerError . ' Error: ' . $ex->getMessage(),
            ], 500);
        }

    }

    public function listAction(PersonInterface $personInterface){
        try{
            return $personInterface->list();
        }catch(Exception $ex){
            //return exception message
            return response()->json([
            'success' =>  false,
            'message' => $this->defaultServerError . ' Error: ' . $ex->getMessage(),
            ], 500);
        }

    }

    public function viewAction($id, PersonInterface $personInterface){
        try{
            return $personInterface->view($id);
        }catch(Exception $ex){
            //return exception message
            return response()->json([
            'success' =>  false,
            'message' => $this->defaultServerError . ' Error: ' . $ex->getMessage(),
            ], 500);
        }

    }
}
