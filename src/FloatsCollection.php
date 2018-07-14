<?php
namespace VersatileCollections;

/**
 * Description of FloatsCollection
 *
 * @author rotimi
 */
class FloatsCollection extends NumericsCollection {

    public function checkType($item) {
        
        return is_float($item);
    }

    public function getType() {
        
        return 'float';
    }
    
    protected function itemFromString($str) {
        
        return ((float) ($str.''));
    }

    protected function itemToString($item) {
        
        return $item.'';
    }
}
