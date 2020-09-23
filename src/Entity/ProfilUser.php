<?php

namespace App\Entity;

use App\Repository\ProfilUserRepository;
use JMS\Serializer\Annotation as JMS;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfilUserRepository::class)
 */
class ProfilUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @JMS\Groups(groups={"user_profil"})
     * @ORM\Column(type="string", length=100)
     */
    private $firstName;
    
    /**
     * @JMS\Groups(groups={"user_profil"})
     * @ORM\Column(type="string", length=100)
     */
    private $lastName;
    
    /**
     * @JMS\Groups(groups={"user_profil"})
     * @ORM\Column(type="datetime")
     */
    private $ddn;

    /**
     * @JMS\Groups(groups={"user_profil"})
     * @ORM\Column(type="integer")
     */
    private $phoneNumber;
  
    /**
     * @JMS\Groups(groups={"user_profil"})
     * @ORM\Column(type="float")
     */
    private $height;
   
    /**
     * @JMS\Groups(groups={"user_profil"})
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="profil")
     *
     */
    private $user;


    /**
     * @JMS\Groups(groups={"user_profil"})
     * @ORM\OneToOne(targetEntity=Address::class, cascade={"persist","remove"})
     */
    protected $address;

    public function getId(): ?int
    {
        return $this->id;
    }
        
    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    /**
     * @param string $firstName
     * @return string
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    
    /**
     * @param string $lastName
     * @return string
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDdn()
    {
        return $this->ddn;
    }

    /**
     * @param mixed $ddn
     * @return ProfilUser
     */
    public function setDdn($ddn)
    {
        $this->ddn = $ddn;
        return $this;
    }
    
    /**
     * @return int
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    
    /**
     * @param int $phoneNumber
     * @return int
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }
    
    /**
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }
    
    /**
     * @param float $height
     * @return ProfilUser 
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }
    
    /**
     * @param float $weight
     * @return ProfilUser
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     * @return ProfilUser
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }
    
    
}
