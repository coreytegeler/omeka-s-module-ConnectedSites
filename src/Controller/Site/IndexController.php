<?php
namespace ConnectedSites\Controller\Site;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $site = $this->currentSite();

        // Redirect to the first linked page, if it exists.
        $linkedPages = $site->linkedPages();
        if ($linkedPages) {
            $firstPage = current($linkedPages);
            return $this->redirect()->toRoute('site/page', [
                'site-slug' => $site->slug(),
                'page-slug' => $firstPage->slug(),
            ]);
        }

        $response = $this->api()->search('sites');

        $view = new ViewModel;
        $view->setVariable('site', $site);
        $view->setVariable('sites', $response->getContent());
        return $view;
    }
}
