<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $fillable = ['permission_name'];
    use HasFactory;
}
