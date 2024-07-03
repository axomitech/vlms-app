<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLetterActionResponseRequest;
use App\Http\Requests\UpdateLetterActionResponseRequest;
use App\Models\LetterActionResponse;
use App\Models\ActionDepartmentMap;
use DB;
class LetterActionResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreLetterActionResponseRequest $request)
    {
        if($request->ajax()){
            
            DB::beginTransaction();
    
                try {

                    $noteDetails = [

                        ActionDepartmentMap::getActionDepartment([
                            $request->letter_action,
                            1
                        ]),

                        $request->note

                    ];

                    $noteId = LetterActionResponse::storeNote($noteDetails);
                    DB::commit();
                    $jData[1] = [
                        'message'=>'Letter data is successfully stored.',
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

    public function actionNotes(Request $request){
        $jdata = [];
        if($request->ajax()){
            $jdata[0] = [
                'note'=>''
            ];
            $i = 1;
            $notes = LetterActionResponse::getAllActionNotes($request->action);
            foreach($notes AS $value){
                $jdata[$i] = [
                    'note'=>$value['action_remarks']
                ];
                $i++;
            }

            return response()->json($jdata);

        }else{
            return response()->json($jdata);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LetterActionResponse $letterActionResponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LetterActionResponse $letterActionResponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLetterActionResponseRequest $request, LetterActionResponse $letterActionResponse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LetterActionResponse $letterActionResponse)
    {
        //
    }
}
