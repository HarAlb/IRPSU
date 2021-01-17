<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugSubstance extends Model
{
    use HasFactory;

    protected $table = 'drug_substance';

    protected $fillable = [
        'drug_id',
        'substance_id'
    ];
}
