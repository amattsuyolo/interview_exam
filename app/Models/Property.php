<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class Property extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "property";
    protected $guarded = [];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
