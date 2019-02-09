<?php namespace App\Services;

use App\Services\Base\BaseSnapGameService;

class SnapGameService extends BaseSnapGameService
{
    public function startGame(): SnapGameService
    {
        $this->splitDeck();

        // Draw card from current player

        // Compare it to the card on the top of the table stack

        // If it's the same, call SNAP and add the table stack to the player stack
            // Clear the table stack

        // Not not then add it to the top of the table stack

        // Increment the player

        // Check to see if a player stack is the same size as the deck
            // Set winner if so

        return $this;
    }

    protected function splitDeck(): SnapGameService
    {
        // Get the stacks from the deck using the total number of players
        $stacks = $this->getDeck()->splitDeck($this->getTotalPlayers());

        // Assign each stack to a player
        foreach ($this->getPlayers() as $key => $player) {
            $player->setStack($stacks[$key]);
        }
        return $this;
    }
}