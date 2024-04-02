<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $fillable = ['category_id', 'generic_name', 'brand_name', 'uom_1', 'qty_1', 'uom_2', 'qty_2', 'encoded_by'];
    use HasFactory;
}
