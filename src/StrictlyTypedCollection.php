<?php
namespace VersatileCollections;

/**
 * 
 * Description of StrictlyTypedCollection
 *
 * @author aadegbam
 * 
 */
abstract class StrictlyTypedCollection extends \VersatileCollections\GenericCollection {
    
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
        
        return parent::appendCollection($other);
    }
    
    /**
     * 
     * @return bool true if $item is of the expected type, else false
     * 
     */
    abstract protected function checkType($item);
    
    /**
     * 
     * @return string|array a string or array of strings of type name(s) for items acceptable in a collection
     * 
     */
    abstract protected function getType();
    
    protected function isRightTypeOrThrowInvalidTypeException($item, $calling_functions_name) {
        
        if( !$this->checkType($item) ) {

            $returned_type = $this->getType();
            $type = (is_array($returned_type) && count($returned_type) > 0)
                    ? implode(' or ', $returned_type) : ((string)$returned_type);
            
            $class = get_class($this);
            $msg = "Error ({$class}::{$calling_functions_name}):"
            . " Trying to add an item of type `" . gettype($item) 
            . "` to a strictly typed collection of type `{$type}`"
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
        
        parent::offsetSet($key, $val);
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
        
        return parent::prependCollection($other);
    }
    
    /**
     * 
     * {@inheritDoc}
     * 
     */
    public function prependItem($item, $key=null) {
        
        $this->isRightTypeOrThrowInvalidTypeException($item, __FUNCTION__);
        
        return parent::prependItem($item, $key);
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
        
        return parent::unionMeWith($items);
    }
}
