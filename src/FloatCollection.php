<?php
namespace VersatileCollections;

/**
 * Description of FloatCollection
 *
 * @author rotimi
 */
class FloatCollection extends NumericsCollection {

    protected function checkType($item) {
        
        return is_float($item);
    }

    protected function getType() {
        
        return 'float';
    }
    

    protected function itemFromString($str) {
        
        return ((float) ($str.''));
    }

    protected function itemToString($item) {
        
        return $item.'';
    }
}
