<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * ChildParent
 *
 * @ORM\Table(name="childparent")
 * @ORM\Entity
 */
class ChildParent
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected  $id;

    /**
      * @ORM\OneToMany(targetEntity="Blog\Entity\Children", mappedBy="childparent",cascade={"persist","remove"})
      */
     protected $children;

     public function __construct()
    {
        $this->children = new ArrayCollection();
    }



    /**
     * Set name
     *
     * @param string $name
     *
     * @return ChildParent
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
    * Get id
    *
    * @return integer
    */
    public function getId()
    {
        return $this->id;
    }

    /**
      * @param array $children
      * @return Children
      */
     public function setChildren($children)
     {
         foreach ($children as $child) {
            $child->setChildParent($this);
            $this->children->add($child);
        }
        return $this;
     }

     /**
      * @return array
      */
     public function getChildren()
     {
        return $this->children;
     }



    /**
    * Exchange array - used in ZF2 form
    *
    * @param array $data An array of data
    */
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id']))? $data['id'] : null;
        $this->name = (isset($data['name']))? $data['name'] : null;
        $this->children = (isset($data['children']))? $data['children'] : null;
    }

    /**
    * Get an array copy of object
    *
    * @return array
    */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * @param Collection $children
     */
    public function addChildren(Collection $children)
    {
        foreach ($children as $child) {
            $child->setChildParent($this);
            $this->children->add($child);
        }
    }

   /**
     * @param Collection $children
     */
    public function removeChildren(Collection $children)
    {
        foreach ($children as $child) {
            $child->setParent(null);
            $this->children->removeElement($child);
        }
    }
}
