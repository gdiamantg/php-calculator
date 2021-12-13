<?php

namespace App\Tests\AppBundle\Calculator\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{
    public function testIndexControllerRedirectsUsToCalculatorOperationPage()
    {
        $client = $this->makeClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/');

        $this->assertStatusCode(200, $client);

        $form = $crawler->selectButton('Calculate')->form();

        $this->assertEquals('', $form['calculator_form']['result']->getValue());
        $this->assertEquals('', $form['calculator_form']['operandA']->getValue());
        $this->assertEquals('', $form['calculator_form']['operandB']->getValue());
        $this->assertEquals('', $form['calculator_form']['operator']->getValue());
    }
}
