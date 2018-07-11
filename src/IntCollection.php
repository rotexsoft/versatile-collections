<?php
namespace VersatileCollections;

/**
 * Description of IntCollection
 *
 * @author rotimi
 */
class IntCollection extends NumericsCollection {

    public function checkType($item) {
        
        return is_int($item);
    }

    public function getType() {
        
        return 'int';
    }

    protected function itemFromString($str) {
        
        return ((int) ($str.''));
    }

    protected function itemToString($item) {
        
        return $item.'';
    }
}
