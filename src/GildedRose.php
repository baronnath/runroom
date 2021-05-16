<?php

namespace Runroom\GildedRose;

class GildedRose {

    private array $items;
    private string $ab = 'Aged Brie';
    private string $bptatc = 'Backstage passes to a TAFKAL80ETC concert';
    private string $shor = 'Sulfuras, Hand of Ragnaros';
    private int $max_quality = 50;

    /**
     * @param array<int, Item> $items
     */
    function __construct(array $items) {
        $this->items = $items;
    }

    /**
    * @return boolean
    */
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
        return true;
    }

    /**
    * @param Item $item
    * @return boolean
    */
    private function remove_quality(Item $item) {
        if ($item->quality && $item->name != $this->shor) {
            if ($item->name != $this->shor) {
                $item->quality--;
            }
        }
        return true;
    }

    /**
    * @param Item $item
    * @return boolean
    */
    private function add_quality(Item $item) {
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
        return true;
    }

    /**
    * @param Item $item
    * @return boolean
    */
    private function not_sell_in(Item $item) {
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
        return true;
    }
}
