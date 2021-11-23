<?php
namespace Paw;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

abstract class AbstractController
{
    protected $request;
    protected $response;

    const VIEW_FOLDER = '/../views/';

    public function __construct(\GuzzleHttp\Psr7\Request $request, \GuzzleHttp\Psr7\Response $response)
    {
        $this->setRequest($request)
            ->setResponse($response);
    }

    protected function addTemplate($name, $variables = [])
    {
        $viewName = __DIR__ . static::VIEW_FOLDER . $name;
        if (!file_exists($viewName)) {
            throw new \Exception("View doesn't exist " . $viewName);
        }

        if (count($variables)) {
            extract($variables);
        }

        ob_start();
        require $viewName;
        $output = ob_get_contents();
        ob_clean();
        $this->getResponse()->getBody()->write($output);
    }

    protected function addHeader()
    {
        $this->addTemplate('partials/header.phtml');
    }

    protected function addFooter()
    {
        $this->addTemplate('partials/footer.phtml');
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    public function getResponse(): Response
    {
        return $this->response;
    }

    public function setResponse(Response $response)
    {
        $this->response = $response;
        return $this;
    }

    protected function getDb()
    {
        if (!isset($this->db)) {
            $this->db = new Db();
        }

        return $this->db;
    }
}