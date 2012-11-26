<?php
namespace LwcBlog\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Entry extends \ArrayObject implements InputFilterAwareInterface
{
    protected $inputFilter;
    
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $text;
   
    /**
     * @var int
     */
    public $created;

    /**
     * @var string
     */
    public $author;
    
    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id']))        ? $data['id'] : null;
        $this->title = (isset($data['title']))      ? $data['title'] : null;
        $this->text  = (isset($data['text']))       ? $data['text'] : null;
        $this->created  = (isset($data['created'])) ? $data['created'] : null;
        $this->author  = (isset($data['author'])) ? $data['author'] : null;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function getCreated() {
        return $this->created;
    }

    public function setCreated($created) {
        $this->created = $created;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

        

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
     #   throw new \Exception('Not used');
        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Zend\InputFilter\InputFilterAwareInterface::getInputFilter()
     */
    public function getInputFilter()
    {
        if($this->inputFilter == null) {
            $this->inputFilter = new InputFilter();
        }
        
        return $this->inputFilter;
    }
}