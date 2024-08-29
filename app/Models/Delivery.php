<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $guarded = ['id'];
    protected $table = 'delivery';

    protected static function booted()
    {
        static::creating(function ($delivery) {
            // Check and reset the PO number counter at the start of each month
            $delivery->dr_number = static::generateDRNumber();
        });
    }

    protected static function generateDRNumber()
    {
        $prefix = 'DR';
        $currentYear = now()->format('Y');
        $currentMonth = now()->format('m');

        // Get the latest PO number in the current year and month
        $lastDR = static::where('dr_number', 'LIKE', "{$prefix}{$currentYear}{$currentMonth}%")
            ->orderBy('dr_number', 'desc')
            ->first();

        if ($lastDR) {
            $lastNumber = intval(substr($lastDR->dr_number, -3));
            return "{$prefix}{$currentYear}{$currentMonth}" . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        }

        return "{$prefix}{$currentYear}{$currentMonth}001";
    }
}
// {
//     protected $table = 'delivery';
//     protected $primaryKey = 'id';
//     use HasFactory;
// }

