<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airbase extends Model
{
    use HasFactory;

    protected $table = "airbases";

    public function getImage()
    {
        if (substr($this->image, 0, 5) == "https") {
            return $this->image;
        }

        if ($this->image) {
            return asset('/uploads/imgCover/' . $this->image);
        }

        return 'https://via.placeholder.com/500x500.png?text=No+Cover';
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
}
