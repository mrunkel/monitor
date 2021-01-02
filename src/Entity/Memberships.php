<?php

namespace App\Entity;

use App\Repository\MembershipsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MembershipsRepository::class)
 */
class Memberships
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="memberships", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $member;

    /**
     * @ORM\OneToOne(targetEntity=Team::class, inversedBy="memberships", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $teams;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Level;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMember(): ?User
    {
        return $this->member;
    }

    public function setMember(User $member): self
    {
        $this->member = $member;

        return $this;
    }

    public function getTeams(): ?Team
    {
        return $this->teams;
    }

    public function setTeams(Team $teams): self
    {
        $this->teams = $teams;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->Level;
    }

    public function setLevel(string $Level): self
    {
        $this->Level = $Level;

        return $this;
    }
}
