<?php

namespace LwcBlog\Form;


use Zend\Form\Element\Submit;
use Zend\Form\Element\Textarea;
use Zend\Form\Element\Text;
use Zend\Form\Element\Hidden;
use Zend\Form\Form;


class EntryForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('entry');
        
        $title = new Text('title');
        $title->setAttribute('maxlength', 70)
              ->setLabel('Name');
        $this->add($title);
        
        $id = new Hidden('id');
        $id->setAttribute('maxlength', 10)
              ->setLabel('Id');
        $this->add($id);   
        
        $text = new Textarea('text');
        $text->setAttributes(array(
                'cols' => 60,
                'rows' => 10
            ))
            ->setLabel('Text');
        $this->add($text);
        
        $button = new Submit('submitEntry');
        $button->setAttribute('class', 'btn btn-primary')
               ->setValue('Submit Entry');
        $this->add($button);
        
         
        
        //@TODO define input filter
        //$this->setInputFilter($inputFilter);
        
    }
    
    
    /*
     * public function getInputFilterSpecification()
     
    {
        $nameInput = new Input('name');
        // configure input... and all others
        $inputFilter = new InputFilter();
        // attach all inputs

        $form->setInputFilter($inputFilter);
        
    }*/
}