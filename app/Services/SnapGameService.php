<?php namespace App\Services;

use App\Services\Base\BaseSnapGameService;

class SnapGameService extends BaseSnapGameService
{
    public function startGame(): SnapGameService
    {
        $this->splitDeck();

        $gameOver = false;
        while (!$gameOver) {
            // Draw a card from the current players stack
            $card = $this->getCurrentPlayer()->drawCard();

            if ($this->getTableStackSize() === 0) {
                // Table stack is empty, so place this card into it
                $this->addCardToTableStack($card);

            } elseif ($card->getValue() === $this->getTopCard()->getValue()) {
                // This card is the same as the card on top of the table stack. Snap!
                // Add table stack to the current player stack
                dump(sprintf('Snap! %s wins the table stack of %d cards.', $this->getCurrentPlayer()->getName(), $this->getTableStackSize()));

                $this->addTableStackToCurrentPlayer();

            } else {
                // No snap, so add the card to the table stack
                $this->addCardToTableStack($card);
            }

            // Increment the current player
            $this->nextPlayer();

            // Check if anyone has won
            $gameOver = $this->checkForWinner();
        }

        // Set the winner of the game
        $this->setWinner();

        dump(sprintf('%s wins the game with a stack of %d cards', $this->getWinner()->getName(), $this->getWinner()->getStackSize()));

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

    protected function addTableStackToCurrentPlayer(): SnapGameService
    {
        // Add the table stack to the current player's stack
        $this->getCurrentPlayer()->addStackToStack($this->getTableStack());
        // Clear the table stack
        $this->clearTableStack();
        return $this;
    }

    protected function nextPlayer(): SnapGameService
    {
        foreach ($this->getPlayers() as $key => $player) {
            if ($player->getId() === $this->getCurrentPlayer()->getId()) {
                // This player is the current player
                if (isset($this->players[$key + 1])) {
                    // The next array element exists, so make that player the current player
                    $this->setCurrentPlayer($this->players[$key + 1]);
                } else {
                    // There isn't a next array element, so set the current player as the first array element
                    $this->setCurrentPlayer($this->players[0]);
                }
                // We're done here
                break;
            }
        }
        return $this;
    }

    protected function checkForWinner(): bool
    {
        foreach ($this->getPlayers() as $player) {
            if ($player->getStackSize() === 0) {
                // A player has run out of cards, so end the game
                return true;
            }
        }
        return false;
    }
}