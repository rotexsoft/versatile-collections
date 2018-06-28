<?php
namespace VersatileCollections;

/**
 *
 * @author aadegbam
 */
trait CollectionInterfaceImplementationTrait {

    /**
     *
     * @var array
     */
    protected $versatile_collections_items = [];
    
    /**
     *
     * @var array
     */
    protected static $versatile_collections_methods_for_all_instances = [];

    /**
     *
     * @var array
     */
    protected $versatile_collections_methods_for_this_instance = [];

    /**
     *
     * @var array
     */
    protected static $versatile_collections_static_methods = [];
    
    protected static function validateMethodName($name, $method_name_was_passed_to, $class_in_which_method_was_called=null) {
        
        $regex_4_valid_method_name = '/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/';
        $class_name_for_instantiation = static::class;
        $is_class_name_abstract = (new \ReflectionClass($class_name_for_instantiation))->isAbstract();

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
            
        } else if(
            is_string($name) 
            && 
            (
                (
                    $is_class_name_abstract === false
                    && method_exists((new $class_name_for_instantiation()), $name)
                )
                || 
                method_exists(static::class, $name) 
            )
        ) {
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
     */
    public function addMethod(
        $name, 
        callable $callable, 
        $has_return_val=false,
        $bind_to_this=true
    ) {
        if( static::validateMethodName($name, __FUNCTION__, get_class($this)) ) {
            
            if( ((bool)$bind_to_this) ) {
                
                $new_callable = \Closure::bind($callable, $this);
                
                if( $new_callable !== false ) {
                    
                    $callable = $new_callable;
                    
                } else {

                    $function = __FUNCTION__;
                    $class = get_class($this);
                    $msg = "Error [{$class}::{$function}(...)]: Could not bind \$this to the supplied callable"
                        . PHP_EOL . " `\$callable`: " . var_to_string($callable);
                    throw new \InvalidArgumentException($msg);
                }
            }
            
            $this->versatile_collections_methods_for_this_instance[ static::class.'::'. $name] = [
                'method' => $callable,
                'has_return_val' => ((bool)$has_return_val)
            ];
        }
    }
    
    protected static function getKeyForDynamicMethod($name, array &$methods_array) {
        
        if( array_key_exists( static::class.'::'.$name , $methods_array) ) {
            
            return static::class.'::'.$name;
        }
        
        $parent_class = get_parent_class(static::class);

        while( $parent_class !== false ) {

            if( array_key_exists( $parent_class.'::'.$name , $methods_array) ) {

                return $parent_class.'::'.$name;
            }
            
            $parent_class = get_parent_class($parent_class);
        }
        
        return false;
    }
    
    public function __call($name, $arguments) {
        
        $key_for_this_instance = static::getKeyForDynamicMethod($name, $this->versatile_collections_methods_for_this_instance);
        $key_for_all_instances = static::getKeyForDynamicMethod($name, static::$versatile_collections_methods_for_all_instances);
        
        if ( $key_for_this_instance !== false ) {
            
            $result = call_user_func_array($this->versatile_collections_methods_for_this_instance[$key_for_this_instance]['method'], $arguments);
            
            if( $this->versatile_collections_methods_for_this_instance[$key_for_this_instance]['has_return_val'] ) {
                
                return $result;
            }
        
        } else if( $key_for_all_instances !== false ) {
            
            $new_callable = static::$versatile_collections_methods_for_all_instances[$key_for_all_instances]['method'];
            
            if( ((bool)static::$versatile_collections_methods_for_all_instances[$key_for_all_instances]['bind_to_this_on_invocation']) ) {
                
                $new_callable = \Closure::bind($new_callable, $this);
            }
            
            if( is_callable($new_callable) ) {
            
                $result = call_user_func_array($new_callable, $arguments);

                if( static::$versatile_collections_methods_for_all_instances[$key_for_all_instances]['has_return_val'] ) {

                    return $result;
                }
                
            } else {
                
                // throw exception, un-callable callable
                $function = __FUNCTION__;
                $class = get_class($this);
                $name_var = var_to_string($name);
                $msg = "Error [{$class}::{$function}(...)]: Trying to call an un-callable dynamic method named `{$name_var}` on a collection";
                throw new \BadMethodCallException($msg);
            }
            
        } else {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $name_var = var_to_string($name);
            $msg = "Error [{$class}::{$function}(...)]: Trying to call a non-existent dynamic method named `{$name_var}` on a collection";
            throw new \BadMethodCallException($msg);
        }
    }
    
    public static function __callStatic($name, $arguments) {
        
        $key_for_static_method = static::getKeyForDynamicMethod($name, static::$versatile_collections_static_methods);
        
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
            $name_var = var_to_string($name);
            $msg = "Error [{$class}::{$function}(...)]: Trying to statically call a non-existent dynamic method named `{$name_var}` on a collection";
            throw new \BadMethodCallException($msg);
        }
    }
    
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
        // a fatal php error will be generated when trying to unpack args from
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
        
        return array_key_exists($key, $this->versatile_collections_items);
    }
    
    /**
     * 
     * {@inheritDoc}
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
     * {@inheritDoc}
     * 
     */
    public function offsetSet($key, $val) {
        
        if(is_null($key) ) {
            
            $this->versatile_collections_items[] = $val;
            
        } else {
            
            $this->versatile_collections_items[$key] = $val;
        }
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function offsetUnset($key) {
        
        $this->versatile_collections_items[$key] = null;
        unset($this->versatile_collections_items[$key]);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function toArray() {

        return $this->versatile_collections_items;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function getIterator() {

        return new \ArrayIterator($this->versatile_collections_items);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function count() {
        
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
     * {@inheritDoc}
     * 
     */
    public function firstItem(){
        
        if( $this->count() <= 0 ) { return null; }
        
        return reset($this->versatile_collections_items);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function lastItem(){
        
        if( $this->count() <= 0 ) { return null; }
        
        $last = end($this->versatile_collections_items);
        reset($this->versatile_collections_items);
        
        return $last;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function getKeys()
    {
        return array_keys($this->versatile_collections_items);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function setValForEachItem($field_name, $field_val, $add_field_if_not_present=false) {
        
        foreach ($this->versatile_collections_items as &$item) {
            
            if( 
                is_object($item)
                && 
                ( 
                    $add_field_if_not_present 
                    || 
                    object_has_property($item, $field_name) 
                    || 
                    (
                        method_exists($item, '__set')
                        && method_exists($item, '__get')
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
     * {@inheritDoc}
     * 
     */
    public function filterAll(callable $filterer, $copy_keys=false, $bind_callback_to_this=true) {
                
        return $this->filterFirstN($filterer, $this->count(), $copy_keys, $bind_callback_to_this);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function filterFirstN(callable $filterer, $max_number_of_filtered_items_to_return =null, $copy_keys=false, $bind_callback_to_this=true) {
        
        if( $bind_callback_to_this === true ) {
            
            $new_callback = \Closure::bind($filterer, $this);

            if( $new_callback === false ) {

                $function = __FUNCTION__;
                $class = get_class($this);
                $msg = "Error [{$class}::{$function}(...)]: Could not bind \$this to the supplied callable"
                    . PHP_EOL . " `\$filterer`: " . var_to_string($filterer);
                throw new \InvalidArgumentException($msg);

            } else {

                $filterer = $new_callback;
            }
        }
        
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
            }
            
        } // foreach ( $this->collection_items as $key => $item )
        
        return $filtered_items;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function transform(callable $transformer, $bind_callback_to_this=true) {
        
        if( $bind_callback_to_this === true ) {
            
            $new_callback = \Closure::bind($transformer, $this);

            if( $new_callback === false ) {

                $function = __FUNCTION__;
                $class = get_class($this);
                $msg = "Error [{$class}::{$function}(...)]: Could not bind \$this to the supplied callable"
                    . PHP_EOL . " `\$transformer`: " . var_to_string($transformer);
                throw new \InvalidArgumentException($msg);

            } else {

                $transformer = $new_callback;
            }
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
     * {@inheritDoc}
     * 
     */
    public function reduce(callable $reducer, $initial_value=NULL) {
        
        return array_reduce($this->versatile_collections_items, $reducer, $initial_value);
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
        
        return array_key_exists($key, $this->versatile_collections_items) 
                ?  $this->versatile_collections_items[$key] : $default_value;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function containsItem($item) {
        
        return in_array($item, $this->versatile_collections_items, true);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function containsKey($key) {
        
        return array_key_exists($key, $this->versatile_collections_items);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function containsItems(array $items) {
        
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
     * {@inheritDoc}
     * 
     */
    public function containsKeys(array $keys) {
        
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
            
            array_unshift($this->versatile_collections_items, ...array_values($other->toArray()));
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
        
        foreach ($this->versatile_collections_items as $key=>$item) {
            
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
     * {@inheritDoc}
     * 
     */
    public function each(
        callable $callback, $termination_value=false, $bind_callback_to_this=true
    ) {
        if( $bind_callback_to_this === true ) {
            
            $new_callback = \Closure::bind($callback, $this);

            if( $new_callback === false ) {

                $function = __FUNCTION__;
                $class = get_class($this);
                $msg = "Error [{$class}::{$function}(...)]: Could not bind \$this to the supplied callable"
                    . PHP_EOL . " `\$callback`: " . var_to_string($callback);
                throw new \InvalidArgumentException($msg);

            } else {

                $callback = $new_callback;
            }
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
     * {@inheritDoc}
     * 
     */
    public function map(
        callable $callback, $preserve_keys = true, $bind_callback_to_this=true
    ) {    
        if( $bind_callback_to_this === true ) {
            
            $new_callback = \Closure::bind($callback, $this);

            if( $new_callback === false ) {

                $function = __FUNCTION__;
                $class = get_class($this);
                $msg = "Error [{$class}::{$function}(...)]: Could not bind \$this to the supplied callable"
                    . PHP_EOL . " `\$callback`: " . var_to_string($callback);
                throw new \InvalidArgumentException($msg);

            } else {

                $callback = $new_callback;
            }
        }
        
        $new_collection = new static();
        
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
     * {@inheritDoc}
     * 
     */
    public function nth($n, $position_of_first_nth_item = 0) {
        
        $new = new static();
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
     * {@inheritDoc}
     * 
     */
    public function pipeAndReturnCallbackResult(callable $callback) {
        
        return $callback($this);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function pipeAndReturnSelf(callable $callback) {
        
        $callback($this);
        
        return $this;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function getAndRemoveLastItem()
    {
        return array_pop($this->versatile_collections_items);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function pull($key, $default = null) {

        $item = $this->getIfExists($key, $default);
        
        unset($this[$key]);
        
        return $item;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function push($item) {
        
        return $this->appendItem($item);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function put($key, $value) {
        
        $this->offsetSet($key, $value);
        
        return $this;
    }
    
    /**
     * 
     * {@inheritDoc}
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
     * {@inheritDoc}
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
     * {@inheritDoc}
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
        return new GenericCollection(...$keys); 
    }
    
    /**
     * 
     * {@inheritDoc}
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
        
        $random_items = new static();
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
     * {@inheritDoc}
     * 
     */   
    public function shuffle($preserve_keys=true) {
                
        if( $this->isEmpty() ) {
            
            return new static();
        }
        
        $shuffled_collection = new static();
        
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
     * {@inheritDoc}
     * 
     */    
    public function searchByVal( $value, $strict = false ) {
        
        return array_search($value, $this->versatile_collections_items, $strict);
    }
    
    /**
     * 
     * {@inheritDoc}
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
     * {@inheritDoc}
     * 
     */  
    public function searchByCallback($callback, $bind_callback_to_this=true) {
        
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
    
    /**
     * 
     * {@inheritDoc}
     * 
     */  
    public function getAndRemoveFirstItem() {
        
        return array_shift($this->versatile_collections_items);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function sort(callable $callable=null, \VersatileCollections\SortType $type=null) {
        
        $items_to_sort = $this->versatile_collections_items;
        
        if( is_null($callable) ) {
            
            $sort_type = SORT_REGULAR;
            
            if( !is_null($type) ) {
                
                $sort_type = $type->getSortType();
            }
            
            asort($items_to_sort, $sort_type);
            
        } else {
            
            uasort($items_to_sort, $callable);
        }
        
        return static::makeNewCollection($items_to_sort);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function sortDesc($callable=null, \VersatileCollections\SortType $type=null) {
        
        $items_to_sort = $this->versatile_collections_items;
        
        if( is_null($callable) ) {
            
            $sort_type = SORT_REGULAR;
            
            if( !is_null($type) ) {
                
                $sort_type = $type->getSortType();
            }
            
            arsort($items_to_sort, $sort_type);
            
        } else {
            
            uasort($items_to_sort, $callable);
        }
        
        return static::makeNewCollection($items_to_sort);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function sortByKey($callable=null, \VersatileCollections\SortType $type=null) {
        
        $items_to_sort = $this->versatile_collections_items;
        
        if( is_null($callable) ) {
            
            $sort_type = SORT_REGULAR;
            
            if( !is_null($type) ) {
                
                $sort_type = $type->getSortType();
            }
            
            ksort($items_to_sort, $sort_type);
            
        } else {
            
            uksort($items_to_sort, $callable);
        }
        
        return static::makeNewCollection($items_to_sort);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function sortDescByKey($callable=null, \VersatileCollections\SortType $type=null) {
        
        $items_to_sort = $this->versatile_collections_items;
        
        if( is_null($callable) ) {
            
            $sort_type = SORT_REGULAR;
            
            if( !is_null($type) ) {
                
                $sort_type = $type->getSortType();
            }
            
            krsort($items_to_sort, $sort_type);
            
        } else {
            
            uksort($items_to_sort, $callable);
        }
        
        return static::makeNewCollection($items_to_sort);
    }
    
    /**
     * 
     * {@inheritDoc}
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
        
        $multi_sort_args = [];
        $columns_to_sort_by = [];
        // copy items
        $array_to_be_sorted = $this->versatile_collections_items;
        $original_key_tracker = 'http://versatile-collections.com/original_key_b4_sort';
        
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

            $original_key = $sorted_array_with_unpreserved_keys[$array_key][$original_key_tracker];
            
            // Remove the key we added in this method 
            // to keep track of the original key of each array item
            unset($sorted_array_with_unpreserved_keys[$array_key][$original_key_tracker]); 

            $sorted_array_with_preserved_keys[$original_key] = $sorted_array_with_unpreserved_keys[$array_key];
        }

        //take out da trash
        unset($sorted_array_with_unpreserved_keys);
        
        return static::makeNewCollection($sorted_array_with_preserved_keys);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function sortMe(callable $callable=null, \VersatileCollections\SortType $type=null) {
                
        if( is_null($callable) ) {
            
            $sort_type = SORT_REGULAR;
            
            if( !is_null($type) ) {
                
                $sort_type = $type->getSortType();
            }
            
            asort($this->versatile_collections_items, $sort_type);
            
        } else {
            
            uasort($this->versatile_collections_items, $callable);
        }
        
        return $this;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function sortMeDesc($callable=null, \VersatileCollections\SortType $type=null) {
                
        if( is_null($callable) ) {
            
            $sort_type = SORT_REGULAR;
            
            if( !is_null($type) ) {
                
                $sort_type = $type->getSortType();
            }
            
            arsort($this->versatile_collections_items, $sort_type);
            
        } else {
            
            uasort($this->versatile_collections_items, $callable);
        }
        
        return $this;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function sortMeByKey($callable=null, \VersatileCollections\SortType $type=null) {
        
        if( is_null($callable) ) {
            
            $sort_type = SORT_REGULAR;
            
            if( !is_null($type) ) {
                
                $sort_type = $type->getSortType();
            }
            
            ksort($this->versatile_collections_items, $sort_type);
            
        } else {
            
            uksort($this->versatile_collections_items, $callable);
        }
        
        return $this;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function sortMeDescByKey($callable=null, \VersatileCollections\SortType $type=null) {
        
        if( is_null($callable) ) {
            
            $sort_type = SORT_REGULAR;
            
            if( !is_null($type) ) {
                
                $sort_type = $type->getSortType();
            }
            
            krsort($this->versatile_collections_items, $sort_type);
            
        } else {
            
            uksort($this->versatile_collections_items, $callable);
        }
        
        return $this;
    }
    
    /**
     * 
     * {@inheritDoc}
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
        
        $multi_sort_args = [];
        $columns_to_sort_by = [];

        $original_key_tracker = 'http://versatile-collections.com/original_key_b4_sort';
        
        foreach( $this->versatile_collections_items as $key => $item) {
            
            if( is_array($item) || $item instanceof \ArrayAccess ) {
                
                $this->versatile_collections_items[$key][$original_key_tracker] = $key;
                
                foreach($param as $current_param) {
                    
                    if( !array_key_exists($current_param->getFieldName() , $columns_to_sort_by) ) {
                        
                        $columns_to_sort_by[$current_param->getFieldName()] = [];
                    }
                    
                    $columns_to_sort_by[$current_param->getFieldName()][$key] 
                                        = $item[$current_param->getFieldName()];
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
        $multi_sort_args[] = &$this->versatile_collections_items;
        
        call_user_func_array("array_multisort", $multi_sort_args);
        
        $sorted_array_with_unpreserved_keys = array_pop($multi_sort_args);
        
        // Restore original key associations
        $sorted_array_with_preserved_keys = [];

        foreach( $sorted_array_with_unpreserved_keys as $array_key => $current_array_data ) {

            $original_key = $sorted_array_with_unpreserved_keys[$array_key][$original_key_tracker];
            
            // Remove the key we added in this method 
            // to keep track of the original key of each array item
            unset($sorted_array_with_unpreserved_keys[$array_key][$original_key_tracker]); 

            $sorted_array_with_preserved_keys[$original_key] = $sorted_array_with_unpreserved_keys[$array_key];
        }

        //take out da trash
        unset($sorted_array_with_unpreserved_keys);
        
        $this->versatile_collections_items = $sorted_array_with_preserved_keys;
        
        return $this;
    }
    
    /**
     * 
     * {@inheritDoc}
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
            
            return new static();
        }

        $groupSize = ceil($this->count() / $numberOfGroups);
        
        $groups = new static();

        foreach ( $this->getCollectionsOfSizeN($groupSize) as $group ) {
            
            $groups[] = $group;
        }
        
        return $groups;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function unique() {
        
        return static::makeNewCollection(
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
     * {@inheritDoc}
     * 
     */
    public function column($column_key, $index_key=null) {

        $column_2_return = new static();
        
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
                    $index_key_value = get_object_property_value($item, $index_key);
                    $column_key_value = get_object_property_value($item, $column_key);
                    
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
                    $column_2_return[] = get_object_property_value($item, $column_key);
                    
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
}
