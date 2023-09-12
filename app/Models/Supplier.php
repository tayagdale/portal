<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey = 'id';
    protected $fillable = ['supplier_code', 'description', 'address', 'contact_no', 'contact_person', 'position', 'encoded_by'];
    use HasFactory;
}
