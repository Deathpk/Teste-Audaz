<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFareRequest;
use App\Http\Requests\ListFaresRequest;
use App\Http\Resources\FareResource;
use App\Services\FareService;
use Illuminate\Http\JsonResponse;

class FareController extends Controller
{
    private FareService $service;

    public function __construct(FareService $service)
    {
        $this->service = $service;
    }

    public function index(ListFaresRequest $request): JsonResponse
    {
        $operatorCodeParsed = (int) $request->query('operatorId');
        $allFares = $this->service->getAllFares($operatorCodeParsed);

        return response()->json([
            'success' => true,
            'fares' => FareResource::collection($allFares)
        ]);
    }

    public function show(int $fareId): JsonResponse
    {
        $fare = $this->service->findSpecificFare($fareId);

        return response()->json([
            'success' => true,
            'fare' => FareResource::make($fare)
        ]);
    }

    /**
     * @throws \Exception
     */
    public function create(CreateFareRequest $request): JsonResponse
    {
        $this->service->createFare($request);

        return response()->json([
            'success' => true,
            'message' => 'Tarifa criada com sucesso!'
        ]);
    }
}
