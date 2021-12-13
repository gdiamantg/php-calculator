<?php

namespace App\Calculator\Compute;

interface ComputeInterface
{
    /**
     * Compute mathimatical operation between two operands ($operandA, $operandB)
     *
     * @param float $operandA
     * @param float $operandB
     * @return float
     * @throws \App\Calculator\Compute\Exception\ComputationException
     */
    public function compute(float $operandA, float $operandB): float;

    /**
     * Return the type of operation the instance class will perform
     *
     * @return string
     */
    public function toString(): string;
}
