<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class Orders extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "orders";
    protected $guarded = [];

    public function room()
    {
        $this->belongsTo(Room::class);
    }
}
