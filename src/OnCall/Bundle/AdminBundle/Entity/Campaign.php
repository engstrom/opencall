<?php

namespace OnCall\Bundle\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use OnCall\Bundle\AdminBundle\Model\ItemStatus;

/**
 * @ORM\Entity
 */
class Campaign extends Item
{
    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="campaigns")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    protected $client;

    /**
     * @ORM\Column(type="integer")
     */
    protected $client_id;

    /**
     * @ORM\OneToMany(targetEntity="AdGroup", mappedBy="campaign")
     */
    protected $adgroups;

    // begin setters
    public function setClient(Client $client)
    {
        $this->client = $client;
        $this->client_id = $client->getID();
        return $this;
    }

    public function setParent(Client $client)
    {
        return $this->setClient($client);
    }

    public function setInactive()
    {
        // TODO: set children inactive as well
        $this->setStatus(ItemStatus::INACTIVE);
        return $this;
    }
    // end setters

    // begin getters
    public function getClient()
    {
        return $this->client;
    }

    public function getAdGroups()
    {
        return $this->adgroups;
    }

    public function getUser()
    {
        return $this->getClient()->getUser();
    }

    public function getParent()
    {
        return $this->getClient();
    }
    // end getters
}
