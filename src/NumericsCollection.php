<?php
namespace VersatileCollections;

/**
 * Description of NumericsCollection
 *
 * @author rotimi
 */
class NumericsCollection extends ScalarCollection {
    
    /**
     * 
     * @return int|float|null average all of the values in the collection or null if collection is empty
     * 
     */
    public function average() {
        
        return ($this->count() > 0) ? ($this->sum() / $this->count()) : null;
    }
    
    /**
     * 
     * This method should be overridden in sub-classes of this class
     * 
     * @param mixed $item
     * @return bool
     * 
     */
    public function checkType($item) {
        
        return is_float($item) || is_int($item);
    }

    /**
     * 
     * This method should be overridden in sub-classes of this class
     * 
     * @return string
     * 
     */
    public function getType() {
        
        return 'numeric';
    }
    
    /**
     * 
     * This method should be overridden in sub-classes of this class 
     * 
     * @param string $str a string representation of an item in this collection
     * 
     * @return mixed an item in this collection that was just created from its string representation
     * 
     */
    protected function itemFromString($str) {
        
        if( strpos($str, '.') !== false ) {
            
            return ( (float) ($str.'') );
        }
        
        return ( (int) ($str.'') );
    }
    
    /**
     * 
     * This method should be overridden in sub-classes of this class 
     * 
     * @param mixed $item an item in this collection
     * 
     * @return string representation of an item in this collection
     * 
     */
    protected function itemToString($item) {
        
        return $item.'';
    }
    
    /**
     * 
     * @return int|float|null maximum of the values in the collection or null if collection is empty
     * 
     */
    public function max() {
        
        return ($this->count() > 0) ? max($this->versatile_collections_items) : null;
    }
    
    /**
     * 
     * @return int|float|null median of the values in the collection or null if collection is empty
     * 
     */
    public function median()
    {
        $count = $this->count();

        if ( $count === 0) {
            
            return null;
        }

        $values = $this->versatile_collections_items;
        
        sort($values, SORT_NUMERIC);
        $middle = (int) ($count / 2);

        if ( $count % 2 === 1) {
            
            return $values[$middle];
        }

        return (($values[$middle - 1] + $values[$middle]) / 2);
    }
    
    /**
     * 
     * @return int|float|null minimum of the values in the collection or null if collection is empty
     * 
     */
    public function min() {
        
        return ($this->count() > 0) ? min($this->versatile_collections_items) : null;
    }
    
    /**
     * 
     * @return array|null an array of modal values in the collection. 
     *                    Returned array will have modal items in the same
     *                    order as in the collection.
     *                    Null is returned if the collection is empty.
     *                  
     *                    Modal Items in the the collection that are floats like
     *                    `5.0`, `7.0` (i.e point zero) will be returned without
     *                    `.0`, in essence they are returned in integer format.
     * 
     */
    public function mode() {
        
        $counts = [];
        $count = $this->count();

        if ($count === 0) { return null; }

        foreach ( $this->versatile_collections_items as $item ) {
            
            if( !is_int($item) ) {
                
                // string concatenation for non-ints which are not 
                // valid as keys to a php array 
                $item = $this->itemToString($item);
            }
            
            $counts[$item] = array_key_exists($item, $counts) ? ++$counts[$item] : 1;
        }

        $highest_count = max($counts);
        $modal_values = [];

        // get all items with counts === $highest_count
        // they are the modal items we are looking for.
        foreach( $counts as $item => $item_count ) {
            
            if( $item_count === $highest_count ) {
                
                // if is_string($item) then, it was
                // originally a float that was cast
                // to a string because array keys in
                // php can only be ints or strings.
                $modal_values[] = 
                    is_string($item) ? $this->itemFromString($item) : $item;
            }
        }

        return $modal_values;
    }
    
    public function product() {
        
        return array_product($this->versatile_collections_items);
    }

        /**
     * 
     * Sum of all the values in this collection
     * 
     * @return float|int sum of all the values in this collection or zero if the collection is empty
     * 
     */
    public function sum() {
        
        return array_sum($this->versatile_collections_items);
    }
}
