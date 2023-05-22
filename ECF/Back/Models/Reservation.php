<?php
//Classe répresentant la table "reservation" en base de données

class Reservation 
{
    private string $id_reservation;
    private string $date;
    private string $hour;
    private int $guests;
    private string $allergies;
    private ?int $limit_capacity;

    public function getIdReservation(): string 
    {
        return $this->id_reservation;
    }

    public function getDateReservation(): string 
    {
        return $this->date;
    }

    public function getHourReservation(): string 
    {
        return $this->hour;
    }

    public function getGuestsReservation(): int 
    {
        return $this->guests;
    }

    public function getAllergiesReservation(): string 
    {
        return $this->allergies;
    }

    public function getLimitReservation(): ?int 
    {
        return $this->limit_capacity;
    }
}