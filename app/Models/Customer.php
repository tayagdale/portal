<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = ['customer_code', 'description', 'address', 'contact_no', 'contact_person', 'position', 'msr', 'encoded_by'];
    use HasFactory;
}
