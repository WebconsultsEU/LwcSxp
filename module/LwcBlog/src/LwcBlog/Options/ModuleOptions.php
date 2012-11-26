<?php

namespace LwcBlog\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions 
{
    /**
     * Turn off strict options mode
     */
    protected $__strictMode__ = false;

    protected $feedtitle;
    protected $feedLink;
    /**
     *@param author 
     */
    protected $feedauthor;
    
    protected $feeddescription;
    protected $feedsitelink;
    
    public function getFeedtitle() {
        return $this->feedtitle;
    }

    public function setFeedtitle($feedtitle) {
        $this->feedtitle = $feedtitle;
    }

    public function getFeedLink() {
        return $this->feedLink;
    }

    public function setFeedLink($feedLink) {
        $this->feedLink = $feedLink;
    }

    public function getFeedauthor() {
        return $this->feedauthor;
    }

    public function setFeedauthor($feedauthor) {
        $this->feedauthor = $feedauthor;
    }

    public function getFeeddescription() {
        return $this->feeddescription;
    }

    public function setFeeddescription($feeddescription) {
        $this->feeddescription = $feeddescription;
    }

    public function getFeedsitelink() {
        return $this->feedsitelink;
    }

    public function setFeedsitelink($feedsitelink) {
        $this->feedsitelink = $feedsitelink;
    }


   
}
