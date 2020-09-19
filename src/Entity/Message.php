<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Many Message have one user. This is the owning side.
     * @ORM\ManyToOne(targetEntity=User::Class, inversedBy="Message", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="sender_id", referencedColumnName="id")
     */
    private $sender;
    
    /**
     * Many Message have one user. This is the owning side.
     * @ORM\ManyToOne(targetEntity=User::Class, inversedBy="Message", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="received_id", referencedColumnName="id")
     */
    private $received;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $body;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $date_sent;
    
    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $archived;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $date_archived;

/*        
    public function __construct()
    {
        $this->$sender = new ArrayCollection();
        $this->received = new ArrayCollection();
    }
*/ 
    /**
     * 
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * 
     * @return type
     */
    public function getSender()
    {
        return $this->sender;
    }
    /**
     * 
     * @param type $sender
     * @return $this
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
        return $this;
    }
    /**
     * 
     * @return type
     */
    public function getReceived()
    {
        return $this->received;
    }
    /**
     * 
     * @param type $received
     * @return $this
     */
    public function setReceived($received)
    {
        $this->received = $received;
        return $this;
    }
    
    public function getBody()
    {
        return $this->body;
    }
    
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }
    /**
     * 
     * @return type
     */
    public function getDateSent()
    {
        return $this->date_sent;
    }
    /**
     * 
     * @param type $dateSent
     * @return $this
     */
    public function setDateSent($dateSent)
    {
        $this->date_sent = new \DateTime();;
        return $this;
    }
    /**
     * 
     * @return type
     */
    public function getArchieved()
    {
        return $this->archived;
        
    }
    /**
     * 
     * @param type $archieved
     * @return $this
     */
    public function setArchived($archieved)
    {
        $this->archived = $archieved;
        return $this;
    }
    /**
     * 
     * @return type
     */
    public function getDateArchieved()
    {
        return $this->date_archived;
    }
    /**
     * 
     * @param type $dateArchieved
     * @return $this
     */
    public function setDateArchieved($dateArchieved)
    {
        $this->date_archived = $dateArchieved;
        return $this;
    }
}
