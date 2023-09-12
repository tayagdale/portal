<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionDetail extends Model
{
    protected $table = 'inspection_details';
    protected $primaryKey = 'id';
    protected $fillable = ['inspection_number', 'po_number', 'item_id', 'qty', 'delivery_date', 'lot_no', 'expiration_date', 'inspect_by'];
    use HasFactory;
}
