<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::creating(function ($salesOrder) {
            // Check and reset the PO number counter at the start of each month
            $salesOrder->so_number = static::generateSONumber();
        });
    }

    protected static function generateSONumber()
    {
        $prefix = 'SO';
        $currentYear = now()->format('Y');
        $currentMonth = now()->format('m');

        // Get the latest PO number in the current year and month
        $lastSO = static::where('so_number', 'LIKE', "{$prefix}{$currentYear}{$currentMonth}%")
            ->orderBy('so_number', 'desc')
            ->first();

        if ($lastSO) {
            $lastNumber = intval(substr($lastSO->so_number, -3));
            return "{$prefix}{$currentYear}{$currentMonth}" . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        }

        return "{$prefix}{$currentYear}{$currentMonth}001";
    }
}
// {
//     protected $table = 'sales_orders';
//     protected $primaryKey = 'id';
//     use HasFactory;
// }
