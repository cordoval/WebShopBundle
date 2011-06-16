<?php

namespace CSF\CartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * CSF\CartBundle\Entity\CommandeStatusCode
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CommandeStatusCode
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
     * @var string $status_description
     *
     * @ORM\Column(name="status_description", type="string", length=255)
     */
    private $statusDescription;

    /**
     * @ORM\OneToMany(targetEntity="CommandeClient", mappedBy="statusCommande")
     */
    private $commandeClients;

    public function __construct()
    {
        $this->commandeClients = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set status_description
     *
     * @param string $statusDescription
     */
    public function setStatusDescription($statusDescription)
    {
        $this->statusDescription = $statusDescription;
    }

    /**
     * Get status_description
     *
     * @return string $statusDescription
     */
    public function getStatusDescription()
    {
        return $this->statusDescription;
    }

    /**
     * Add commandeClients
     *
     * @param CSF\CartBundle\Entity\CommandeClient $commandeClients
     */
    public function addCommandeClients(\CSF\CartBundle\Entity\CommandeClient $commandeClients)
    {
        $this->commandeClients[] = $commandeClients;
    }

    /**
     * Get commandeClients
     *
     * @return Doctrine\Common\Collections\Collection $commandeClients
     */
    public function getCommandeClients()
    {
        return $this->commandeClients;
    }
}