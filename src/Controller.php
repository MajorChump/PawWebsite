<?php
namespace Paw;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class Controller
{
    protected $request;
    protected $response;

    const VIEW_FOLDER = '/../views/';

    public function __construct(\GuzzleHttp\Psr7\Request $request, \GuzzleHttp\Psr7\Response $response)
    {
        $this->setRequest($request)
            ->setResponse($response);
    }

    public function index()
    {
        $this->addHeader();
        $this->addTemplate('partials/index.phtml');
        $this->addFooter();
        return $this->getResponse();
    }

    public function distribution()
    {
        $this->addHeader();
        $this->addTemplate('partials/distribution.phtml', [
            "REWARDS" => $this->getDb()->db_recent_rewards(),
            "DISTRIBUTIONS" => $this->getDb()->db_recent_distributions()
        ]);
        $this->addFooter();
        return $this->getResponse();
    }

    public function email()
    {
        $this->addHeader();
        $this->addTemplate('partials/email.phtml');
        $this->addFooter();
        return $this->getResponse();
    }

    public function receive()
    {
        $this->addHeader();
        $this->addTemplate('partials/receive.phtml');
        $this->addFooter();
        return $this->getResponse();
    }

    public function eula()
    {
        $this->addTemplate('eula.phtml');
        return $this->getResponse();
    }

    public function privacy()
    {
        $this->addTemplate('privacy.phtml');
        return $this->getResponse();
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