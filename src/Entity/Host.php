<?php

namespace App\Entity;

use App\Repository\HostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HostRepository::class)
 */
class Host
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Test::class, mappedBy="host", orphanRemoval=true)
     */
    private $tests;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="ip", nullable=true)
     */
    private $ipv4;

    /**
     * @ORM\Column(type="ip", nullable=true)
     */
    private $ipv6;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="hosts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    public function __construct()
    {
        $this->tests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Test[]
     */
    public function getTests(): Collection
    {
        return $this->tests;
    }

    public function addTest(Test $test): self
    {
        if (!$this->tests->contains($test)) {
            $this->tests[] = $test;
            $test->setHost($this);
        }

        return $this;
    }

    public function removeTest(Test $test): self
    {
        if ($this->tests->removeElement($test)) {
            // set the owning side to null (unless already changed)
            if ($test->getHost() === $this) {
                $test->setHost(null);
            }
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIpv4()
    {
        return $this->ipv4;
    }

    public function setIpv4($ipv4): self
    {
        $this->ipv4 = $ipv4;

        return $this;
    }

    public function getIpv6()
    {
        return $this->ipv6;
    }

    public function setIpv6($ipv6): self
    {
        $this->ipv6 = $ipv6;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }
}
