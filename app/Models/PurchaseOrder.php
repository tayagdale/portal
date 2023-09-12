<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
// {
//     protected $guarded = ['id'];

//     protected static function booted()
//     {
//         static::creating(function ($purchaseOrder) {
//             // Check and reset the PO number counter at the start of each month
//             $purchaseOrder->po_number = static::generatePONumber();
//         });
//     }

//     protected static function generatePONumber()
//     {
//         $prefix = 'PO';
//         $currentYear = now()->format('Y');
//         $currentMonth = now()->format('m');

//         // Get the latest PO number in the current year and month
//         $lastPO = static::where('po_number', 'LIKE', "{$prefix}{$currentYear}{$currentMonth}%")
//             ->orderBy('po_number', 'desc')
//             ->first();

//         if ($lastPO) {
//             $lastNumber = intval(substr($lastPO->po_number, -3));
//             return "{$prefix}{$currentYear}{$currentMonth}" . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
//         }

//         return "{$prefix}{$currentYear}{$currentMonth}001";
//     }
// }
{
    protected $table = 'purchase_orders';
    protected $primaryKey = 'id';
    use HasFactory;
}
