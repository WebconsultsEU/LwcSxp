<?php
namespace LwcBlog\Controller;
use LwcBlog\Model\Entry;
use LwcBlog\Model\EntryResultSet;
use LwcBlog\Form\EntryForm;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator;
use Zend\Paginator\Adapter\DbSelect;
use LwcBlog\Slugger;

use Zend\Feed\Writer\Feed;
use Zend\View\Model\FeedModel;

class BlogController extends AbstractActionController
{
    private $options ;
    
    public function setOptions( $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * get options
     *
     * @return UserControllerOptionsInterface
     */
    public function getOptions()
    {
        if (!$this->options ) {
            $this->setOptions($this->getServiceLocator()->get('lwc_blog_module_options'));
        }
        return $this->options;
    }
    
   /**
     * @Return \LwcBlog\Model\EntryTable
     */
    private function getEntryTable()
    {
        
        $entryTable = $this->getServiceLocator()->get('LwcBlog\Model\EntryTable');         
        return $entryTable;
    }
    
    public function indexAction ()
    { 
         
         //@TODO find a better way
         $page = $this->params()->fromRoute('page');
         if($page < 1) $page =1;         
        
         $view = new ViewModel();
         $entryTable = $this->getEntryTable();
         
         //$resultSet = $entryTable->fetchAllDesc();         
         $select = $entryTable->getSql()->select()->order("created DESC");
         $sqlObject = $entryTable->getSql();
         
         
         $paginatorAdapter = new DbSelect($select, $sqlObject);
         $results = $paginatorAdapter->getItems(0, 10);
         $view->slugger = new Slugger();         
         
         $paginator = new \Zend\Paginator\Paginator($paginatorAdapter);    
         $paginator->setItemCountPerPage(5);
         
         $paginator->setCurrentPageNumber($page);
         
         $view->entrys = $paginator->getItemsByPage($page);
         
         $view->paginator = $paginator;
         
         
        
        
        return $view;
    }
    
    public function feedAction ()
    { 
        $entryTable = $this->getEntryTable();
        
        $resultSet = $entryTable->fetchAllDesc();
        $entries = $entryTable->getAll($resultSet);
        
        //Todo: Move to Mapper
        $feed = new Feed();
        //@TODO: Move to config
        $feed->setTitle($this->getOptions()->getFeedTitle());
        $feed->setFeedLink($this->getOptions()->getFeedLink(), 'atom');
        $feed->addAuthor($this->getOptions()->getFeedAuthor());
        $feed->setDescription($this->getOptions()->getFeedDescription());
        $feed->setLink($this->getOptions()->getFeedSiteLink());

        $feed->setDateModified(time());
        $urlPlugin = $this->plugin('url');
        
        foreach($entries as $row)
        {   
            $slug =  Slugger::buildSlug($row->title);
            $url = $urlPlugin->fromRoute("blog", array("action" => 'entry', "id" => $row->id, "slug" => $slug));
            
            $entry = $feed->createEntry();
            $entry->setTitle($row->title);
            $entry->setLink($url);
            
            $text = strip_tags($row->text);
           
            $text = substr($text, 0, 200);
            $entry->setDescription($text);
            
            $entry->setDateModified(strtotime($row->created));
            $entry->setDateCreated(strtotime($row->created));

            $feed->addEntry($entry);
        }
        
        
        $feed->export('rss');

        $feedmodel = new FeedModel();
        $feedmodel->setFeed($feed);

     return $feedmodel; 
   
    }
    
    public function archivesAction()
    {
               
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $slug = $this->getEvent()->getRouteMatch()->getParam('slug');
        return $this->redirect()->toRoute('blog', array("controller" => "blog", "action"=>"entry", "id"=>$id, "slug"=>$slug));
        
            
    }
    
    
    public function entryAction()
    {
        
        //example for getting parameter via GET
        //does not work for route parameters
        //$id = (int) $this->getRequest()->getQuery()->id;
        
        //example for getting parameter via route 
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        //should also work $slug= $this->params('slug');
        
        $entryTable = $this->getEntryTable();    
       
        $entry = $entryTable->getEntry($id);
        $view = new ViewModel();
        $view->entry = $entry;
        
        return $view;
        
        
            
    }

   
}