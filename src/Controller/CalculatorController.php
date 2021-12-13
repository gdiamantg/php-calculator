<?php

namespace App\Controller;

use App\Form\CalculatorFormType;
use App\Calculator\Operation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CalculatorController extends AbstractController
{
    /**
     * @Route("/calculator", name="calculator_operation")
     */
    public function operation(Request $request, Operation $operation)
    {
        $result = null;
        $form = $this->createForm(CalculatorFormType::class, $operation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $form->getData()->isValid()) {
            $result = $operation->compute();
        }

        return $this->render('calculator/operation.html.twig', [
            'calculatorForm' => $form->createView(),
            'result' => $result,
        ]);
    }
}
