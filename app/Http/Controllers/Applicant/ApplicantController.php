<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant\Company;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompanyCollection;
use Validator;

class ApplicantController extends Controller
{

    /**
     * @OAS\Post(
     *     path="applicant/read",
     *     tags={"Applicant"},
     *     summary="List of Applicant",
     *     @OAS\Response(
     *         response=200,
     *         description="Ok",
     *         @OAS\JsonContent(
     *             type="array",
     *             @OAS\Items(ref="#/../../Models/Applicant/Applicant")
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
            $applicant = Applicant::with('company')->whereId($request->id)->first();
            return new ApplicantResource($applicant);
        } elseif (isset($request->items)) {
            $applicant = Applicant::with('company')->paginate($request->items);
            return new ApplicantCollection($applicant);
        } else {
            $applicant = Applicant::with('company')->get();
            return ApplicantCollection::collection($applicant);
        }
    }

    /**
     * @OAS\Post(
     *     path="applicant/create",
     *     tags={"Applicant"},
     *     summary="Create a Applicant",
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

        $applicant = new Applicant();
        $input = $request->all();
        $applicant->fill($input)->save();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="applicant/update",
     *     tags={"Applicant"},
     *     summary="Update a Applicant",
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

        $applicant = Applicant::find($request->id);
        $input = $request->all();
        $applicant->fill($input)->save();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @OAS\Post(
     *     path="applicant/delete",
     *     tags={"Applicant"},
     *     summary="Delete a Applicant",
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
        $applicant = Applicant::find($request->id);
        $applicant->delete();

        return response()->json([
            'status' => 'ok'
        ]);
    }

}

?>