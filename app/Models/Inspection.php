<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
// {
//     protected $guarded = ['id'];

//     protected static function booted()
//     {
//         static::creating(function ($inspection) {
//             // Check and reset the PO number counter at the start of each month
//             $inspection->inspection_number = static::generateInspectionNumber();
//         });
//     }

//     protected static function generateInspectionNumber()
//     {
//         $prefix = 'INS';
//         $currentYear = now()->format('Y');
//         $currentMonth = now()->format('m');

//         // Get the latest PO number in the current year and month
//         $lastINS = static::where('inspection_number', 'LIKE', "{$prefix}{$currentYear}{$currentMonth}%")
//             ->orderBy('inspection_number', 'desc')
//             ->first();

//         if ($lastINS) {
//             $lastNumber = intval(substr($lastINS->inspection_number, -3));
//             return "{$prefix}{$currentYear}{$currentMonth}" . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
//         }

//         return "{$prefix}{$currentYear}{$currentMonth}001";
//     }
// }
{
    protected $table = 'inspections';
    protected $primaryKey = 'id';
    use HasFactory;
}
