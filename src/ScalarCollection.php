<?php
namespace VersatileCollections;

/**
 * Description of ScalarCollection
 *
 * @author aadegbam
 */
class ScalarCollection extends StrictlyTypedCollection {

    /**
     * This method should be overridden in sub-classes of this class
     * 
     * @param mixed $item
     * @return bool
     */
    protected function checkType($item) {
        
        return is_scalar($item);
    }

    /**
     * This method should be overridden in sub-classes of this class
     * 
     * @return string
     */
    protected function getType() {
        
        return 'scalar';
    }
    
    public function uniqueNonStrict() {
        
        return static::makeNew(
            $this->reduce(
                
                function($carry, $item) {

                    if( !in_array($item, $carry, false)) {

                        $carry[] = $item;
                    }

                    return $carry;
                },
                []
            )
        );
    }
}
