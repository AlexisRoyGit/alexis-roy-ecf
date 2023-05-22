<?php
//Classe répresentant la table "images_courses" en base de données

class Images_courses 
{
    private string $title;
    private string $name;

    public function getImageTitle(): string 
    {
        return $this->title;
    }

    public function getImageName(): string 
    {
        return $this->name;
    }
}