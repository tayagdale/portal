<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory';
    protected $primaryKey = 'id';
    protected $fillable = ['item_id', 'item_brand_name', 'item_category_id', 'item_unit_id'];
    use HasFactory;
}
