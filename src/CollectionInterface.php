<?php
namespace VersatileCollections;

/**
 *
 * @author rotimi
 */
interface CollectionInterface extends \ArrayAccess, \Countable, \IteratorAggregate {

    /**
     * 
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
     * 
     * @return array an array containing all items in the collection object
     */
    public function toArray();
    
    /**
     * 
     * @return \Iterator an iterator
     */
    public function getIterator();
    
    /**
     * 
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
     * 
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
     * @param bool $bind_callback_to_this true if the variable $this inside the supplied 
     *                                    $filterer should refer to the collection object
     *                                    this method is being invoked on, else false if
     *                                    you want the variable $this to be undefined 
     *                                    inside the supplied $filterer.
     * 
     * @return \VersatileCollections\CollectionInterface a collection of filtered items or an empty collection
     */
    public function filterAll(callable $filterer, $copy_keys=false, $bind_callback_to_this=true);
    
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
     * @param bool $bind_callback_to_this true if the variable $this inside the supplied 
     *                                    $filterer should refer to the collection object
     *                                    this method is being invoked on, else false if
     *                                    you want the variable $this to be undefined 
     *                                    inside the supplied $filterer.
     * 
     * @return \VersatileCollections\CollectionInterface a collection of filtered items or an empty collection
     */
    public function filterFirstN(callable $filterer, $max_number_of_filtered_items_to_return=null, $copy_keys=false, $bind_callback_to_this=true);
    
    /**
     * 
     * Transform each item in the collection via a callback function.
     * 
     * @param callable $transformer a callback with the following signature
     *                 function($key, $item) that returns a value that will replace $this[$key]
     * 
     * @param bool $bind_callback_to_this true if the variable $this inside the supplied 
     *                                    $transformer should refer to the collection object
     *                                    this method is being invoked on, else false if
     *                                    you want the variable $this to be undefined 
     *                                    inside the supplied $transformer.
     * 
     * @return $this
     */
    public function transform(callable $transformer, $bind_callback_to_this=true);
    
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
     * 
     * Check if a collection contains an item
     * 
     * @param mixed $item item whose existence in the collection is to be checked
     * 
     * @return bool true if collection contains item, false otherwise
     */
    public function containsItem($item);
    
    /**
     * 
     * Check if a key exists in a collection
     * 
     * @param mixed $key key whose existence in the collection is to be checked
     * 
     * @return bool true if key exists in collection, false otherwise
     */
    public function containsKey($key);
    
    /**
     * 
     * Check if all the specified keys exist in a collection
     * 
     * @param array $keys specified keys whose existence is to be checked in the collection 
     * 
     * @return bool true if all specified keys exist in collection, false otherwise
     */
    public function containsKeys(array $keys);
    
    /**
     * 
     * Appends all items from $other collection to the end of $this collection. Note that appended items will be assigned numeric keys.
     * 
     * @param \VersatileCollections\CollectionInterface $other
     * 
     * @return $this
     */
    public function appendCollection(CollectionInterface $other);
    
    /**
     * 
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
     * 
     * Prepends an $item to the front of $this collection.
     * 
     * @param mixed $item
     * @param string|int $key
     * 
     * @return $this
     */
    public function prependItem($item, $key=null);
    
    /**
     * 
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
     * Convert all keys in the collection to consecutive integer keys starting from zero 
     * 
     * @return $this
     */
    public function makeAllKeysNumeric();
    
    /**
     * 
     * Iterate through a collection and execute a callback over each item during the iteration.
     * 
     * @param callable $callback a callback with the following signature
     *                           function($key, $item). To stop iteration at any
     *                           point, the callback should return the value 
     *                           specified via $termination_value. For example,
     *                           if you wanted to loop through the first half of
     *                           a collection you 
     * 
     * @param mixed $termination_value a value that should be returned by $callback 
     *                                 signifying that iteration through a collection
     *                                 should stop.
     * 
     * @param bool $bind_callback_to_this true if the variable $this inside the supplied 
     *                                    $callback should refer to the collection object
     *                                    this method is being invoked on, else false if
     *                                    you want the variable $this to be undefined 
     *                                    inside the supplied $callback.
     * 
     * @return $this
     */
    public function each(callable $callback, $termination_value=false, $bind_callback_to_this=true);
    
    /**
     * 
     * Applies the callback to the items in the collection and returns a new 
     * collection containing all the items in the original collection after 
     * applying the callback function to each one.
     * 
     * 
     * 
     * @param callable $callback a callback with the following signature
     *                           function($key, $item). It should perform an
     *                           operation on each item and return the result 
     *                           of the operation on each item.
     *                          
     * @param bool $preserve_keys true if keys in the returned collection should 
     *                            match the keys in the original collection, else
     *                            false for sequentially incrementing integer keys 
     *                            (starting from 0) in the returned collection.
     * 
     * @param bool $bind_callback_to_this true if the variable $this inside the supplied 
     *                                    $callback should refer to the collection object
     *                                    this method is being invoked on, else false if
     *                                    you want the variable $this to be undefined 
     *                                    inside the supplied $callback.
     * 
     * @return \VersatileCollections\CollectionInterface
     * 
     */
    public function map(callable $callback, $preserve_keys=true, $bind_callback_to_this=true);
    
    /**
     * 
     * Create a new collection consisting of every n-th element.
     *
     * @param  int  $n the number representing n
     * @param  int  $position_of_first_nth_item position in the collection to 
     *                                          start counting for the nth elements. 
     *                                          0 represents the position of 
     *                                          the first item in the collection.
     * 
     * @return \VersatileCollections\CollectionInterface (a new collection consisting of every n-th element)
     */
    public function nth($n, $position_of_first_nth_item = 0);
    
    /**
     * 
     * Pass the collection to the given callback and return whatever value is
     * returned from executing the given callback.
     *
     * @param  callable $callback a callback with the following signature
     *                            function($collection). The $collection 
     *                            argument in the callback's signature is
     *                            collection object this pipe method is 
     *                            being invoked on.
     * 
     * @return mixed whatever is returned by $callback
     */
    public function pipe(callable $callback);
    
    /**
     * 
     * Get and remove the last item from the collection.
     *
     * @return mixed
     */
    public function getAndRemoveLastItem();
    
    /**
     * 
     * Get and remove an item from the collection.
     *
     * @param  mixed  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function pull($key, $default = null);
    
    /**
     * 
     * Alias of appendItem($item)
     *
     * @param  mixed  $item
     * @return $this
     */
    public function push($item);
    

    /**
     * 
     * Put an item in the collection by key.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * 
     * @return $this
     */
    public function put($key, $value);

    /**
     * 
     * Search the collection for a given value and return the first 
     * corresponding key if successful.
     * 
     * @param mixed $value the value to be searched for
     * @param bool $strict true if strict comparison should be used when searching, 
     *                          else false for loose comparison
     * 
     * @return mixed the first key in the collection whose item matches $value 
     *               or false if $value is not found in the collection
     */
    public function searchByVal( $value, $strict = false );

    /**
     * 
     * Search the collection for a given value and return an array of all 
     * corresponding key(s) in the collection whose item(s) match the value, 
     * if successful.
     * 
     * @param mixed $value the value to be searched for
     * @param bool $strict true if strict comparison should be used when searching, 
     *                          else false for loose comparison
     * 
     * @return mixed an array of all key(s) in the collection whose item(s) match $value 
     *               or false if $value is not found in the collection
     */
    public function searchAllByVal( $value, $strict = false );


    /**
     * 
     * Search the collection using a callback. The callback will be executed on
     * each item and corresponding key in the collection. Returns an array of all 
     * corresponding key(s) in the collection for which the callback returns
     * true.
     * 
     * @param callable $callback a callback with the following signature
     *                           function($key, $item). It should return true
     *                           if a $key should be returned or false otherwise.
     *  
     * @param bool $bind_callback_to_this true if the variable $this inside the supplied 
     *                                    $callback should refer to the collection object
     *                                    this method is being invoked on, else false if
     *                                    you want the variable $this to be undefined 
     *                                    inside the supplied $callback.
     * 
     * @return mixed an array of all key(s) in the collection for which the callback 
     *               returned true or false if the callback did not return true for 
     *               any iteration over the collection
     */
    public function searchByCallback($callback, $bind_callback_to_this=true);
    

    /**
     * 
     * Get and remove the first item from the collection.
     *
     * @return mixed
     */
    public function getAndRemoveFirstItem ();
}
