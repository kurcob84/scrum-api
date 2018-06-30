<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use App\Answers;

class seed_questions_answers extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        if($request->id != null) {
            $Questions = Questions::whereId($request->id)->select('id','name')->first();
        }
        else {
            $Questions = Questions::select('id','name')->get();
        }
        return response()->json([
            'status' => 'ok',
            'data' => $Questions
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        
        $Questions = new Questions();
        $Questions->question = $request->question;
        $bQuestions = $Questions->save();

        foreach($ans as $request->answers) {
            $Answers = new Answers();
            $Answers->answer = $ans->answers;
            $Answers->correct = $ans->correct;
            $Answers->questions_id = $Questions->id;
            $Answers->save();
        }

        return response()->json([
            'status' => 'ok',
            'data' => $bQuestions
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $Questions = Questions::find($request->id);
        $bQuestions = $Questions->delete();
        
        return response()->json([
            'status' => 'ok',
            'data' => $bQuestions
        ]);
    }
}
