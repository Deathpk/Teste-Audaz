<?php

namespace App\Services;

use App\Http\Requests\CreateOperatorRequest;
use App\Models\Operator;
use Illuminate\Support\Facades\Log;

class OperatorService
{

    /**
     * @throws \Exception
     */
    public function createOperator(CreateOperatorRequest $request): void
    {
        $operatorCode = $request->get('code');
        $operatorAlreadyExists = Operator::query()->firstWhere('code', $operatorCode);

        if ($operatorAlreadyExists) {
            throw new \Exception('Um operador com o mesmo código já existe em nossa base de dados.', 422);
        }

        $this->createNewOperator($operatorCode);
    }

    private function createNewOperator(string $operatorCode): void
    {
        try {
            $operator = new Operator();
            $operator->code = $operatorCode;
            $operator->save();
        } catch (\Throwable $e) {
            Log::error(
                "Ocorreu um erro ao criar uma operadora.
                \n -Message: {$e->getMessage()}
                \n -Stacktrace: {$e->getTraceAsString()}"
            );
            throw new \Exception('Ocorreu um erro ao criar a operadora , por favor , tente novamente.',500);
        }
    }
}
