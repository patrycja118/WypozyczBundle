<?php

namespace Patrycja\WypozyczBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Review
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Patrycja\WypozyczBundle\Entity\ReviewRepository")
 */
class Review
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
     * @ORM\OneToMany(targetEntity="Patrycja\WypozyczBundle\Entity\Movies", mappedBy="movies")
     */
    private $Movie_id;


    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;


    /**
     * @var string
     *
     * @ORM\Column(name="body", type="string", length=255)
     */
    private $body;




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
     * Set subject
     *
     * @param string $subject
     * @return Review
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    
    /**
     * Set body
     *
     * @param string $body
     * @return Review
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }


    /**
     * Set Movie_id
     *
     * @param integer $movieId
     * @return Review
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
