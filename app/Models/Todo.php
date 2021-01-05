<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    public $table = 'todos';
    public $primaryKey = 'id';

    protected $fillable = [
        'title', 'desscription', 'created', 'due_date'
    ];
}
