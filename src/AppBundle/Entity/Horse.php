<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Horse
 *
 * @ORM\Table(name="horses")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HorseRepository")
 */
class Horse
{
    /**
    * @var Stable
    *
    * @ORM\ManyToOne(targetEntity="Stable", inversedBy="horses")
    * @ORM\JoinColumn(name="stable_id", referencedColumnName="id")
    */
    
    private $stable;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=255)
     */
    private $sex;

    /**
     * @var string
     *
     * @ORM\Column(name="breed", type="string", length=255)
     */
    private $breed;


    /**
     * Get id
     *
     * @return int
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
     * @return Horse
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
     * Set age
     *
     * @param integer $age
     *
     * @return Horse
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set sex
     *
     * @param string $sex
     *
     * @return Horse
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set breed
     *
     * @param string $breed
     *
     * @return Horse
     */
    public function setBreed($breed)
    {
        $this->breed = $breed;

        return $this;
    }

    /**
     * Get breed
     *
     * @return string
     */
    public function getBreed()
    {
        return $this->breed;
    }

    /**
     * Set stable
     *
     * @param \AppBundle\Entity\Stable $stable
     *
     * @return Horse
     */
    public function setStable(\AppBundle\Entity\Stable $stable = null)
    {
        $this->stable = $stable;

        return $this;
    }

    /**
     * Get stable
     *
     * @return \AppBundle\Entity\Stable
     */
    public function getStable()
    {
        return $this->stable;
    }
}
