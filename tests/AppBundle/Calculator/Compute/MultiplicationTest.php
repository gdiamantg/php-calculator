<?php

namespace App\Tests\AppBundle\Calculator\Compute;

use PHPUnit\Framework\TestCase;
use \App\Calculator\Compute\Multiplication as Multiplication;

class MultiplicationTest extends TestCase
{
    /**
     * @var Multiplication
     */
    protected $computeOperator;

    protected function setUp(): void
    {
        $this->computeOperator = new Multiplication();
    }

    /**
     * @dataProvider validMultiplicationResults
     */
    public function testAddComputationResultsAreCorrect($operandA, $operandB, $sum)
    {
        $this->assertEquals($sum, $this->computeOperator->compute($operandA, $operandB));
    }

    public function validMultiplicationResults()
    {
        return [
            '5.0*5.0=25.0'  => [5.0,     5.0,   25.0],
            '5*-5=-25'      => [5,        -5,  -25.0],
            '1*1=1'         => [1,         1,    1.0],
            '0*3=0'         => [0,       3.0,    0.0],
            '4*0=4'         => [4,         0,    0.0],
        ];
    }
}
