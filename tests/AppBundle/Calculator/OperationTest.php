<?php

namespace App\Tests\AppBundle\Calculator;

use PHPUnit\Framework\TestCase;
use App\Calculator\Operation;

class OperationTest extends TestCase
{
    /**
     * @var Operation
     */
    protected $computer;

    protected function setUp(): void
    {
        $this->computer = new Operation();
    }

    /**
     * @dataProvider expectedOperationResults
     */
    public function testOperationResultsAreCorrect($operandA, $operandB, $operator, $expectedResult)
    {
        $this->computer->setOperandA($operandA)
            ->setOperandB($operandB)
            ->setOperator(new $operator());
        $this->assertEquals($operandA, $this->computer->getOperandA());
        $this->assertEquals($operandB, $this->computer->getOperandB());
        $this->assertInstanceOf($operator, $this->computer->getOperator());
        $this->assertEquals($expectedResult, $this->computer->compute());
    }

    public function expectedOperationResults()
    {
        return [
            '5.0+5.0=10.0'  => [5.0,     5.0,       '\App\Calculator\Compute\Addition',        10.0],
            '5--5=0'        => [5,        -5,       '\App\Calculator\Compute\Subtraction',     10.0],
            '10*20=200'     => [10,       20,       '\App\Calculator\Compute\Multiplication', 200.0],
            '30/10=3'       => [30,     10.0,       '\App\Calculator\Compute\Division',         3.0],
            '30/0=error'    => [30,      0.0,       '\App\Calculator\Compute\Division',       'DivisionByZero Error'],
        ];
    }
}
