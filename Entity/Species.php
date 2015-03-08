<?php

namespace Patrycja\WypozyczBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Species
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Patrycja\WypozyczBundle\Entity\SpeciesRepository")
 */
class Species
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
     * @var string
     *
     * @ORM\Column(name="spec", type="string", length=255)
     */
    private $spec;


    /**
     * @var integer
     * @ORM\Column(name="Movie_id", type="integer")
     * @ORM\ManyToMany(targetEntity="Patrycja\WypozyczBundle\Entity\Movies", mappedBy="movies")
     */
    private $Movie_id;


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
     * Set spec
     *
     * @param string $spec
     * @return Species
     */
    public function setSpec($spec)
    {
        $this->spec = $spec;

        return $this;
    }

    /**
     * Get spec
     *
     * @return string 
     */
    public function getSpec()
    {
        return $this->spec;
    }


    /**
     * Set Movie_id
     *
     * @param integer $movieId
     * @return Species
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
