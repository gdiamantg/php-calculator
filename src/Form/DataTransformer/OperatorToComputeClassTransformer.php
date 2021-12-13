<?php

namespace App\Form\DataTransformer;

use App\Calculator\Compute\ComputeInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class OperatorToComputeClassTransformer implements DataTransformerInterface
{

    /**
     * This function transforms an \App\Calculator\Compute\ComputeInterface implementation to a string
     *
     * {@inheritdoc}
     *
     * @param mixed $value The value in the original representation
     * @return mixed
     * @throws TransformationFailedException when the transformation fails
     */
    public function transform($value)
    {
        if (null === $value) {
            return '';
        }
        
        if (!$value instanceof ComputeInterface) {
            throw new TransformationFailedException('The OperatorChoiceType can only be used with App\Calculator\Compute objects');
        }
        
        return $value->toString();
    }

    /**
     * This function transforms a text into its relevant \App\Calculator\Compute\ComputeInterface implementation
     *
     * {@inheritdoc}
     *
     * @param mixed $value The value in the transformed representation
     * @return mixed
     * @throws TransformationFailedException when the transformation fails
     */
    public function reverseTransform($value)
    {
        if (!$value) {
            return;
        }

        $operatorClass = implode("\\", ['App','Calculator','Compute', $value]);
        if (class_exists($operatorClass)) {
            return new $operatorClass();
        }

        throw new TransformationFailedException("Operator value $value is not currently supported");
    }
}
