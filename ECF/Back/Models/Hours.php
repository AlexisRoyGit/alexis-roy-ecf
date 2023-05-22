<?php
//Classe répresentant la table "hours" en base de données

class Hours 
{
    private string $day;
    private ?string $hoursNoon;
    private ?string $hoursEvening;
    private bool $isClosed;

    public function getHoursDay(): string 
    {
        return $this->day;
    }

    public function getHoursNoon(): ?string 
    {
        return $this->hoursNoon;
    }

    public function getHoursEvening(): ?string 
    {
        return $this->hoursEvening;
    }

    public function getIsClosed(): bool
    {
        return $this->isClosed;
    }
}