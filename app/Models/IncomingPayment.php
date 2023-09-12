<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingPayment extends Model
// {
//     protected $guarded = ['id'];
//     protected $table = 'incoming_payment';

//     protected static function booted()
//     {
//         static::creating(function ($incoming_payment) {
//             // Check and reset the PO number counter at the start of each month
//             $incoming_payment->or_number = static::generateORNumber();
//         });
//     }

//     protected static function generateORNumber()
//     {
//         $prefix = 'OR';
//         $currentYear = now()->format('Y');
//         $currentMonth = now()->format('m');

//         // Get the latest PO number in the current year and month
//         $lastOR = static::where('or_number', 'LIKE', "{$prefix}{$currentYear}{$currentMonth}%")
//             ->orderBy('or_number', 'desc')
//             ->first();

//         if ($lastOR) {
//             $lastNumber = intval(substr($lastOR->or_number, -3));
//             return "{$prefix}{$currentYear}{$currentMonth}" . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
//         }

//         return "{$prefix}{$currentYear}{$currentMonth}001";
//     }
// }

{
    protected $table = 'incoming_payment';
    protected $primaryKey = 'id';
    use HasFactory;
}
