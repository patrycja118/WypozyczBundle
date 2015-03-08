<?php

namespace Patrycja\WypozyczBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Patrycja\WypozyczBundle\Entity\OrdersRepository")
 */
class Orders
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
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @var string
     * @ORM\Column(name="term", type="string", length=255,)
     */
    private $term;

    /**
     * @var string
     * @ORM\Column(name="form", type="string", length=255)
     */
    private $form;

    /**
     * @var string
     * @ORM\Column(name="conditions", type="string", length=255)
     */
    private $conditions;

    /**
     * @var string
     * @ORM\Column(name="Movie_id", type="integer")
     * @ORM\ManyToMany(targetEntity="Movies")
     * @ORM\JoinColumn(name="id", referencedColumnName="Movie_id")
     *
     */
    private $Movie_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="idCustomer", type="integer")
     * @ORM\OneToOne(targetEntity="User", inversedBy="user")
     */
    private $idCustomer;


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
     * Set status
     *
     * @param string $status
     * @return Orders
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set term
     *
     * @param string $term
     * @return Orders
     */
    public function setTerm($term)
    {
        $this->term = $term;

        return $this;
    }

    /**
     * Get term
     *
     * @return string 
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * Set form
     *
     * @param string $form
     * @return Orders
     */
    public function setForm($form)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * Get form
     *
     * @return string 
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Set conditions
     *
     * @param string $conditions
     * @return Orders
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;

        return $this;
    }

    /**
     * Get conditions
     *
     * @return string 
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    
    /**
     * Set Movie_id
     *
     * @param integer $movieId
     * @return Orders
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

    /**
     * Set idCustomer
     *
     * @param integer $idCustomer
     * @return Orders
     */
    public function setIdCustomer($idCustomer)
    {
        $this->idCustomer = $idCustomer;

        return $this;
    }

    /**
     * Get idCustomer
     *
     * @return integer 
     */
    public function getIdCustomer()
    {
        return $this->idCustomer;
    }


}
