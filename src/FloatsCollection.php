<?php
declare(strict_types=1);
namespace VersatileCollections;

/**
 * Description of FloatsCollection
 *  
 * Below is a list of acceptable value(s), that could be comma separated, 
 * for the @used-for tag in phpdoc blocks for public methods in this class:
 *  
 *      - accessing-or-extracting-keys-or-items
 *      - adding-items
 *      - adding-methods-at-runtime
 *      - checking-keys-presence
 *      - checking-items-presence
 *      - creating-new-collections
 *      - deleting-items
 *      - finding-or-searching-for-items
 *      - getting-collection-meta-data
 *      - iteration
 *      - mathematical-operations
 *      - modifying-keys
 *      - modifying-items
 *      - ordering-or-sorting-items
 *      - other-operations
 *
 * @author rotimi
 */
class FloatsCollection extends NumericsCollection {

    public function __construct(float ...$numbers) {
        
        $this->versatile_collections_items = $numbers;
    }
    
    public function checkType($item): bool {
        
        return is_float($item);
    }

    /**
     * @return string
     */
    public function getType() {
        
        return 'float';
    }
    
    /**
     * @return float
     */
    protected function itemFromString($str) {
        
        return ((float) ($str.''));
    }

    /**
     * @return string
     */
    protected function itemToString($item) {
        
        return $item.'';
    }
}
