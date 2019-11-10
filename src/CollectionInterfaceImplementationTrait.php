<?php
namespace VersatileCollections;

/**
 *
 * Below is a list of acceptable value(s), that could be comma separated, 
 * for the @used-for tag in phpdoc blocks for public methods in this trait:
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
 * @author aadegbam
 */
trait CollectionInterfaceImplementationTrait {

    /**
     *
     * @var array
     * 
     */
    protected $versatile_collections_items = [];
    
    /**
     *
     * @var array
     * 
     */
    protected static $versatile_collections_methods_for_all_instances = [];

    /**
     *
     * @var array
     * 
     */
    protected $versatile_collections_methods_for_this_instance = [];

    /**
     *
     * @var array
     * 
     */
    protected static $versatile_collections_static_methods = [];
    
    protected static function validateMethodName($name, $method_name_was_passed_to, $class_in_which_method_was_called=null) {
        
        $regex_4_valid_method_name = '/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/';
        
        if( !is_string($name)) {
            
            $class = 
                (!is_null($class_in_which_method_was_called) && is_string($class_in_which_method_was_called))
                    ? $class_in_which_method_was_called : static::class;
            
            $function = $method_name_was_passed_to;
            $name_type = gettype($name);
            $msg = "Error [{$class}::{$function}(...)]: Trying to add a dynamic method with an invalid name of type `{$name_type}` to a collection"
                . PHP_EOL . " `\$name`: " . var_to_string($name);
            
            throw new \InvalidArgumentException($msg);
            
        } else if( 
            !preg_match( $regex_4_valid_method_name, preg_quote($name, '/') ) 
        ) {
            // A valid php class' method name starts with a letter or underscore, 
            // followed by any number of letters, numbers, or underscores.

            // Make sure the controller name is a valid string usable as a class name
            // in php as defined in http://php.net/manual/en/language.oop5.basic.php
            $class = 
                (!is_null($class_in_which_method_was_called) && is_string($class_in_which_method_was_called))
                    ? $class_in_which_method_was_called : static::class;
            
            $function = $method_name_was_passed_to;
            $name_var = var_to_string($name);
            $msg = "Error [{$class}::{$function}(...)]: Trying to add a dynamic method with an invalid name `{$name_var}` to a collection";
            
            throw new \InvalidArgumentException($msg);
            
        } else if( is_string($name) && method_exists(static::class, $name) ) {
            
            // valid method name was supplied but conflicts with an
            // already defined real class method
            $class = 
                (!is_null($class_in_which_method_was_called) && is_string($class_in_which_method_was_called))
                    ? $class_in_which_method_was_called : static::class;
            
            $function = $method_name_was_passed_to;
            $msg = "Error [{$class}::{$function}(...)]: Trying to add a dynamic method with the same name `{$name}` as an existing actual method to a collection";
            
            throw new Exceptions\AddConflictingMethodException($msg);
        }
        
        return true;
    }
    
    /**
     * 
     * @param string $name name of the method being added
     * @param callable $callable method being added
     * @param bool $has_return_val true means $callable returns a value, else false if $callable returns no value
     * 
     * @used-for: adding-methods-at-runtime
     * 
     * @title: Registers a specified `callable` with a specified name to a Collection class, so that the registered callable can be later called as a static method with the specified name on the Collection class or any of its sub-classes.
     * 
     */
    public static function addStaticMethod(
        $name, 
        callable $callable, 
        $has_return_val=false
    ) {
        if( static::validateMethodName($name, __FUNCTION__) ) {
            
            static::$versatile_collections_static_methods[ static::class.'::'. $name] = [
                'method' => $callable,
                'has_return_val' => ((bool)$has_return_val)
            ];
        }
    }
    
    /**
     * 
     * @param string $name name of the method being added
     * @param callable $callable method being added
     * @param bool $has_return_val true means $callable returns a value, else false if $callable returns no value
     * @param bool $bind_to_this_on_invocation true means $callable will be bound to $this before invocation, else false if $callable should not be explicitly bound to $this before invocation
     * 
     * @used-for: adding-methods-at-runtime
     * 
     * @title: Registers a specified `callable` with a specified name to a Collection class, so that the registered callable can be later called as an instance method with the specified name on any instance of the Collection class or any of its sub-classes.
     * 
     */
    public static function addMethodForAllInstances(
        $name, 
        callable $callable, 
        $has_return_val=false,
        $bind_to_this_on_invocation=true
    ) {
        if( static::validateMethodName($name, __FUNCTION__) ) {
            
            static::$versatile_collections_methods_for_all_instances[ static::class.'::'. $name] = [
                'method' => $callable,
                'has_return_val' => ((bool)$has_return_val),
                'bind_to_this_on_invocation' => ((bool)$bind_to_this_on_invocation)
            ];
        }
    }
    
    /**
     * 
     * @param string $name name of the method being added
     * @param callable $callable method being added
     * @param bool $has_return_val true means $callable returns a value, else false if $callable returns no value
     * @param bool $bind_to_this true means $callable will be bound to $this, else false if $callable should not be explicitly bound to $this
     * 
     * @used-for: adding-methods-at-runtime
     * 
     * @title: Registers a specified `callable` with a specified name to a single instance of a Collection class, so that the registered callable can be later called as an instance method with the specified name on the instance of the Collection class the callable was registered to.
     * 
     * @return $this
     * 
     */
    public function addMethod(
        $name, 
        callable $callable, 
        $has_return_val=false,
        $bind_to_this=true
    ) {
        if( static::validateMethodName($name, __FUNCTION__, get_class($this)) ) {
            
            if( ((bool)$bind_to_this) && Utils::canReallyBind($callable) ) {

                $callable = Utils::bindObjectAndScopeToClosure(
                    Utils::getClosureFromCallable($callable), 
                    $this
                );
            }
            
            $this->versatile_collections_methods_for_this_instance[ static::class.'::'. $name] = [
                'method' => $callable,
                'has_return_val' => ((bool)$has_return_val)
            ];
        }
        
        return $this;
    }
    
    protected static function getKeyForDynamicMethod($name, array &$methods_array, $search_parent_class_registration=true) {
        
        if( array_key_exists( static::class.'::'.$name , $methods_array) ) {
            
            return static::class.'::'.$name;
        }
        
        if( ((bool)$search_parent_class_registration) === true ) {
            
            $parent_class = get_parent_class(static::class);

            while( $parent_class !== false ) {

                if( array_key_exists( $parent_class.'::'.$name , $methods_array) ) {

                    return $parent_class.'::'.$name;
                }

                $parent_class = get_parent_class($parent_class);
            }
        }
        
        return false;
    }
    
    /**
     * 
     * @param string $method_name
     * @param array $arguments
     * 
     * @return mixed
     * 
     * @used-for: other-operations
     * 
     * @title: Tries to call the specified method with the specified arguments and return its return value if it was registered via either `addMethod` or `addMethodForAllInstances` . An exception of type **\BadMethodCallException** is thrown if the method could not be called.
     * 
     * @throws \BadMethodCallException
     * 
     */
    public function __call($method_name, $arguments) {
        
        $key_for_this_instance = static::getKeyForDynamicMethod($method_name, $this->versatile_collections_methods_for_this_instance, false);
        $key_for_all_instances = static::getKeyForDynamicMethod($method_name, static::$versatile_collections_methods_for_all_instances);
        
        if ( $key_for_this_instance !== false ) {
            
            $result = call_user_func_array($this->versatile_collections_methods_for_this_instance[$key_for_this_instance]['method'], $arguments);
            
            if( $this->versatile_collections_methods_for_this_instance[$key_for_this_instance]['has_return_val'] ) {
                
                return $result;
            }
        
        } else if( $key_for_all_instances !== false ) {
            
            $new_callable = static::$versatile_collections_methods_for_all_instances[$key_for_all_instances]['method'];
            
            if( 
                ((bool)static::$versatile_collections_methods_for_all_instances[$key_for_all_instances]['bind_to_this_on_invocation'])
                && Utils::canReallyBind($new_callable)    
            ) {
                
                $new_callable = Utils::bindObjectAndScopeToClosure(
                    Utils::getClosureFromCallable($new_callable), 
                    $this
                );
            }

            $result = call_user_func_array($new_callable, $arguments);

            if( static::$versatile_collections_methods_for_all_instances[$key_for_all_instances]['has_return_val'] ) {

                return $result;
            }
            
        } else {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $name_var = var_to_string($method_name);
            $msg = "Error [{$class}::{$function}(...)]: Trying to call a non-existent dynamic method named `{$name_var}` on a collection";
            throw new \BadMethodCallException($msg);
        }
    }
    
    /**
     * 
     * @param string $method_name
     * @param array $arguments
     * 
     * @return mixed
     * 
     * @used-for: other-operations
     * 
     * @title: Tries to call the specified method with the specified arguments and return its return value if it was registered via `addStaticMethod`. An exception of type **\BadMethodCallException** is thrown if the method could not be called.
     * 
     * @throws \BadMethodCallException
     * 
     */
    public static function __callStatic($method_name, $arguments) {
        
        $key_for_static_method = static::getKeyForDynamicMethod($method_name, static::$versatile_collections_static_methods);
        
        if( $key_for_static_method !== false ) {
            
            // never bind to this when method is called statically            
            $result = call_user_func_array(
                static::$versatile_collections_static_methods[$key_for_static_method]['method'], $arguments
            );
            
            if( static::$versatile_collections_static_methods[$key_for_static_method]['has_return_val'] ) {
                
                return $result;
            }
            
        } else {
            
            $function = __FUNCTION__;
            $class = static::class;
            $name_var = var_to_string($method_name);
            $msg = "Error [{$class}::{$function}(...)]: Trying to statically call a non-existent dynamic method named `{$name_var}` on a collection";
            throw new \BadMethodCallException($msg);
        }
    }
    
    public function __get(string $key) {
        
        return $this->offsetGet($key);
    }
    
    public function __isset(string $key) {
        
        return $this->offsetExists($key);
    }
    
    public function __set(string $key, $val) {
        
        $this->offsetSet($key, $val);
    }
    
    public function __unset(string $key) {
        
        $this->offsetUnset($key);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::makeNew()
     * 
     */
    public static function makeNew(array $items=[], bool $preserve_keys=true): \VersatileCollections\CollectionInterface {

        if ($preserve_keys === true) {
       
            $collection = new static();

            foreach ($items as $key => $item ) {

                $collection[$key] = $item;
            }

            return $collection;
        }
        
        // I use array_values to ensure that all keys 
        // are numeric. Argument unpacking does not
        // work on arrays with one or more string keys.
        return new static(...array_values($items)); // This should be faster than loop above
                                                    // since looping triggers offsetSet()
                                                    // for each item
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::offsetExists()
     * 
     */
    public function offsetExists($key): bool {
        
        return array_key_exists($key, $this->versatile_collections_items);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::offsetGet()
     * 
     */
    public function offsetGet($key) {
        
        if ( array_key_exists($key, $this->versatile_collections_items) ) {

            return $this->versatile_collections_items[$key];
            
        } else {

            throw new \VersatileCollections\Exceptions\NonExistentItemException(get_class($this)."::offsetGet({$key})");
        }
    }

    /**
     * 
     * @see \VersatileCollections\CollectionInterface::offsetSet()
     * 
     */
    public function offsetSet($key, $val): void {
        
        if(is_null($key) ) {
            
            $this->versatile_collections_items[] = $val;
            
        } else {
            
            $this->versatile_collections_items[$key] = $val;
        }
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::offsetUnset()
     * 
     */
    public function offsetUnset($key): void {
        
        $this->versatile_collections_items[$key] = null;
        unset($this->versatile_collections_items[$key]);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::toArray()
     * 
     */
    public function toArray(): array {

        return $this->versatile_collections_items;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::getIterator()
     * 
     */
    public function getIterator(): \Iterator {

        return new \ArrayIterator($this->versatile_collections_items);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::count()
     * 
     */
    public function count(): int {
        
        return count($this->versatile_collections_items);
    }

    public function __construct(...$items) {

        $this->versatile_collections_items = $items;
    }
    
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    ////////// OTHER COLLECTION METHODS ////////////////////////////////////////
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::firstItem()
     * 
     */
    public function firstItem(){
        
        if( $this->count() <= 0 ) { return null; }
        
        return $this->versatile_collections_items[array_key_first($this->versatile_collections_items)];
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::lastItem()
     * 
     */
    public function lastItem(){
        
        if( $this->count() <= 0 ) { return null; }
                
        return $this->versatile_collections_items[array_key_last($this->versatile_collections_items)];
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::getKeys()
     * 
     */
    public function getKeys(): \VersatileCollections\GenericCollection {
        
        return \VersatileCollections\GenericCollection::makeNew( array_keys($this->versatile_collections_items) );
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::setValForEachItem()
     * 
     */
    public function setValForEachItem(string $field_name, $field_val, bool $add_field_if_not_present=false): \VersatileCollections\CollectionInterface {
        
        foreach ($this->versatile_collections_items as &$item) {
            
            if( 
                is_object($item)
                && !($item instanceof \ArrayAccess)
                && 
                ( 
                    $add_field_if_not_present 
                    || 
                    object_has_property($item, $field_name) 
                    || 
                    (
                        method_exists($item, '__set')
                        && method_exists($item, '__get')
                        && method_exists($item, '__isset')
                        && isset($item->{$field_name})    
                    )
                )
            ) {
                $item->{$field_name} = $field_val;
                
            } else if(
                is_array($item)
                && ( $add_field_if_not_present  || array_key_exists($field_name, $item) )
            ) {
                $item[$field_name] = $field_val;
                
            } else if(
                $item instanceof \ArrayAccess
                && ( $add_field_if_not_present  || $item->offsetExists($field_name) )
            ) {
                $item->offsetSet($field_name, $field_val);
                
            } else {
                
                $class = get_class($this);
                $function = __FUNCTION__;
                $msg = "Error [{$class}::{$function}(...)]:Trying to set a property named `$field_name` on a collection item of type "
                    . "`". gettype($item)."` "
                    . PHP_EOL . " `\$field_val`: " . var_to_string($field_val)
                    . PHP_EOL . " `\$add_field_if_not_present`: " . var_to_string($add_field_if_not_present);
                
                throw new Exceptions\InvalidCollectionOperationException($msg);
            }
            
        } // foreach ($this->collection_items as &$item)
        
        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::filterAll()
     * 
     */
    public function filterAll(callable $filterer, bool $copy_keys=false, bool $bind_callback_to_this=true, bool $remove_filtered_items=false): \VersatileCollections\CollectionInterface {
                
        return $this->filterFirstN($filterer, $this->count(), $copy_keys, $bind_callback_to_this, $remove_filtered_items);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::filterFirstN()
     * 
     */
    public function filterFirstN(callable $filterer, ?int $max_number_of_filtered_items_to_return =null, bool $copy_keys=false, bool $bind_callback_to_this=true, bool $remove_filtered_items=false): \VersatileCollections\CollectionInterface {
        
        if( $bind_callback_to_this === true && Utils::canReallyBind($filterer) ) {
            
            $filterer = Utils::bindObjectAndScopeToClosure(
                Utils::getClosureFromCallable($filterer), 
                $this
            );
        }
        
        $filtered_items = static::makeNew();
        
        if( 
            is_null($max_number_of_filtered_items_to_return)
            || ((int)$max_number_of_filtered_items_to_return) > $this->count()
            || ((int)$max_number_of_filtered_items_to_return) < 0
            || !is_numeric($max_number_of_filtered_items_to_return)
        ) {
            $max_number_of_filtered_items_to_return = $this->count();
        }
        
        $num_filtered_items = 0;
        
        foreach ( $this->versatile_collections_items as $key => $item ) {
            
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
                
                if( ((bool)$remove_filtered_items) ) {
                    
                    unset($this->versatile_collections_items[$key]);
                }
            }
            
        } // foreach ( $this->collection_items as $key => $item )
        
        return $filtered_items;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::transform()
     * 
     */
    public function transform(callable $transformer, bool $bind_callback_to_this=true): \VersatileCollections\CollectionInterface {
        
        if( $bind_callback_to_this === true && Utils::canReallyBind($transformer) ) {
            
            $transformer = Utils::bindObjectAndScopeToClosure(
                Utils::getClosureFromCallable($transformer), 
                $this
            );
        }
        
        foreach ( $this->versatile_collections_items as $key => $item ) {
            
            // using $this[$key] instead of $this->collection_items[$key]
            // so that $this->offsetSet(...) will be invoked which will
            // trigger type-checking in sub-classes like StrictlyTypedCollection
            $this[$key] = $transformer($key, $item);
            
        } // foreach ( $this->collection_items as $key => $item )
        
        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::reduce()
     * 
     */
    public function reduce(callable $reducer, $initial_value=NULL) {
        
        return array_reduce($this->versatile_collections_items, $reducer, $initial_value);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::reduceWithKeyAccess()
     * 
     */
    public function reduceWithKeyAccess(callable $reducer, $initial_value=NULL) {
        
        $reduced_result = $initial_value;
        
        foreach ($this->versatile_collections_items as $key=>$item) {
            
            $reduced_result = $reducer($reduced_result, $item, $key);
        }
        
        return $reduced_result;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::reverse()
     * 
     */
    public function reverse(): \VersatileCollections\CollectionInterface {
        
        return static::makeNew(
            array_reverse($this->versatile_collections_items, true)
        );
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::reverseMe()
     * 
     */
    public function reverseMe(): \VersatileCollections\CollectionInterface {
        
        $this->versatile_collections_items = 
            array_reverse($this->versatile_collections_items, true);
        
        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::slice()
     * 
     */
    public function slice($offset, $length = null) {
        
        if( !is_int($offset) ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $offset_type = gettype($offset);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You must specify a valid integer as the offset."
            . " You supplied a(n) `{$offset_type}` with a value of: ". var_to_string($offset);
            throw new \InvalidArgumentException($msg); 
        }
        
        if( !is_null($length) && !is_int($length) ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $length_type = gettype($length);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You must specify a valid integer as the length."
            . " You supplied a(n) `{$length_type}` with a value of: ". var_to_string($length);
            throw new \InvalidArgumentException($msg); 
        }
        
        return static::makeNew(
            array_slice($this->versatile_collections_items, $offset, $length, true)
        );
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::isEmpty()
     * 
     */
    public function isEmpty(): bool {
        
        return ($this->count() <= 0);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::getIfExists()
     * 
     */
    public function getIfExists($key, $default_value=null) {
        
        if( !is_int($key) && !is_string($key) ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $key_type = gettype($key);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You must specify an integer or string as the \$key parameter."
            . " You supplied a(n) `{$key_type}` with a value of: ". var_to_string($key);
            throw new \InvalidArgumentException($msg); 
        }
        
        return array_key_exists($key, $this->versatile_collections_items) 
                ?  $this->versatile_collections_items[$key] : $default_value;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::containsItem()
     * 
     */
    public function containsItem($item): bool {
        
        return in_array($item, $this->versatile_collections_items, true);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::containsKey()
     * 
     */
    public function containsKey($key): bool {
        
        if( !is_int($key) && !is_string($key) ) {
            
            return false; 
        }
        
        return array_key_exists($key, $this->versatile_collections_items);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::containsItemWithKey()
     * 
     */
    public function containsItemWithKey($key, $item): bool {
        
        if( !is_int($key) && !is_string($key) ) {
            
            return false; 
        }
        
        return $this->containsKey($key) 
                && $item === $this->versatile_collections_items[$key];
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::containsItems()
     * 
     */
    public function containsItems(array $items): bool {
        
        $all_items_exist = count($items) > 0;
        
        foreach ($items as $item) {
            
            $all_items_exist = $all_items_exist && $this->containsItem($item);
            
            if( $all_items_exist === false ) {
                
                break;
            }
        }
        
        return $all_items_exist;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::containsKeys()
     * 
     */
    public function containsKeys(array $keys): bool {
        
        $all_keys_exist = count($keys) > 0;
        
        foreach ($keys as $key) {
            
            $all_keys_exist = $all_keys_exist && $this->containsKey($key);
            
            if( $all_keys_exist === false ) {
                
                break;
            }
        }
        
        return $all_keys_exist;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::appendCollection()
     * 
     */
    public function appendCollection(CollectionInterface $other): \VersatileCollections\CollectionInterface {
        
        if( ! $other->isEmpty() ) {
            
            foreach ($other as $item) {
                
                $this[] = $item;
            }
        }
        
        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::appendItem()
     * 
     */
    public function appendItem($item): \VersatileCollections\CollectionInterface {
        
        $this[] = $item;
        
        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::mergeWith()
     * 
     */
    public function mergeWith(array $items) {
        
        $copy = $this->versatile_collections_items;
        $merged_items = static::makeNew($copy);
        
        if( count($items) > 0 ) {
            
            // not using array_merge , want to trigger $merged_items->offsetSet() logic
            foreach ( $items as $key => $item ) {
                
                $merged_items[$key] = $item;
            }
        }
        
        return $merged_items;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::mergeMeWith()
     * 
     */
    public function mergeMeWith(array $items) {
        
        if( count($items) > 0 ) {
            
            // not using array_merge , want to trigger $this->offsetSet() logic
            foreach ( $items as $key => $item ) {
                
                $this[$key] = $item;
            }
        }
        
        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::prependCollection()
     * 
     */
    public function prependCollection(CollectionInterface $other): \VersatileCollections\CollectionInterface {
        
        if( ! $other->isEmpty() ) {
            
            array_unshift($this->versatile_collections_items, ...array_values($other->toArray()));
        }
        
        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::prependItem()
     * 
     */
    public function prependItem($item, $key=null) {
        
        if( is_null($key) ) {
            
            array_unshift($this->versatile_collections_items, $item);
            
        } else if( is_string($key) || is_int($key) ) {
            
            $this->versatile_collections_items = [$key=>$item] + $this->versatile_collections_items;
            
        } else {
            
            $class = get_class($this);
            $function = __FUNCTION__;
            $msg = "Error [{$class}::{$function}(...)]:Trying prepend an item with a non-integer and non-string key on a collection. "
                . PHP_EOL . " `\$key`: " . var_to_string($key)
                . PHP_EOL . " `\$item`: " . var_to_string($item);
            
            throw new Exceptions\InvalidKeyException($msg);
        }
        
        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::getCollectionsOfSizeN()
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
        
        $collections = \VersatileCollections\GenericCollection::makeNew();
        $current_batch = static::makeNew();
        $result = [];
        $counter = 0;
        
        foreach ($this->versatile_collections_items as $key=>$item) {
            
            $current_batch[$key] = $item;
            
            if( ++$counter >= $max_size_of_each_collection ) {
                
                $collections[] = $current_batch;
                $counter = 0; // reset
                $current_batch = static::makeNew(); // initialize next collection
            }
        }

        // yield last batch if not already yielded
        if( !$current_batch->isEmpty() ) {
            
            $collections[] = $current_batch;
        }
        
        return $collections;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::yieldCollectionsOfSizeN()
     * 
     */
    public function yieldCollectionsOfSizeN($max_size_of_each_collection=1) {
        
        if(
            ((int)$max_size_of_each_collection) > $this->count()
            || ((int)$max_size_of_each_collection) < 0
            || !is_numeric($max_size_of_each_collection)
        ) {
            $max_size_of_each_collection = 1;
            
        } else if( is_float($max_size_of_each_collection) ) {
            
            $max_size_of_each_collection = 
                (int)$max_size_of_each_collection;
        }
        
        $current_batch = static::makeNew();
        $result = [];
        $counter = 0;
        
        foreach ($this->versatile_collections_items as $key=>$item) {
            
            $current_batch[$key] = $item;
            
            if( ++$counter >= $max_size_of_each_collection ) {
                
                yield $current_batch;
                $counter = 0; // reset
                $current_batch = static::makeNew(); // initialize next collection
            }
        }

        // yield last batch if not already yielded
        if( !$current_batch->isEmpty() ) {
            
            yield $current_batch;
        }
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::makeAllKeysNumeric()
     * 
     */
    public function makeAllKeysNumeric($starting_key=0) {
        
        if( !is_int($starting_key) ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $starting_key_type = gettype($starting_key);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You must specify an integer or string as the \$starting_key parameter."
            . " You supplied a(n) `{$starting_key_type}` with a value of: ". var_to_string($starting_key);
            throw new \InvalidArgumentException($msg); 
        }
        
        if( $starting_key < 0 ) {
            
            $starting_key = 0;
        }
        
        if( $starting_key === 0 ) {
        
            $this->versatile_collections_items = 
                array_values($this->versatile_collections_items);
            
        } else {
            
            $this->versatile_collections_items = 
                array_combine(
                    range($starting_key, ( ($starting_key + $this->count()) - 1) ), 
                    array_values($this->versatile_collections_items)
                );
        }
        
        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::each()
     * 
     */
    public function each(
        callable $callback, $termination_value=false, $bind_callback_to_this=true
    ) {
        if( $bind_callback_to_this === true && Utils::canReallyBind($callback) ) {
            
            $callback = Utils::bindObjectAndScopeToClosure(
                Utils::getClosureFromCallable($callback), 
                $this
            );
        }
        
        foreach ($this->versatile_collections_items as $key => $item) {
        
            if ( $callback($key, $item) === $termination_value ) {
                
                break;
            }
        }
        
        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::map()
     * 
     */
    public function map(
        callable $callback, $preserve_keys = true, $bind_callback_to_this=true
    ) {    
        if( $bind_callback_to_this === true && Utils::canReallyBind($callback) ) {
            
            $callback = Utils::bindObjectAndScopeToClosure(
                Utils::getClosureFromCallable($callback), 
                $this
            );
        }
        
        $new_collection = static::makeNew();
        
        foreach ( $this->versatile_collections_items as $key => $item ) {
            
            // using $new_collection[$key] or $new_collection[]
            // so that $new_collection->offsetSet(...) will be invoked which will
            // trigger type-checking in sub-classes like StrictlyTypedCollection
            
            if( $preserve_keys === true ) {
                
                $new_collection[$key] = $callback($key, $item);
                
            } else {
                
                $new_collection[] = $callback($key, $item);
            }
            
        } // foreach ( $this->collection_items as $key => $item )
        
        return $new_collection;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::everyNth()
     * 
     */
    public function everyNth($n, $position_of_first_nth_item = 0) {
        
        $new = static::makeNew();
        $iteration_counter = 0;

        foreach ($this->versatile_collections_items as $item) {
            
            if ( ($iteration_counter % $n) === $position_of_first_nth_item ) {
                
                $new[] = $item;
            }

            $iteration_counter++;
        }

        return $new;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::pipeAndReturnCallbackResult()
     * 
     */
    public function pipeAndReturnCallbackResult(callable $callback) {
        
        return $callback($this);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::pipeAndReturnSelf()
     * 
     */
    public function pipeAndReturnSelf(callable $callback) {
        
        $callback($this);
        
        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::tap()
     * 
     */
    public function tap(callable $callback) {
        
        $callback(static::makeNew($this->versatile_collections_items));

        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::getAndRemoveFirstItem()
     * 
     */  
    public function getAndRemoveFirstItem() {
        
        return array_shift($this->versatile_collections_items);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::getAndRemoveLastItem()
     * 
     */
    public function getAndRemoveLastItem()
    {
        return array_pop($this->versatile_collections_items);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::pull()
     * 
     */
    public function pull($key, $default = null) {

        $item = $this->getIfExists($key, $default);
        
        unset($this[$key]);
        
        return $item;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::push()
     * 
     */
    public function push($item) {
        
        return $this->appendItem($item);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::put()
     * 
     */
    public function put($key, $value) {
        
        $this->offsetSet($key, $value);
        
        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::randomKey()
     * 
     */
    public function randomKey() {
        
        if( $this->count() <= 0 ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $msg = "Error [{$class}::{$function}(...)]: You cannot request a random key from an empty collection.";
            throw new \LengthException($msg);
        }
        
        return random_array_key($this->versatile_collections_items);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::randomItem()
     * 
     */
    public function randomItem() {
        
        if( $this->count() <= 0 ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $msg = "Error [{$class}::{$function}(...)]: You cannot request a random item from an empty collection.";
            throw new \LengthException($msg);
        }
        
        return $this[$this->randomKey()];
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::randomKeys()
     * 
     */
    public function randomKeys($number = 1) {
        
        if( $this->count() <= 0 ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $msg = "Error [{$class}::{$function}(...)]: You cannot request random keys from an empty collection.";
            throw new \LengthException($msg);
        }
        
        if( !is_int($number) ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $number_type = gettype($number);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You must specify a valid integer as the number of random keys."
            . " You supplied a(n) `{$number_type}` with a value of: ". var_to_string($number);
            throw new \InvalidArgumentException($msg); 
        }
        
        if( is_int($number) && $number > $this->count() ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You requested {$number} key(s), but there are only {$this->count()} keys available.";
            throw new \InvalidArgumentException($msg); 
        }
        
        $keys = random_array_keys($this->versatile_collections_items, $number);

        // keys could be strings or ints or a mix
        // GenericCollection will allow both types
        return \VersatileCollections\GenericCollection::makeNew($keys); 
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::randomItems()
     * 
     */
    public function randomItems($number = 1, $preserve_keys=false) {
        
        if( $this->count() <= 0 ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $msg = "Error [{$class}::{$function}(...)]: You cannot request random items from an empty collection.";
            throw new \LengthException($msg);
        }
        
        if( !is_int($number) ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $number_type = gettype($number);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You must specify a valid integer as the number of random items."
            . " You supplied a(n) `{$number_type}` with a value of: ". var_to_string($number);
            throw new \InvalidArgumentException($msg); 
        }
        
        if( is_int($number) && $number > $this->count() ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You requested {$number} item(s), but there are only {$this->count()} items available.";
            throw new \InvalidArgumentException($msg); 
        }
        
        $random_items = static::makeNew();
        $random_keys = $this->randomKeys($number);
        
        foreach ($random_keys as $random_key) {
            
            if( ((bool)$preserve_keys) ) {
                
                $random_items[$random_key] = $this[$random_key];
                
            } else {
                
                $random_items[] = $this[$random_key];
            }
        }
        
        return $random_items;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::shuffle()
     * 
     */   
    public function shuffle($preserve_keys=true) {
                
        if( $this->isEmpty() ) {
            
            return static::makeNew();
        }
        
        $shuffled_collection = static::makeNew();
        
        // Decided to use $this->randomKeys() instead of php's
        // native shuffle(array &$array) since $this->randomKeys() uses 
        // random_array_keys(...) which uses the more cryptographically
        // secure random_int(...) under the hood.
        $all_keys_randomized = $this->randomKeys($this->count());
        
        foreach ($all_keys_randomized as $current_random_key) {
            
            if( ((bool) $preserve_keys) ) {
                
                $shuffled_collection[$current_random_key] = $this[$current_random_key];
                
            } else {
                
                $shuffled_collection[] = $this[$current_random_key];
            }
        }
        
        return $shuffled_collection;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::searchByVal()
     * 
     */    
    public function searchByVal( $value, $strict = false ) {
        
        return array_search($value, $this->versatile_collections_items, $strict);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::searchAllByVal()
     * 
     */  
    public function searchAllByVal( $value, $strict = false ){
        
        $result = array_keys($this->versatile_collections_items, $value, $strict);
        
        if( is_array($result) && count($result) <= 0 ) {
            
            $result = false;
        }
        
        return $result;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::searchByCallback()
     * 
     */  
    public function searchByCallback(callable $callback, $bind_callback_to_this=true) {
        
        $results = [];
        
        $searcher = function($key, $item) use ($callback, &$results) {
            
            if( $callback($key, $item) === true ) {
                
                $results[] = $key;
            }
        };
        
        // using 9999 as termination value since $callback is only ever 
        // expected to return true or false, which means each will not
        // terminate until iteration is fully completed.
        $this->each($searcher, 9999, $bind_callback_to_this);
        
        return count($results) > 0 ? $results : false;
    }

    protected function performSort(
        array &$items_to_sort, 
        callable $callable=null, 
        \VersatileCollections\SortType $type=null, 
        $sort_function_name_not_requiring_callback='asort',
        $sort_function_name_requiring_callback='uasort'
    ) {    
        if( is_null($callable) ) {
            
            $sort_type = SORT_REGULAR;
            
            if( !is_null($type) ) {
                
                $sort_type = $type->getSortType();
            }
            
            $sort_function_name_not_requiring_callback($items_to_sort, $sort_type);
            
        } else {
            
            $sort_function_name_requiring_callback($items_to_sort, $callable);
        }
    }

    protected function performMultiSort(array $array_to_be_sorted, \VersatileCollections\MultiSortParameters ...$param) {
        
        $multi_sort_args = [];
        $columns_to_sort_by = [];
        
        $original_key_tracker = 'http_versatile_collections_dot_com_original_key_b4_sort';
        
        foreach( $array_to_be_sorted as $key => $item) {
            
            if( is_array($item) || $item instanceof \ArrayAccess ) {
                
                $array_to_be_sorted[$key][$original_key_tracker] = $key;
                
                foreach($param as $current_param) {
                    
                    if( !array_key_exists($current_param->getFieldName() , $columns_to_sort_by) ) {
                        
                        $columns_to_sort_by[$current_param->getFieldName()] = [];
                    }
                    
                    $columns_to_sort_by[$current_param->getFieldName()][$key] 
                                        = $item[$current_param->getFieldName()];
                }
                
            } else if ( is_object($item) /*a non ArrayAccess object*/ ) {
                
                $array_to_be_sorted[$key]->$original_key_tracker = $key;
                
                foreach($param as $current_param) {
                    
                    if( !array_key_exists($current_param->getFieldName() , $columns_to_sort_by) ) {
                        
                        $columns_to_sort_by[$current_param->getFieldName()] = [];
                    }
                    
                    // get the field's value even if it's private or protected
                    $columns_to_sort_by[$current_param->getFieldName()][$key] 
                        = get_object_property_value($item, $current_param->getFieldName(), null, true);                    
                }
                
            } else {
                
                $function = __FUNCTION__;
                $class = get_class($this);
                $msg = "Error [{$class}::{$function}(...)]:"
                . " {$class}::{$function}(...) does not work with collections containing items that are"
                . " not associative arrays or instances of ArrayAccess.";
                throw new \RuntimeException($msg);
            }
        }
        
        foreach($param as $current_param) {
            
            // set column
            $multi_sort_args[] = $columns_to_sort_by[$current_param->getFieldName()];
            
            // set sort direction
            $multi_sort_args[] = $current_param->getSortDirection();
            
            // set sort type
            $multi_sort_args[] = $current_param->getSortType();
        }
        
        // last parameter is the array to be sorted
        $multi_sort_args[] = &$array_to_be_sorted;
        
        call_user_func_array("array_multisort", $multi_sort_args);
        
        $sorted_array_with_unpreserved_keys = array_pop($multi_sort_args);
        
        // Restore original key associations
        $sorted_array_with_preserved_keys = [];

        foreach( $sorted_array_with_unpreserved_keys as $array_key => $current_array_data ) {

            $original_key = 
                (
                    is_array($sorted_array_with_unpreserved_keys[$array_key])
                    || $sorted_array_with_unpreserved_keys[$array_key] instanceof \ArrayAccess
                )
                ? $sorted_array_with_unpreserved_keys[$array_key][$original_key_tracker] // array / ArrayAccess
                : $sorted_array_with_unpreserved_keys[$array_key]->$original_key_tracker // object
                ;
            
            // Remove the key we added in this method 
            // to keep track of the original key of each array item / object
            if(
                is_array($sorted_array_with_unpreserved_keys[$array_key])
                || $sorted_array_with_unpreserved_keys[$array_key] instanceof \ArrayAccess        
            ) {
                // array / ArrayAccess
                unset($sorted_array_with_unpreserved_keys[$array_key][$original_key_tracker]);
                
            } else {
                
                // object
                unset($sorted_array_with_unpreserved_keys[$array_key]->$original_key_tracker);
            }
            
            $sorted_array_with_preserved_keys[$original_key] = $sorted_array_with_unpreserved_keys[$array_key];
        }

        //take out da trash
        unset($sorted_array_with_unpreserved_keys);
        
        return $sorted_array_with_preserved_keys;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::sort()
     * 
     */
    public function sort(callable $callable=null, \VersatileCollections\SortType $type=null) {
        
        // sort a copy
        $items_to_sort = $this->versatile_collections_items;
        
        $this->performSort(
            $items_to_sort, 
            $callable, 
            $type, 
            'asort',
            'uasort'
        );
        
        return static::makeNew($items_to_sort);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::sortDesc()
     * 
     */
    public function sortDesc(callable $callable=null, \VersatileCollections\SortType $type=null) {
        
        // sort a copy
        $items_to_sort = $this->versatile_collections_items;
        
        $this->performSort(
            $items_to_sort, 
            $callable, 
            $type, 
            'arsort',
            'uasort'
        );
        
        return static::makeNew($items_to_sort);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::sortByKey()
     * 
     */
    public function sortByKey(callable $callable=null, \VersatileCollections\SortType $type=null) {
        
        // sort a copy
        $items_to_sort = $this->versatile_collections_items;
        
        $this->performSort(
            $items_to_sort, 
            $callable, 
            $type, 
            'ksort',
            'uksort'
        );
        
        return static::makeNew($items_to_sort);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::sortDescByKey()
     * 
     */
    public function sortDescByKey(callable $callable=null, \VersatileCollections\SortType $type=null) {
        
        // sort a copy
        $items_to_sort = $this->versatile_collections_items;
        
        $this->performSort(
            $items_to_sort, 
            $callable, 
            $type, 
            'krsort',
            'uksort'
        );
        
        return static::makeNew($items_to_sort);
    }

    
    /**
     * 
     * Can also sort by private and / or protected field(s) in each object in 
     * the collection.
     * 
     * @see \VersatileCollections\CollectionInterface::sortByMultipleFields()
     * 
     */
    public function sortByMultipleFields(\VersatileCollections\MultiSortParameters ...$param) {
        
        if( count($param) <= 0 ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " {$class}::{$function}(...) expects at least one parameter of type `". \VersatileCollections\MultiSortParameters::class ."`";
            throw new \InvalidArgumentException($msg);
        }
     
        // sort a copy
        $array_to_be_sorted = $this->versatile_collections_items;
        
        return static::makeNew($this->performMultiSort($array_to_be_sorted, ...$param));
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::sortMe()
     * 
     */
    public function sortMe(callable $callable=null, \VersatileCollections\SortType $type=null) {
          
        $this->performSort(
            $this->versatile_collections_items, 
            $callable, 
            $type, 
            'asort',
            'uasort'
        );
        
        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::sortMeDesc()
     * 
     */
    public function sortMeDesc(callable $callable=null, \VersatileCollections\SortType $type=null) {
                
        $this->performSort(
            $this->versatile_collections_items, 
            $callable, 
            $type, 
            'arsort',
            'uasort'
        );
        
        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::sortMeByKey()
     * 
     */
    public function sortMeByKey(callable $callable=null, \VersatileCollections\SortType $type=null) {
        
        $this->performSort(
            $this->versatile_collections_items, 
            $callable, 
            $type, 
            'ksort',
            'uksort'
        );
        
        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::sortMeDescByKey()
     * 
     */
    public function sortMeDescByKey(callable $callable=null, \VersatileCollections\SortType $type=null) {
        
        $this->performSort(
            $this->versatile_collections_items, 
            $callable, 
            $type, 
            'krsort',
            'uksort'
        );
        
        return $this;
    }
    
    /**
     * 
     * Can also sort by private and / or protected field(s) in each object in 
     * the collection.
     * 
     * @see \VersatileCollections\CollectionInterface::sortMeByMultipleFields()
     * 
     */
    public function sortMeByMultipleFields(\VersatileCollections\MultiSortParameters ...$param) {
        
        if( count($param) <= 0 ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " {$class}::{$function}(...) expects at least one parameter of type `". \VersatileCollections\MultiSortParameters::class ."`";
            throw new \InvalidArgumentException($msg);
        }
               
        $this->versatile_collections_items = 
            $this->performMultiSort(
                $this->versatile_collections_items, ...$param
            );
        
        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::splice()
     * 
     */
    public function splice($offset, $length=null, array $replacement=[]) {
        
        if( !is_int($offset) ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $offset_type = gettype($offset);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You must specify a valid integer as the offset."
            . " You supplied a(n) `{$offset_type}` with a value of: ". var_to_string($offset);
            throw new \InvalidArgumentException($msg); 
        }
        
        if( !is_null($length) && !is_int($length) ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $length_type = gettype($length);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You must specify a valid integer as the length."
            . " You supplied a(n) `{$length_type}` with a value of: ". var_to_string($length);
            throw new \InvalidArgumentException($msg); 
        }
        
        if( is_null($length) ) {
            
            $length = $this->count();
        }

        return static::makeNew(array_splice($this->versatile_collections_items, $offset, $length, $replacement));
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::split()
     * 
     */
    public function split($numberOfGroups) {
        
        if( !is_int($numberOfGroups) ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $number_type = gettype($numberOfGroups);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You must specify a valid integer as the number of groups."
            . " You supplied a(n) `{$number_type}` with a value of: ". var_to_string($numberOfGroups);
            throw new \InvalidArgumentException($msg); 
        }
        
        if( is_int($numberOfGroups) && $numberOfGroups > $this->count() ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You requested {$numberOfGroups} group(s), but there are only {$this->count()} items available.";
            throw new \InvalidArgumentException($msg); 
        }
        
        if( is_int($numberOfGroups) && $numberOfGroups < 0 ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You requested a negative number `{$numberOfGroups}` of group(s).";
            throw new \InvalidArgumentException($msg); 
        }
        
        if ( $this->isEmpty() || $numberOfGroups === 0 ) {
            
            return static::makeNew();
        }

        $groupSize = ceil($this->count() / $numberOfGroups);
        
        $groups = static::makeNew();

        foreach ( $this->yieldCollectionsOfSizeN($groupSize) as $group ) {
            
            $groups[] = $group;
        }
        
        return $groups;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::take()
     * 
     */
    public function take($limit) {
        
        if( !is_int($limit) ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $limit_type = gettype($limit);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You must specify a valid integer as the limit."
            . " You supplied a(n) `{$limit_type}` with a value of: ". var_to_string($limit);
            throw new \InvalidArgumentException($msg); 
        }
        
        if ($limit < 0) {
            return $this->slice($limit, abs($limit));
        }

        return $this->slice(0, $limit);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::unique()
     * 
     */
    public function unique() {
        
        return static::makeNew(
            $this->reduce(
                
                function($carry, $item) {

                    if( !in_array($item, $carry, true)) {

                        $carry[] = $item;
                    }

                    return $carry;
                },
                []
            )
        );
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::unionWith()
     * 
     */
    public function unionWith(array $items) {
        
        return static::makeNew($this->versatile_collections_items + $items);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::unionMeWith()
     * 
     */
    public function unionMeWith(array $items) {
        
        $this->versatile_collections_items =
            $this->versatile_collections_items + $items;
        
        return $this;
    }
    
    /**
     * 
     * Can also extract values from private and  / or protected properties 
     * of each object in the collection.
     * 
     * @see \VersatileCollections\CollectionInterface::column()
     * 
     */
    public function column($column_key, $index_key=null) {
        
        // use GenericCollection because the values 
        // in the column may be of varying types
        $column_2_return = \VersatileCollections\GenericCollection::makeNew();
        
        if( !is_int($column_key) && !is_string($column_key) ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $column_key_type = gettype($column_key);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You must specify an integer or string as the \$column_key parameter."
            . " You supplied a(n) `{$column_key_type}` with a value of: ". var_to_string($column_key);
            throw new \InvalidArgumentException($msg); 
        }
        
        if( !is_null($index_key) && !is_int($index_key) && !is_string($index_key) ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $index_key_type = gettype($index_key);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You must specify an integer or string as the \$index_key parameter."
            . " You supplied a(n) `{$index_key_type}` with a value of: ". var_to_string($index_key);
            throw new \InvalidArgumentException($msg); 
        }

        foreach ( $this->versatile_collections_items as $coll_key => $item ) {
            
            if( !is_array($item) && !is_object($item) ) {
                
                $function = __FUNCTION__;
                $class = get_class($this);
                $item_type = gettype($item);
                $msg = "Error [{$class}::{$function}(...)]:"
                . " This method only works on collections containing only arrays and / or objects."
                . " A(n) invalid item of type `{$item_type}` with a value of: ". var_to_string($item)
                . " was found with this key `$coll_key` in the collection". PHP_EOL
                . " Collection Items: ". var_to_string($this->versatile_collections_items);
                throw new \RuntimeException($msg); 
            }
            
            if( is_array($item) || $item instanceof \ArrayAccess) {
                
                if( 
                    ( is_array($item) && !array_key_exists($column_key, $item) )
                    ||
                    ( $item instanceof \ArrayAccess && !isset($item[$column_key]) )
                ) {
                    $function = __FUNCTION__;
                    $class = get_class($this);
                    $item_type = ($item instanceof \ArrayAccess)
                                    ? get_class($item) : gettype($item);
                    
                    $msg = "Error [{$class}::{$function}(...)]:"
                    . " An item of type `$item_type` without the specified column key `$column_key`"
                    . " was found with this key `$coll_key` in the collection." .PHP_EOL
                    . " Collection Items: ". var_to_string($this->versatile_collections_items);
                    throw new \RuntimeException($msg); 
                    
                } else if (
                    !is_null($index_key)
                    &&
                    (
                        ( is_array($item) && !array_key_exists($index_key, $item) )
                        ||
                        ( $item instanceof \ArrayAccess && !isset($item[$index_key]) ) 
                    )
                ) {
                    $function = __FUNCTION__;
                    $class = get_class($this);
                    $item_type = ($item instanceof \ArrayAccess)
                                    ? get_class($item) : gettype($item);
                    
                    $msg = "Error [{$class}::{$function}(...)]:"
                    . " An item of type `$item_type` without the specified index key `$index_key`"
                    . " was found with this key `$coll_key` in the collection." .PHP_EOL
                    . " Collection Items: ". var_to_string($this->versatile_collections_items);
                    throw new \RuntimeException($msg); 
                    
                } else if( is_null($index_key) ) {
                    
                    $column_2_return[] = $item[$column_key];
                    
                } else if(
                    !is_null($index_key) 
                    && 
                    ( 
                        ( is_array($item) && array_key_exists($index_key, $item) )
                        ||
                        ( $item instanceof \ArrayAccess && isset($item[$index_key]) )
                    )
                ) {
                    if(
                        !is_string($item[$index_key])
                        && !is_int($item[$index_key])
                    ){
                        $function = __FUNCTION__;
                        $class = get_class($this);
                        $item_type = gettype($item[$index_key]);

                        $msg = "Error [{$class}::{$function}(...)]:"
                        . " \$collection['{$coll_key}']['{$index_key}'] of type `$item_type`"
                        . " has a non-string and non-int value of `". var_to_string($item[$index_key])."`"
                        . " which cannot be used as a key in the collection to be returned by this method." .PHP_EOL
                        . " Collection Items: ". var_to_string($this->versatile_collections_items).PHP_EOL .PHP_EOL;
                        throw new \RuntimeException($msg);
                    }
                    
                    $column_2_return[$item[$index_key]] = $item[$column_key];
                    
                } else {
                    
                    $function = __FUNCTION__;
                    $class = get_class($this);
                    $item_type = ($item instanceof \ArrayAccess)
                                    ? get_class($item) : gettype($item);
                    
                    $msg = "Error [{$class}::{$function}(...)]:"
                    . " Error occured while accessing an item of type `$item_type` with the specified index key `$index_key`"
                    . " and specified column key `$column_key` with this key `$coll_key` in the collection." . PHP_EOL
                    . " Collection Items: ". var_to_string($this->versatile_collections_items).PHP_EOL .PHP_EOL;
                    throw new \RuntimeException($msg); 
                }

            } else if( is_object($item) ) {
                
                if( 
                    !is_null($index_key) 
                    && object_has_property($item, $column_key)
                    && object_has_property($item, $index_key)   
                ) {
                    $index_key_value = get_object_property_value($item, $index_key, null, true);
                    $column_key_value = get_object_property_value($item, $column_key, null, true);
                    
                    if( 
                        !is_int($index_key_value) 
                        && !is_string($index_key_value) 
                    ) {
                        $function = __FUNCTION__;
                        $class = get_class($this);
                        $item_type = gettype($index_key_value);
                        $msg = "Error [{$class}::{$function}(...)]:"
                        . " \$collection['{$coll_key}']->{'{$index_key}'} of type `$item_type`"
                        . " has a non-string and non-int value of `". var_to_string($index_key_value)."`"
                        . " which cannot be used as a key in the collection to be returned by this method." .PHP_EOL
                        . " Collection Items: ". var_to_string($this->versatile_collections_items).PHP_EOL .PHP_EOL;
                        throw new \RuntimeException($msg); 
                    }            
                    
                    $column_2_return[$index_key_value] = $column_key_value;
                    
                } else if(
                    is_null($index_key) 
                    && object_has_property($item, $column_key)
                ) {
                    $column_2_return[] = get_object_property_value($item, $column_key, null, true);
                    
                } else {
                    
                    $function = __FUNCTION__;
                    $class = get_class($this);
                    $item_type = get_class($item);
                    $msg = "Error [{$class}::{$function}(...)]:"
                    . " Error occured while accessing an item of type `$item_type` with the specified index key `$index_key`"
                    . " and specified column key `$column_key` with this key `$coll_key` in the collection." . PHP_EOL
                    . " Either the index key `$index_key` is not an accessible property of the item"
                    . " or the specified column key `$column_key` is not an accessible property of the item"
                    . " or some other error occurred" .PHP_EOL
                    . " Collection Items: ". var_to_string($this->versatile_collections_items).PHP_EOL .PHP_EOL;
                    throw new \RuntimeException($msg); 
                }
            } // else if(is_object($item))
        } // foreach ( $this->versatile_collections_items as $coll_key => $item )
        
        return $column_2_return;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::getItems()
     * 
     */
    public function getItems() {
        
        return static::makeNew(array_values($this->versatile_collections_items));
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::whenTrue()
     * 
     */
    public function whenTrue( 
        $truthy_value, callable $callback, callable $default=null
    ) {
        if ( $truthy_value ) {
            
            return $callback($this);
            
        } elseif ( !is_null($default) ) {
            
            return $default($this);
        }

        return $default;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::whenFalse()
     * 
     */
    public function whenFalse( 
        $falsy_value, callable $callback, callable $default=null
    ) {
        return $this->whenTrue( (!$falsy_value) , $callback, $default);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::getAsNewType()
     * 
     */
    public function getAsNewType($new_collection_class=\VersatileCollections\GenericCollection::class) {
        
        if( 
            !is_string($new_collection_class) 
            && !is_object($new_collection_class) 
        ) {
            $function = __FUNCTION__;
            $class = get_class($this);
            $new_collection_class_type = gettype($new_collection_class);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You must specify an object or string as the \$new_collection_class parameter."
            . " You supplied a(n) `{$new_collection_class_type}` with a value of: ". var_to_string($new_collection_class);
            throw new \InvalidArgumentException($msg); 
        }
        
        if( 
            !is_subclass_of($new_collection_class, CollectionInterface::class)
        ) {
            $function = __FUNCTION__;
            $class = get_class($this);
            $new_collection_class_type = gettype($new_collection_class);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You must specify an object or string that is a sub-class of "
            . CollectionInterface::class . " as the \$new_collection_class parameter."
            . " You supplied a(n) `{$new_collection_class_type}` with a value of: ". var_to_string($new_collection_class);
            throw new \InvalidArgumentException($msg); 
        }
        
        if( 
            is_object($new_collection_class)
            && $new_collection_class instanceof CollectionInterface
        ) {
            $new_collection_class = get_class($new_collection_class);
        }

        return $new_collection_class::makeNew($this->versatile_collections_items);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::removeAll()
     * 
     */
    public function removeAll(array $keys=[]) {
        
        if( count($keys) > 0 ) {
            
            foreach($keys as $key) {
                
                if( $this->containsKey($key) ) {
                    
                    $this->offsetUnset($key);
                }
            }
            
        } else {
            
            // shortcut
            $this->versatile_collections_items = [];
        }
        
        return $this;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::getAllWhereKeysIn()
     * 
     */
    public function getAllWhereKeysIn(array $keys) {
        
        $result = static::makeNew();
        
        foreach ( $this->versatile_collections_items as $key => $item ) {
            
            if( in_array($key, $keys, true) ) {
                
                $result[$key] = $item;
            }
        }
        
        return $result;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::getAllWhereKeysNotIn()
     * 
     */
    public function getAllWhereKeysNotIn(array $keys) {
        
        $result = static::makeNew();
        
        foreach ( $this->versatile_collections_items as $key => $item ) {
            
            if( !in_array($key, $keys, true) ) {
                
                $result[$key] = $item;
            }
        }
        
        return $result;
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::paginate()
     * 
     */
    public function paginate($page_number, $num_items_per_page) {
        
        if( !is_int($page_number) ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $page_number_type = gettype($page_number);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You must specify a valid integer as the \$page_number."
            . " You supplied a(n) `{$page_number_type}` with a value of: ". var_to_string($page_number);
            throw new \InvalidArgumentException($msg); 
        }
        
        if( !is_int($num_items_per_page) ) {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $num_items_per_page_type = gettype($num_items_per_page);
            $msg = "Error [{$class}::{$function}(...)]:"
            . " You must specify a valid integer as the length."
            . " You supplied a(n) `{$num_items_per_page_type}` with a value of: ". var_to_string($num_items_per_page);
            throw new \InvalidArgumentException($msg); 
        }
        
        if( $page_number < 1 ) {
            
            $page_number = 1;
        }
        
        if( $num_items_per_page < 1 ) {
            
            $num_items_per_page = 1;
        }
        
        if( $num_items_per_page > $this->count() ) {
            
            $offset = $page_number - 1;
            
        } else {

            $offset = (($page_number * $num_items_per_page) - $num_items_per_page);
        }

        return $this->slice($offset, $num_items_per_page);
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::diff()
     * 
     */
    public function diff(array $items) {
        
        return static::makeNew(array_diff($this->versatile_collections_items, $items));
    }

    /**
     * 
     * @see \VersatileCollections\CollectionInterface::diffUsing()
     * 
     */
    public function diffUsing(array $items, callable $callback) {
        
        return static::makeNew(array_udiff($this->versatile_collections_items, $items, $callback));
    }

    /**
     * 
     * @see \VersatileCollections\CollectionInterface::diffAssoc()
     * 
     */
    public function diffAssoc(array $items) {
        
        return static::makeNew(array_diff_assoc($this->versatile_collections_items, $items));
    }

    /**
     * 
     * @see \VersatileCollections\CollectionInterface::diffAssocUsing()
     * 
     */
    public function diffAssocUsing(array $items, callable $key_comparator) {
        
        return static::makeNew(array_diff_uassoc($this->versatile_collections_items, $items, $key_comparator));
    }

    /**
     * 
     * @see \VersatileCollections\CollectionInterface::diffKeys()
     * 
     */
    public function diffKeys(array $items) {
        
        return static::makeNew(array_diff_key($this->versatile_collections_items, $items));
    }

    /**
     * 
     * @see \VersatileCollections\CollectionInterface::diffKeysUsing()
     * 
     */
    public function diffKeysUsing(array $items, callable $key_comparator) {
        
        return static::makeNew(array_diff_ukey($this->versatile_collections_items, $items, $key_comparator));
    }

    /**
     * 
     * @see \VersatileCollections\CollectionInterface::allSatisfyConditions()
     * 
     */
    public function allSatisfyConditions(callable $callback, $bind_callback_to_this=true) {
        
        if( $bind_callback_to_this === true && Utils::canReallyBind($callback)) {
            
            $callback = Utils::bindObjectAndScopeToClosure(
                Utils::getClosureFromCallable($callback), 
                $this
            );
        }
        
        return $this->reduceWithKeyAccess(
            function($carry, $item, $key) use ($callback){
            
                return $carry && $callback($key, $item);
            }, 
            true
        );
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::intersectByKeys()
     * 
     */
    public function intersectByKeys(array $arr) {
        
        return static::makeNew(array_intersect_key($this->versatile_collections_items, $arr));
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::intersectByItems()
     * 
     */
    public function intersectByItems(array $arr) {
        
        return static::makeNew(array_intersect($this->versatile_collections_items, $arr));
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::intersectByKeysAndItems()
     * 
     */
    public function intersectByKeysAndItems(array $arr) {
        
        return static::makeNew(array_intersect_assoc($this->versatile_collections_items, $arr));
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::intersectByKeysUsingCallback()
     * 
     */
    public function intersectByKeysUsingCallback(array $arr, callable $key_comparator) {
        
        return static::makeNew(array_intersect_ukey($this->versatile_collections_items, $arr, $key_comparator));
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::intersectByItemsUsingCallback()
     * 
     */
    public function intersectByItemsUsingCallback(array $arr, callable $item_comparator) {
        
        return static::makeNew(array_uintersect($this->versatile_collections_items, $arr, $item_comparator));
    }
    
    /**
     * 
     * @see \VersatileCollections\CollectionInterface::intersectByKeysAndItemsUsingCallbacks()
     * 
     */
    public function intersectByKeysAndItemsUsingCallbacks(array $arr, callable $key_comparator=null, callable $item_comparator=null){
        
        $result = [];
        
        if( !is_null($key_comparator) && is_null($item_comparator) ) {
            
            $result = array_intersect_uassoc(
                $this->versatile_collections_items, $arr, $key_comparator
            );
            
        } else if( is_null($key_comparator) && !is_null($item_comparator) ) {
            
            $result = array_uintersect_assoc(
                $this->versatile_collections_items, $arr, $item_comparator
            );
            
        } else if( !is_null($key_comparator) && !is_null($item_comparator) ) {
            
            $result = array_uintersect_uassoc(
                $this->versatile_collections_items, $arr, $item_comparator, $key_comparator
            );
            
        } else {
            
            //is_null($key_comparator) && is_null($item_comparator)
            $result = array_intersect_assoc($this->versatile_collections_items, $arr);
        }
        
        return static::makeNew($result);
    }
}
