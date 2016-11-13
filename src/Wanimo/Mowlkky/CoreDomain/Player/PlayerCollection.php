<?php

namespace Wanimo\Mowlkky\CoreDomain\Player;

use Wanimo\Mowlkky\CoreDomain\Collection\ArrayCollection;

class PlayerCollection extends ArrayCollection
{
    /**
     * Check if a new element added to the collection is of the right type.
     *
     * @param mixed $element
     * @return bool
     */
    protected function checkNewElementType($element): bool
    {
        return $element instanceof Player;
    }

    /**
     * @param Player $player
     * @return PlayerCollection
     */
    public function add(Player $player): PlayerCollection
    {
        $this->elements[] = $player;

        return $this;
    }
}
