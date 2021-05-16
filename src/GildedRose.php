<?php

namespace Runroom\GildedRose;

class GildedRose {

    private $items;
    private $ab = 'Aged Brie';
    private $bptatc = 'Backstage passes to a TAFKAL80ETC concert';
    private $shor = 'Sulfuras, Hand of Ragnaros';
    private $max_quality = 50;


    function __construct($items) {
        $this->items = $items;
    }

    function update_quality() {
        foreach ($this->items as $item) {
            if ($item->name != $this->ab and $item->name != $this->bptatc) {
                $this->remove_quality($item);
            } else {
                $this->add_quality($item);
            }

            if ($item->name != $this->shor) {
                $item->sell_in--;
            }

            if ($item->sell_in < 0) {
                $this->not_sell_in($item);
            }
        }
    }

    private function remove_quality($item) {
        if ($item->quality) {
            if ($item->name != $this->shor) {
                $item->quality--;
            }
        }
    }

    private function add_quality($item) {
        if ($item->quality < $this->max_quality) {
            $item->quality++;
            if ($item->name == $this->bptatc) {
                if ($item->sell_in < 11) {
                        $item->quality++;
                }
                if ($item->sell_in < 6) {
                        $item->quality++;
                }
            }
        }
    }

    private function not_sell_in($item) {
        if ($item->name != $this->ab) {
            if ($item->name != $this->bptatc) {
                if ($item->quality) {
                    if ($item->name != $this->shor) {
                        $item->quality--;
                    }
                }
            } else {
                $item->quality = $item->quality - $item->quality;
            }
        } else {
            if ($item->quality < $this->max_quality) {
                $item->quality++;
            }
        }
    }
}
