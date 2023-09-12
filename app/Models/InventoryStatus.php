<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryStatus extends Model
{
    protected $table = 'inventory_statuses';
    protected $primaryKey = 'id';
    protected $fillable = ['status_value'];
    use HasFactory;
}
