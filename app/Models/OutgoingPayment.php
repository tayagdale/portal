<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingPayment extends Model
// {
//     protected $guarded = ['id'];
//     protected $table = 'outgoing_payment';

//     protected static function booted()
//     {
//         static::creating(function ($outgoing_payment) {
//             // Check and reset the PO number counter at the start of each month
//             $outgoing_payment->por_number = static::generateORNumber();
//         });
//     }

//     protected static function generateORNumber()
//     {
//         $prefix = 'POR';
//         $currentYear = now()->format('Y');
//         $currentMonth = now()->format('m');

//         // Get the latest PO number in the current year and month
//         $lastPOR = static::where('por_number', 'LIKE', "{$prefix}{$currentYear}{$currentMonth}%")
//             ->orderBy('por_number', 'desc')
//             ->first();

//         if ($lastPOR) {
//             $lastNumber = intval(substr($lastPOR->por_number, -3));
//             return "{$prefix}{$currentYear}{$currentMonth}" . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
//         }

//         return "{$prefix}{$currentYear}{$currentMonth}001";
//     }
// }
{
    protected $table = 'outgoing_payment';
    protected $primaryKey = 'id';
    use HasFactory;
}