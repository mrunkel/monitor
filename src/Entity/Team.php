<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 * @ORM\Table(name="`team`")
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $billingContact;

    /**
     * @ORM\OneToMany(targetEntity=PaymentMethod::class, mappedBy="owner", orphanRemoval=true)
     */
    private $paymentMethods;

    /**
     * @ORM\OneToOne(targetEntity=PaymentMethod::class, cascade={"persist", "remove"})
     */
    private $primaryPaymentMethod;

    /**
     * @ORM\OneToOne(targetEntity=PaymentMethod::class, cascade={"persist", "remove"})
     */
    private $backupPaymentMethod;

    /**
     * @ORM\OneToOne(targetEntity=Memberships::class, mappedBy="teams", cascade={"persist", "remove"})
     */
    private $memberships;

    /**
     * @ORM\OneToMany(targetEntity=Host::class, mappedBy="team", orphanRemoval=true)
     */
    private $hosts;

    /**
     * @ORM\OneToMany(targetEntity=AlertChannel::class, mappedBy="team", orphanRemoval=true)
     */
    private $alertChannels;

    public function __construct()
    {
        $this->paymentMethods = new ArrayCollection();
        $this->hosts          = new ArrayCollection();
        $this->alertChannels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBillingContact(): ?string
    {
        return $this->billingContact;
    }

    public function setBillingContact(?string $billingContact): self
    {
        $this->billingContact = $billingContact;

        return $this;
    }

    /**
     * @return Collection|PaymentMethod[]
     */
    public function getPaymentMethods(): Collection
    {
        return $this->paymentMethods;
    }

    public function addPaymentMethod(PaymentMethod $paymentMethod): self
    {
        if (!$this->paymentMethods->contains($paymentMethod)) {
            $this->paymentMethods[] = $paymentMethod;
            $paymentMethod->setOwner($this);
        }

        return $this;
    }

    public function removePaymentMethod(PaymentMethod $paymentMethod): self
    {
        if ($this->paymentMethods->removeElement($paymentMethod)) {
            // set the owning side to null (unless already changed)
            if ($paymentMethod->getOwner() === $this) {
                $paymentMethod->setOwner(null);
            }
        }

        return $this;
    }

    public function getPrimaryPaymentMethod(): ?PaymentMethod
    {
        return $this->primaryPaymentMethod;
    }

    public function setPrimaryPaymentMethod(?PaymentMethod $primaryPaymentMethod): self
    {
        $this->primaryPaymentMethod = $primaryPaymentMethod;

        return $this;
    }

    public function getBackupPaymentMethod(): ?PaymentMethod
    {
        return $this->backupPaymentMethod;
    }

    public function setBackupPaymentMethod(?PaymentMethod $backupPaymentMethod): self
    {
        $this->backupPaymentMethod = $backupPaymentMethod;

        return $this;
    }

    public function getMemberships(): ?Memberships
    {
        return $this->memberships;
    }

    public function setMemberships(Memberships $memberships): self
    {
        // set the owning side of the relation if necessary
        if ($memberships->getTeams() !== $this) {
            $memberships->setTeams($this);
        }

        $this->memberships = $memberships;

        return $this;
    }

    /**
     * @return Collection|Host[]
     */
    public function getHosts(): Collection
    {
        return $this->hosts;
    }

    public function addHost(Host $host): self
    {
        if (!$this->hosts->contains($host)) {
            $this->hosts[] = $host;
            $host->setTeam($this);
        }

        return $this;
    }

    public function removeHost(Host $host): self
    {
        if ($this->hosts->removeElement($host)) {
            // set the owning side to null (unless already changed)
            if ($host->getTeam() === $this) {
                $host->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AlertChannel[]
     */
    public function getAlertChannels(): Collection
    {
        return $this->alertChannels;
    }

    public function addAlertChannel(AlertChannel $alertChannel): self
    {
        if (!$this->alertChannels->contains($alertChannel)) {
            $this->alertChannels[] = $alertChannel;
            $alertChannel->setTeam($this);
        }

        return $this;
    }

    public function removeAlertChannel(AlertChannel $alertChannel): self
    {
        if ($this->alertChannels->removeElement($alertChannel)) {
            // set the owning side to null (unless already changed)
            if ($alertChannel->getTeam() === $this) {
                $alertChannel->setTeam(null);
            }
        }

        return $this;
    }
}
