<?php namespace App\Models\Decks;

use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\Deck;
use App\Models\Cards\SnapCard;

class SnapDeck extends Model implements Deck
{
    private $deck;
    private $suits = [
        'Clubs',
        'Diamonds',
        'Hearts',
        'Spades'
    ];
    private $values = [
        'Ace',
        2,
        3,
        4,
        5,
        6,
        7,
        8,
        9,
        10,
        'Jack',
        'Queen',
        'King'
    ];

    public function __construct(array $attributes = [])
    {
        $this->createDeck();
        parent::__construct($attributes);
    }
    
    private function createDeck(): Deck
    {
        $cards = [];
        // Create the deck of cards
        foreach($this->suits as $suit) {
            foreach ($this->values as $value) {
                $snapCard = new SnapCard();
                $snapCard->setSuit($suit)
                    ->setValue($value);
                $cards[] = $snapCard;
            }
        }

        // Shuffle the deck so it's good to go
        shuffle($cards);

        $this->setDeckSize(count($cards))
            ->setCards($cards);
        return $this;
    }

    /**
     * @return SnapCard[]
     */
    public function getCards()
    {
        // Returns an array of SnapCards
        return $this->cards;
    }

    private function setCards(array $cards): Deck
    {
        $this->cards = $cards;
        return $this;
    }
}