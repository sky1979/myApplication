<?php

namespace User\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * A user right.
 *
 * @ORM\Entity
 * @ORM\Table(name="user_right")
 * @property boolean $unlocked
 * @property string $right1
 * @property string $right2
 * @property User $user
 * @property int $user_id
 * @property int $id
 */
class Right {			
	
	/**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")     
     */
    protected $id;
	
	/**
	* @ORM\OneToOne(targetEntity="User", cascade={"persist"})     	  
	* @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	*/ 
	protected $user;

	/**
     * @ORM\Column(type="integer");
     */
    protected $user_id;
	
    /**
     * @ORM\Column(type="boolean")
     */
    protected $unlocked;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $right1;
	
    /**
     * @ORM\Column(type="boolean")
     */
    protected $right2;
	

    /**
     * Magic getter to expose protected properties.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property) {
        return $this->$property;
    }

    /**
     * Magic setter to save protected properties.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value) {
        $this->$property = $value;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function toArray() {
        return get_object_vars($this);
    }

}