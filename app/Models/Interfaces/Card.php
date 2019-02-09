<?php namespace App\Models\Interfaces;

interface Card
{
    public function getCard(): Card;
    public function getSuit();
    public function getValue();
}