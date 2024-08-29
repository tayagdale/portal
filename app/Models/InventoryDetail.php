<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryDetail extends Model
{
    protected $table = 'inventory_details';
    protected $primaryKey = 'id';
    protected $fillable = ['po_number', 'item_id', 'qty', 'unit_price', 'lot_no', 'expiration_date', 'encoded_by'];
    use HasFactory;
}
