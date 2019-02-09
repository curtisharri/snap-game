<?php namespace App\Models;

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
}