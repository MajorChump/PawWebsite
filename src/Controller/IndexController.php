<?php
namespace Paw\Controller;

use Paw\AbstractController;

class IndexController extends AbstractController
{
    public function get()
    {
        $this->addHeader();
        $this->addTemplate('partials/index.phtml');
        $this->addFooter();
        return $this->getResponse();
    }
}