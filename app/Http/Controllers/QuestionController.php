<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
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
     *     tags={"Question"},
     *     summary="List of question and answer",
     *     @OAS\Response(
     *         response=200,
     *         description="Ok",
     *         @OAS\JsonContent(
     *             type="array",
     *             @OAS\Items(ref="#/../../Models/Answer")
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
            $question = Question::with('answer')->whereId($request->id)->first();
            return new QuestionResource($question);
        }
        elseif(isset($request->items)) {
            $question = Question::with('answer')->paginate($request->items);
            return new QuestionCollection($question);
        }
        else {
            $question = Question::with('answer')->get();
            return QuestionResource::collection($question);
        }
    }

    /**
     * @OAS\Post(
     *     path="question/create",
     *     tags={"Question"},
     *     summary="Create a question with answer",
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
        
        $question = new Question();
        $question->question = $request->question;
        $question->save();
        foreach($request->answer as $ans) {
            $Answer = new Answer();
            $Answer->answer = $ans["answer"];
            $Answer->correct = $ans["correct"];
            $Answer->question_id = $question->id;
            $Answer->save();
        }

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="question/delete",
     *     tags={"Question"},
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
        $question = Question::find($request->id);
        $question->delete();
        
        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="question/update",
     *     tags={"Question"},
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

        $question = Question::with('answer')->find($request->id); 
        $question->question = $request->question;
        $question->save();
        $answerDelete = array_diff($question->answer->pluck('id')->toArray(), array_column($request->answer, 'id'));

        //gelöscht
        foreach($answerDelete as $id) {
            $answer = Answer::find($id);
            $answer->delete();
        }

        foreach($request->answer as $ans) {

            //update
            if(isset($ans["id"])) {
                $answer = Answer::find($ans["id"]);
                $answer->answer = $ans["answer"];
                $answer->correct = $ans["correct"];
                $answer->save();
            }
            //neu
            elseif(!isset($ans["id"])) {
                $answer = new Answer();
                $answer->answer = $ans["answer"];
                $answer->correct = $ans["correct"];
                $answer->question_id = $question->id;
                $answer->save();
            }
        }
        
        return response()->json([
            'status' => 'ok'
        ]);
    }
}