<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    protected $guarded = ['id'];
    protected $table = 'sales_invoice';

    protected static function booted()
    {
        static::creating(function ($sales_invoice) {
            // Check and reset the PO number counter at the start of each month
            $sales_invoice->si_number = static::generateSINumber();
        });
    }

    protected static function generateSINumber()
    {
        $prefix = 'SI';
        $currentYear = now()->format('Y');
        $currentMonth = now()->format('m');

        // Get the latest PO number in the current year and month
        $lastSI = static::where('si_number', 'LIKE', "{$prefix}{$currentYear}{$currentMonth}%")
            ->orderBy('si_number', 'desc')
            ->first();

        if ($lastSI) {
            $lastNumber = intval(substr($lastSI->si_number, -3));
            return "{$prefix}{$currentYear}{$currentMonth}" . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        }

        return "{$prefix}{$currentYear}{$currentMonth}001";
    }
}
// {
//     protected $table = 'sales_invoice';
//     protected $primaryKey = 'id';
//     use HasFactory;
// }

