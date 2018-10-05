<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant\ApplicationJob;
use App\Http\Resources\ApplicationJobResource;
use App\Http\Resources\CompanyCollection;
use Validator;

class ApplicationJobController extends Controller
{

    /**
     * @OAS\Post(
     *     path="applicationjob/read",
     *     tags={"ApplicationJob"},
     *     summary="List of ApplicationJob",
     *     @OAS\Response(
     *         response=200,
     *         description="Ok",
     *         @OAS\JsonContent(
     *             type="array",
     *             @OAS\Items(ref="#/../../Models/Applicant/ApplicationJob")
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
            $applicationJob = ApplicationJob::with('company')->whereId($request->id)->first();
            return new ApplicationJobResource($applicationJob);
        } elseif (isset($request->items)) {
            $applicationJob = ApplicationJob::with('company')->paginate($request->items);
            return new ApplicationJobCollection($applicationJob);
        } else {
            $applicationJob = ApplicationJob::with('company')->get();
            return ApplicationJobCollection::collection($applicationJob);
        }
    }

    /**
     * @OAS\Post(
     *     path="applicationjob/create",
     *     tags={"ApplicationJob"},
     *     summary="Create a ApplicationJob",
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
            'name' => 'required',
            'email' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $applicationJob = new ApplicationJob();
        $input = $request->all();
        $applicationJob->fill($input)->save();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="applicationjob/update",
     *     tags={"ApplicationJob"},
     *     summary="Update a ApplicationJob",
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

        $applicationJob = ApplicationJob::find($request->id);
        $input = $request->all();
        $applicationJob->fill($input)->save();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="applicationjob/delete",
     *     tags={"ApplicationJob"},
     *     summary="Delete a ApplicationJob",
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
        $applicationJob = ApplicationJob::find($request->id);
        $applicationJob->delete();

        return response()->json([
            'status' => 'ok'
        ]);
    }
}

?>