<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'id';
    protected $fillable = ['customer_id', 'reservation_date', 'os_number', 'status'];
    use HasFactory;
}
