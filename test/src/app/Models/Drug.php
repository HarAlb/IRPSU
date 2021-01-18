<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Drug
 * @package App\Models
 */
class Drug extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $perPage = 5;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function substances()
    {
        return $this->belongsToMany(Substance::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function substancesNotPrimary(){
        return $this->substances()->where([
            ['drug_substance.visible' , '=' ,1],
            ['substances.visible' , '=' ,1],
        ]);
    }

    public function relations(){
        return $this->hasMany(DrugSubstance::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($drug) { 
             $drug->relations()->delete();
        });
    }
}
