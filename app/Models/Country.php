<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = "countries";

    public function airbase()
    {
        return $this->hasMany(Airbase::class);
    }
}
