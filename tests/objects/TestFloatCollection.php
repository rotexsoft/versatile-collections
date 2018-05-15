<?php

/**
 * Description of TestFloatCollection
 *
 * @author aadegbam
 */
class TestFloatCollection extends \VersatileCollections\FloatCollection {

    public function getItemFromString($str) {
        
        return $this->itemFromString($str);
    }

    public function getItemAsString($item) {
        
        return $this->itemToString($item);
    }
}
