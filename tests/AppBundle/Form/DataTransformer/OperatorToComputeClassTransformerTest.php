<?php

namespace App\Tests\AppBundle\Form\DataTransformer;

use PHPUnit\Framework\TestCase;
use App\Form\DataTransformer\OperatorToComputeClassTransformer;
use App\Calculator\Compute\Addition;
use App\Calculator\Compute\Subtraction;
use App\Calculator\Compute\Multiplication;
use App\Calculator\Compute\Division;
use stdClass;

class OperatorToComputeClassTransformerTest extends TestCase
{
    /**
     * @var Operation
     */
    protected $dataTransformer;
    
    protected function setUp(): void
    {
        $this->dataTransformer = new OperatorToComputeClassTransformer();
    }

    /**
     * @dataProvider expectedTransformResults
     */
    public function testDataTransformerTransformReturnsExpectedResults($computeInstance, $expectedResult)
    {
        $this->assertEquals($expectedResult, $this->dataTransformer->transform($computeInstance));
    }

    public function expectedTransformResults()
    {
        return [
            'null'                                      => [ null,                 ''               ],
            '\App\Calculator\Compute\Addition'          => [ new Addition(),       'Addition'       ],
            '\App\Calculator\Compute\Subtraction'       => [ new Subtraction(),    'Subtraction'    ],
            '\App\Calculator\Compute\Multiplication'    => [ new Multiplication(), 'Multiplication' ],
            '\App\Calculator\Compute\Division'          => [ new Division(),       'Division'       ],
        ];
    }

    public function testDataTransformerTransformThrowsExpectionWhenUnexpectedObjectsArePassedAsValues()
    {
        $this->expectException('Symfony\Component\Form\Exception\TransformationFailedException');
        $this->expectExceptionMessage('The OperatorChoiceType can only be used with App\Calculator\Compute objects');
        $dummyObject = new stdClass;
        $this->dataTransformer->transform($dummyObject);
    }

    /**
     * @dataProvider expectedReverseTransformResults
     */
    public function testDataTransformerReverseTransformReturnsExpectedResults($computeInstance, $expectedResult)
    {
        $this->assertEquals($expectedResult, $this->dataTransformer->reverseTransform($computeInstance));
    }

    public function expectedReverseTransformResults()
    {
        return [
            'null'              => [ null,              ''                      ],
            'Addition'          => [ 'Addition',        new Addition(),         ],
            'Subtraction'       => [ 'Subtraction',     new Subtraction(),      ],
            'Multiplication'    => [ 'Multiplication',  new Multiplication(),   ],
            'Division'          => [ 'Division',        new Division(),         ],
        ];
    }

    public function testDataTransformerReverseTransformThrowsExpectionWhenUnexpectedOperatorValuesArePassed()
    {
        $this->expectException('Symfony\Component\Form\Exception\TransformationFailedException');
        $this->expectExceptionMessage('Operator value DummyOperator is not currently supported');
        $this->dataTransformer->reverseTransform('DummyOperator');
    }
}