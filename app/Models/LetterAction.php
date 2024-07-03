<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterAction extends Model
{
    use HasFactory;

    public static function storeLetterAction($actionDetails){
        $action = new LetterAction;
        $action->user_id = session('role_user');
        $action->letter_id = $actionDetails[0];
        $action->letter_priority_id = $actionDetails[1];
        $action->action_description = $actionDetails[2];
        $action->save();
        return $action->id;
    }

    public static function getDepartmentActions($letterId){
        return LetterAction::join('action_department_maps','letter_actions.id','=','action_department_maps.letter_action_id')
            ->where([
                'department_id'=>1
            ])->join('letter_priorities','letter_actions.letter_priority_id','=','letter_priorities.id')
            ->join('letters','letter_actions.letter_id','=','letters.id')
            ->where([
                'letter_actions.letter_id'=>$letterId
            ])
            ->select('letter_actions.id AS action_id','action_description','letter_actions.created_at as action_date','subject','letter_no','letter_path','priority_name')
            ->get();
    }
}
