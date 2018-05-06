<?php
namespace VersatileCollections;

/**
 * Description of StrictlyTypedCollection
 *
 * @author aadegbam
 */
abstract class StrictlyTypedCollection extends BaseCollection {

    abstract protected function checkType($item);
    abstract protected function getType();
    
    protected function isRightTypeOrThrowInvalidTypeException($item, $calling_functions_name) {
        
        if( !$this->checkType($item) ) {

            $class = get_class($this);
            $msg = "Error ({$class}::{$calling_functions_name}):"
            . " Trying to add an item of type `" . gettype($item) 
            . "` to a strictly typed collection of type `{$this->getType()}`"
            . PHP_EOL;
            
            throw new Exceptions\InvalidItemException($msg);
        }
        
        return true;
    }
    
    public function __construct(...$arr_objs) {
        
        foreach ($arr_objs as $item) {
            
            $this->isRightTypeOrThrowInvalidTypeException($item, __FUNCTION__);
        }
        
        $this->collection_items = $arr_objs;
    }
    
    public function offsetSet($key, $val) {
        
        $this->isRightTypeOrThrowInvalidTypeException($val, __FUNCTION__);
        
        parent::offsetSet($key, $val);
    }
    
    /**
     * 
     * @param \VersatileCollections\CollectionInterface $other
     * @throws Exceptions\InvalidCollectionOperationException
     * 
     * @return $this
     */
    public function appendCollection(CollectionInterface $other) {
        
        if( 
            get_class($this) !== get_class($other)
            && !is_subclass_of($other, get_class($this))
        ) {
            $class = get_class($this);
            $other_class = get_class($other);
            $calling_functions_name = __FUNCTION__;
            
            $msg = "Error ({$class}::{$calling_functions_name}):"
            . " Trying to append a collection of type `" .$other_class 
            . "` to a strictly typed collection of type `{$class}`"
            . PHP_EOL;
            
            throw new Exceptions\InvalidCollectionOperationException($msg);
        }
        
        return parent::appendCollection($other);
    }
    
    /**
     * 
     * @param \VersatileCollections\CollectionInterface $other
     * @throws Exceptions\InvalidCollectionOperationException
     * 
     * @return $this
     */
    public function prependCollection(CollectionInterface $other) {
        
        if( 
            get_class($this) !== get_class($other)
            && !is_subclass_of($other, get_class($this))
        ) {
            $class = get_class($this);
            $other_class = get_class($other);
            $calling_functions_name = __FUNCTION__;
            
            $msg = "Error ({$class}::{$calling_functions_name}):"
            . " Trying to prepend a collection of type `" .$other_class 
            . "` to a strictly typed collection of type `{$class}`"
            . PHP_EOL;
            
            throw new Exceptions\InvalidCollectionOperationException($msg);
        }
        
        return parent::prependCollection($other);
    }
    
    /**
     * 
     * @param mixed $item
     * 
     * @return $this
     */
    public function prependItem($item) {
        
        $this->isRightTypeOrThrowInvalidTypeException($item, __FUNCTION__);
        
        return parent::prependItem($item);
    }
    
    /**
     * 
     * @param \VersatileCollections\CollectionInterface $other
     * @throws Exceptions\InvalidCollectionOperationException
     * 
     * @return $this
     */
    public function merge(CollectionInterface $other) {
        
        if( 
            get_class($this) !== get_class($other)
            && !is_subclass_of($other, get_class($this))
        ) {    
            $class = get_class($this);
            $other_class = get_class($other);
            $calling_functions_name = __FUNCTION__;
            
            $msg = "Error ({$class}::{$calling_functions_name}):"
            . " Trying to merge a collection of type `" .$other_class 
            . "` to a strictly typed collection of type `{$class}`"
            . PHP_EOL;
            
            throw new Exceptions\InvalidCollectionOperationException($msg);
        }
        
        return parent::merge($other);
    }
}
