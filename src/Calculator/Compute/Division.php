<?php

namespace App\Calculator\Compute;

use App\Calculator\Compute\Exception\ComputationException;

class Division implements ComputeInterface
{
    public const OPERATOR_TYPE = 'Division';

    /**
     * Compute division between two operands ($operandA, $operandB)
     *
     * {@inheritdoc}
     */
    public function compute(float $operandA, float $operandB): float
    {
        if ($operandB == 0) {
            throw new ComputationException('DivisionByZero Error');
        }
        return $operandA / $operandB;
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return self::OPERATOR_TYPE;
    }
}
