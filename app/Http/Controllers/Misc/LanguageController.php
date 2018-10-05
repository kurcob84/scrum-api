<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Misc\Language;
use App\Http\Resources\LanguageResource;
use App\Http\Resources\LanguageCollection;
use Validator;

class LanguageController extends Controller {

    /**
     * @OAS\Post(
     *     path="language/read",
     *     tags={"Misc"},
     *     summary="List of Language",
     *     @OAS\Response(
     *         response=200,
     *         description="Ok",
     *         @OAS\JsonContent(
     *             type="array",
     *             @OAS\Items(ref="#/../../Models/Misc/Language")
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
            $language = Language::whereId($request->id)->first();
            return new LanguageResource($language);
        }
        elseif(isset($request->items)) {
            $language = Language::paginate($request->items);
            return new LanguageCollection($language);
        }
        else {
            $language = Language::get();
            return LanguageCollection::collection($language);
        }
    }

    /**
     * @OAS\Post(
     *     path="language/create",
     *     tags={"Language"},
     *     summary="Create a Language",
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
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        
        $language = new Language();
        $language->name = $request->name;
        $language->save();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="language/update",
     *     tags={"Language"},
     *     summary="Update a Language",
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
            'id' => 'required',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $language = Language::find($request->id);
        $language->name = $request->name;
        $language->save();
        
        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="language/delete",
     *     tags={"Language"},
     *     summary="Delete a Language",
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
        $language = Language::find($request->id);
        $language->delete();
        
        return response()->json([
            'status' => 'ok'
        ]);
    }

}

?>