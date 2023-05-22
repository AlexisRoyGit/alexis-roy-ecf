<?php
//Classe répresentant la table "clients" en base de données

class Clients 
{
    private string $id_client;
    private string $email_client;
    private string $password_client;
    private int $number_guests;
    private string $allergies;

    public function getIdClient(): string
    {
        return $this->id_client;
    }

    public function getEmailClient(): string
    {
        return $this->email_client;
    }

    public function getPasswordClient(): string 
    {
        return $this->password_client;
    }

    public function getNumberGuests(): int 
    {
        return $this->number_guests;
    }

    public function getAllergies(): string 
    {
        return $this->allergies;
    }
}