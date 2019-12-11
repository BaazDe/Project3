<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfilClubRepository")
 */
class ProfilClub
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameClub;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cityClub;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logoClub;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionClub;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Sport", inversedBy="profilClubs")
     */
    private $sport;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\GeneralChatClub", mappedBy="profilClub", cascade={"persist", "remove"})
     */
    private $generalChatClub;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\PrivateChatClub", mappedBy="profilClub", cascade={"persist", "remove"})
     */
    private $privateChatClub;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="profilClub")
     */
    private $users;

    public function __construct()
    {
        $this->sport = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameClub(): ?string
    {
        return $this->nameClub;
    }

    public function setNameClub(string $nameClub): self
    {
        $this->nameClub = $nameClub;

        return $this;
    }

    public function getCityClub(): ?string
    {
        return $this->cityClub;
    }

    public function setCityClub(string $cityClub): self
    {
        $this->cityClub = $cityClub;

        return $this;
    }

    public function getLogoClub(): ?string
    {
        return $this->logoClub;
    }

    public function setLogoClub(string $logoClub): self
    {
        $this->logoClub = $logoClub;

        return $this;
    }

    public function getDescriptionClub(): ?string
    {
        return $this->descriptionClub;
    }

    public function setDescriptionClub(?string $descriptionClub): self
    {
        $this->descriptionClub = $descriptionClub;

        return $this;
    }

    /**
     * @return Collection|Sport[]
     */
    public function getSport(): Collection
    {
        return $this->sport;
    }

    public function addSport(Sport $sport): self
    {
        if (!$this->sport->contains($sport)) {
            $this->sport[] = $sport;
        }

        return $this;
    }

    public function removeSport(Sport $sport): self
    {
        if ($this->sport->contains($sport)) {
            $this->sport->removeElement($sport);
        }

        return $this;
    }

    public function getGeneralChatClub(): ?GeneralChatClub
    {
        return $this->generalChatClub;
    }

    public function setGeneralChatClub(GeneralChatClub $generalChatClub): self
    {
        $this->generalChatClub = $generalChatClub;

        // set the owning side of the relation if necessary
        if ($generalChatClub->getProfilClub() !== $this) {
            $generalChatClub->setProfilClub($this);
        }

        return $this;
    }

    public function getPrivateChatClub(): ?PrivateChatClub
    {
        return $this->privateChatClub;
    }

    public function setPrivateChatClub(PrivateChatClub $privateChatClub): self
    {
        $this->privateChatClub = $privateChatClub;

        // set the owning side of the relation if necessary
        if ($privateChatClub->getProfilClub() !== $this) {
            $privateChatClub->setProfilClub($this);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addProfilClub($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeProfilClub($this);
        }

        return $this;
    }
}
