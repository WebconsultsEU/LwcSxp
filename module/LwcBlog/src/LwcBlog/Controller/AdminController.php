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

class AdminController extends AbstractActionController
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
            $this->setOptions($this->getServiceLocator()->get('lwcblog_module_options'));
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
        
    }
    
    private function forceLogin()
    {
        $userService = $this->getServiceLocator()->get('zfcuser_user_service');
        
         if(!$userService->getAuthService()->hasIdentity()) {
             return $this->redirect()->toRoute('zfcuser');
             
         }
        
    }
    
    public function listAction ()
    { 
         
         $this->forceLogin();
         //@TODO find a better way
         $page = $this->params()->fromRoute('page');
         if($page < 1) $page =1;         
        
         $view = new ViewModel();
         $entryTable = $this->getEntryTable();
         
         //$resultSet = $entryTable->fetchAllDesc();         
         $select = $entryTable->getSql()->select()->order("created DESC");
         $sqlObject = $entryTable->getSql();
         
         
         $paginatorAdapter = new DbSelect($select, $sqlObject);
         
         $view->slugger = new Slugger();         
         
         $paginator = new \Zend\Paginator\Paginator($paginatorAdapter);    
         $paginator->setItemCountPerPage(30);
         
         $paginator->setCurrentPageNumber($page);
         
         $view->entrys = $paginator->getItemsByPage($page);
         
         $view->paginator = $paginator;
        return $view;
    }
    
    
    

    
    
    public function prewiewAction()
    {
        throw new \Exception('not ready yet');        
        $view = new ViewModel();
        $view->entry = $entry;
        
        return $view;
        
        
            
    }
    
    
    public function editAction ()
    {
        $this->forceLogin();
        $form = new EntryForm();
        
        //for existing entrys
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        if($id) {
            
            $entry = $this->getEntryTable()->getEntry($id);
            $data = array (
                           "title" => $entry->getTitle(),
                           "text" => $entry->getText(),
                           "id" => $entry->getId()
                           );
            //this is the semi elegant method but works
            $form->setData($data);
        } 
        
        if($this->getRequest()->isPost()) {
            $entry = new Entry();
            $entry->setAuthor('John Behrens');
            $entry->setCreated(date("Y-m-d h:i:s"));
            
            $form->setData($this->getRequest()->getPost());
            
            $form->setInputFilter($entry->getInputFilter());
            
            if($form->isValid()) {
        
                //@TODO this should run through the input filter but i do not know how it works yet
                 $entry->setTitle($this->getRequest()->getPost()->get('title'));
                //@TODO attention unfiltered
                 $entry->setText($this->getRequest()->getPost()->get('text'));
                 $id = (int) $this->getRequest()->getPost()->get('id');
                 if($id > 0) {
                    $entry->setId($id);
                 }
                $entryTable = $this->getEntryTable();
            
                $entry = $entryTable->saveEntry($entry);
                $id = $entry->getId();
                $slug  = Slugger::buildSlug($entry->getTitle());                
                return $this->redirect()->toRoute('blog', array('action' => 'entry', 'id'=> $id, "slug" => Slugger::buildSlug($entry->title)));
            }
        }
        
        return array('form' => $form);
    }


   
}