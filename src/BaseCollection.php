<?php
namespace VersatileCollections;

abstract class BaseCollection implements CollectionInterface {

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
     * {@inheritDoc}
     * 
     */
    public static function makeNewCollection(array $items=[], $preserve_keys=true) {

        if ($preserve_keys === true) {
       
            $collection = new static();

            foreach ($items as $key => $item ) {

                $collection[$key] = $item;
            }

            return $collection;
        }
        
        // don't preserve keys 
        // (WARNING: $items should only contain numeric (non-string) keys, else 
        // a fatal php error will be generating when trying to unpack args from
        // an array with one or more string keys)
        
        return new static(...$items); // This should be faster than loop above
                                      // since looping triggers offsetSet()
                                      // for each item
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function offsetExists($key) {
        
        return array_key_exists($key, $this->collection_items);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function offsetGet($key) {
        
        if ( array_key_exists($key, $this->collection_items) ) {

            return $this->collection_items[$key];
            
        } else {

            throw new \VersatileCollections\Exceptions\NonExistentItemException(get_class($this)."::offsetGet({$key})");
        }
    }

    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function offsetSet($key, $val) {
        
        if(is_null($key) ) {
            
            $this->collection_items[] = $val;
            
        } else {
            
            $this->collection_items[$key] = $val;
        }
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function offsetUnset($key) {
        
        $this->collection_items[$key] = null;
        unset($this->collection_items[$key]);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function toArray() {

        return $this->collection_items;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function getIterator() {

        return new \ArrayIterator($this->collection_items);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function count() {
        
        return count($this->collection_items);
    }

    public function __construct(...$items) {

        $this->collection_items = $items;
    }
    
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    ////////// OTHER COLLECTION METHODS ////////////////////////////////////////
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function firstItem(){
        
        if( $this->count() <= 0 ) { return null; }
        
        reset($this->collection_items);
        
        return current($this->collection_items);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function lastItem(){
        
        if( $this->count() <= 0 ) { return null; }
        
        $last = end($this->collection_items);
        reset($this->collection_items);
        
        return $last;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function getKeys()
    {
        return array_keys($this->collection_items);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function setValForEachItem($field_name, $field_val, $add_field_if_not_present=false) {
        
        foreach ($this->collection_items as &$item) {
            
            if( 
                is_object($item)
                && 
                ( $add_field_if_not_present || property_exists($item, $field_name) )
            ) {
                $item->$field_name = $field_val;
                
            } else if(
                is_array($item)
                && ( $add_field_if_not_present  || array_key_exists($field_name, $item) )
            ) {
                $item[$field_name] = $field_val;
                
            } else {
                
                $class = get_class($this);
                $function = __FUNCTION__;
                $msg = "Error [{$class}::{$function}(...)]:Trying to set a property named `$field_name` on a collection item of type "
                    . "`". gettype($item)."` "
                    . PHP_EOL . " `\$field_val`: " . var_export($field_val, true)
                    . PHP_EOL . " `\$add_field_if_not_present`: " . var_export($add_field_if_not_present, true);
                
                throw new Exceptions\InvalidCollectionOperationException($msg);
            }
            
        } // foreach ($this->collection_items as &$item)
        
        return $this;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function filterAll(callable $filterer, $copy_keys=false) {
                
        return $this->filterFirstN($filterer, $this->count(), $copy_keys);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function filterFirstN(callable $filterer, $max_number_of_filtered_items_to_return =null, $copy_keys=false) {
        
        $filtered_items = new static();
        
        if( 
            is_null($max_number_of_filtered_items_to_return)
            || ((int)$max_number_of_filtered_items_to_return) > $this->count()
            || ((int)$max_number_of_filtered_items_to_return) < 0
            || !is_numeric($max_number_of_filtered_items_to_return)
        ) {
            $max_number_of_filtered_items_to_return = $this->count();
        }
        
        $num_filtered_items = 0;
        
        foreach ( $this->collection_items as $key => $item ) {
            
            if( $num_filtered_items >= $max_number_of_filtered_items_to_return ) {
                
                break;
            }
            
            if( $filterer($key, $item) === true ) {
                
                $num_filtered_items++;
                
                if( $copy_keys ) {
                    
                    $filtered_items[$key] = $item;
                    
                } else {
                    
                    $filtered_items[] = $item;
                }
            }
            
        } // foreach ( $this->collection_items as $key => $item )
        
        return $filtered_items;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function transform(callable $transformer) {
        
        foreach ( $this->collection_items as $key => $item ) {
            
            // using $this[$key] instead of $this->collection_items[$key]
            // so that $this->offsetSet(...) will be invoked which will
            // trigger type-checking in sub-classes like StrictlyTypedCollection
            $this[$key] = $transformer($key, $item);
            
        } // foreach ( $this->collection_items as $key => $item )
        
        return $this;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function reduce(callable $reducer, $initial_value=NULL) {
        
        return array_reduce($this->collection_items, $reducer, $initial_value);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function isEmpty() {
        
        return ($this->count() <= 0);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function getIfExists($key, $default_value=null) {
        
        return array_key_exists($key, $this->collection_items) 
                ?  $this->collection_items[$key] : $default_value;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function containsItem($item) {
        
        return in_array($item, $this->collection_items, true);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function containsKey($key) {
        
        return array_key_exists($key, $this->collection_items);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function appendCollection(CollectionInterface $other) {
        
        if( ! $other->isEmpty() ) {
            
            foreach ($other as $item) {
                
                $this[] = $item;
            }
        }
        
        return $this;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function appendItem($item) {
        
        $this[] = $item;
        
        return $this;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function merge(CollectionInterface $other) {
        
        if( ! $other->isEmpty() ) {
            
            // not using array_merge , want to trigger $this->offsetSet() logic
            foreach ( $other->toArray() as $key => $item ) {
                
                $this[$key] = $item;
            }
        }
        
        return $this;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function prependCollection(CollectionInterface $other) {
        
        if( ! $other->isEmpty() ) {
            
            array_unshift($this->collection_items, ...array_values($other->toArray()));
        }
        
        return $this;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function prependItem($item, $key=null) {
        
        if( is_null($key) ) {
            
            array_unshift($this->collection_items, $item);
            
        } else if( is_string($key) || is_int($key) ) {
            
            $this->collection_items = [$key=>$item] + $this->collection_items;
            
        } else {
            
            $class = get_class($this);
            $function = __FUNCTION__;
            $msg = "Error [{$class}::{$function}(...)]:Trying prepend an item with a non-integer and non-string key on a collection. "
                . PHP_EOL . " `\$key`: " . var_export($key, true)
                . PHP_EOL . " `\$item`: " . var_export($item, true);
            
            throw new Exceptions\InvalidKeyException($msg);
        }
        
        return $this;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function getCollectionsOfSizeN($max_size_of_each_collection=1) {
        
        if(
            ((int)$max_size_of_each_collection) > $this->count()
            || ((int)$max_size_of_each_collection) < 0
            || !is_numeric($max_size_of_each_collection)
        ) {
            $max_size_of_each_collection = 1;
        }
            
            
        $current_batch = new static();
        $result = [];
        $counter = 0;
        
        foreach ($this->collection_items as $key=>$item) {
            
            $current_batch[$key] = $item;
            
            if( ++$counter >= $max_size_of_each_collection ) {
                
                yield $current_batch;
                $counter = 0; // reset
                $current_batch = new static(); // initialize next collection
            }
        }

        // yield last batch if not already yielded
        if( !$current_batch->isEmpty() ) {
            
            yield $current_batch;
        }
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function makeAllKeysNumeric() {
        
        $this->collection_items = array_values($this->collection_items);
        
        return $this;
    }
}
