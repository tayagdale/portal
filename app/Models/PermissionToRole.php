<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionToRole extends Model
{
    protected $table = 'permission_to_roles';
    protected $primaryKey = 'id';
    use HasFactory;
}
