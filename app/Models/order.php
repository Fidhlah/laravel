<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $guarded = ['id'];

    public function car()
{
    return $this->belongsTo(Car::class, 'id_car', 'id');
}
    public function user()
{
    return $this->belongsTo(User::class, 'id_customer', 'id');
}
    public function driver()
{
    return $this->belongsTo(Driver::class, 'id_driver', 'id');
}
}
