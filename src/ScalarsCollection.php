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
    
    /**
     * 
     * Get a collection of unique items from an existing collection. The keys
     * are not preserved in the returned collection. The uniqueness test is
     * done via loose comparison (==). 
     * 
     * @return \VersatileCollections\CollectionInterface
     * 
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, modifying-keys
     * 
     * @title: Returns a new collection of unique items from an existing collection. This method uses non-strict comparison for testing uniqueness. The keys are not preserved in the returned collection.
     * 
     */
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
