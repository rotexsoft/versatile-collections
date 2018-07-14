<?php
namespace VersatileCollections;

/**
 * Description of ScalarsCollection
 *
 * @author aadegbam
 */
class ScalarsCollection implements \VersatileCollections\StrictlyTypedCollectionInterface {
    
    use StrictlyTypedCollectionInterfaceImplementationTrait;

    /**
     * 
     * This method should be overridden in sub-classes of this class
     * 
     * @param mixed $item
     * 
     * @return bool
     * 
     */
    public function checkType($item) {
        
        return is_scalar($item);
    }

    /**
     * This method should be overridden in sub-classes of this class
     * 
     * @return string
     * 
     */
    public function getType() {
        
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
