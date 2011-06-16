<?php

namespace CSF\CartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * CSF\CartBundle\Entity\MethodeLivraison
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class MethodeLivraison
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
     * @var decimal $frais_expedition
     *
     * @ORM\Column(name="frais_expedition", type="decimal")
     */
    private $fraisExpedition;

    /**
     * @ORM\OneToMany(targetEntity="CommandeClient", mappedBy="methodeLivraison")
     */
    private	$commandeClients;
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
     * Set frais_expedition
     *
     * @param decimal $fraisExpedition
     */
    public function setFraisExpedition($fraisExpedition)
    {
        $this->fraisExpedition = $fraisExpedition;
    }

    /**
     * Get frais_expedition
     *
     * @return decimal $fraisExpedition
     */
    public function getFraisExpedition()
    {
        return $this->fraisExpedition;
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