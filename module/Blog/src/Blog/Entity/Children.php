<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Children
 *
 * @ORM\Table(name="children")
 * @ORM\Entity
 */
class Children
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \Blog\Entity\ChildParent
     *
     * @ORM\ManyToOne(targetEntity="Blog\Entity\ChildParent", inversedBy="Children")
     * @ORM\JoinColumn(name="childparent_id", referencedColumnName="id", nullable=FALSE)
     */
    private $childparent;

    /**
      * @ORM\OneToMany(targetEntity="Blog\Entity\Hobby", mappedBy="children",cascade={"persist"})
      */
     protected $hobby;

     public function __construct()
    {
        $this->hobby = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Children
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
     * Set parent
     *
     * @param \Blog\Entity\ChildParent $parent
     *
     * @return childparent
     */
    public function setChildParent(ChildParent $childparent)
    {
        return $this->childparent= $childparent;
    }

    /**
     * Get parent
     *
     * @return \Blog\Entity\Parents
     */
    public function getChildParent()
    {
        return $this->childparent;
    }

    /**
      * @param array $hobby
      * @return Hobby
      */
     public function setHobby($hobbies)
     {
         foreach ($hobbies as $hobby) {
            $child->setChildren($hobby);
            $this->hobby->add($hobby);
        }
        return $this;
     }

     public function addHobby(Collection  $hobbies)
     {
         foreach ($hobbies as $hobby) {
            $hobby->setChildren($this);
            $this->hobby->add($hobby);
        }
        return $this;
     }

     /**
     * @param Collection $children
     */
    public function removeHobby(Collection $hobbies)
    {
        foreach ($hobbies as $hobby) {
            $hobby->setChildren(null);
            $this->hobby->removeElement($hobby);
        }
    }

     /**
      * @return array
      */
     public function getHobby()
     {
        return $this->hobby;
     }
}
