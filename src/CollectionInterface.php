<?php
declare(strict_types=1);
namespace VersatileCollections;

use ArrayAccess;
use Countable;
use Generator;
use InvalidArgumentException;
use Iterator;
use IteratorAggregate;
use LengthException;
use RuntimeException;
use VersatileCollections\Exceptions\InvalidItemException;

/**
 * Below is a list of acceptable value(s), that could be comma separated, 
 * for the @used-for tag in phpdoc blocks for public methods in this interface:
 *  
 *      - accessing-or-extracting-keys-or-items
 *      - adding-items
 *      - adding-methods-at-runtime
 *      - checking-keys-presence
 *      - checking-items-presence
 *      - creating-new-collections
 *      - deleting-items
 *      - finding-or-searching-for-items
 *      - getting-collection-meta-data
 *      - iteration
 *      - mathematical-operations
 *      - modifying-keys
 *      - modifying-items
 *      - ordering-or-sorting-items
 *      - other-operations
 *
 * @author rotimi
 * @psalm-suppress MissingTemplateParam
 */
interface CollectionInterface extends ArrayAccess, Countable, IteratorAggregate 
{
    /**
     * A factory method to help create a new collection.
     *  
     * The purpose is to act as a shortcut to __construct(...$items)
     * Calling this method eliminates the need to unpack the items .e.g
     * new \VersatileCollections\NumericsCollection(...[1,2,3])
     * vs \VersatileCollections\NumericsCollection::makeNew([1,2,3])
     *  
     * @param iterable $items an iterable of items for the new collection to be created.
     * @param bool $preserve_keys true if keys in $items will be preserved in the created collection.
     *  
     * @return CollectionInterface newly created collection
     *  
     * @used-for: creating-new-collections
     *  
     * @title: Creates a new collection from an array of items. Items must be rightly typed if collection class is strictly typed.
     */
    public static function makeNew(iterable $items=[], bool $preserve_keys=true): CollectionInterface;
    
    /**
     * Get a key's value.
     *  
     * https://www.php.net/manual/en/language.oop5.overloading.php#object.get
     * NOTE: __get() is never called when chaining assignments together like this: $a = $obj->b = 8;
     *  
     * @param string $key The requested key.
     *  
     * @return mixed
     *  
     * @used-for: accessing-or-extracting-keys-or-items
     *  
     * @title: Retrieves an item associated with a specified key in the collection.
     */
    public function __get(string $key);
    
    /**
     * Does the requested key exist?
     * 
     * @param string $key The requested key.
     * 
     * 
     * @used-for: checking-items-presence
     * 
     * @title: Checks if an item with a specified key exists in the collection.
     */
    public function __isset(string $key): bool;
    
    /**
     * Set a key's value.
     * 
     * @param string $key The requested key.
     * 
     * @param mixed $val The value to set it to.
     * 
     * 
     * @used-for: adding-items
     * 
     * @title: Adds an item with a specified key to the collection.
     */
    public function __set(string $key, $val): void;
    
    /**
     * Unset a key.
     * 
     * @param string $key The requested key.
     * 
     * 
     * @used-for: deleting-items
     * 
     * @title: Removes an item associated with the specified key from the collection.
     */
    public function __unset(string $key): void;
    
    /**
     * ArrayAccess: does the requested key exist?
     * 
     * @param mixed $key The requested key.
     * 
     * 
     * @used-for: checking-items-presence
     * 
     * @title: Checks if an item with a specified key exists in the collection.
     * 
     * @noinspection PhpParameterNameChangedDuringInheritanceInspection
     */
    public function offsetExists($key): bool;
    
    /**                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
     * ArrayAccess: get a key's value.
     * 
     * @param mixed $key The requested key.
     * 
     * @used-for: accessing-or-extracting-keys-or-items
     * 
     * @title: Retrieves an item associated with a specified key in the collection.
     * 
     * @noinspection PhpParameterNameChangedDuringInheritanceInspection
     */
    public function offsetGet(mixed $key): mixed;
    
    /**
     * ArrayAccess: set a key's value.
     * 
     * @param string|int|null $key The requested key.
     * 
     * @param mixed $val The value to set it to.
     * 
     * @used-for: adding-items
     * 
     * @title: Adds an item with a specified key to the collection.
     * 
     * @noinspection PhpParameterNameChangedDuringInheritanceInspection
     */
    public function offsetSet($key, $val): void;
    
    /**
     * ArrayAccess: unset a key.
     * 
     * @param string|int $key The requested key.
     * 
     * @used-for: deleting-items
     * 
     * @title: Removes an item associated with the specified key from the collection.
     * 
     * @noinspection PhpParameterNameChangedDuringInheritanceInspection
     */
    public function offsetUnset($key): void;
    
    /**
     * @return array an array containing all items in the collection object
     *  
     * @used-for: accessing-or-extracting-keys-or-items
     *  
     * @title: Returns all items in the collection and their corresponding keys in an array.
     */
    public function toArray(): array;
    
    /**
     * @return Iterator an iterator
     *  
     * @used-for: iteration
     *  
     * @title: Returns an Iterator object that can be used to iterate through the collection.
     */
    public function getIterator(): Iterator;
    
    /**
     * @return int number of items in collection
     *  
     * @used-for: getting-collection-meta-data
     *  
     * @title: Returns the number of items in the collection.
     */
    public function count(): int;
    
    ////////////////////////////////////////////////////////////////////////////
    ////////// OTHER COLLECTION METHODS ////////////////////////////////////////
    /**
     * Retrieves and returns the first item in this collection.
     * 
     * @return mixed The first item in this collection or null if collection is empty.
     * 
     * @used-for: accessing-or-extracting-keys-or-items
     * 
     * @title: Returns the first item in the collection or null if the collection is empty.
     */
    public function firstItem();
    
    /**                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
     * Retrieves and returns the last item in this collection.
     * 
     * @return mixed The last item in this collection or null if collection is empty.
     * 
     * @used-for: accessing-or-extracting-keys-or-items
     * 
     * @title: Returns the last item in the collection or null if the collection is empty.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
     */
    public function lastItem();
    
    /**
     * @return GenericCollection keys to this collection
     *  
     * @used-for: accessing-or-extracting-keys-or-items, getting-collection-meta-data, creating-new-collections
     *  
     * @title: Returns a new instance of **`\VersatileCollections\GenericCollection`** containing all the keys in the original collection.
     */
    public function getKeys(): GenericCollection;
    
    /**
     * This method works only on collections of arrays and / or objects.
     * It set's the specified field in each array or property in each object
     * to the given value.
     * 
     * @param mixed $field_val
     * 
     * @used-for: modifying-items
     * 
     * @title: Sets the specified field in each array or object in the collection to a specified value.
     */
    public function setValForEachItem(string $field_name, $field_val, bool $add_field_if_not_present=false): CollectionInterface;
    
    /** 
     * Filter out items in the collection via a callback function and return filtered items in a new collection.
     *  
     * @param callable $filterer a callback with the following signature
     *                 function($key, $item) that must return true if an item should be filtered out, or false if not
     *  
     * @param bool $copy_keys true if key for each filtered item in $this should be copied into the collection to be returned
     *  
     * @param bool $bind_callback_to_this true if the variable $this inside the supplied 
     *                                    $filterer should refer to the collection object
     *                                    this method is being invoked on, else false if
     *                                    you want the variable $this to be undefined 
     *                                    inside the supplied $filterer.
     *  
     * @param bool $remove_filtered_items true if the filtered items should be removed from
     *                                    the collection this method is being invoked on, 
     *                                    else false if the filtered items should not be 
     *                                    removed from the collection this method is 
     *                                    being invoked on.
     *  
     * @return CollectionInterface a collection of filtered items or an empty collection
     *  
     * @used-for: finding-or-searching-for-items, creating-new-collections
     *  
     * @title: Filters out items in the collection via a callback function and returns filtered items in a new collection.
     */
    public function filterAll(callable $filterer, bool $copy_keys=false, bool $bind_callback_to_this=true, bool $remove_filtered_items=false): CollectionInterface;
    
    /**
     * Filter out the first N items in the collection via a callback function and return filtered items in a new collection.
     *  
     * @param callable $filterer a callback with the following signature
     *                 function($key, $item) that must return true if an item should be filtered out, or false if not
     *  
     * @param int|null $max_number_of_filtered_items_to_return Number of filtered items to be returned. Null means return all filtered items
     *  
     * @param bool $copy_keys true if key for each filtered item in $this should be copied into the collection to be returned
     *  
     * @param bool $bind_callback_to_this true if the variable $this inside the supplied 
     *                                    $filterer should refer to the collection object
     *                                    this method is being invoked on, else false if
     *                                    you want the variable $this to be undefined 
     *                                    inside the supplied $filterer.
     *  
     * @param bool $remove_filtered_items true if the filtered items should be removed from
     *                                    the collection this method is being invoked on, 
     *                                    else false if the filtered items should not be 
     *                                    removed from the collection this method is 
     *                                    being invoked on.
     *  
     * @return CollectionInterface a collection of filtered items or an empty collection
     *  
     * @used-for: finding-or-searching-for-items, creating-new-collections
     *  
     * @title: Filters out the first N items in the collection via a callback function and returns filtered items in a new collection.
     */
    public function filterFirstN(callable $filterer, ?int $max_number_of_filtered_items_to_return=null, bool $copy_keys=false, bool $bind_callback_to_this=true, bool $remove_filtered_items=false): CollectionInterface;
    
    /**
     * Transform each item in the collection via a callback function.
     * 
     * @param callable $transformer a callback with the following signature
     *                 function($key, $item):mixed that returns a value that will replace $this[$key]
     * 
     * @param bool $bind_callback_to_this true if the variable $this inside the supplied 
     *                                    $transformer should refer to the collection object
     *                                    this method is being invoked on, else false if
     *                                    you want the variable $this to be undefined 
     *                                    inside the supplied $transformer.
     * 
     * @used-for: modifying-items, iteration
     * 
     * @title: Transforms each item in the collection via a callback function.
     */
    public function transform(callable $transformer, bool $bind_callback_to_this=true): CollectionInterface;
    
    /**                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
     * Iteratively reduce the collection items to a single value using a callback function.
     * 
     * @see http://php.net/manual/en/function.array-reduce.php array_reduce
     * 
     * @param callable $reducer function(mixed $carry , mixed $item): mixed
     *                          $carry: Holds the return value of the previous iteration; in the case of the first iteration it instead holds the value of initial.
     *                           $item: Holds the value of the current iteration.
     * 
     * @param mixed $initial_value If the optional initial is available, it will be used at the beginning of the process, or as a final result in case the collection is empty.
     * 
     * @return mixed a value that all items in the collection have been reduced to by applying the $reducer callback on each item.
     * 
     * @used-for: accessing-or-extracting-keys-or-items, iteration
     * 
     * @title: Iteratively reduces the collection items to a single value using a callback function.
     */
    public function reduce(callable $reducer, $initial_value=NULL);
    
    /**                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
     * Iteratively reduce the collection items to a single value using a callback function.
     * The callback function will have access to the key for each item.
     *  
     * @param callable $reducer function(mixed $carry , mixed $item, string|int $key): mixed
     *                          $carry: Holds the return value of the previous iteration; in the case of the first iteration it instead holds the value of initial.
     *                           $item: Holds the value of the current iteration.
     *                            $key: Holds the corresponding key of the current iteration.
     * 
     * @param mixed $initial_value If the optional initial is available, it will be used at the beginning of the process, or as a final result in case the collection is empty.
     * 
     * @return mixed a value that all items in the collection have been reduced to by applying the $reducer callback on each item.
     * 
     * @used-for: accessing-or-extracting-keys-or-items, iteration
     * 
     * @title: Iteratively reduces the collection items to a single value using a callback function.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
     */
    public function reduceWithKeyAccess(callable $reducer, $initial_value=NULL);
    
    /**
     * Reverse order of items in the collection and return the reversed items in a new collection.
     *  
     * @return CollectionInterface a collection of reversed items
     *  
     * @used-for: ordering-or-sorting-items, creating-new-collections
     *  
     * @title: Reverses the order of items in the collection and returns the reversed items in a new collection.
     */
    public function reverse(): CollectionInterface;
    
    /**
     * Reverse order of items in the collection. Original collection will be modified.
     * 
     * @used-for: ordering-or-sorting-items
     * 
     * @title: Reverses the order of items in the collection. Original collection is modified.
     */
    public function reverseMe(): CollectionInterface;
    
    /**
     * Return true if there are one or more items in the collection or false otherwise
     * 
     * @used-for: getting-collection-meta-data
     * 
     * @title: Returns true if there are one or more items in the collection or false otherwise.
     */
    public function isEmpty(): bool;
    
    /**
     * Try to get an item with the specified key ($key) or return $default_value if key does not exist.
     * 
     * @param string|int $key
     * @param mixed $default_value
     * 
     * @return mixed
     * 
     * @used-for: accessing-or-extracting-keys-or-items, checking-items-presence
     * 
     * @title: Returns the item in the collection with the specified key (if such an item exists) or the specified default value otherwise.
     */
    public function getIfExists($key, $default_value=null);
    
    /**
     * Check if a collection contains an item using strict comparison.
     *  
     * @param mixed $item item whose existence in the collection is to be checked
     *  
     * @return bool true if collection contains item, false otherwise
     *  
     * @used-for: checking-items-presence
     *  
     * @title: Checks if a collection contains a specified item (using strict comparison).
     */
    public function containsItem($item): bool;
    
    /**
     * Check if a collection contains an item with the specified key using strict comparison for the item.
     * Strict comparison is used for checking each item.
     *  
     * @param int|string $key key whose existence in the collection is to be checked
     * @param mixed $item item whose existence in the collection is to be checked
     *  
     * @return bool true if collection contains item with the specified key, false otherwise
     *  
     * @used-for: checking-items-presence, checking-keys-presence
     *  
     * @title: Checks if a collection contains a specified item (using strict comparison) together with the specified key.
     */
    public function containsItemWithKey($key, $item): bool;
    
    /**
     * Check if all the specified items exist in a collection. 
     * Strict comparison is used for checking each item.
     *  
     * @param array $items specified items whose existence is to be checked in the collection 
     *  
     * @return bool true if all specified items exist in collection, false otherwise
     *  
     * @used-for: checking-items-presence
     *  
     * @title: Checks if a collection contains all specified items (using strict comparison for each comparison).
     */
    public function containsItems(array $items): bool;
    
    /**
     * Check if a key exists in a collection
     *  
     * @param int|string $key key whose existence in the collection is to be checked
     *  
     * @return bool true if key exists in collection, false otherwise
     *  
     * @used-for: checking-keys-presence
     *  
     * @title: Checks if a collection contains a specified key.
     */
    public function containsKey($key): bool;
    
    /**
     * Check if all the specified keys exist in a collection
     *  
     * @param array $keys specified keys whose existence is to be checked in the collection 
     *  
     * @return bool true if all specified keys exist in collection, false otherwise
     *  
     * @used-for: checking-keys-presence
     *  
     * @title: Checks if a collection contains all specified keys.
     */
    public function containsKeys(array $keys): bool;
    
    /**
     * Appends all items from $other collection to the end of $this collection. 
     * Note that appended items will be assigned numeric keys.
     * 
     * @used-for: adding-items
     *
     * @title: Appends all items from a specified collection to the end of a collection. Note that appended items will be assigned numeric keys.
     */
    public function appendCollection(CollectionInterface $other): CollectionInterface;
    
    /**
     * Appends an $item to the end of $this collection.
     * 
     * @param mixed $item
     * 
     * @used-for: adding-items
     * 
     * @title: Appends a specified item to the end of a collection.
     */
    public function appendItem($item): CollectionInterface;
    
    /**
     * Prepends all items from $other collection to the front of $this collection. 
     * Note that all numeric keys will be modified to start counting from zero while literal keys won't be changed.
     * 
     * @used-for: adding-items
     *
     * @title: Prepends all items from a specified collection to the front of a collection.
     */
    public function prependCollection(CollectionInterface $other): CollectionInterface;
    
    /**
     * Prepends an $item to the front of $this collection.
     * 
     * @param mixed $item
     * @param string|int|null $key
     * 
     * @used-for: adding-items
     * 
     * @title: Prepends a specified item (with a specified key, if specified) to the front of a collection.
     */
    public function prependItem($item, $key=null): CollectionInterface;
    
    /**
     * Adds all items from $items to $this collection and returns a new collection
     * containing the result. The original collection will not be modified.
     * Items in $items with existing keys in $this will overwrite the existing items in $this.
     * 
     * Use unionWith() and unionMeWith() if you want items from $this to be used
     * when same keys exist in both $items and $this.
     * 
     * @return CollectionInterface a new collection containing
     *                                                   the result of merging all
     *                                                   items from $items with
     *                                                   $this collection
     *
     * @used-for: adding-items, creating-new-collections
     *
     * @title: Adds all specified items to a collection and returns a new collection containing the result. The original collection is not modified. New items with the same keys as existing items will overwrite the existing items.
     * 
     * @see \VersatileCollections\CollectionInterface::unionWith()
     * @see \VersatileCollections\CollectionInterface::unionMeWith()
     */
    public function mergeWith(array $items): CollectionInterface;

    /**
     * Adds all items from $items to $this collection. 
     * Items in $items with existing keys in $this will overwrite the existing items in $this.
     * 
     * Use unionWith() and unionMeWith() if you want items from $this to be used
     * when same keys exist in both $items and $this.
     * 
     * @see \VersatileCollections\CollectionInterface::unionWith()
     * @see \VersatileCollections\CollectionInterface::unionMeWith()
     * 
     * @used-for: adding-items
     * 
     * @title: Adds all specified items to a collection. The original collection is modified. New items with the same keys as existing items will overwrite the existing items.
     */
    public function mergeMeWith(array $items): CollectionInterface;

    /**
     * Returns a generator that yields collections each having a maximum of $num_of_items. Original keys are preserved in each returned collection.
     * 
     * If $this contains [1,2,3,4,5,6]
     * 
     * foreach( $this->yieldCollectionsOfSizeN(2) as $batch ) {
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
     * @return Generator a generator that yields sub-collections
     * 
     * @used-for: creating-new-collections
     * 
     * @title: Returns a generator that yields collections each having a specified maximum number of items. Original keys are preserved in each returned collection.
     */
    public function yieldCollectionsOfSizeN(int $max_size_of_each_collection=1): Generator;
    
    /**
     * Returns a collection of collections each having a maximum of $num_of_items. Original keys are preserved in each sub-collection.
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
     * @return CollectionInterface a collection of sub-collections
     * 
     * @used-for: creating-new-collections
     * 
     * @title: Returns a collection of collections; with each sub-collection having a specified maximum number of items. Original keys are preserved in each sub-collection.
     */
    public function getCollectionsOfSizeN(int $max_size_of_each_collection=1): CollectionInterface;

    /**
     * Convert all keys in the collection to consecutive integer keys starting from $starting_key 
     * 
     * @param int $starting_key a positive integer value that will be the value of the first key. 
     *                          A negative integer value should be forced to zero.
     * 
     * @used-for: modifying-keys
     * 
     * @title: Converts all keys in a collection to consecutive integer keys starting from the specified integer value.
     * 
     * @throws InvalidArgumentException if $starting_key is not an integer
     */
    public function makeAllKeysNumeric(int $starting_key=0): CollectionInterface;

    /**
     * Create a new collection with all the items in the original collection.
     * All the keys in the new collection will be consecutive integer keys 
     * starting from zero.
     *
     * @return CollectionInterface new collection with all the items in the original collection
     *  
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, modifying-keys
     *  
     * @title: Returns a new collection with all items in the original collection. All the keys in the new collection will be consecutive integer keys starting from zero.
     */
    public function getItems(): CollectionInterface;

    /**
     * Iterate through a collection and execute a callback over each item during the iteration.
     * 
     * @param callable $callback a callback with the following signature
     *                           function($key, $item). To stop iteration at any
     *                           point, the callback should return the value 
     *                           specified via $termination_value. For example,
     *                           if you wanted to loop through the first half of
     *                           a collection you should return false in the 
     *                           callback when you reach the ($this->count()/2)th item.
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
     * @used-for: accessing-or-extracting-keys-or-items, iteration
     * 
     * @title: Iterates through a collection and executes a callback over each item.
     */
    public function each(callable $callback, $termination_value=false, bool $bind_callback_to_this=true): CollectionInterface;

    /**
     * Applies the callback to the items in the collection and returns a new 
     * collection containing all the items in the original collection after 
     * applying the callback function to each one. The original collection
     * is not modified.
     * 
     * @param callable $callback a callback with the following signature
     *                           function($key, $item): mixed. It should perform an
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
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, iteration
     * 
     * @title: Applies a callback to the items in a collection and returns a new collection containing all items in the original collection after applying the callback function to each one. The original collection is not modified.
     */
    public function map(callable $callback, bool $preserve_keys=true, bool $bind_callback_to_this=true): CollectionInterface;

    /**
     * Create a new collection consisting of every n-th element.
     *
     * @param int  $n the number representing n
     * @param int  $position_of_first_nth_item position in the collection to 
     *                                         start counting for the nth elements. 
     *                                         0 represents the position of 
     *                                         the first item in the collection.
     *  
     * @return CollectionInterface (a new collection consisting of every n-th element)
     *  
     * @used-for: creating-new-collections
     *  
     * @title: Creates a new collection consisting of every n-th element in a collection.
     */
    public function everyNth(int $n, int $position_of_first_nth_item = 0): CollectionInterface;

    /**                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
     * Pass the collection to the given callback and return whatever value is
     * returned from executing the given callback.
     *
     * @param callable $callback a callback with the following signature
     *                            function($collection):mixed. The $collection 
     *                            argument in the callback's signature is
     *                            collection object this 
     *                            pipeAndReturnCallbackResult 
     *                            method is being invoked on.
     * 
     * @return mixed whatever is returned by $callback
     * 
     * @used-for: other-operations
     * 
     * @title: Executes the given callback on a collection and returns whatever value the callback returned.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
     */
    public function pipeAndReturnCallbackResult(callable $callback);
    
    /**
     * Pass the collection to the given callback and return the collection.
     *
     * @param callable $callback a callback with the following signature
     *                            function($collection). The $collection 
     *                            argument in the callback's signature is
     *                            collection object this pipeAndReturnSelf 
     *                            method is being invoked on.
     * 
     * 
     * @used-for: other-operations
     * 
     * @title: Executes the given callback on a collection and returns the collection itself.
     */
    public function pipeAndReturnSelf(callable $callback): CollectionInterface;

    /**                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
     * Get and remove the last item from the collection.
     *
     * @return mixed
     * 
     * @used-for: accessing-or-extracting-keys-or-items, deleting-items
     * 
     * @title: Removes and returns the last item from a collection.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
     */
    public function getAndRemoveLastItem();
    
    /**                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
     * Get and remove an item from the collection.
     *
     * @param int|string  $key
     * @param mixed       $default
     * @return mixed
     * 
     * @used-for: accessing-or-extracting-keys-or-items, deleting-items
     * 
     * @title: Removes and returns the item with the specified key from a collection (if it exists) or returns a default value.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
     */
    public function pull($key, $default = null);
    
    /**
     * Alias of appendItem($item)
     *
     * @param mixed  $item
     * 
     * @used-for: adding-items
     * 
     * @title: Appends a specified item to the end of a collection.
     */
    public function push($item): CollectionInterface;


    /**
     * Put an item in the collection by key.
     *
     * @param int|string  $key
     * @param mixed       $value
     * 
     * @used-for: adding-items
     * 
     * @title: Adds a specified key and item pair to a collection. If the specified key already exists, the specified item will overwrite the existing item.
     */
    public function put($key, $value): CollectionInterface;

    /**
     * Get one key randomly from the collection.
     * A length exception (\LengthException) should be thrown if this method is called on an empty collection.
     * 
     * @return mixed a random key from the collection if there is at least an item in the collection
     * 
     * @throws LengthException
     * 
     * @used-for: accessing-or-extracting-keys-or-items, ordering-or-sorting-items
     * 
     * @title: Gets one key randomly from a collection.
     */
    public function randomKey();
    
    /**                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
     * Get one item randomly from the collection.
     * A length exception (\LengthException) should be thrown if this method is called on an empty collection.
     * 
     * @return mixed a random item from the collection if there is at least an item in the collection
     * 
     * @used-for: accessing-or-extracting-keys-or-items, ordering-or-sorting-items
     * 
     * @title: Gets one item randomly from a collection.
     * 
     * @throws LengthException
     */
    public function randomItem();

    /**
     * Get a specified number of unique keys randomly from the collection and return them in a new collection.
     *  
     * A \LengthException should be thrown if this method is called on an empty collection.
     * An \InvalidArgumentException should be thrown if $number is either not an int or if it is bigger than the number of items in the collection.
     *
     * @param int $number number of random keys to be returned
     *  
     * @return GenericCollection (a new collection containing the random keys)
     *  
     * @used-for: accessing-or-extracting-keys-or-items, ordering-or-sorting-items
     *
     * @title: Gets a specified number of unique keys randomly from a collection and returns them in a new collection.
     *  
     * @throws InvalidArgumentException
     * @throws LengthException 
     */
    public function randomKeys(int $number = 1): CollectionInterface;

    /**
     * Get a specified number of items randomly from the collection and return them in a new collection.
     *  
     * A \LengthException should be thrown if this method is called on an empty collection.
     * An \InvalidArgumentException should be thrown if $number is either not an int or if it is bigger than the number of items in the collection.
     *
     * @param int $number number of random items to be returned
     * @param bool $preserve_keys true if the key associated with each random item should be used in the new collection returned by this method,
     *                            otherwise false if the new collection returned should have sequential integer keys starting at zero.
     *  
     * @return CollectionInterface (a new collection containing the random items)
     *  
     * @used-for: accessing-or-extracting-keys-or-items, ordering-or-sorting-items
     *
     * @title: Gets a specified number of items randomly from a collection and returns them in a new collection.
     *  
     * @throws InvalidArgumentException
     * @throws LengthException
     */
    public function randomItems(int $number = 1, bool $preserve_keys=false): CollectionInterface;

    /**
     * Shuffle all the items in the collection and return shuffled items in a new collection.
     * If collection is empty, this method should also return an empty collection.
     *  
     * @param bool $preserve_keys true if the key associated with each shuffled item should be used in the new collection returned by this method,
     *                            otherwise false if the new collection returned should have sequential integer keys starting at zero.
     *  
     * @return CollectionInterface (a new collection containing the shuffled items)
     *  
     * @used-for: creating-new-collections, ordering-or-sorting-items
     *  
     * @title: Shuffles all the items in a collection and returns the shuffled items in a new collection. The original collection is not modified.
     */
    public function shuffle(bool $preserve_keys=true): CollectionInterface;

    /**                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
     * Search the collection for a given value and return the first corresponding key 
     * in the collection whose item matches the given value if successful or false if not.
     * 
     * @param mixed $value the value to be searched for
     * @param bool $strict true if strict comparison should be used when searching, 
     *                          else false for loose comparison
     * 
     * @return mixed the first key in the collection whose item matches $value 
     *               or false if $value is not found in the collection
     * 
     * @used-for: accessing-or-extracting-keys-or-items, finding-or-searching-for-items
     * 
     * @title: Searches the collection for a given value and returns the first corresponding key in the collection whose item matches the given value if successful or false if not.
     */
    public function searchByVal( $value, bool $strict = false );

    /**
     * Search the collection for a given value and return an array of all 
     * corresponding key(s) in the collection whose item(s) match the given value, 
     * if successful.
     * 
     * @param mixed $value the value to be searched for
     * @param bool $strict true if strict comparison should be used when searching, 
     *                          else false for loose comparison
     * 
     * @return mixed an array of all key(s) in the collection whose item(s) match $value 
     *               or false if $value is not found in the collection
     * 
     * @used-for: accessing-or-extracting-keys-or-items, finding-or-searching-for-items
     * 
     * @title: Searches the collection for a given value and returns an array of all corresponding key(s) in the collection whose item(s) match the given value or else returns false.
     */
    public function searchAllByVal( $value, bool $strict = false );

    /**
     * Search the collection using a callback. The callback will be executed on
     * each item and corresponding key in the collection. Returns an array of all 
     * corresponding key(s) in the collection for which the callback returns true.
     * 
     * @param callable $callback a callback with the following signature
     *                           function($key, $item):bool. It should return true
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
     * 
     * @used-for: accessing-or-extracting-keys-or-items, finding-or-searching-for-items
     * 
     * @title: Searches the collection using a callback. Returns an array of all corresponding key(s) in the collection for which the callback returns true or else returns false.
     */
    public function searchByCallback(callable $callback, bool $bind_callback_to_this=true);
    
    /**
     * Get and remove the first item from the collection.
     * 
     * @return mixed
     * 
     * @used-for: accessing-or-extracting-keys-or-items, deleting-items
     * 
     * @title: Returns and removes the first item in a collection.
     */
    public function getAndRemoveFirstItem ();
    
    /**
     * Extract a slice of the collection.
     * 
     * The collection itself should not be modified (i.e. sliced items will 
     * still remain in the collection this method is being called with).
     *  
     * @see http://php.net/manual/en/function.array-slice.php array_slice
     *  
     * @param int $offset If offset is non-negative, the sequence will start at 
     *                    that offset in the array. If offset is negative, the 
     *                    sequence will start that far from the end of the array.
     *  
     * @param int|null $length If length is given and is positive, then the sequence
     *                    will have up to that many elements in it. If the array 
     *                    is shorter than the length, then only the available 
     *                    array elements will be present. If length is given and 
     *                    is negative then the sequence will stop that many 
     *                    elements from the end of the array. If it is omitted, 
     *                    then the sequence will have everything from offset up 
     *                    until the end of the array.
     *  
     * @return CollectionInterface A new collection containing the sliced items
     *  
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections
     *  
     * @title: Extracts a slice from a collection and returns the slice as a new collection. The original collection is not modified.
     *  
     * @throws InvalidArgumentException if $offset is non-int and / or if $length is non-null and non-int
     */
    public function slice(int $offset, ?int $length = null): CollectionInterface;

    /**
     * Sort the collection's items in ascending order while maintaining key association.
     * A new collection containing the sorted items is returned.
     *  
     * @param callable|null $callable a callback with the following signature
     *                           function(mixed $a, mixed $b): int. 
     *                           The callback function must return an INTEGER 
     *                           less than, equal to, or greater than zero if the 
     *                           first argument is considered to be respectively 
     *                           less than, equal to, or greater than the second.
     *                           If callback is not supplied, a native php sorting
     *                           function that maintains key association should be
     *                           used for the sorting.
     *  
     * @param SortType|null $type an object indicating the sort type.
     *                                             See \VersatileCollections\SortType::$valid_sort_types
     *                                             for available sort types.
     *  
     * @return CollectionInterface A new collection containing the sorted items
     *  
     * @used-for: ordering-or-sorting-items, creating-new-collections
     *  
     * @title: Sorts a collection's items in ascending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
     */
    public function sort(callable $callable=null, SortType $type=null): CollectionInterface;

    /**
     * Sort the collection's items in descending order while maintaining key association.
     * A new collection containing the sorted items is returned.
     *  
     * @param callable|null $callable a callback with the following signature
     *                           function(mixed $a, mixed $b): int. 
     *                           The callback function must return an INTEGER 
     *                           less than, equal to, or greater than zero if the 
     *                           second argument is considered to be respectively 
     *                           less than, equal to, or greater than the first.
     *                           If callback is not supplied, a native php sorting
     *                           function that maintains key association should be
     *                           used for the sorting.
     *  
     * @param SortType|null $type an object indicating the sort type.
     *                                             See \VersatileCollections\SortType::$valid_sort_types
     *                                             for available sort types.
     *  
     * @return CollectionInterface A new collection containing the sorted items
     *  
     * @used-for: ordering-or-sorting-items, creating-new-collections
     *  
     * @title: Sorts a collection's items in descending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
     */
    public function sortDesc(callable $callable=null, SortType $type=null): CollectionInterface;

    /**
     * Sort the collection's items by keys in ascending order while maintaining key association.
     * A new collection containing the sorted items is returned.
     *
     * @param callable|null $callable $callable a callback with the following signature
     *                           function(mixed $a, mixed $b): int.
     *                           The callback function must return an INTEGER
     *                           less than, equal to, or greater than zero if the
     *                           first argument is considered to be respectively
     *                           less than, equal to, or greater than the second.
     *                           If callback is not supplied, a native php sorting
     *                           function that sorts by key and maintains key
     *                           association should be used for the sorting.
     *
     * @param SortType|null $type an object indicating the sort type.
     *                                             See \VersatileCollections\SortType::$valid_sort_types
     *                                             for available sort types.
     *
     * @return CollectionInterface A new collection containing the sorted items
     *
     * @used-for: ordering-or-sorting-items, creating-new-collections
     *
     * @title: Sorts a collection's items by keys in ascending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
     */
    public function sortByKey(callable $callable=null, SortType $type=null): CollectionInterface;

    /**
     * Sort the collection's items by keys in descending order while maintaining key association.
     * A new collection containing the sorted items is returned.
     *
     * @param callable|null $callable $callable a callback with the following signature
     *                           function(mixed $a, mixed $b): int.
     *                           The callback function must return an INTEGER
     *                           less than, equal to, or greater than zero if the
     *                           second argument is considered to be respectively
     *                           less than, equal to, or greater than the first.
     *                           If callback is not supplied, a native php sorting
     *                           function that sorts by key and maintains key
     *                           association should be used for the sorting.
     *
     * @param SortType|null $type an object indicating the sort type.
     *                                             See \VersatileCollections\SortType::$valid_sort_types
     *                                             for available sort types.
     *
     * @return CollectionInterface A new collection containing the sorted items
     *
     * @used-for: ordering-or-sorting-items, creating-new-collections
     *
     * @title: Sorts a collection's items by keys in descending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
     */
    public function sortDescByKey(callable $callable=null, SortType $type=null): CollectionInterface;

    /**
     * Sort a collection of associative arrays or objects by
     * specified field name(s) and return a new collection containing the sorted items
     * with their original key associations preserved.
     *
     * This method should throw a \RuntimeException if any of the items in the
     * collection is not an associative array or an object.
     *
     * Example:
     * $data = [];
     * $data[0] = [ 'volume' => 67, 'edition' => 2 ]; <br />
     * $data[1] = [ 'volume' => 86, 'edition' => 1 ]; <br />
     * $data[2] = [ 'volume' => 85, 'edition' => 6 ]; <br />
     *
     * $collection = new \VersatileCollections\GenericCollection(...$data);
     * $sort_param = new \VersatileCollections\MultiSortParameters('volume', SORT_ASC, SORT_NUMERIC);
     * $sorted_collection = $collection->SortByMultipleFields($sort_param);
     *
     * // $sorted_collection->toArray() will look like:
     *
     * [
     *      0 => [ 'volume' => 67, 'edition' => 2 ],
     *      2 => [ 'volume' => 85, 'edition' => 6 ],
     *      1 => [ 'volume' => 86, 'edition' => 1 ],
     * ]
     *
     *                                                  See \VersatileCollections\MultiSortParameters::$valid_sort_types for available sort types for each field.
     *                                                  See \VersatileCollections\MultiSortParameters::$valid_sort_directions for available sort directions for each field.
     *
     * @return CollectionInterface A new collection containing the sorted items
     *
     * @used-for: ordering-or-sorting-items, creating-new-collections
     *
     * @title: Sorts a collection of associative arrays or objects by specified field name(s) while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
     */
    public function sortByMultipleFields(MultiSortParameters ...$param): CollectionInterface;

    /**
     * Sort the collection's items in ascending order while maintaining key association.
     *
     * @param callable|null $callable $callable a callback with the following signature
     *                           function(mixed $a, mixed $b): int.
     *                           The callback function must return an INTEGER
     *                           less than, equal to, or greater than zero if the
     *                           first argument is considered to be respectively
     *                           less than, equal to, or greater than the second.
     *                           If callback is not supplied, a native php sorting
     *                           function that maintains key association should be
     *                           used for the sorting.
     *
     * @param SortType|null $type an object indicating the sort type.
     *                                             See \VersatileCollections\SortType::$valid_sort_types
     *                                             for available sort types.
     * 
     * @used-for: ordering-or-sorting-items
     *
     * @title: Sorts a collection's items in ascending order while maintaining key association. The original collection is modified.
     */
    public function sortMe(callable $callable=null, SortType $type=null): CollectionInterface;

    /**
     * Sort the collection's items in descending order while maintaining key association.
     *
     * @param callable|null $callable $callable a callback with the following signature
     *                           function(mixed $a, mixed $b): int.
     *                           The callback function must return an INTEGER
     *                           less than, equal to, or greater than zero if the
     *                           second argument is considered to be respectively
     *                           less than, equal to, or greater than the first.
     *                           If callback is not supplied, a native php sorting
     *                           function that maintains key association should be
     *                           used for the sorting.
     *
     * @param SortType|null $type an object indicating the sort type.
     *                                             See \VersatileCollections\SortType::$valid_sort_types
     *                                             for available sort types.
     * 
     * @used-for: ordering-or-sorting-items
     *
     * @title: Sorts a collection's items in descending order while maintaining key association. The original collection is modified.
     */
    public function sortMeDesc(callable $callable=null, SortType $type=null): CollectionInterface;

    /**
     * Sort the collection's items by keys in ascending order while maintaining key association.
     *
     * @param callable|null $callable $callable a callback with the following signature
     *                           function(mixed $a, mixed $b): int.
     *                           The callback function must return an INTEGER
     *                           less than, equal to, or greater than zero if the
     *                           first argument is considered to be respectively
     *                           less than, equal to, or greater than the second.
     *                           If callback is not supplied, a native php sorting
     *                           function that sorts by key and maintains key
     *                           association should be used for the sorting.
     *
     * @param SortType|null $type an object indicating the sort type.
     *                            See \VersatileCollections\SortType::$valid_sort_types
     *                            for available sort types.
     * 
     * @used-for: ordering-or-sorting-items
     *
     * @title: Sorts a collection's items by keys in ascending order while maintaining key association. The original collection is modified.
     */
    public function sortMeByKey(callable $callable=null, SortType $type=null): CollectionInterface;

    /**
     * Sort the collection's items by keys in descending order while maintaining key association.
     *
     * @param callable|null $callable $callable a callback with the following signature
     *                           function(mixed $a, mixed $b): int.
     *                           The callback function must return an INTEGER
     *                           less than, equal to, or greater than zero if the
     *                           second argument is considered to be respectively
     *                           less than, equal to, or greater than the first.
     *                           If callback is not supplied, a native php sorting
     *                           function that sorts by key and maintains key
     *                           association should be used for the sorting.
     *
     * @param SortType|null $type an object indicating the sort type.
     *                                             See \VersatileCollections\SortType::$valid_sort_types
     *                                             for available sort types.
     *
     *
     * @used-for: ordering-or-sorting-items
     *
     * @title: Sorts a collection's items by keys in descending order while maintaining key association. The original collection is modified.
     */
    public function sortMeDescByKey(callable $callable=null, SortType $type=null): CollectionInterface;

    /**
     * Sort a collection of associative arrays or objects by
     * specified field name(s) while preserving original key associations.
     *
     * This method should throw a \RuntimeException if any of the items in the
     * collection is not an associative array or an object.
     *
     * Example:
     * $data = [];
     * $data[0] = [ 'volume' => 67, 'edition' => 2 ]; <br />
     * $data[1] = [ 'volume' => 86, 'edition' => 1 ]; <br />
     * $data[2] = [ 'volume' => 85, 'edition' => 6 ]; <br />
     *
     * $collection = new \VersatileCollections\GenericCollection(...$data);
     * $sort_param = new \VersatileCollections\MultiSortParameters('volume', SORT_ASC, SORT_NUMERIC);
     * $collection->SortMeByMultipleFields($sort_param);
     *
     * // $collection->toArray() will look like:
     *
     * [
     *      0 => [ 'volume' => 67, 'edition' => 2 ],
     *      2 => [ 'volume' => 85, 'edition' => 6 ],
     *      1 => [ 'volume' => 86, 'edition' => 1 ],
     * ]
     * 
     * @used-for: ordering-or-sorting-items
     *
     * @title: Sorts a collection of associative arrays or objects by specified field name(s) while maintaining key association. The original collection is modified.
     */
    public function sortMeByMultipleFields(MultiSortParameters ...$param): CollectionInterface;

    /**
     * Remove a portion of the collection and optionally replace with items in $replacement.
     * This method modifies the original collection.
     *  
     * @see http://php.net/manual/en/function.array-splice.php array_splice
     *
     * @param int $offset If offset is positive then the start of removed portion 
     *                     is at that offset from the beginning of the collection. 
     *                     If offset is negative then it starts that far from the 
     *                     end of the collection.
     *  
     * @param int|null $length If length is omitted, removes everything from offset 
     *                          to the end of the collection. If length is specified  
     *                          & is positive, then that many elements will be removed. 
     *                          If length is specified and is negative then the end 
     *                          of the removed portion will be that many elements from 
     *                          the end of the collection. If length is specified and 
     *                          is zero, no elements will be removed. Tip: to remove 
     *                          everything from offset to the end of the collection 
     *                          when replacement is also specified, use $this->count() 
     *                          for length.
     *  
     * @param array $replacement If replacement array is specified, then the removed items 
     *                            are replaced with items from this array.
     *  
     *                            If offset and length are such that nothing is removed, 
     *                            then the items from the replacement array are inserted 
     *                            in the place specified by the offset. Note that keys in 
     *                            replacement array are not preserved.
     *                                                        
     * @return CollectionInterface A new collection containing the removed items.
     *  
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, deleting-items, modifying-items
     *  
     * @title: Removes and returns in a new collection, a portion of a collection and optionally replaces the removed portion with some specified items.
     *  
     * @throws InvalidArgumentException if $offset is non-int and / or if $length is non-null and non-int
     */
    public function splice(int $offset, ?int $length=null, array $replacement=[]): CollectionInterface;

    /**
     * Split a collection into a certain number of groups.
     * 
     * Throw an execution if
     *      !is_int($numberOfGroups) or
     *      $numberOfGroups > $this->count() or
     *      $numberOfGroups < 0
     * 
     * @return CollectionInterface A new collection containing $numberOfGroups collections
     * 
     * @used-for: creating-new-collections
     * 
     * @title: Splits a collection into a specified number of collections and returns a collection containing those collections.
     *
     * @throws InvalidArgumentException
     */
    public function split(int $numberOfGroups): CollectionInterface;

    /**
     * Take the first or last {$limit} items and return them in a new collection.
     * The items will not be removed from the original collection.
     *
     * @param int  $limit If positive, then first {$limit} items will be returned.
     *                     If negative, then last {$limit} items will be returned.
     *                     If zero, then empty collection will be returned.
     *  
     * @return CollectionInterface A new collection containing first or last {$limit} items.
     *  
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections
     *  
     * @title: Returns the first or last specified number of items in a collection in a new collection. Original collection is not modified.
     *  
     * @throws InvalidArgumentException
     */
    public function take(int $limit): CollectionInterface;

    /**
     * Pass a copy of collection to the given callback and then return $this.
     *
     * @param callable $callback a callback with the following signature: 
     *                            function(\VersatileCollections\CollectionInterface $collection):void
     * 
     * @used-for: other-operations
     * 
     * @title: Invokes a specified callback on a copy of a collection and returns the original collection.
     */
    public function tap(callable $callback): CollectionInterface;

    /**
     * Union the collection with the given items by trying to append all items 
     * from $items to $this collection and return the result in a new collection.
     * This method does not modify the original collection.
     * 
     * For keys that exist in both $items and $this, the items from $this 
     * will be used, and the matching items from $items will be ignored.
     * 
     * For example:
     *  $a = \VersatileCollections\GenericCollection::makeNew( 
     *          [ "a"=>"apple", "b"=>"banana" ]
     *      );
     * $b = [ "a"=>"pear", "b"=>"strawberry", "c"=>"cherry" ];
     * 
     * // result
     * $a->unionWith($b)->toArray() === [ "a"=>"apple", "b"=>"banana", "c"=>"cherry" ]
     * 
     * Use mergeWith() and mergeMeWith() if you want items from $items to be used
     * when same keys exist in both $items and $this.
     * 
     * @return CollectionInterface A new collection containing items in the original collection unioned with $items.
     *
     * @used-for: adding-items, creating-new-collections
     *
     * @title: Appends specified items to a collection and returns the result in a new collection. New items with the same keys as existing items will not overwrite the existing items. Original collection is not modified.
     * 
     * @see \VersatileCollections\CollectionInterface::mergeWith()
     * @see \VersatileCollections\CollectionInterface::mergeMeWith()
     */
    public function unionWith(array $items): CollectionInterface;

    /**
     * Union the collection with the given items by trying to append all items 
     * from $items to $this collection.
     * This method modifies the original collection.
     * 
     * For keys that exist in both $items and $this, the items from $this 
     * will be used, and the matching items from $items will be ignored.
     * 
     * For example:
     *  $a = \VersatileCollections\GenericCollection::makeNew( 
     *          [ "a"=>"apple", "b"=>"banana" ]
     *      );
     * $b = [ "a"=>"pear", "b"=>"strawberry", "c"=>"cherry" ];
     * 
     * // result
     * $a->unionMeWith($b)->toArray() === [ "a"=>"apple", "b"=>"banana", "c"=>"cherry" ]
     * 
     * Use mergeWith() and mergeMeWith() if you want items from $items to be used
     * when same keys exist in both $items and $this.
     * 
     * @see \VersatileCollections\CollectionInterface::mergeWith()
     * @see \VersatileCollections\CollectionInterface::mergeMeWith()
     * 
     * @used-for: adding-items
     * 
     * @title: Appends specified items to a collection. New items with the same keys as existing items will not overwrite the existing items. Original collection is modified.
     */
    public function unionMeWith(array $items): CollectionInterface;

    /**
     * Get a collection of unique items from an existing collection. The keys
     * are not preserved in the returned collection. The uniqueness test must be
     * done via strict comparison (===). 
     * 
     * Non-strict comparison is unsafe for collections containing objects, for 
     * example you can't cast an object to a double or int. To get unique items 
     * using non-strict comparison see 
     * \VersatileCollections\ScalarsCollection::uniqueNonStrict().
     * 
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, modifying-keys
     *
     * @title: Returns a new collection of unique items from an existing collection. This method uses strict comparison for testing uniqueness. The keys are not preserved in the returned collection.
     * 
     * @see \VersatileCollections\ScalarsCollection::uniqueNonStrict()
     */
    public function unique(): CollectionInterface;

    /**
     * Execute $callback on $this and return its return value if $truthy_value is truthy
     * or execute $default on $this and return its return value if $default is not null
     * or return NULL as a last resort.
     * 
     * @param bool $truthy_value
     * 
     * @param callable $callback a callback with the following signature
     *                           function(\VersatileCollections\CollectionInterface $collection): mixed
     *                           It will be invoked on the collection object from which this method
     *                           is being called.
     * 
     * @param callable|null $default a callback with the following signature
     *                               function(\VersatileCollections\CollectionInterface $collection): mixed
     *                               It will be invoked on the collection object from which this method
     *                               is being called. 
     *                               If $default is null and $truthy_value is not truthy, NULL will
     *                               be returned by this method.
     * 
     * @return mixed
     * 
     * @used-for: other-operations
     * 
     * @title: Conditionally executes a specified callback on a collection if first argument is truthy or executes a specified default callback otherwise and returns the value returned by the executed callback. If no callback could be executed, null is returned.
     * 
     * @noinspection PhpMissingParamTypeInspection
     */
    public function whenTrue($truthy_value, callable $callback, callable $default=null);
    
    /**
     * Execute $callback on $this and return its return value if $falsy_value is falsy
     * or execute $default on $this and return its return value if $default is not null
     * or return NULL as a last resort.
     * 
     * @param bool $falsy_value
     * 
     * @param callable $callback a callback with the following signature
     *                           function(\VersatileCollections\CollectionInterface $collection): mixed
     *                           It will be invoked on the collection object from which this method
     *                           is being called.
     * 
     * @param callable|null $default a callback with the following signature
     *                               function(\VersatileCollections\CollectionInterface $collection): mixed
     *                               It will be invoked on the collection object from which this method
     *                               is being called. 
     *                               If $default is null and $falsy_value is not falsy, NULL will
     *                               be returned by this method.
     * 
     * @return mixed
     * 
     * @used-for: other-operations
     * 
     * @title: Conditionally executes a specified callback on a collection if first argument is falsy or executes a specified default callback otherwise and returns the value returned by the executed callback. If no callback could be executed, null is returned.
     * 
     * @noinspection PhpMissingParamTypeInspection
     */
    public function whenFalse($falsy_value, callable $callback, callable $default=null);
    
    /**
     * Return the values from a single column in the collection.
     *  
     * Will only work on collections containing items that are 
     * arrays and/or objects.
     *  
     * Must throw an exception if either $column_key and / or $index_key 
     * contain(s) non-string and non-int value(s). 
     * NOTE: $index_key can be null, meaning that the collection returned by 
     * this method will have sequential integer keys starting at 0.
     *  
     * Must throw an exception if any item in the collection is not an array
     * or object.
     *    
     * Must throw an exception if $column_key is not a key in at least one array
     * in the collection. 
     *  
     * Must throw an exception if $column_key is not an accessible property in 
     * at least one object in the collection.
     *
     * Must throw an exception if $index_key is not null and is not a key in 
     * at least one array in the collection.
     *  
     * Must throw an exception if $index_key is not null and is not an 
     * accessible property in at least one object in the collection.
     *
     * Must throw an exception if $index_key is not null and at least one 
     * array in the collection has a non-int and non-string value for the 
     * element with key $index_key.
     *
     * Must throw an exception if $index_key is not null and at least one 
     * object in the collection has a non-int and non-string value for the
     * property named $index_key.
     *  
     * @param int|string $column_key name of field in each item to be used as values / items in the collection to be returned
     * @param int|string|null $index_key name of field in each item to be used as key in the collection to be returned.
     *                              If null, the returned collection will have sequential integer keys starting from 0.
     *                              Be aware that only string or integer values are usable as keys in the collection
     *                              to be returned by this method and as a result an exception will be thrown if any
     *                              item in the collection has a non-string and non-integer value for the field 
     *                              specified in $index_key.
     *  
     * @return GenericCollection A new collection containing the values from a single column in this collection
     *
     * @used-for: accessing-or-extracting-keys-or-items
     *  
     * @title: Returns a new collection containing the values from a specified field in each item in a collection. Corresponding keys in the returned collection could be specified as another field in each item in the collection. MUST be a collection whose items are arrays and / or objects.
     *  
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function column($column_key, $index_key=null): GenericCollection;

    /**
     * Create a new collection of the specified type with the keys and items in this collection.
     * Only keys and items will be copied into the new collection, other properties
     * of the original collection like methods added via addMethod(), 
     * addMethodForAllInstances() and addStaticMethod() will not be 
     * copied.
     * Original collection should not be modified.
     * 
     * @param string|CollectionInterface $new_collection_class name of a collection class that implements
     *                                                                               \VersatileCollections\CollectionInterface or an 
     *                                                                               instance of \VersatileCollections\CollectionInterface
     * 
     * @return CollectionInterface a new collection of the specified type
     *                                                   containing the exact same keys and items 
     *                                                   as the original collection.
     * 
     * @used-for: creating-new-collections
     *  
     * @title: Creates a new collection of the specified type with the keys and items from an existing collection. The specified collection type MUST be compatible with the existing collection's type.
     *  
     * @throws InvalidItemException if one or more items in the original collection does not satisfy
     *                                                               the specified new type. For example you cannot get a collection 
     *                                                               of Objects as a collection of Floats.
     *  
     * @throws InvalidArgumentException if $new_collection_class is not a string and is not an object
     *                                   of if $new_collection_class is not an instanceof \VersatileCollections\CollectionInterface
     */
    public function getAsNewType($new_collection_class=GenericCollection::class): CollectionInterface;

    /**
     * Remove items from the collection (whose keys are present in $keys) or (all items if $keys is empty)  and return $this.
     * 
     * @param array $keys optional array of keys for the items to be removed.
     * 
     * @used-for: deleting-items
     * 
     * @title: Removes items from a collection (whose keys are specified) or (all items if no keys were specified).
     */
    public function removeAll(array $keys=[]): CollectionInterface;

    /**
     * Return a collection of items whose keys are present in $keys.
     * Keys are preserved in the new collection.
     * 
     * Key presence is determined via strict comparison (i.e. ===)
     * 
     * @return CollectionInterface a new collection of items whose keys are present in $keys
     * 
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, finding-or-searching-for-items
     * 
     * @title: Returns a new collection of items from an existing collection whose keys are present in the specified keys.
     */
    public function getAllWhereKeysIn(array $keys): CollectionInterface;

    /**
     * Return a collection of items whose keys are not present in $keys.
     * Keys are preserved in the new collection.
     * 
     * Key presence is determined via strict comparison (i.e. ===)
     * 
     * @return CollectionInterface a new collection of items whose keys are not present in $keys
     *   
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, finding-or-searching-for-items
     * 
     * @title: Returns a new collection of items from an existing collection whose keys are not present in the specified keys.
     */
    public function getAllWhereKeysNotIn(array $keys): CollectionInterface;

    /**
     * This method assumes positions in the collection are 1-indexed rather
     * than zero-indexed. For example item 'a' in this array (['a', 'b', 'c'])
     * is at the first position as far as the documentation of this method is 
     * concerned as opposed to the zeroeth position (which is how you would
     * actually reference it php code).
     *  
     * Get a collection of at most $num_items_per_page items starting from the
     * (($page_number * $num_items_per_page) - $num_items_per_page + 1)th position
     * in the collection.
     *  
     * For example given a collection containing:
     *  
     *          [ 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h' ]
     *             ^    ^    ^    ^    ^    ^    ^    ^
     * position    1    2    3    4    5    6    7    8
     *  
     * calling paginate(2, 3) on that collection means you want to get a collection 
     * of at most 3 items starting from the (((2 * 3) - 3 + 1) == 4th) position 
     * in that collection which should return a collection containing:
     *  
     *          [ 'd', 'e', 'f' ]
     *  
     * @param int $page_number Page number.
     *                         It must be a positive integer starting from 1.
     *  
     *                         If a value less than 1 is supplied, it should 
     *                         be bumped up to 1.
     *  
     *                         If it has a value larger than the total number of 
     *                         available pages (i.e. ($this->count() / $num_items_per_page)  
     *                         assuming  1 <= $num_items_per_page <= $this->count()),
     *                         an empty collection will be returned.
     *  
     * @param int $num_items_per_page The number of items in the collection to be returned.
     *  
     *                                It must be a positive integer starting from 1.
     *  
     *                                If a value less than 1 is supplied, it should 
     *                         be bumped up to 1.
     *  
     *                                If it has a value larger than $this->count(),
     *                                all items from position $page_number in the
     *                                collection till the end of the collection 
     *                                will be returned.
     *                                                                
     * @return CollectionInterface a new collection of at most `$num_items_per_page` items present in the specified page
     *  
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections
     *  
     * @title: Returns a new collection of at most a specified number of items present in the specified page.
     */
    public function paginate(int $page_number, int $num_items_per_page): CollectionInterface;

    /**
     * Get the items in the collection that are not present in the given items.
     *
     * @param array  $items items in the collection that are not present in $items are returned by this method
     *  
     * @return CollectionInterface a new collection containing items in the collection that are not present in the given items
     *  
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, finding-or-searching-for-items
     *  
     * @title: Returns a new collection containing items in an existing collection that are not present in the specified array of items.
     */
    public function diff(array $items): CollectionInterface;

    /**
     * Get the items in the collection that are not present in the given items using a callback for the comparison.
     *
     * @param array  $items items in the collection that are not present in $items are returned by this method 
     * @param callable  $callback a callback used to check if an item in the collection is equal to an item in $item 
     *                   The function must have the following signature:
     *                   int callback ( mixed $a, mixed $b ): 
     *                   The comparison function must return an integer less than, 
     *                   equal to, or greater than zero if the first argument is 
     *                   considered to be respectively less than, equal to, 
     *                   or greater than the second.
     *  
     * @return CollectionInterface a new collection containing items in the collection that are not present in the given items
     *  
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, finding-or-searching-for-items
     *  
     * @title: Returns a new collection containing items in an existing collection that are not present in the specified array of items using a specified callback to test for item presence.
     */
    public function diffUsing(array $items, callable $callback): CollectionInterface;

    /**
     * Get the items in the collection whose keys and values are not present in the given items.
     *
     * @param array  $items items in the collection whose keys and values are not present in $items are returned by this method
     *  
     * @return CollectionInterface a new collection containing items in the collection whose keys and values are not present in the given items
     *  
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, finding-or-searching-for-items
     *  
     * @title: Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items.
     */
    public function diffAssoc(array $items): CollectionInterface;

    /**
     * Get the items in the collection whose keys and values are not present in the given items.
     *
     * @param callable  $key_comparator a callback used to check if a key for an item in the collection is equal to a key for an item in $item 
     *                   The function must have the following signature:
     *                   int callback ( mixed $a, mixed $b ): 
     *                   The comparison function must return an integer less than, 
     *                   equal to, or greater than zero if the first argument is 
     *                   considered to be respectively less than, equal to, 
     *                   or greater than the second.
     * 
     * @return CollectionInterface a new collection containing items in the collection whose keys and values are not present in the given items
     * 
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, finding-or-searching-for-items
     * 
     * @title: Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items using a callback to test for key presence.
     */
    public function diffAssocUsing(array $items, callable $key_comparator): CollectionInterface;

    /**
     * Get the items in the collection whose keys are not present in the given items.
     *
     * @param array  $items items in the collection whose keys are not present in $items are returned by this method
     *  
     * @return CollectionInterface a new collection containing items in the collection whose keys are not present in $items
     *  
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, finding-or-searching-for-items
     *  
     * @title: Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items.
     */
    public function diffKeys(array $items): CollectionInterface;

    /**
     * Get the items in the collection whose keys are not present in the given items using a callback for the key comparison.
     *
     * @param array   $items items in the collection whose keys are not present in $items are returned by this method
     * @param callable  $key_comparator a callback used to check if a key for an item in the collection is equal to a key for an item in $item 
     *                   The function must have the following signature:
     *                   int callback ( mixed $a, mixed $b ): 
     *                   The comparison function must return an integer less than, 
     *                   equal to, or greater than zero if the first argument is 
     *                   considered to be respectively less than, equal to, 
     *                   or greater than the second.
     *  
     * @return CollectionInterface a new collection containing items in the collection whose keys are not present in $items
     *  
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, finding-or-searching-for-items
     *  
     * @title: Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items using a specified callback to test for key presence.
     */
    public function diffKeysUsing(array $items, callable $key_comparator): CollectionInterface;
    
    /**
     * Iterate through a collection and execute a callback over each item (the callback
     * checks if each item satisfies one or more condition(s) and returns true if an item 
     * satisfies the condition(s) or false if not) and return true if all items satisfy 
     * the condition(s) tested in the callback or false otherwise.
     * 
     * @param callable $callback a callback with the following signature
     *                           function($key, $item):bool
     *                           It should return true if the current item `$item`
     *                           satisfies one or more condition(s) or false otherwise.
     * 
     * @param bool $bind_callback_to_this true if the variable $this inside the supplied 
     *                                    $callback should refer to the collection object
     *                                    this method is being invoked on, else false if
     *                                    you want the variable $this to be undefined 
     *                                    inside the supplied $callback.
     * 
     * @used-for: other-operations
     * 
     * @title: Iterates through a collection and executes a callback (that returns a boolean) over each item and returns true if the callback returns true for all items or false otherwise.
     */
    public function allSatisfyConditions(callable $callback, bool $bind_callback_to_this=true): bool;
    
    /**
     * Create a collection of items from the original collection whose keys are present in $arr
     * 
     * @return CollectionInterface new collection of items from the original collection whose keys are present in $arr
     * 
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, finding-or-searching-for-items
     * 
     * @title: Returns a new collection of items from an existing collection whose keys are present in an array of specified keys.
     */
    public function intersectByKeys(array $arr): CollectionInterface;

    /**
     * Create a collection of items from the original collection that are present in $arr
     * 
     * @return CollectionInterface new collection of items from the original collection that are present in $arr
     * 
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, finding-or-searching-for-items
     * 
     * @title: Returns a new collection of items from an existing collection that are present in an array of specified items.
     */
    public function intersectByItems(array $arr): CollectionInterface;

    /**
     * Create a collection of items from the original collection whose keys and corresponding items /values are present in $arr
     * 
     * @return CollectionInterface new collection of items from the original collection whose keys and corresponding items /values are present in $arr
     * 
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, finding-or-searching-for-items
     * 
     * @title: Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items.
     */
    public function intersectByKeysAndItems(array $arr): CollectionInterface;

    /**
     * Create a collection of items from the original collection whose keys are present in $arr using a callback for the key comparison
     * 
     * @param callable $key_comparator a callback used to check if a key in the collection is equal to a key in $arr 
     *                   The function must have the following signature:
     *                   int callback ( mixed $a, mixed $b ): 
     *                   The comparison function must return an integer less than, 
     *                   equal to, or greater than zero if the first argument is 
     *                   considered to be respectively less than, equal to, 
     *                   or greater than the second.
     * 
     * @return CollectionInterface new collection of items from the original collection whose keys are present in $arr
     * 
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, finding-or-searching-for-items
     * 
     * @title: Returns a new collection of items from an existing collection whose keys are present in an array of specified keys using a specified callback for testing key presence.
     */
    public function intersectByKeysUsingCallback(array $arr, callable $key_comparator): CollectionInterface;

    /**
     * Create a collection of items from the original collection that are present in $arr using a callback for the item comparison
     * 
     * @param callable $item_comparator a callback used to check if an item in the collection is equal to an item in $arr 
     *                   The function must have the following signature:
     *                   int callback ( mixed $a, mixed $b ): 
     *                   The comparison function must return an integer less than, 
     *                   equal to, or greater than zero if the first argument is 
     *                   considered to be respectively less than, equal to, 
     *                   or greater than the second.
     * 
     * @return CollectionInterface new collection of items from the original collection that are present in $arr
     * 
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, finding-or-searching-for-items
     * 
     * @title: Returns a new collection of items from an existing collection that are present in an array of specified items using a specified callback for testing item presence.
     */
    public function intersectByItemsUsingCallback(array $arr, callable $item_comparator): CollectionInterface;

    /**
     * Create a collection of items from the original collection whose keys and corresponding items /values are present in $arr  using callbacks for key and item comparisons
     * 
     * @param callable|null $key_comparator a callback used to check if a key in the collection is equal to a key in $arr
     *                   The function must have the following signature:
     *                   int callback ( mixed $a, mixed $b ):
     *                   The comparison function must return an integer less than,
     *                   equal to, or greater than zero if the first argument is
     *                   considered to be respectively less than, equal to,
     *                   or greater than the second.
     *
     * @param callable|null $item_comparator a callback used to check if an item in the collection is equal to an item in $arr
     *                   The function must have the following signature:
     *                   int callback ( mixed $a, mixed $b ):
     *                   The comparison function must return an integer less than,
     *                   equal to, or greater than zero if the first argument is
     *                   considered to be respectively less than, equal to,
     *                   or greater than the second.
     *
     *                   !is_null($key_comparator) && is_null($item_comparator) use array_intersect_uassoc
     *                   is_null($key_comparator) && !is_null($item_comparator) use array_uintersect_assoc
     *                   !is_null($key_comparator) && !is_null($item_comparator) use array_uintersect_uassoc
     *                   is_null($key_comparator) && is_null($item_comparator) use array_intersect_assoc
     *
     * @return CollectionInterface new collection of items from the original collection whose keys and corresponding items /values are present in $arr
     *
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, finding-or-searching-for-items
     *
     * @title: Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items using one specified callback for testing key presence and another specified callback for testing item presence.
     */
    public function intersectByKeysAndItemsUsingCallbacks(array $arr, callable $key_comparator=null, callable $item_comparator=null): CollectionInterface;
}
