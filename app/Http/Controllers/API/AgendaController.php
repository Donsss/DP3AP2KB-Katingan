<?php

namespace App\Http\Controllers\API;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgendaController extends BaseController
{
    /**
     * @OA\Get(
     * path="/api/agendas",
     * tags={"Agendas"},
     * summary="Get list of agendas",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        $agendas = Agenda::latest('date')->paginate(10);
        return $this->sendResponse($agendas, 'Agendas retrieved successfully.');
    }

    /**
     * @OA\Post(
     * path="/api/agendas",
     * tags={"Agendas"},
     * summary="Create new agenda",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"title", "date", "time"},
     * @OA\Property(property="title", type="string"),
     * @OA\Property(property="date", type="string", format="date", example="2024-12-31"),
     * @OA\Property(property="time", type="string", example="14:30"),
     * @OA\Property(property="description", type="string")
     * )
     * ),
     * @OA\Response(response=200, description="Agenda created successfully"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $agenda = Agenda::create($request->all());
        return $this->sendResponse($agenda, 'Agenda created successfully.');
    }

    /**
     * @OA\Get(
     * path="/api/agendas/{id}",
     * tags={"Agendas"},
     * summary="Get specific agenda",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Successful operation"),
     * @OA\Response(response=404, description="Agenda not found")
     * )
     */
    public function show($id)
    {
        $agenda = Agenda::find($id);
        if (is_null($agenda)) {
            return $this->sendError('Agenda not found.');
        }
        return $this->sendResponse($agenda, 'Agenda retrieved successfully.');
    }

    /**
     * @OA\Put(
     * path="/api/agendas/{id}",
     * tags={"Agendas"},
     * summary="Update agenda",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"title", "date", "time"},
     * @OA\Property(property="title", type="string"),
     * @OA\Property(property="date", type="string", format="date"),
     * @OA\Property(property="time", type="string"),
     * @OA\Property(property="description", type="string")
     * )
     * ),
     * @OA\Response(response=200, description="Agenda updated successfully")
     * )
     */
    public function update(Request $request, Agenda $agenda)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $agenda->update($request->all());
        return $this->sendResponse($agenda, 'Agenda updated successfully.');
    }

    /**
     * @OA\Delete(
     * path="/api/agendas/{id}",
     * tags={"Agendas"},
     * summary="Delete agenda",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Agenda deleted successfully")
     * )
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return $this->sendResponse([], 'Agenda deleted successfully.');
    }
}