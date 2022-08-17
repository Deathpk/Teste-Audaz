<?php

namespace App\Services;

use App\Http\Requests\CreateFareRequest;
use App\Models\Fare;
use App\Models\Operator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FareService
{
    private readonly Collection $attributes;

    public function createFare(CreateFareRequest $request): void
    {
        $this->setAttributes($request);

        $operator = $this->getOperator();
        $operatorCanProceed = $this->ensureIfOperatorIsAbleToProceed($operator);

        if (!$operatorCanProceed) {
            throw new \Exception('Não podemos prosseguir , pois já existe uma tarefa de mesmo valor ativa.');
        }

        $this->createNewFare($operator->id);
    }

    private function setAttributes(CreateFareRequest $request): void
    {
        $this->attributes = $request->getAttributes();
    }

    private function getOperator(): Operator
    {
        $operator = Operator::query()->firstWhere('code', $this->attributes->get('operatorCode'));

        if (!$operator) {
            throw new NotFoundHttpException('Operador não existente em nossa base de dados.');
        }

        return $operator;
    }

    private function ensureIfOperatorIsAbleToProceed(Operator $operator): bool
    {
        $faresBetweenSixMonthsAgo = Fare::getActiveFaresBetweenSixMonthsAgo($operator->id);

        if (!$faresBetweenSixMonthsAgo) {
            return true;
        }

        return $faresBetweenSixMonthsAgo->filter(function (Fare $fare) {
            return $fare->value === $this->attributes->get('value');
        })->filter()->isEmpty();
    }

    private function createNewFare(int $operatorId): void
    {
        try {
            $fare = new Fare();
            $fare->operator_id = $operatorId;
            $fare->status = Fare::ACTIVE_FARE;
            $fare->value = $this->attributes->get('value');
            $fare->save();
        } catch (\Throwable $e) {
            Log::error(
                "Ocorreu um erro ao criar uma tarifa para o operador de id: {$operatorId}
                \n -Message: {$e->getMessage()}
                \n -Stacktrace: {$e->getTraceAsString()}"
            );
        }
    }

    public function getAllFares(int $operatorId): ?Collection
    {
        return Fare::query()->where('operator_id', $operatorId)->get();
    }

    public function findSpecificFare(int $fareId): ?Fare
    {
        $fare = Fare::query()->find($fareId);

        if (!$fare) {
            throw new NotFoundHttpException("A fare de id {$fareId} não foi encontrada em nossa base de dados.");
        }

        return $fare;
    }
}
