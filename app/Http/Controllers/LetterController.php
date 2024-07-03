<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLetterRequest;
use App\Http\Requests\UpdateLetterRequest;
use App\Models\Letter;
use App\Models\Sender;
use App\Models\LetterPriority;
use App\Models\LetterCategory;
use DB;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $priorities = LetterPriority::getAllPriorities();
        $letterCategories = LetterCategory::getAllLetterCategories();
        return view('diarize.diarize',compact('priorities','letterCategories'));
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
    public function store(StoreLetterRequest $request)
    {
        if($request->ajax()){
            $jData = [];
            $letterPath = "";
            $letterCategory = [
                '',
                'vip',
                'do'
            ];
            
            if ($request->hasFile('letter')) {
                
                if ($request->file('letter')->isValid()) {

                    $letterPath = $request->letter->store('letters/'.$letterCategory[$request->category]);

                }else{

                    $jData[1] = [
                        'message'=>'The letter upload was unsuccessful! Please try again.',
                        'candidate'=>'',
                        'status'=>'error'
                    ];
                }

            }else{

                $jData[1] = [
                    'message'=>'The uploaded letter is absent! Please try again.',
                    'candidate'=>'',
                    'status'=>'error'
                ];
            }
            DB::beginTransaction();
    
                try {

                    $letterDetails = [

                        $request->category,
                        $request->priority,
                        $request->letter_date,
                        $request->received_date,
                        $request->diary_date,
                        $request->letter_no,
                        $request->subject,
                        $letterPath,

                    ];

                    $letterId = Letter::storeLetter($letterDetails);
                    
                    $senderDetails = [

                        $letterId,
                        $request->sender_name,
                        $request->sender_designation,
                        $request->sender_mobile,
                        $request->sender_email,
                        $request->organization,
                        $request->address

                    ];
                    Sender::storeSender($senderDetails);
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

    public function showLetters()
    {
        $letters = Letter::showLetterAndSender();
        return view('diarize.letters',compact('letters'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Letter $letter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Letter $letter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLetterRequest $request, Letter $letter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Letter $letter)
    {
        //
    }
}