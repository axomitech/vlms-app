<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDepartment extends Model
{
    use HasFactory;

    public static function roleUser($userId,$deppartmentId,$roleId){
        return UserDepartment::where([
            'user_id'=>$userId,
            'department_id'=>$deppartmentId,
            'role_id'=>$roleId
        ])->value('id');
    }
}
