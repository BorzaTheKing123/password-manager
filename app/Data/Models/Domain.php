<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model {
    protected $fillable = ['domain', 'salt'];
}