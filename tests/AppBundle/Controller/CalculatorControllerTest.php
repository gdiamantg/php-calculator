<?php

namespace App\Tests\AppBundle\Calculator\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    public function testCalculatorOperationRouteIsReachable()
    {
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/calculator');

        $this->assertStatusCode(200, $client);
    }

    public function testAdditionOperationReturnsExpectedResults()
    {
        $client = $this->makeClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/calculator/');

        $this->assertStatusCode(200, $client);

        $form = $crawler->selectButton('Calculate')->form();

        $form['calculator_form']['operandA']->setValue(10);
        $form['calculator_form']['operandB']->setValue(30);
        $form['calculator_form']['operator']->select('Addition');

        $crawler = $client->submit($form);
        $this->assertStatusCode(200, $client);

        $form = $crawler->selectButton('Calculate')->form();
        $this->assertEquals('40', $form['calculator_form']['result']->getValue());
    }

    public function testSubtractionOperationReturnsExpectedResults()
    {
        $client = $this->makeClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/calculator/');

        $this->assertStatusCode(200, $client);

        $form = $crawler->selectButton('Calculate')->form();

        $form['calculator_form']['operandA']->setValue(10);
        $form['calculator_form']['operandB']->setValue(30);
        $form['calculator_form']['operator']->select('Subtraction');

        $crawler = $client->submit($form);
        $this->assertStatusCode(200, $client);

        $form = $crawler->selectButton('Calculate')->form();
        $this->assertEquals('-20', $form['calculator_form']['result']->getValue());
    }

    public function testMultiplicationOperationReturnsExpectedResults()
    {
        $client = $this->makeClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/calculator/');

        $this->assertStatusCode(200, $client);

        $form = $crawler->selectButton('Calculate')->form();

        $form['calculator_form']['operandA']->setValue(10);
        $form['calculator_form']['operandB']->setValue(30);
        $form['calculator_form']['operator']->select('Multiplication');

        $crawler = $client->submit($form);
        $this->assertStatusCode(200, $client);

        $form = $crawler->selectButton('Calculate')->form();
        $this->assertEquals('300', $form['calculator_form']['result']->getValue());
    }

    public function testDivisionOperationReturnsExpectedResults()
    {
        $client = $this->makeClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/calculator/');

        $this->assertStatusCode(200, $client);

        $form = $crawler->selectButton('Calculate')->form();

        $form['calculator_form']['operandA']->setValue(10);
        $form['calculator_form']['operandB']->setValue(30);
        $form['calculator_form']['operator']->select('Division');

        $crawler = $client->submit($form);
        $this->assertStatusCode(200, $client);

        $form = $crawler->selectButton('Calculate')->form();
        $this->assertEquals('0.33333333333333', $form['calculator_form']['result']->getValue());
    }

    public function testDivisionByZeroOperationReturnsExpectedResults()
    {
        $client = $this->makeClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/calculator/');

        $this->assertStatusCode(200, $client);

        $form = $crawler->selectButton('Calculate')->form();

        $form['calculator_form']['operandA']->setValue(10);
        $form['calculator_form']['operandB']->setValue(0);
        $form['calculator_form']['operator']->select('Division');

        $crawler = $client->submit($form);
        $this->assertStatusCode(200, $client);

        $form = $crawler->selectButton('Calculate')->form();
        $this->assertEquals('', $form['calculator_form']['result']->getValue());
        $this->assertEquals(10, $form['calculator_form']['operandA']->getValue());
        $this->assertEquals(0, $form['calculator_form']['operandB']->getValue());
        // Now ensure that we did get an error element indicating the issue
        $this->assertStringContainsString('is-invalid', $crawler->filter('#calculator_form_operandB')->attr('class'));
        $this->assertEquals('Division by zero attempt.', $crawler->filter('.invalid-feedback')->text());
    }

}
