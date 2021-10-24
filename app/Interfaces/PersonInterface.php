<?php

namespace App\Interfaces;

use Illuminate\Http\Request;


interface PersonInterface
{

    public function create(Request $request);

    public function update(Request $request);

    public function delete($id);

    public function list();

    public function view($id);
}
