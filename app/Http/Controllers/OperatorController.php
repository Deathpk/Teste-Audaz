<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOperatorRequest;
use App\Services\OperatorService;

class OperatorController extends Controller
{
    /**
     * @throws \Exception
     */
    public function create(CreateOperatorRequest $request, OperatorService $service): \Illuminate\Http\JsonResponse
    {
        $service->createOperator($request);

        return response()->json([
            'success' => true,
            'message' => 'A Operadora voi criada com sucesso!'
        ]);
    }
}
