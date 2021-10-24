<?php

namespace Tests\Feature\Api\V1\Sales;

use Tests\TestCase;
use App\Models\Person;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonTest extends TestCase
{

    use RefreshDatabase;

    public function test_person_list(){

        //create 10 person record in db
        $persons = Person::factory(10)->create();

        //get id list of persons
        $personIds = $persons->map(function($person){return $person->id;})->toArray();

        //call to url and get response
        $response = $this->json('get', '/api/v1/person/list');

        //check is response is 200
        $response->assertStatus(200);

        //get response josn data section only
        $data = $response->json('data');

        //create collection and loop within the each data block
        collect($data)->each(

            //Callback function with personIds
            function($person)use($personIds){

                //check is assert return true , check is that ids avialable in json return
                $this->assertTrue(in_array($person['id'],$personIds));
            }
        );
    }

    public function test_show_person(){

        //create dummy records
        $dummy = Person::factory()->create();

        //call person view route
        $response = $this->json('get','/api/v1/person/view/'.$dummy->id);

        //check is response code is 200
        $result = $response->assertStatus(200)->json('data');

        //check requested id is match with return id
        $this->assertEquals(data_get($result, 'id'),$dummy->id,'Response ID not the same as model ID');
    }



    public function test_create_person(){

        //create dummy person request data
        $dummy = Person::factory()->make();

        //call person create api with dummy headder
        $response = $this->json('post','/api/v1/person/create',$dummy->toArray());

        //check is response code 201 and get data set
        $result = $response->assertStatus(201)->json('data');

        //create collection using result with dummy attributes (dummy array keys)
        $result = collect($result)->only(array_keys($dummy->getAttributes()));

        $result->each(function($value,$field)use($dummy){
            $this->assertSame(data_get($dummy,$field),$value,'Fillable is not the same!.');
        });
    }


    public function test_update_person(){

        //create dummy person
        $dummy = Person::factory()->create();
        $dummy2 = Person::factory()->create();

        //call update route
        $response = $this->json('patch','/api/v1/person/update/'. $dummy->id,$dummy2->toArray());

        //check response code
        $response->assertStatus(200)->json('data');

        //refresh dummy and remove id
        $arrayDummy = $dummy->refresh()->toArray();
        unset($arrayDummy['id']);

        //refresh dummy2 and remove id
        $arrayDummy2 = $dummy2->refresh()->toArray();
        unset($arrayDummy2['id']);

        //comperaring two data, validate update happen in db
        $this->assertSame($arrayDummy,$arrayDummy2,'Failed to update model!');
    }


    public function test_delete_person(){

        //create dummy person
        $dummy = Person::factory()->create();

        //call delete route
        $response = $this->json('delete','/api/v1/person/delete/'.$dummy->id);

        //check resposne code is 200
        $result = $response->assertStatus(200);

        //expect not found exception
        $this->expectException(ModelNotFoundException::class);

        //check with db, person record is available in db or not
        Person::query()->findOrFail($dummy->id);
    }
}
