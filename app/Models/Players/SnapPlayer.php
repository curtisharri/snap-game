<?php namespace App\Models\Players;

use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\Player;
use App\Models\Cards\SnapCard;

class SnapPlayer extends Model implements Player
{
    protected $id;
    protected $name;
    protected $stack;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): SnapPlayer
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): SnapPlayer
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return SnapCard[]
     */
    public function getStack()
    {
        return $this->stack;
    }

    public function setStack(array $stack): SnapPlayer
    {
        $this->stack = $stack;
        return $this;
    }

    public function getStackSize(): int
    {
        return count($this->getStack());
    }

    public function addCardToStack(SnapCard $card): SnapPlayer
    {
        $this->stack[] = $card;
        return $this;
    }

    public function addStackToStack(array $stack): SnapPlayer
    {
        foreach ($stack as $card) {
            $this->addCardToStack($card);
        }
        return $this;
    }

    public function drawCard(): SnapCard
    {
        return array_shift($this->stack);
    }
}