<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class LetterActionResponse extends Model
{
    use HasFactory;

    public static function storeNote($noteDetails){

        $response = new LetterActionResponse;
        $response->act_dept_map_id = $noteDetails[0];
        $response->user_id = session('role_user');
        $response->action_remarks = $noteDetails[1];
        $response->save();
        return $response->id;
        
    }

    public static function getActionLastNote($actionId){
        return LetterActionResponse::join('action_department_maps','letter_action_responses.act_dept_map_id','=','action_department_maps.id')
        ->where([
            'action_department_maps.letter_action_id'=>$actionId,
            'response_attach'=>NULL,
            'letter_action_responses.user_id'=>session('role_user')
        ])->orderBy('letter_action_responses.created_at', 'asc')->first();
    }

    public static function getAllActionNotes($actionId){

        return LetterActionResponse::join('action_department_maps','letter_action_responses.act_dept_map_id','=','action_department_maps.id')
        ->where([
            'action_department_maps.letter_action_id'=>$actionId,
            'response_attach'=>NULL,
            'letter_action_responses.user_id'=>session('role_user')
        ])->orderBy('letter_action_responses.updated_at', 'desc')
          ->select('action_remarks')
          ->get();
          
    }
}
