<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    protected $table = 'purchase_order_details';
    protected $primaryKey = 'id';
    protected $fillable = ['po_number', 'item_id', 'qty', 'unit_id', 'unit_price', 'total_amount', 'remarks'];
    use HasFactory;
}
