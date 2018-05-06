<?php

namespace VersatileCollections;

/**
 * Description of NumericsCollection
 *
 * @author rotimi
 */
class NumericsCollection extends ScalarCollection {

    protected function checkType($item) {
        
        return is_float($item) || is_int($item);
    }

    protected function getType() {
        
        return 'numeric';
    }
    
    /**
     * 
     * Sum of all the numbers in this collection
     * 
     * @return float|int 
     */
    public function sum() {
        
        return array_sum($this->collection_items);
    }
    
    public function average() {
        
        return ($this->count() > 0) ? ($this->sum() / $this->count()) : NULL;
    }
    
    public function max() {
        
        return ($this->count() > 0) ? max($this->collection_items) : NULL;
    }
    
    public function min() {
        
        return ($this->count() > 0) ? min($this->collection_items) : NULL;
    }
}
