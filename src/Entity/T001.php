<?php

namespace App\Entity;

use App\Repository\T001Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: T001Repository::class)]
class T001
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 4)]
    private ?string $bukrs = null;

    #[ORM\Column(length: 255)]
    private ?string $butxt = null;

    #[ORM\OneToMany(mappedBy: 'BukrsID', targetEntity: ZtinmmTkH::class)]
    private Collection $ztinmmTkHsid;

    public function __construct()
    {
        $this->ztinmmTkHsid = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBukrs(): ?string
    {
        return $this->bukrs;
    }

    public function setBukrs(string $bukrs): self
    {
        $this->bukrs = $bukrs;

        return $this;
    }

    public function getButxt(): ?string
    {
        return $this->butxt;
    }

    public function setButxt(string $butxt): self
    {
        $this->butxt = $butxt;

        return $this;
    }

    /**
     * @return Collection<int, ZtinmmTkH>
     */
    public function getZtinmmTkHsid(): Collection
    {
        return $this->ztinmmTkHsid;
    }

    public function addZtinmmTkHsid(ZtinmmTkH $ztinmmTkHsid): self
    {
        if (!$this->ztinmmTkHsid->contains($ztinmmTkHsid)) {
            $this->ztinmmTkHsid->add($ztinmmTkHsid);
            $ztinmmTkHsid->setBukrsID($this);
        }

        return $this;
    }

    public function removeZtinmmTkHsid(ZtinmmTkH $ztinmmTkHsid): self
    {
        if ($this->ztinmmTkHsid->removeElement($ztinmmTkHsid)) {
            // set the owning side to null (unless already changed)
            if ($ztinmmTkHsid->getBukrsID() === $this) {
                $ztinmmTkHsid->setBukrsID(null);
            }
        }

        return $this;
    }
}
