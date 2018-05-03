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
}
