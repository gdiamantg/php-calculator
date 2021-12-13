<?php

namespace App\Calculator\Compute;

class Addition implements ComputeInterface
{
    public const OPERATOR_TYPE = 'Addition';

    /**
     * Compute addition between two operands ($operandA, $operandB)
     *
     * {@inheritdoc}
     */
    public function compute(float $operandA, float $operandB): float
    {
        return $operandA + $operandB;
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return self::OPERATOR_TYPE;
    }
}
