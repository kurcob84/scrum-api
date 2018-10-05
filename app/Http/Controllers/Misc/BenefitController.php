<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Misc\Benefit;
use App\Http\Resources\BenefitResource;
use App\Http\Resources\BenefitCollection;
use Validator;

class BenefitController extends Controller {

    /**
     * @OAS\Post(
     *     path="benefit/read",
     *     tags={"Misc"},
     *     summary="List of benefit",
     *     @OAS\Response(
     *         response=200,
     *         description="Ok",
     *         @OAS\JsonContent(
     *             type="array",
     *             @OAS\Items(ref="#/../../Models/Misc/Benefit")
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
            $benefit = Benefit::whereId($request->id)->first();
            return new BenefitResource($benefit);
        }
        elseif(isset($request->items)) {
            $benefit = Benefit::paginate($request->items);
            return new BenefitCollection($benefit);
        }
        else {
            $benefit = Benefit::get();
            return BenefitCollection::collection($benefit);
        }
    }

    /**
     * @OAS\Post(
     *     path="benefit/create",
     *     tags={"Benefit"},
     *     summary="Create a Benefit",
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
        
        $benefit = new Benefit();
        $benefit->name = $request->name;
        $benefit->save();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="benefit/update",
     *     tags={"Benefit"},
     *     summary="Update a Benefit",
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

        $benefit = Benefit::find($request->id);
        $benefit->name = $request->name;
        $benefit->save();
        
        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="benefit/delete",
     *     tags={"Question"},
     *     summary="Delete a Benefit",
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
        $benefit = Benefit::find($request->id);
        $benefit->delete();
        
        return response()->json([
            'status' => 'ok'
        ]);
    }

}

?>