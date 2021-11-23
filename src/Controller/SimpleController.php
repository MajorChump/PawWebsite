<?php
namespace Paw\Controller;

use Paw\AbstractController;

class SimpleController extends AbstractController
{
    public function eula()
    {
        $this->addTemplate('eula.html');
        return $this->getResponse();
    }

    public function privacy()
    {
        $this->addTemplate('privacy.html');
        return $this->getResponse();
    }
}