<?php

namespace App\Calculator\Compute;

class Multiplication implements ComputeInterface
{
    public const OPERATOR_TYPE = 'Multiplication';

    /**
     * Compute multiplication between two operands ($operandA, $operandB)
     *
     * {@inheritdoc}
     */
    public function compute(float $operandA, float $operandB): float
    {
        return $operandA * $operandB;
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return self::OPERATOR_TYPE;
    }
}
