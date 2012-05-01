<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A user.
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $password
 */
class User {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")     
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string")
     */
    protected $lastname;
	
	/**
     * @ORM\Column(type="string")
     */
    protected $password;

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
