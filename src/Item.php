<?php

namespace Runroom\GildedRose;

class Item {

    public string $name;
    public int $sell_in;
    public int $quality;

    /**
    * @param string $name
    * @param integer $sell_in
    * @param integer $quality
    */
    function __construct($name, $sell_in, $quality) {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString() {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

}
