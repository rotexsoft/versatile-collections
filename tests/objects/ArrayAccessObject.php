<?php
/**
 * 
 * Description of ArrayAccessObject
 *
 * @author Rotimi Ade
 */
class ArrayAccessObject implements \ArrayAccess {
    
    private $container = [];

    public function __construct(array $array=[]) { 
        
        $this->container = $array;
    }

    public function offsetSet($offset, $value): void {
        
        if (is_null($offset)) {
            
            $this->container[] = $value;
            
        } else {
            
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool {
        
        return array_key_exists($offset, $this->container);
    }

    public function offsetUnset($offset): void {
        
        unset($this->container[$offset]);
    }

    #[\ReturnTypeWillChange]
    public function offsetGet($offset) {
        
        if( $this->offsetExists($offset) ) {
            
            return $this->container[$offset];
        }
        
        throw new Exception( 
            "Error in ".__METHOD__.": offsetGet `"
            . \VersatileCollections\var_to_string($offset)
            ."` does not exist."
        );
    }
}
