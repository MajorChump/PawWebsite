<?php
namespace Paw\Controller;

use Paw\AbstractController;

class DistributionController extends AbstractController
{
    public function get()
    {
        $this->addHeader();
        $this->addTemplate('partials/distribution.phtml', [
            "REWARDS" => $this->getDb()->db_recent_rewards(),
            "DISTRIBUTIONS" => $this->getDb()->db_recent_distributions()
        ]);
        $this->addFooter();
        return $this->getResponse();
    }
}