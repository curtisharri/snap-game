<?php namespace App\Services;

use App\Services\Base\BaseSnapGameService;

class SnapGameService extends BaseSnapGameService
{
    public function startGame(): SnapGameService
    {
        // Set players and deck
        
        // Split the deck into chunks depending on number of players, and assign chunks to players

        // Draw card from current player

        // Compare it to the card on the top of the table stack

        // If it's the same, call SNAP and add the table stack to the player stack

        // Not not then add it to the top of the table stack

        // Increment the player

        // Check to see if a player stack is the same size as the deck

        return $this;
    }
}