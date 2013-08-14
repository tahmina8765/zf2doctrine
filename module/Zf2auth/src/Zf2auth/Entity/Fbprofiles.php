<?php

namespace Zf2auth\Entity;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Fbprofiles implements InputFilterAwareInterface
{

    public $user_id;
	public $facebook_id;
	public $name;
	public $first_name;
	public $last_name;
	public $link;
	public $username;
	public $email;
	public $gender;
	public $timezone;
	public $locale;
	public $verified;
	public $updated_time;
	
    protected $inputFilter;                       // <-- Add this variable

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
	$this->user_id     = (isset($data['user_id'])) ? $data['user_id'] : null;
	$this->facebook_id     = (isset($data['facebook_id'])) ? $data['facebook_id'] : null;
	$this->name     = (isset($data['name'])) ? $data['name'] : null;
	$this->first_name     = (isset($data['first_name'])) ? $data['first_name'] : null;
	$this->last_name     = (isset($data['last_name'])) ? $data['last_name'] : null;
	$this->link     = (isset($data['link'])) ? $data['link'] : null;
	$this->username     = (isset($data['username'])) ? $data['username'] : null;
	$this->email     = (isset($data['email'])) ? $data['email'] : null;
	$this->gender     = (isset($data['gender'])) ? $data['gender'] : null;
	$this->timezone     = (isset($data['timezone'])) ? $data['timezone'] : null;
	$this->locale     = (isset($data['locale'])) ? $data['locale'] : null;
	$this->verified     = (isset($data['verified'])) ? $data['verified'] : null;
	$this->updated_time     = (isset($data['updated_time'])) ? $data['updated_time'] : null;
	
    }


    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setUserId($user_id)
            {
                $this->user_id = $user_id;
            }

            public function getUserId()
            {
                return $this->user_id;
            }
            public function setFacebookId($facebook_id)
            {
                $this->facebook_id = $facebook_id;
            }

            public function getFacebookId()
            {
                return $this->facebook_id;
            }
            public function setName($name)
            {
                $this->name = $name;
            }

            public function getName()
            {
                return $this->name;
            }
            public function setFirstName($first_name)
            {
                $this->first_name = $first_name;
            }

            public function getFirstName()
            {
                return $this->first_name;
            }
            public function setLastName($last_name)
            {
                $this->last_name = $last_name;
            }

            public function getLastName()
            {
                return $this->last_name;
            }
            public function setLink($link)
            {
                $this->link = $link;
            }

            public function getLink()
            {
                return $this->link;
            }
            public function setUsername($username)
            {
                $this->username = $username;
            }

            public function getUsername()
            {
                return $this->username;
            }
            public function setEmail($email)
            {
                $this->email = $email;
            }

            public function getEmail()
            {
                return $this->email;
            }
            public function setGender($gender)
            {
                $this->gender = $gender;
            }

            public function getGender()
            {
                return $this->gender;
            }
            public function setTimezone($timezone)
            {
                $this->timezone = $timezone;
            }

            public function getTimezone()
            {
                return $this->timezone;
            }
            public function setLocale($locale)
            {
                $this->locale = $locale;
            }

            public function getLocale()
            {
                return $this->locale;
            }
            public function setVerified($verified)
            {
                $this->verified = $verified;
            }

            public function getVerified()
            {
                return $this->verified;
            }
            public function setUpdatedTime($updated_time)
            {
                $this->updated_time = $updated_time;
            }

            public function getUpdatedTime()
            {
                return $this->updated_time;
            }
            


    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                        'name'     => 'id',
                        'required' => true,
                        'filters'  => array(
                            array('name' => 'Int'),
                        ),
            )));

            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'user_id',
                        'required' => true,
            )));
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'facebook_id',
                        'required' => true,
            )));
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'name',
                        'required' => true,
            )));
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'first_name',
                        'required' => true,
            )));
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'last_name',
                        'required' => true,
            )));
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'link',
                        'required' => true,
            )));
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'username',
                        'required' => true,
            )));
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'email',
                        'required' => true,
            )));
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'gender',
                        'required' => true,
            )));
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'timezone',
                        'required' => true,
            )));
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'locale',
                        'required' => true,
            )));
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'verified',
                        'required' => true,
            )));
            
            $inputFilter->add($factory->createInput(array(
                        'name'     => 'updated_time',
                        'required' => true,
            )));
            

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}