<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    use HasFactory;
    protected $table = 'person';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'address',
        'telephone',
        'join_date',
        'comments',
        'type'
    ];

}
