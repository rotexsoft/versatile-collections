<?php
namespace VersatileCollections;

abstract class BaseCollection implements CollectionInterface {

    protected $collection_items = [];
    
    protected static $methods_for_all_instances = [];
    protected $methods_for_this_instance = [];
    protected static $static_methods = [];
    
    protected static function validateMethodName($name, $method_name_was_passed_to, $class_in_which_method_was_called=null) {
        
        $regex_4_valid_method_name = '/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/';

        if( !is_string($name)) {
            
            $class = 
                (!is_null($class_in_which_method_was_called) && is_string($class_in_which_method_was_called))
                    ? $class_in_which_method_was_called : static::class;
            
            $function = $method_name_was_passed_to;
            $name_type = gettype($name);
            $msg = "Error [{$class}::{$function}(...)]: Trying to add a dynamic method with an invalid name of type `{$name_type}` to a collection"
                . PHP_EOL . " `\$name`: " . var_export($name, true);
            
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
            $name_var = var_export($name, true);
            $msg = "Error [{$class}::{$function}(...)]: Trying to add a dynamic method with an invalid name `{$name_var}` to a collection";
            
            throw new \InvalidArgumentException($msg);
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
            
            static::$static_methods[ static::class.'::'. $name] = [
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
            
            static::$methods_for_all_instances[ static::class.'::'. $name] = [
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
                
                if( is_callable($new_callable) ) {
                    
                    $callable = $new_callable;
                    
                } else {

                    $function = __FUNCTION__;
                    $class = get_class($this);
                    $msg = "Error [{$class}::{$function}(...)]: Could not bind \$this to the supplied callable"
                        . PHP_EOL . " `\$callable`: " . var_export($callable, true);
                    throw new \InvalidArgumentException($msg);
                }
            }
            
            $this->methods_for_this_instance[ static::class.'::'. $name] = [
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
        
        $key_for_this_instance = static::getKeyForDynamicMethod($name, $this->methods_for_this_instance);
        $key_for_all_instances = static::getKeyForDynamicMethod($name, static::$methods_for_all_instances);
        
        if ( $key_for_this_instance !== false ) {
            
            $result = call_user_func_array($this->methods_for_this_instance[$key_for_this_instance]['method'], $arguments);
            
            if( $this->methods_for_this_instance[$key_for_this_instance]['has_return_val'] ) {
                
                return $result;
            }
        
        } else if( $key_for_all_instances !== false ) {
            
            $new_callable = static::$methods_for_all_instances[$key_for_all_instances]['method'];
            
            if( ((bool)static::$methods_for_all_instances[$key_for_all_instances]['bind_to_this_on_invocation']) ) {
                
                $new_callable = \Closure::bind($new_callable, $this);
            }
            
            if( is_callable($new_callable) ) {
            
                $result = call_user_func_array($new_callable, $arguments);

                if( static::$methods_for_all_instances[$key_for_all_instances]['has_return_val'] ) {

                    return $result;
                }
                
            } else {
                
                // throw exception, un-callable callable
                $function = __FUNCTION__;
                $class = get_class($this);
                $name_var = var_export($name, true);
                $msg = "Error [{$class}::{$function}(...)]: Trying to call an un-callable dynamic method named `{$name_var}` on a collection";
                throw new \BadMethodCallException($msg);
            }
            
        } else {
            
            $function = __FUNCTION__;
            $class = get_class($this);
            $name_var = var_export($name, true);
            $msg = "Error [{$class}::{$function}(...)]: Trying to call a non-existent dynamic method named `{$name_var}` on a collection";
            throw new \BadMethodCallException($msg);
        }
    }
    
    public static function __callStatic($name, $arguments) {
        
        $key_for_static_method = static::getKeyForDynamicMethod($name, static::$static_methods);
        
        if( $key_for_static_method !== false ) {
            
            // never bind to this when method is called statically            
            $result = call_user_func_array(
                static::$static_methods[$key_for_static_method]['method'], $arguments
            );
            
            if( static::$static_methods[$key_for_static_method]['has_return_val'] ) {
                
                return $result;
            }
            
        } else {
            
            $function = __FUNCTION__;
            $class = static::class;
            $name_var = var_export($name, true);
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
        
        return reset($this->collection_items);
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

            if( !is_callable($new_callback) ) {

                $function = __FUNCTION__;
                $class = get_class($this);
                $msg = "Error [{$class}::{$function}(...)]: Could not bind \$this to the supplied callable"
                    . PHP_EOL . " `\$callable`: " . var_export($callback, true);
                throw new \InvalidArgumentException($msg);

            } else {

                $callback = $new_callback;
            }
        }
        
        foreach ($this->collection_items as $key => $item) {
        
            if ( $callback($item, $key) === $termination_value ) {
                
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
    public function map(callable $callback, $preserve_keys = true, $bind_callback_to_this=true) {
        
        if( $bind_callback_to_this === true ) {
            
            $new_callback = \Closure::bind($callback, $this);

            if( !is_callable($new_callback) ) {

                $function = __FUNCTION__;
                $class = get_class($this);
                $msg = "Error [{$class}::{$function}(...)]: Could not bind \$this to the supplied callable"
                    . PHP_EOL . " `\$callable`: " . var_export($callback, true);
                throw new \InvalidArgumentException($msg);

            } else {

                $callback = $new_callback;
            }
        }
        
        $new_collection = new static();
        
        foreach ( $this->collection_items as $key => $item ) {
            
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
}
