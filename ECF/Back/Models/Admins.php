<?php
//Classe répresentant la table "admins" en base de données 


class Admins 
{
    private string $id_admin;
    private string $email_admin;
    private string $password_admin;

    public function getIdAdmin(): string 
    {
        return $this->id_admin;
    }

    public function getEmailAdmin(): string 
    {
        return $this->email_admin;
    }

    public function getPasswordAdmin(): string 
    {
        return $this->password_admin;
    }
}