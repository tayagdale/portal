<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    protected $table = 'terms';
    protected $primaryKey = 'id';
    protected $fillable = ['terms',  'calendar_id'];
    use HasFactory;
}
