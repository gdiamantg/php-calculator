<?php

namespace App\Tests\AppBundle\Calculator\Compute;

use PHPUnit\Framework\TestCase;
use \App\Calculator\Compute\Subtraction;

class SubtractionTest extends TestCase
{
    /**
     * @var Subtraction
     */
    protected $computeOperator;

    protected function setUp(): void
    {
        $this->computeOperator = new Subtraction();
    }

    /**
     * @dataProvider validSubtractionResults
     */
    public function testAddComputationResultsAreCorrect($operandA, $operandB, $sum)
    {
        $this->assertEquals($sum, $this->computeOperator->compute($operandA, $operandB));
    }

    public function validSubtractionResults()
    {
        return [
            '5.0-5.0=0.0'   => [5.0,     5.0,    0.0],
            '5--5=10'       => [5,        -5,   10.0],
            '1-1=0'         => [1,         1,    0.0],
            '0-3=-3'        => [0,       3.0,   -3.0],
            '4-0=4'         => [4,         0,    4.0],
        ];
    }
}
