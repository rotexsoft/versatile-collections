<?php
namespace VersatileCollections;

/**
 * Description of IntsCollection
 *
 * @author rotimi
 */
class IntsCollection extends NumericsCollection {

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
