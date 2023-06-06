<?php

namespace App\Model;

class KonkursItem
{
    private int $konkurs_id;

    private string $konkurs_nr;

    private string $konkurs_name;

    public function __construct(int $konkurs_id, string $konkurs_nr, string $konkurs_name)
    {
        $this->konkurs_id = $konkurs_id;
        $this->konkurs_nr = $konkurs_nr;
        $this->konkurs_name = $konkurs_name;
    }

    public function getKonkursId(): int
    {
        return $this->konkurs_id;
    }

    public function getKonkursNr(): string
    {
        return $this->konkurs_nr;
    }

    public function getKonkursName(): string
    {
        return $this->konkurs_name;
    }

}