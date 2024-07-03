<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLetterActionRequest;
use App\Http\Requests\UpdateLetterActionRequest;
use App\Models\LetterAction;
use App\Models\Department;
use App\Models\LetterPriority;
use App\Models\ActionDepartmentMap;
use App\Models\LetterActionResponse;
use App\Models\Letter;
use DB;

class LetterActionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $priorities = LetterPriority::getAllPriorities();
        $letters = Letter::showLetterAndSender();
        $departments = Department::getAllDepartments();
        return view('deligate.action_letters',compact('letters','departments','priorities'));
    }

    public function actions($id,$letter,$subject,$sender,$org)
    {
        $letter_id = $id;
        $letterNo = $letter;
        $letterSubject = $subject;
        $senderName = $sender;
        $organization = $org;
        $actions = LetterAction::getDepartmentActions($letter_id);
        $notes = [];
        $i = 0;
        foreach($actions AS $value){
            $note = LetterActionResponse::getActionLastNote($value['action_id']);
            if($note != null){
                $notes[$i] = $note->action_remarks;
            }
            $i++;
        }
        return view('deligate.actions',compact('actions','letterNo','letterSubject','letter_id','notes','senderName','organization'));
    }

    public function letterIndex()
    {
        $priorities = LetterPriority::getAllPriorities();
        $letters = Letter::showLetterAndSender();
        $departments = Department::getAllDepartments();
        return view('deligate.letter_lists',compact('letters','departments','priorities'));
    }
    public function letterActions($id,$letter,$subject,$sender,$org)
    {
        $letter_id = $id;
        $letterNo = $letter;
        $letterSubject = $subject;
        $senderName = $sender;
        $organization = $org;
        $priorities = LetterPriority::getAllPriorities();
        $departments = Department::getAllDepartments();
        $actions = LetterAction::getDepartmentActions($letter_id);
        
        return view('deligate.action_list',compact('actions','letterNo','letterSubject','letter_id','senderName','organization','priorities','departments'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLetterActionRequest $request)
    {
        if($request->ajax()){
            $jData = [];
        
            DB::beginTransaction();
    
                try {

                    $departments = $request->departments;
                    $actionId = LetterAction::storeLetterAction([
                        $request->letter,
                        $request->priority,
                        $request->letter_action,
                    ]);
                    for($i = 0; $i < count($departments); $i++){
                        ActionDepartmentMap::storeDepartmentActions([
                            $actionId,
                            $departments[$i]
                        ]);
                    }
                    DB::commit();
                    $jData[1] = [
                        'message'=>'Letter\'s action is successfully stored.',
                        'status'=>'success'
                    ];
                    
                } catch (\Exception $e) {
                    DB::rollback();
                    $jData[1] = [
                        'message'=>'Something went wrong! Please try again.'.$e->getMessage(),
                        'candidate'=>'',
                        'status'=>'error'
                    ];
                }

                return response()->json($jData,200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LetterAction $letterAction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LetterAction $letterAction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLetterActionRequest $request, LetterAction $letterAction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LetterAction $letterAction)
    {
        //
    }
}
