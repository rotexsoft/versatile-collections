<?php

/**
 * Description of TestNumericsCollection
 *
 * @author aadegbam
 */
class TestNumericsCollection extends \VersatileCollections\NumericsCollection {

    public function getItemFromString($str) {
        
        return $this->itemFromString($str);
    }

    public function getItemAsString($item) {
        
        return $this->itemToString($item);
    }
}
