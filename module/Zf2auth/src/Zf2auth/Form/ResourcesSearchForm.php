<?php
namespace Zf2auth\Form;

use Zend\Form\Form;
use \Zend\Form\Element;

class ResourcesSearchForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('resources');
        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('method', 'post');


	
        $name = new Element\Text('name');
        $name->setLabel('Name')
                ->setAttribute('class', 'required')
                ->setAttribute('placeholder', 'Name');
        



        $submit = new Element\Submit('submit');
        $submit->setValue('Search')
                ->setAttribute('class', 'btn btn-primary');


        $this->add($name);
	
        $this->add($submit);

    }
}


    