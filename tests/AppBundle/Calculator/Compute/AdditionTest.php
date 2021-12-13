<?php

namespace App\Tests\AppBundle\Calculator\Compute;

use PHPUnit\Framework\TestCase;
use \App\Calculator\Compute\Addition as Addition;

class AdditionTest extends TestCase
{
    /**
     * @var Addition
     */
    protected $computeOperator;

    protected function setUp(): void
    {
        $this->computeOperator = new Addition();
    }

    /**
     * @dataProvider expectedAdditionResults
     */
    public function testAdditionResultsAreCorrect($operandA, $operandB, $sum)
    {
        $this->assertEquals($sum, $this->computeOperator->compute($operandA, $operandB));
    }

    public function expectedAdditionResults()
    {
        return [
            '5.0+5.0=10.0'  => [5.0,     5.0,    10.0],
            '5+-5=0'        => [5,        -5,    0.0],
            '1+1=2'         => [1,         1,    2.0],
            '0+3=3'         => [0,       3.0,    3.0],
            '4+0=4'         => [4,         0,    4.0],
        ];
    }
}
