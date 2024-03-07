<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationDetails extends Model
{
    protected $table = 'reservation_details';
    protected $primaryKey = 'id';
    protected $fillable = ['reservation_id', 'item_id', 'unit_id' ,'qty'];
    use HasFactory;
}
