<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    // use HasFactory, HasUuids;
    use HasFactory, SoftDeletes;

    public $incrementing = false; // need to create a uuid model to based upon later
}

// $todo = Todo::create([]);
// $todo->id;
