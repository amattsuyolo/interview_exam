<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;
use App\Models\Orders;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "room";
    protected $guarded = [];

    public function property()
    {
        return $this->BelongsTo(Property::class);
    }
    public function orders()
    {
        return $this->hasMany(Orders::class);
    }
}
