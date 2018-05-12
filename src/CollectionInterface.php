<?php
namespace VersatileCollections;

/**
 *
 * @author rotimi
 */
interface CollectionInterface extends \ArrayAccess, \Countable, \IteratorAggregate {

    /**
     * A factory method to help create a new collection.
     * 
     * The purpose is to act as a shortcut to __construct(...$items)
     * Calling this method eliminates the need to unpack the items .e.g
     * new \VersatileCollections\NumericsCollection(...[1,2,3])
     * vs \VersatileCollections\NumericsCollection::makeNewCollection([1,2,3])
     * 
     * @param array $items an array of items for the new collection to be created. Keys will be preserved in the created collection.
     * @param array $preserve_keys true if keys in $items will be preserved in the created collection.
     * 
     * @return \VersatileCollections\CollectionInterface newly created collection
     */
    public static function makeNewCollection(array $items=[], $preserve_keys=true);


    /**
     * 
     * ArrayAccess: does the requested key exist?
     * 
     * @param string $key The requested key.
     * 
     * @return bool
     * 
     */
    public function offsetExists($key);

    /**
     * 
     * ArrayAccess: get a key value.
     * 
     * @param string $key The requested key.
     * 
     * @return mixed
     * 
     */
    public function offsetGet($key);

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
    public function offsetSet($key, $val);

    /**
     * 
     * ArrayAccess: unset a key.
     * 
     * @param string $key The requested key.
     * 
     * @return void
     * 
     */
    public function offsetUnset($key);

    /**
     * @return array an array containing all items in the collection object
     */
    public function toArray();

    /**
     * @return \Iterator an iterator
     */
    public function getIterator();

    /**
     * @return int number of items in collection
     */
    public function count();
    
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
    public function firstItem();
    
    /**
     * 
     * Retrieves and returns the last record in this collection.
     * 
     * @return mixed The last item in this collection or null if collection is empty.
     * 
     */
    public function lastItem();
    
    /**
     * @return array keys to this collection
     */
    public function getKeys();
    
    /**
     * 
     * @param string $field_name
     * @param mixed $field_val
     * @param bool $add_field_if_not_present
     * 
     * @return $this
     */
    public function setValForEachItem($field_name, $field_val, $add_field_if_not_present=false);
        
    /**
     * 
     * Filter out items in the collection via a callback function and return filtered items in a new collection.
     * Note that the filtered items are not removed from the original collection.
     * 
     * @param callable $filterer a callback with the following signature
     *                 function($key, $item) that returns true if an item should be filtered out, or false if not
     * 
     * @param bool $copy_keys true if key for each filtered item in $this should be copied into the collection to be returned
     * 
     * @return \VersatileCollections\CollectionInterface a collection of filtered items or an empty collection
     */
    public function filterAll(callable $filterer, $copy_keys=false);
        
    /**
     * 
     * Filter out the first N items in the collection via a callback function and return filtered items in a new collection.
     * Note that the filtered items are not removed from the original collection.
     * 
     * @param callable $filterer a callback with the following signature
     *                 function($key, $item) that returns true if an item should be filtered out, or false if not
     * 
     * @param int $max_number_of_filtered_items_to_return Number of filtered items to be returned. Null means return all filtered items
     * 
     * @param bool $copy_keys true if key for each filtered item in $this should be copied into the collection to be returned
     * 
     * @return \VersatileCollections\CollectionInterface a collection of filtered items or an empty collection
     */
    public function filterFirstN(callable $filterer, $max_number_of_filtered_items_to_return=null, $copy_keys=false);
        
    /**
     * 
     * Transform each item in the collection via a callback function.
     * 
     * @param callable $transformer a callback with the following signature
     *                 function($key, $item) that returns a value that will replace $this[$key]
     * 
     * @return $this
     */
    public function transform(callable $transformer);
    
    /**
     * 
     * Iteratively reduce the collection items to a single value using a callback function.
     * 
     * @see mixed array_reduce( array $array, callable $callback [, mixed $initial = NULL ] )
     * 
     * @param callable $reducer function(mixed $carry , mixed $item): mixed
     *                          $carry: Holds the return value of the previous iteration; in the case of the first iteration it instead holds the value of initial.
     *                           $item: Holds the value of the current iteration.
     * 
     * @param mixed $initial_value If the optional initial is available, it will be used at the beginning of the process, or as a final result in case the collection is empty.
     * 
     * @return mixed a value that all items in the collection have been reduced to by applying the $reducer callback on each item. 
     */
    public function reduce(callable $reducer, $initial_value=NULL);
    
    /**
     * 
     * Return true if there are one or more items in the collection or false otherwise
     * 
     * @return bool
     */
    public function isEmpty();
    
    /**
     * 
     * Try to get an item with the specified key ($key) or return $default_value if key does not exist.
     * 
     * @param string|int $key
     * @param mixed $default_value
     * 
     * @return mixed
     */
    public function getIfExists($key, $default_value=null);
 
    /**
     * Check if a collection contains an item
     * 
     * @param mixed $item item whose existence in the collection is to be checked
     * 
     * @return bool true if collection contains item, false otherwise
     */
    public function containsItem($item);
    
    /**
     * Check if a key exists in a collection
     * 
     * @param mixed $key key whose existence in the collection is to be checked
     * 
     * @return bool true if key exists in collection, false otherwise
     */
    public function containsKey($key);

    /**
     * Appends all items from $other collection to the end of $this collection. Note that appended items will be assigned numeric keys.
     * 
     * @param \VersatileCollections\CollectionInterface $other
     * 
     * @return $this
     */
    public function appendCollection(CollectionInterface $other);
    
    /**
     * Appends an $item to the end of $this collection.
     * 
     * @param mixed $item
     * 
     * @return $this
     */
    public function appendItem($item);
    
    /**
     * 
     * Prepends all items from $other collection to the front of $this collection. Note that all numerical keys will be modified to start counting from zero while literal keys won't be changed.
     * 
     * @param \VersatileCollections\CollectionInterface $other
     * 
     * @return $this
     */
    public function prependCollection(CollectionInterface $other);
    
    /**
     * Prepends an $item to the front of $this collection.
     * 
     * @param mixed $item
     * @param string|int $key
     * 
     * @return $this
     */
    public function prependItem($item, $key=null);
    
    /**
     * Adds all items from $other collection to $this collection. Items in $other with existing keys in $this will overwrite the existing items in $this.
     * 
     * @param \VersatileCollections\CollectionInterface $other
     * 
     * @return $this
     */
    public function merge(CollectionInterface $other);
    
    /**
     * 
     * Returns a generator that yields collections each having a maximum of $num_of_items. Original keys are preserved in each returned collection.
     * 
     * If $this contains [1,2,3,4,5,6]
     * 
     * foreach( $this->getCollectionsOfSizeN(2) as $batch ) {
     * 
     *     var_dump($batch);
     * }
     * 
     * will output
     * 
     * [0=>1,1=>2]
     * [2=>3,3=>4]
     * [4=>5,5=>6]
     * 
     * @param int $max_size_of_each_collection
     * 
     * @return \Generator a generator that yields sub-collections
     * 
     */
    public function getCollectionsOfSizeN($max_size_of_each_collection=1);
    
    /**
     * 
     * Convert all keys in the collection to consecutive integer keys  
     * 
     * @return $this
     */
    public function makeAllKeysNumeric();

}
