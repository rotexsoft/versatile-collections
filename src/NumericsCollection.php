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
        
        return ($this->count() > 0) ? ($this->sum() / $this->count()) : null;
    }
    
    public function max() {
        
        return ($this->count() > 0) ? max($this->collection_items) : null;
    }
    
    public function min() {
        
        return ($this->count() > 0) ? min($this->collection_items) : null;
    }
    
    public function median()
    {
        $count = $this->count();

        if ( $count === 0) {
            
            return null;
        }

        $values = $this->collection_items;
        
        sort($values, SORT_NUMERIC);

        $middle = (int) ($count / 2);

        if ( $count % 2 === 1) {
            
            return $values[$middle];
        }

        return (($values[$middle - 1] + $values[$middle]) / 2);
    }
}
