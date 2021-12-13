<?php

namespace App\Tests\AppBundle\Calculator\Compute;

use PHPUnit\Framework\TestCase;
use \App\Calculator\Compute\Division as Division;

class DivisionTest extends TestCase
{
    /**
     * @var Division
     */
    protected $computeOperator;

    protected function setUp(): void
    {
        $this->computeOperator = new Division();
    }

    /**
     * @dataProvider expectedDivisionResults
     */
    public function testDivisionResultsAreCorrect($operandA, $operandB, $sum)
    {
        $this->assertEquals($sum, $this->computeOperator->compute($operandA, $operandB));
    }

    public function expectedDivisionResults()
    {
        return [
            '5.0/5.0=1.0'   => [5.0,     5.0,    1.0],
            '5/-5=-1'       => [5,        -5,   -1.0],
            '1/1=1'         => [1,         1,    1.0],
            '0/3=0'         => [0,       3.0,    0.0],
        ];
    }

    public function testDivisionByZeroThrowsException()
    {
        $this->expectException('App\Calculator\Compute\Exception\ComputationException');
        $this->expectExceptionMessage('DivisionByZero Error');
        $this->computeOperator->compute(4,0);
    }
}
