<?php

namespace Patrycja\WypozyczBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movies
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Patrycja\WypozyczBundle\Entity\MoviesRepository")
 */
class Movies
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=255)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="poster", type="string", length=255)
     */
    private $poster;

    /**
     * @ORM\ManyToMany(targetEntity="Patrycja\WypozyczBundle\Entity\AActors", inversedBy="Movie_id")
     * @ORM\JoinTable(name="Movies_AActors")
     *
     */
    private $actors;

    /**
     * @ORM\ManyToMany(targetEntity="Patrycja\WypozyczBundle\Entity\Species", inversedBy="Movie_id")
     * @ORM\JoinTable(name="Movies_Species")
     *
     */
    private $species;


   /**
     * @ORM\ManyToMany(targetEntity="Patrycja\WypozyczBundle\Entity\Orders", inversedBy="Movie_id")
     * @ORM\JoinTable(name="Movies_Orders")
     *
     */
    private $orders;

    /**
     * @ORM\ManyToOne(targetEntity="Patrycja\WypozyczBundle\Entity\Review", inversedBy="Movie_id")
     * @ORM\JoinTable(name="Movies_Review")
     *
     */
    private $reviews;


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
     * Set title
     *
     * @param string $title
     * @return Movies
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Movies
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Movies
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set poster
     *
     * @param string $poster
     * @return Movies
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * Get poster
     *
     * @return string 
     */
    public function getPoster()
    {
        return $this->poster;
    }

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->species = new \Doctrine\Common\Collections\ArrayCollection();
        $this->orders = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add actors
     *
     * @param \Patrycja\WypozyczBundle\Entity\AActors $actors
     * @return Movies
     */
    public function addActor(\Patrycja\WypozyczBundle\Entity\AActors $actors)
    {
        $this->actors[] = $actors;

        return $this;
    }

    /**
     * Remove actors
     *
     * @param \Patrycja\WypozyczBundle\Entity\AActors $actors
     */
    public function removeActor(\Patrycja\WypozyczBundle\Entity\AActors $actors)
    {
        $this->actors->removeElement($actors);
    }

    /**
     * Get actors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * Add species
     *
     * @param \Patrycja\WypozyczBundle\Entity\Species $species
     * @return Movies
     */
    public function addSpecy(\Patrycja\WypozyczBundle\Entity\Species $species)
    {
        $this->species[] = $species;

        return $this;
    }

    /**
     * Remove species
     *
     * @param \Patrycja\WypozyczBundle\Entity\Species $species
     */
    public function removeSpecy(\Patrycja\WypozyczBundle\Entity\Species $species)
    {
        $this->species->removeElement($species);
    }

    /**
     * Get species
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * Set reviews
     *
     * @param \Patrycja\WypozyczBundle\Entity\Review $reviews
     * @return Movies
     */
    public function setReviews(\Patrycja\WypozyczBundle\Entity\Review $reviews = null)
    {
        $this->reviews = $reviews;

        return $this;
    }

    /**
     * Get reviews
     *
     * @return \Patrycja\WypozyczBundle\Entity\Review 
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * Add orders
     *
     * @param \Patrycja\WypozyczBundle\Entity\Orders $orders
     * @return Movies
     */
    public function addOrder(\Patrycja\WypozyczBundle\Entity\Orders $orders)
    {
        $this->orders[] = $orders;

        return $this;
    }

    /**
     * Remove orders
     *
     * @param \Patrycja\WypozyczBundle\Entity\Orders $orders
     */
    public function removeOrder(\Patrycja\WypozyczBundle\Entity\Orders $orders)
    {
        $this->orders->removeElement($orders);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrders()
    {
        return $this->orders;
    }
}
