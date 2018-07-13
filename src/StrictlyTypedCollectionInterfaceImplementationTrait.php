<?php
namespace VersatileCollections;

/**
 *
 * @author aadegbam
 */
trait StrictlyTypedCollectionInterfaceImplementationTrait {
    
    use CollectionInterfaceImplementationTrait {
        CollectionInterfaceImplementationTrait::appendCollection as parentAppendCollection;
        CollectionInterfaceImplementationTrait::offsetSet as parentOffsetSet;
        CollectionInterfaceImplementationTrait::prependCollection as parentPrependCollection;
        CollectionInterfaceImplementationTrait::prependItem as parentPrependItem;
        CollectionInterfaceImplementationTrait::unionMeWith as parentUnionMeWith;
    }
    
    public function __construct(...$arr_objs) {
        
        foreach ($arr_objs as $item) {
            
            $this->isRightTypeOrThrowInvalidTypeException($item, __FUNCTION__);
        }
        
        $this->versatile_collections_items = $arr_objs;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
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
        
        return static::parentAppendCollection($other);
    }
    
    protected function isRightTypeOrThrowInvalidTypeException($item, $calling_functions_name) {
        
        if( !$this->checkType($item) ) {

            $returned_type = $this->getType();
            $type = (is_array($returned_type) && count($returned_type) > 0)
                    ? implode(' or ', $returned_type) : ((string)$returned_type);
            
            $class = get_class($this);
            $msg = "Error ({$class}::{$calling_functions_name}):"
            . " Trying to add an item of type `" . gettype($item) 
            . "` to a strictly typed collection for items of type(s) `{$type}`"
            . PHP_EOL;
            
            throw new Exceptions\InvalidItemException($msg);
        }
        
        return true;
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function offsetSet($key, $val) {
        
        $this->isRightTypeOrThrowInvalidTypeException($val, __FUNCTION__);
        
        static::parentOffsetSet($key, $val);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
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
            . "` to a strictly typed collection of type `{$class}`" . PHP_EOL;
            
            throw new Exceptions\InvalidCollectionOperationException($msg);
        }
        
        return static::parentPrependCollection($other);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function prependItem($item, $key=null) {
        
        $this->isRightTypeOrThrowInvalidTypeException($item, __FUNCTION__);
        
        return static::parentPrependItem($item, $key);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function unionMeWith(array $items) {
        
        foreach ($items as $item) {
            
            $this->isRightTypeOrThrowInvalidTypeException($item, __FUNCTION__);
        }
        
        return static::parentUnionMeWith($items);
    }
}
