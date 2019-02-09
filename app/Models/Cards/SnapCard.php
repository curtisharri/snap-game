<?php namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\Card;

class SnapCard extends Model implements Card
{
    private $suit;
    private $value;

    public function getCard(): SnapCard
    {
        return $this;
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function setSuit($suit): SnapCard
    {
        $this->suit = $suit;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value): SnapCard
    {
        $this->value = $value;
        return $this;
    }
}