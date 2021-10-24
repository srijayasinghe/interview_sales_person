<?php

namespace App\Services;

use Exception;

use App\Models\Person;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Interfaces\PersonInterface;
use Illuminate\Support\Facades\Validator;

class PersonService implements PersonInterface
{

    private $defaultServerError = 'Something went wrong, please try again!';

    /**
     * Person create method
     */
    public function create(Request $request){
        try{
            $validatior = Validator::make($request->all(),[
                'name'=>'required|string|max:300',
                'email'=>'required|email',
                'address'=> 'required|string',
                'telephone'=>'required',
                'join_date'=>'required|date',
                'current_route'=>'nullable|string|max:200',
                'comments'=>'nullable|string'
            ]);

             //if validation fails, return error message
             if ($validatior->fails()) {
                return response()->json([
                    "success" => false,
                    "message" => $validatior->errors(),
                ], 400);
            }

            $person = new Person();
            $person->name = $request->get('name');
            $person->email = $request->get('email');
            $person->address = $request->get('address');
            $person->telephone = $request->get('telephone');
            $person->join_date = $request->get('join_date');
            $person->current_route = $request->get('current_route');
            $person->comments = $request->get('comments');
            $person->type = 'sales';
            $person->save();


            return response()->json([
                'success'=>true,
                'message'=> 'Person recorded successfully created!'
            ],201);

        }catch(Exception $ex){
            //return exception message
            return response()->json([
            'success' =>  false,
            'message' => $this->defaultServerError . ' Error: ' . $ex->getMessage(),
            ], 500);
        }

    }

    public function update(Request $request){
        try{
            $validatior = Validator::make($request->all(),[
                'id'=> 'required|integer',
                'name'=>'required|string|max:300',
                'email'=>'required|email',
                'address'=> 'required|string',
                'telephone'=>'required',
                'join_date'=>'required|date',
                'current_route'=>'nullable|string|max:200',
                'comments'=>'nullable|string'
            ]);

             //if validation fails, return error message
             if ($validatior->fails()) {
                return response()->json([
                    "success" => false,
                    "message" => $validatior->errors(),
                ], 400);
            }

            $person =  Person::find($request->get('id'));
            $person->name = $request->get('name');
            $person->email = $request->get('email');
            $person->address = $request->get('address');
            $person->telephone = $request->get('telephone');
            $person->join_date = $request->get('join_date');
            $person->current_route = $request->get('current_route');
            $person->comments = $request->get('comments');
            $person->type = 'sales';
            $person->save();

            return response()->json([
                'success'=>true,
                'message'=> 'Person recorded successfully updated!'
            ],200);
        }catch(Exception $ex){
            //return exception message
            return response()->json([
            'success' =>  false,
            'message' => $this->defaultServerError . ' Error: ' . $ex->getMessage(),
            ], 500);
        }

    }

    public function delete($id){
        try{
            Person::find($id)->delete();

            return response()->json([
                'success'=>true,
                'message'=>'Person successfuly deleted!'
            ],200);
        }catch(Exception $ex){
            //return exception message
            return response()->json([
            'success' =>  false,
            'message' => $this->defaultServerError . ' Error: ' . $ex->getMessage(),
            ], 500);
        }

    }

    public function list(){
        try{
            //get data from databae
            $persons = Person::where('type', 'sales')
                ->orderBy('created_at', 'DESC')->get();

            return response()->json([
                'success'=>true,
                'data'=>$persons
            ]);
        }catch(Exception $ex){
            //return exception message
            return response()->json([
            'success' =>  false,
            'message' => $this->defaultServerError . ' Error: ' . $ex->getMessage(),
            ], 500);
        }
    }

    public function view($id){
        try{
            $person = Person::find($id);

            return response()->json([
                'success'=>true,
                'data'=>$person
            ]);

        }catch(Exception $ex){
            //return exception message
            return response()->json([
            'success' =>  false,
            'message' => $this->defaultServerError . ' Error: ' . $ex->getMessage(),
            ], 500);
        }
    }
}
