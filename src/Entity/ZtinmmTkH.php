<?php

namespace App\Entity;

use App\Repository\ZtinmmTkHRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ZtinmmTkHRepository::class)]
class ZtinmmTkH
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $konkurs_id = null;

    #[ORM\Column(length: 40)]
    private ?string $konkurs_nr = null;

    #[ORM\Column(length: 255)]
    private ?string $konkurs_name = null;

    #[ORM\OneToMany(mappedBy: 'konkurs_idd', targetEntity: ZinmmSofLotH::class)]
    private Collection $zinmmSofLotHs;

    #[ORM\ManyToOne(inversedBy: 'ztinmmTkHsid')]
    private ?T001 $BukrsID = null;

    public function __construct()
    {
        $this->zinmmSofLotHs = new ArrayCollection();
    }

    public function getKonkursId(): ?int
    {
        return $this->konkurs_id;
    }

    public function getKonkursNr(): ?string
    {
        return $this->konkurs_nr;
    }

    public function setKonkursNr(string $konkurs_nr): self
    {
        $this->konkurs_nr = $konkurs_nr;

        return $this;
    }

    public function getKonkursName(): ?string
    {
        return $this->konkurs_name;
    }

    public function setKonkursName(string $konkurs_name): self
    {
        $this->konkurs_name = $konkurs_name;

        return $this;
    }

    /**
     * @return Collection<int, ZinmmSofLotH>
     */
    public function getZinmmSofLotHs(): Collection
    {
        return $this->zinmmSofLotHs;
    }

    public function addZinmmSofLotH(ZinmmSofLotH $zinmmSofLotH): self
    {
        if (!$this->zinmmSofLotHs->contains($zinmmSofLotH)) {
            $this->zinmmSofLotHs->add($zinmmSofLotH);
            $zinmmSofLotH->setKonkursIdd($this);
        }

        return $this;
    }

    public function removeZinmmSofLotH(ZinmmSofLotH $zinmmSofLotH): self
    {
        if ($this->zinmmSofLotHs->removeElement($zinmmSofLotH)) {
            // set the owning side to null (unless already changed)
            if ($zinmmSofLotH->getKonkursIdd() === $this) {
                $zinmmSofLotH->setKonkursIdd(null);
            }
        }

        return $this;
    }

    public function getBukrsID(): ?T001
    {
        return $this->BukrsID;
    }

    public function setBukrsID(?T001 $BukrsID): self
    {
        $this->BukrsID = $BukrsID;

        return $this;
    }



}
