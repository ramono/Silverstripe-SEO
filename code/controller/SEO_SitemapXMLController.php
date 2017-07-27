<?php
/**
 * SitemapXML_Controller
 *
 * sitemap.xml controller
 *
 * @package silverstripe-seo
 * @license MIT License https://github.com/cyber-duck/silverstripe-seo/blob/master/LICENSE
 * @author  <andrewm@cyber-duck.co.uk>
 **/
class SEO_SitemapXMLController extends Page_Controller
{
    /**
     * Set the required content type header
     *
     * @since version 1.0.0
     *
     * @return void
     **/
    public function init()
    {
        parent::init();

        $this->response->addHeader("Content-Type", "application/xml"); 
    }

    /**
     * Route request to default index method
     *
     * @param SS_HTTPRequest $request
     *
     * @since version 1.0.0
     *
     * @return ViewableData
     **/
    public function index(SS_HTTPRequest $request)
    {
        return $this->renderWith('SitemapXML');
    }

    /**
     * Route request to default index method
     *
     * @param SS_HTTPRequest $request
     *
     * @since version 1.0.0
     *
     * @return ViewableData
     **/
    public function getSitemapPages()
    {
        $pages = [];
        foreach(Page::get() as $page) {
            if(!$page->SitemapHide) {
                $this->pages[] = $page;
            }
        }
        $objects = (array) Config::inst()->get('SEO_Sitemap', 'objects');

        if(!empty($objects)) {
            foreach($objects as $name => $values) {
                foreach($name::get() as $page) {
                    if(!$page->SitemapHide) {
                        $this->pages[] = $page;
                    }
                }
            }
        }
        return $pages;
    }
}