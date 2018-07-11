<?php
namespace VersatileCollections;

/**
 * Description of FloatCollection
 *
 * @author rotimi
 */
class FloatCollection extends NumericsCollection {

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
