<?php namespace App\Services\Base;

use App\Models\Decks\SnapDeck;
use App\Models\Cards\SnapCard;
use App\Models\Players\SnapPlayer;

class BaseSnapGameService
{
    protected $deck;
    protected $tableStack = [];
    protected $players = [];
    protected $totalPlayers = 2;
    protected $currentPlayer;
    protected $winner;

    public function __construct()
    {
        $this->setDeck();
    }

    public function getDeck(): SnapDeck
    {
        return $this->deck;
    }

    protected function setDeck(): BaseSnapGameService
    {
        $this->deck = new SnapDeck;
        return $this;
    }

    /**
     * @return SnapCard[]
     */
    protected function getTableStack()
    {
        return $this->tableStack;
    }

    protected function getTopCard(): SnapCard
    {
        // Get the card at the top of the table stack
        return $this->tableStack[0];
    }

    protected function addCardToTableStack(SnapCard $card): BaseSnapGameService
    {
        // Add the card to the 'top' of the table stack
        array_unshift($this->tableStack, $card);
        return $this;
    }

    protected function clearTableStack()
    {
        $this->tableStack = [];
    }

    /**
     * @return SnapPlayer[]
     */
    public function getPlayers()
    {
        return $this->players;
    }

    protected function getTotalPlayers(): int
    {
        return $this->totalPlayers;
    }

    public function setPlayers($total = 2): BaseSnapGameService
    {
        // Set our total players so we can send that through to the deck
        $this->totalPlayers = $total;

        $players = [];
        for ($i = 1; $i <= $total; $i++) {
            $player = new SnapPlayer;
            $player->setId($i)
                ->setName(sprintf('Player %d', $i));

            $players[] = $player;
        }
        $this->players = $players;

        // Set our first player so we're ready to go
        $this->setCurrentPlayer($players[0]);

        return $this;
    }

    protected function setCurrentPlayer(SnapPlayer $player): BaseSnapGameService
    {
        $this->currentPlayer = $player;
        return $this;
    }

    protected function getCurrentPlayer(): SnapPlayer
    {
        return $this->currentPlayer;
    }

    public function getWinner(): ?SnapPlayer
    {
        return $this->winner;
    }

    public function setWinner(SnapPlayer $player): BaseSnapGameService
    {
        $this->winner = $player;
        return $this;
    }
}