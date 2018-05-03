<?php
namespace VersatileCollections;

abstract class BaseCollection implements \ArrayAccess, \Countable, \IteratorAggregate {

    protected $collection_items = [];
    
    public function __get($key) {
        
        return $this->offsetGet($key);
    }
    
    public function __isset($key) {
        
        return $this->offsetExists($key);
    }
    
    public function __set($key, $val) {
        
        $this->offsetSet($key, $val);
    }
    
    public function __unset($key) {
        
        $this->offsetUnset($key);
    }
    
    /**
     * 
     * ArrayAccess: does the requested key exist?
     * 
     * @param string $key The requested key.
     * 
     * @return bool
     * 
     */
    public function offsetExists($key) {
        
        return array_key_exists($key, $this->collection_items);
    }

    /**
     * 
     * ArrayAccess: get a key value.
     * 
     * @param string $key The requested key.
     * 
     * @return mixed
     * 
     */
    public function offsetGet($key) {
        
        if ( array_key_exists($key, $this->collection_items) ) {

            return $this->collection_items[$key];
            
        } else {

            throw new \Exception(get_class($this)."::offsetGet({$key})");
        }
    }

    /**
     * 
     * ArrayAccess: set a key value.
     * 
     * @param string $key The requested key.
     * 
     * @param string $val The value to set it to.
     * 
     * @return void
     * 
     */
    public function offsetSet($key, $val) {
        
        if ($key === null) {

            //support for $this[] = $val; syntax
            $key = $this->count();

            if (!$key) {

                $key = 0;
            }
        }

        $this->collection_items[$key] = $val;
    }

    /**
     * 
     * ArrayAccess: unset a key.
     * 
     * @param string $key The requested key.
     * 
     * @return void
     * 
     */
    public function offsetUnset($key) {
        
        $this->collection_items[$key] = null;
        unset($this->collection_items[$key]);
    }

    public function toArray() {

        return $this->collection_items;
    }

    // IteratorAggregate
    public function getIterator() {

        return new \ArrayIterator($this->collection_items);
    }

    // Countable: how many keys are there?
    public function count() {
        
        return count($this->collection_items);
    }

    // Because we are not type hinting here
    // strict typing will be enforced by assuming
    // all items in $arr_objs should be of the same
    // type as the first item in $arr_objs
    public function __construct(...$arr_objs) {

        // if count $arr_objs > 0
        // gettype of first item
        // if it's an object get the class name
        // for subsequent items check that they 
        // are of the same type and (optionally) class 
        // as first item. Use native array construct to 
        // do this e.g array_walk . If an item with different
        // type is encoutered throw Exception
        // Actually move the strict type check into a new sub-class
        // StrictlyTypedGenericCollection

        $this->collection_items = $arr_objs;
    }
    
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    ////////// OTHER COLLECTION METHODS ////////////////////////////////////////
    
    /**
     * 
     * Retrieves and returns the first record in this collection.
     * 
     * @return mixed The first item in this collection or null if collection is empty.
     * 
     */
    public function firstItem(){
        
        if( $this->count() <= 0 ) { return null; }
        
        $keys = array_keys($this->collection_items);
        
        return $this[$keys[0]];
    }
    
    /**
     * 
     * Retrieves and returns the last record in this collection.
     * 
     * @return mixed The last item in this collection or null if collection is empty.
     * 
     */
    public function lastItem(){
        
        if( $this->count() <= 0 ) { return null; }
        
        $keys = array_keys($this->collection_items);
        $reversed_keys = array_reverse($keys);
        
        return $this[$reversed_keys[0]];
    }
    
    public function getKeys()
    {
        return array_keys($this->collection_items);
    }

}
