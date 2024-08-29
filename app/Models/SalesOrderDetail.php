<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderDetail extends Model
{
    protected $table = 'sales_order_details';
    protected $primaryKey = 'id';
    protected $fillable = ['so_number', 'os_number', 'invty_id', 'item_id', 'qty', 'unit_id', 'lot_no', 'expiration_date', 'unit_price', 'remarks'];
    use HasFactory;
}
