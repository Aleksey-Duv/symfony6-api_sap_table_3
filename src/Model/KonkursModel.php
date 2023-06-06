<?php

namespace App\Model;

class KonkursModel
{
    private array $items;

    /**
     * @param KonkursItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return KonkursItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

}