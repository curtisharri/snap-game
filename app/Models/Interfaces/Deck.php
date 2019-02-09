<?php namespace App\Models\Interfaces;

interface Deck
{
    /**
     * @return Card[]
     */
    public function getCards();
}