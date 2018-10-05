<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job\Jobrole;
use App\Http\Resources\JobroleResource;
use App\Http\Resources\JobroleCollection;
use Validator;

class JobroleController extends Controller
{

    /**
     * @OAS\Post(
     *     path="jobrole/read",
     *     tags={"Jobrole"},
     *     summary="List of Jobrole",
     *     @OAS\Response(
     *         response=200,
     *         description="Ok",
     *         @OAS\JsonContent(
     *             type="array",
     *             @OAS\Items(ref="#/../../Models/Job/Jobrole")
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
    public function read(Request $request)
    {
        if ($request->id != null) {
            $jobrole = Jobrole::with('company')->whereId($request->id)->first();
            return new JobroleResource($jobrole);
        } elseif (isset($request->items)) {
            $jobrole = Jobrole::with('company')->paginate($request->items);
            return new JobroleCollection($jobrole);
        } else {
            $jobrole = Jobrole::with('company')->get();
            return JobroleCollection::collection($jobrole);
        }
    }

    /**
     * @OAS\Post(
     *     path="jobrole/create",
     *     tags={"Jobrole"},
     *     summary="Create a Jobrole",
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
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $jobrole = new Job();
        $jobrole->name = $request->name;
        $jobrole->save();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="jobrole/update",
     *     tags={"Jobrole"},
     *     summary="Update a Jobrole",
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
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $jobrole = Jobrole::find($request->id);
        $input = $request->all();
        $jobrole->fill($input)->save();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="jobrole/delete",
     *     tags={"Jobrole"},
     *     summary="Delete a Jobrole",
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
    public function delete(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $jobrole = Jobrole::find($request->id);
        $jobrole->delete();

        return response()->json([
            'status' => 'ok'
        ]);
    }
}

?>