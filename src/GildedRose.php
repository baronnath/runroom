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
                        $item->quality--;
                    }
                }
            } else {
                if ($item->quality < 50) {
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

            if ($item->name != $this->shor) {
                $item->sell_in--;
            }

            if ($item->sell_in < 0) {
                if ($item->name != $this->ab) {
                    if ($item->name != $this->bptatc) {
                        if ($item->quality > 0) {
                            if ($item->name != $this->shor) {
                                $item->quality--;
                            }
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality++;
                    }
                }
            }
        }
    }

    private function quality_check($item) {
        
    } 
}
