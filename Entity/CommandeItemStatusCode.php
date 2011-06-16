<?php

namespace CSF\CartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * CSF\CartBundle\Entity\CommandeItemStatusCode
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CommandeItemStatusCode
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
    
    /**
     * @ORM\OneToMany(targetEntity="CommandeItems", mappedBy="commandeItemsStatusCode")
     */
    private $commandeItems;


    public function __construct()
    {
        $this->commandeItems = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add commandeItems
     *
     * @param CSF\CartBundle\Entity\CommandeItems $commandeItems
     */
    public function addCommandeItems(\CSF\CartBundle\Entity\CommandeItems $commandeItems)
    {
        $this->commandeItems[] = $commandeItems;
    }

    /**
     * Get commandeItems
     *
     * @return Doctrine\Common\Collections\Collection $commandeItems
     */
    public function getCommandeItems()
    {
        return $this->commandeItems;
    }
    
	public function __toString()
    {
    	return $this->description;
    }
}