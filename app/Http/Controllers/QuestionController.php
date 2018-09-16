<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questions;
use App\Models\Answers;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class Pet
 *
 * @package App\Http\Controllers
 */

class QuestionController extends Controller
{
    /**
     * @OAS\Post(
     *     path="question/read",
     *     tags={"Questions"},
     *     summary="List of questions and answers",
     *     @OAS\Response(
     *         response=200,
     *         description="Ok",
     *         @OAS\JsonContent(
     *             type="array",
     *             @OAS\Items(ref="#/../../Models/Answers")
     *         )
     *     ),
     *     @OAS\Parameter(
     *         name="Authorization",
     *         in="query",
     *         description="JWT access token.",
     *         required=true,
     *         @OAS\Schema(
     *             type="header",
     *         )
     *     ),
     * )
     */
    public function read(Request $request) {
        if($request->id != null) {
            $question = Questions::with('answers')->whereId($request->id)->first();
            return new QuestionResource($question);
        }
        elseif(isset($request->items)) {
            $question = Questions::with('answers')->paginate($request->items);
            return new QuestionCollection($question);
        }
        else {
            $question = Questions::with('answers')->get();
            return QuestionResource::collection($question);
        }
    }

    /**
     * @OAS\Post(
     *     path="question/create",
     *     tags={"Questions"},
     *     summary="Create a question with answers",
     *     @OAS\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     @OAS\Parameter(
     *         name="Authorization",
     *         in="query",
     *         description="JWT access token.",
     *         required=true,
     *         @OAS\Schema(
     *             type="header",
     *         )
     *     ),
     * )
     */
    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            'question'  => 'required',
            'answer'    => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        
        $question = new Questions();
        $question->question = $request->question;
        $question->save();
        
        foreach($request->answer as $ans) {
            $Answers = new Answers();
            $Answers->answer = $ans["answer"];
            $Answers->correct = $ans["correct"];
            $Answers->questions_id = $question->id;
            $Answers->save();
        }

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="question/delete",
     *     tags={"Questions"},
     *     summary="Delete a question",
     *     @OAS\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     @OAS\Parameter(
     *         name="Authorization",
     *         in="query",
     *         description="JWT access token.",
     *         required=true,
     *         @OAS\Schema(
     *             type="header",
     *         )
     *     ),
     * )
     */
    public function delete(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $question = Questions::find($request->id);
        $question->delete();
        
        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="question/update",
     *     tags={"Questions"},
     *     summary="Update a question",
     *     @OAS\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     @OAS\Parameter(
     *         name="Authorization",
     *         in="query",
     *         description="JWT access token.",
     *         required=true,
     *         @OAS\Schema(
     *             type="header",
     *         )
     *     ),
     * )
     */
    public function update(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $question = Questions::with('answers')->find($request->id); 
        $question->question = $request->question;
        $question->save();
        $answerDelete = array_diff($question->answers->pluck('id')->toArray(), array_column($request->answer, 'id'));

        //gelöscht
        foreach($answerDelete as $id) {
            $answer = Answers::find($id);
            $answer->delete();
        }

        foreach($request->answer as $ans) {

            //update
            if(isset($ans["id"])) {
                $answer = Answers::find($ans["id"]);
                $answer->answer = $ans["answer"];
                $answer->correct = $ans["correct"];
                $answer->save();
            }
            //neu
            elseif(!isset($ans["id"])) {
                $answer = new Answers();
                $answer->answer = $ans["answer"];
                $answer->correct = $ans["correct"];
                $answer->questions_id = $question->id;
                $answer->save();
            }
        }
        
        return response()->json([
            'status' => 'ok'
        ]);
    }
}