<?php

namespace Skel\Service;

use Skel\Test\ApplicationTestCase;
use Skel\Model\Client as ClientModel;
use Skel\Service\Client as ClientService;

class ClientTest extends ApplicationTestCase
{
	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Invalid Parameters
	 */
    public function testSaveWithoutData()
    {
        $clientService = new ClientService();
        $data = array();
        $clientService->save(json_encode($data));
    }

    /**
	 * @expectedException Exception
	 * @expectedExceptionMessage No company
	 */
    public function testSaveWithoutCompany()
    {
        $clientService = new ClientService();
        $clientService->setEm($this->getDefaultEmMock());
        $data = array(
        	'name' => 'Apple',
        	'responsable' => 'Steve Jobs',
        	'email' => 'steve@apple.com',
        	'companyId' => -1
        );
        $clientService->save(json_encode($data));
    }

    public function testSaveNewClient()
    {
        $clientService = new ClientService();
        $clientService->setEm($this->getDefaultEmMock());
        $data = array(
        	'name' => 'Apple',
        	'responsable' => 'Steve Jobs',
        	'email' => 'steve@apple.com',
        	'companyId' => 1
        );
        $saved = $clientService->save(json_encode($data));

        $this->assertEquals('Apple', $saved->getName());
    }

    public function testSaveEditClient()
    {
        $clientService = new ClientService();
        $clientService->setEm($this->getDefaultEmMock());
        $data = array(
        	'name' => 'Apple',
        	'responsable' => 'Steve Jobs',
        	'email' => 'steve@apple.com',
        	'companyId' => 1
        );
        $saved = $clientService->save(json_encode($data));

        $this->assertEquals('Apple', $saved->getName());

        $data = array(
        	'name' => 'Apple Store',
        	'responsable' => 'Steve Jobs',
        	'email' => 'steve@apple.com',
        	'companyId' => 1,
        	'id' => 1
        );
        $saved = $clientService->save(json_encode($data));

        $this->assertEquals('Apple Store', $saved->getName());
    }
}