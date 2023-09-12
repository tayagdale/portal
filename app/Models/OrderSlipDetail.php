<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSlipDetail extends Model
{
    protected $table = 'order_slip_details';
    protected $primaryKey = 'id';
    protected $fillable = ['os_number', 'item_id', 'unit_id' ,'qty'];
    use HasFactory;
}
