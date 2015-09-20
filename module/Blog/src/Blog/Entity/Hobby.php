<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Children
 *
 * @ORM\Table(name="hoppies")
 * @ORM\Entity
 */
class Hobby
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
     * @var \Blog\Entity\Children
     *
     * @ORM\ManyToOne(targetEntity="Blog\Entity\Children", inversedBy="hoppies")
     * @ORM\JoinColumn(name="children_id", referencedColumnName="id", nullable=FALSE)
     */
    private $children;



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
     * @param \Blog\Entity\Children $parent
     *
     * @return childparent
     */
    public function setChildren(Children $children)
    {
        return $this->children = $children;
    }

    /**
     * Get parent
     *
     * @return \Blog\Entity\Children
     */
    public function getChildren()
    {
        return $this->children;
    }
}
