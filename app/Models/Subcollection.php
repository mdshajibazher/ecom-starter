<?php

namespace App\Models;

use App\Models\Label;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcollection extends Model
{
    use HasFactory;

    Public function Label(){
        return $this->belongsTo(Label::class);
    }
}
