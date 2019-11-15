<?php

/**
 * Description of TestFloatsCollection
 *
 * @author Rotimi Ade
 */
class TestFloatsCollection extends \VersatileCollections\FloatsCollection {

    public function getItemFromString($str) {
        
        return $this->itemFromString($str);
    }

    public function getItemAsString($item) {
        
        return $this->itemToString($item);
    }
}
