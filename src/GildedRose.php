<?php

namespace Runroom\GildedRose;

class GildedRose {

    private $items;
    private $ab = 'Aged Brie';
    private $bptatc = 'Backstage passes to a TAFKAL80ETC concert';
    private $shor = 'Sulfuras, Hand of Ragnaros';


    function __construct($items) {
        $this->items = $items;
    }

    function update_quality() {
        foreach ($this->items as $item) {
            if ($item->name != $this->ab and $item->name != $this->bptatc) {
                if ($item->quality > 0) {
                    if ($item->name != $this->shor) {
                        $item->quality = $item->quality - 1;
                    }
                }
            } else {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                    if ($item->name == $this->bptatc) {
                        if ($item->sell_in < 11) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ($item->sell_in < 6) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }

            if ($item->name != $this->shor) {
                $item->sell_in = $item->sell_in - 1;
            }

            if ($item->sell_in < 0) {
                if ($item->name != 'Aged Brie') {
                    if ($item->name != $this->bptatc) {
                        if ($item->quality > 0) {
                            if ($item->name != $this->shor) {
                                $item->quality = $item->quality - 1;
                            }
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }
}
