<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Letter extends Model
{
    use HasFactory;

    public static function storeLetter($letterDetails){
        $letter = new Letter;
        $letter->user_id = session('role_user');
        $letter->letter_category_id = $letterDetails[0];
        $letter->letter_priority_id = $letterDetails[1];
        $letter->letter_no = $letterDetails[5];
        $letter->letter_date = $letterDetails[2];
        $letter->received_date = $letterDetails[3];
        $letter->diary_date = $letterDetails[4];
        $letter->subject = $letterDetails[6];
        $letter->letter_path = $letterDetails[7];
        $letter->save();
        return $letter->id;
    }

    public static function showLetterAndSender(){
        return Letter::join('senders','letters.id','=','senders.letter_id')
               ->select('letter_no','subject','sender_name','letter_path','letters.id AS letter_id','organization')
               ->get();
    }
}
