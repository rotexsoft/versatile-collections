<?php
namespace VersatileCollections;

/**
 * Description of ScalarCollection
 *
 * @author aadegbam
 */
class ScalarCollection extends StrictlyTypedCollection {

    protected function checkType($item) {
        
        return is_scalar($item);
    }

    protected function getType() {
        
        return 'scalar';
    }
    
    public function unique($strict_comparison=false) {
        
        return $this->reduce(
                
            function($carry, $item) use ($strict_comparison) {
                
                if( !in_array($item, $carry, $strict_comparison)) {
                    
                    $carry[] = $item;
                }
                
                return $carry;
            },
            []
        );
    }
}
