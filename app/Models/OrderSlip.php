<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSlip extends Model
{
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::creating(function ($orderSlip) {
            // Check and reset the PO number counter at the start of each month
            $orderSlip->os_number = static::generateOSNumber();
        });
    }

    protected static function generateOSNumber()
    {
        $prefix = 'OS';
        $currentYear = now()->format('Y');
        $currentMonth = now()->format('m');

        // Get the latest PO number in the current year and month
        $lastOS = static::where('os_number', 'LIKE', "{$prefix}{$currentYear}{$currentMonth}%")
            ->orderBy('os_number', 'desc')
            ->first();

        if ($lastOS) {
            $lastNumber = intval(substr($lastOS->os_number, -3));
            return "{$prefix}{$currentYear}{$currentMonth}" . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        }

        return "{$prefix}{$currentYear}{$currentMonth}001";
    }
}
