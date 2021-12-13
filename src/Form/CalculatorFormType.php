<?php

namespace App\Form;

use App\Calculator\Operation;
use App\Form\CustomFieldType\OperatorChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CalculatorFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('result', TextType::class, [
                'disabled' => true,
                'mapped' => false,
            ])
            ->add('operandA', NumberType::class, [
                'label' => 'OperandA',
                'scale' => 8
            ])
            ->add('operandB', NumberType::class, [
                'label' => 'OperandB',
                'scale' => 8,
            ])
            ->add('operator', OperatorChoiceType::class, [
                'placeholder' => 'Choose an operation',
                'choices' => [
                    'Addition' => 'Addition',
                    'Subtraction' => 'Subtraction',
                    'Multiplication' => 'Multiplication',
                    'Division' => 'Division',
                ]
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Operation::class
        ]);
    }
}
