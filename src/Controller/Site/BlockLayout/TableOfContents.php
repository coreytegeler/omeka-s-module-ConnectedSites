<?php
namespace ConnectedSites\Site\BlockLayout;

use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Api\Representation\SitePageRepresentation;
use Omeka\Api\Representation\SitePageBlockRepresentation;
use Zend\Navigation\Navigation;
use Zend\Form\Element\Number;
use Zend\View\Renderer\PhpRenderer;

class TableOfContents extends AbstractBlockLayout
{
    public function getLabel()
    {
        return 'Table of contents'; // @translate
    }

    public function form(PhpRenderer $view, SiteRepresentation $site,
        SitePageRepresentation $page = null, SitePageBlockRepresentation $block = null
    ) {
        $depth = new Number("o:block[__blockIndex__][o:data][depth]");

        $depth->setValue($block ? $block->dataValue('depth', 1) : 1);
        $depth->setAttribute('min', 1);

        $html = '';
        $html = '<div class="field"><div class="field-meta">';
        $html .= '<label>' . $view->translate('Depth') . '</label>';
        $html .= '<div class="field-description">' . $view->translate('Number of child page levels to display') . '</div>';
        $html .= '</div>';
        $html .= '<div class="inputs">' . $view->formRow($depth) . '</div>';
        $html .= '</div>';
        return $html;
    }

    public function render(PhpRenderer $view, SitePageBlockRepresentation $block)
    {
        $view->pageViewModel->setVariable('displayNavigation', false);

        $nav = $block->page()->site()->publicNav();
        $container = $nav->getContainer();
        $activePage = $nav->findActive($container);

        if (!$activePage) {
            return null;
        }

        // Make new copies of the pages so we don't disturb the regular nav
        $pages = $activePage['page']->getPages();
        $newPages = [];
        foreach ($pages as $page) {
            $newPages[] = $page->toArray();
        }
        $subNav = new Navigation($newPages);

        $depth = $block->dataValue('depth', 1);


        $defaultSiteId = $this->setting('default_site');
        $defaultSiteResponse = $this->api()->read('sites', $defaultSiteId);
        $defaultSite = $defaultSiteResponse->getContent();

        $response = $this->api()->search('sites');
        $sites = $response->getContent();
        // if ($sites):
        //     foreach ($sites as $thisSite):
        //         $thisId = $thisSite->id();
        //         if($thisId != $defaultSiteId):
        //         $siteHtml = '<a href="">';
        //         $siteHtml .= '<h3>'.$thisSite->title().'</h3>';
        //         $siteHtml .= '</a>';
        //         echo '<div class="exhibit">'.$siteHtml.'</div>';
        //         endif;
        //     endforeach;
        // endif;

        // return $view->partial('common/block-layout/table-of-contents', [
            // 'sites' => $sites,
            // 'block' => $block,
            // 'subNav' => $subNav,
            // 'maxDepth' => $depth - 1,
        // ]);
    }
}
