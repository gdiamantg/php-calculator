<?php

namespace App\Calculator;

use App\Calculator\Compute\Division;
use App\Calculator\Compute\ComputeInterface;
use App\Calculator\Compute\Exception\ComputationException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Operation
{
    /**
     * @var float
     * @Assert\NotBlank(message="Fill out this field")
     * @Assert\Type("float", message="was expecting float")
     */
    private ?float $operandA = null;
    /**
     * @var float
     * @Assert\NotBlank(message="Fill out this field")
     * @Assert\Type("float", message="was expecting float")
     */
    private ?float $operandB = null;
    /**
     * @var ComputeInterface
     * @Assert\NotBlank(message="Please select an operator")
     */
    private ?ComputeInterface $operator = null;

    /**
     * Get the value of operandA
     */
    public function getOperandA(): ?float
    {
        return $this->operandA;
    }

    /**
     * Set the value of operandA
     *
     * @return  self
     */
    public function setOperandA(?float $operandA)
    {
        $this->operandA = $operandA;

        return $this;
    }

    /**
     * Get the value of operandB
     */
    public function getOperandB(): ?float
    {
        return $this->operandB;
    }

    /**
     * Set the value of operandB
     *
     * @return  self
     */
    public function setOperandB(?float $operandB)
    {
        $this->operandB = $operandB;

        return $this;
    }

    /**
     * Get the value of operator
     *
     */
    public function getOperator(): ?ComputeInterface
    {
        return $this->operator;
    }

    /**
     * Set the value of operator
     *
     * @return  self
     */
    public function setOperator(?ComputeInterface $operator)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get the result of the operation
     *
     * @return  float|string
     */
    public function compute()
    {
        try {
            return $this->getOperator()
                ->compute($this->getOperandA(), $this->getOperandB()) ?? 'Not a number';
        } catch (ComputationException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Ensure that all properties are set before trying to utilise this class
     *
     * @return boolean
     */
    public function isValid()
    {
        return is_float($this->getOperandA())
            && is_float($this->getOperandB())
            && ($this->getOperator() instanceof ComputeInterface);
    }

    /**
     * Custom callback validator to be used on the operandB to check for division by zero cases
     *
     * @Assert\Callback
     */
    public function divisionByZeroValidator(ExecutionContextInterface $context)
    {
        if ($this->isValid()
         && ($this->operator instanceof Division)
         && ($this->operandB == 0)
        ) {
            $context->buildViolation('Division by zero attempt.')
                ->atPath('operandB')
                ->addViolation();
        }
    }
}
