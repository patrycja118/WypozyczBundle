<?php

namespace Patrycja\WypozyczBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AActors
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Patrycja\WypozyczBundle\Entity\AActorsRepository")
 */
class AActors
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

  /**
     * @var integer
     * @ORM\Column(name="Movie_id", type="integer")
     * @ORM\ManyToMany(targetEntity="Patrycja\WypozyczBundle\Entity\Movies", mappedBy="actors")
     */
    private $Movie_id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


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
     * @return AActors
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
     * Set Movie_id
     *
     * @param integer $movieId
     * @return AActors
     */
    public function setMovieId($movieId)
    {
        $this->Movie_id = $movieId;

        return $this;
    }

    /**
     * Get Movie_id
     *
     * @return integer 
     */
    public function getMovieId()
    {
        return $this->Movie_id;
    }
}
