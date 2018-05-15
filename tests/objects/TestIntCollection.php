<?php

/**
 * Description of TestIntCollection
 *
 * @author aadegbam
 */
class TestIntCollection extends \VersatileCollections\IntCollection {

    public function getItemFromString($str) {
        
        return $this->itemFromString($str);
    }

    public function getItemAsString($item) {
        
        return $this->itemToString($item);
    }
}
