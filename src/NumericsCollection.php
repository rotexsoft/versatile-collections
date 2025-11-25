<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */
declare(strict_types=1);
namespace VersatileCollections;

/**
 * Description of NumericsCollection
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
class NumericsCollection extends ScalarsCollection
{
    /**
     * @return int|float|null average all of the values in the collection or null if collection is empty
     *  
     * @used-for: mathematical-operations
     *  
     * @title: Returns the average of all of the values(a.k.a items) in the collection or null if collection is empty.
     */
    public function average(): float|null
    {
        return ($this->count() > 0) ? \fdiv( $this->sum(), (float)$this->count() ) : null;
    }
    
    /**
     * This method should be overridden in sub-classes of this class
     */
    #[\Override]
    public function checkType(mixed $item): bool
    {    
        return \is_float($item) || \is_int($item);
    }

    #[\Override]
    public function getTypes(): StringsCollection
    {    
        return new StringsCollection('int', 'float');
    }
    
    /**
     * This method should be overridden in sub-classes of this class 
     *    
     * @param string $str a string representation of an item in this collection
     *    
     * @return float|int an item in this collection that was just created from its string representation
     *
     * @noinspection PhpMissingParamTypeInspection
     */
    protected function itemFromString(string $str): float|int
    {    
        if( str_contains($str, '.') ) {
            
            return ( (float) ($str) );
        }
        
        return ( (int) ($str) );
    }
    
    /**
     * This method should be overridden in sub-classes of this class 
     *  
     * @param float|int $item an item in this collection
     *  
     * @return string representation of an item in this collection
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    protected function itemToString(float|int $item): string
    {    
        return ((string)$item).'';
    }
    
    /**
     * @return int|float|null maximum of the values in the collection or null if collection is empty
     *  
     * @used-for: mathematical-operations
     *  
     * @title: Returns the maximum of all of the values(a.k.a items) in the collection or null if collection is empty.
     * 
     * @psalm-suppress ArgumentTypeCoercion 
     */
    public function max(): float|null
    {    
        return ($this->count() > 0) ? \max($this->versatile_collections_items) : null;
    }
    
    /**
     * @return int|float|null median of the values in the collection or null if collection is empty
     *  
     * @used-for: mathematical-operations
     *  
     * @title: Returns the median of all of the values(a.k.a items) in the collection or null if collection is empty.
     */
    public function median(): float|null
    {
        $count = $this->count();

        if ( $count === 0) {
            
            return null;
        }

        $values = $this->versatile_collections_items;
        
        \sort($values, SORT_NUMERIC);
        $middle = (int) ($count / 2);

        if ( $count % 2 === 1) {
            
            return $values[$middle];
        }

        return (($values[$middle - 1] + $values[$middle]) / 2);
    }
    
    /**
     * @return int|float|null minimum of the values in the collection or null if collection is empty
     *  
     * @used-for: mathematical-operations
     *  
     * @title: Returns the minimum of all of the values(a.k.a items) in the collection or null if collection is empty.
     * 
     * @psalm-suppress ArgumentTypeCoercion 
     */
    public function min(): float|null
    {
        return ($this->count() > 0) ? \min($this->versatile_collections_items) : null;
    }
    
    /**
     * @return array|null an array of modal values in the collection. 
     *                    Returned array will have modal items in the same
     *                    order as in the collection.
     *                    Null is returned if the collection is empty.
     *                                    
     *                    Modal Items in the the collection that are floats like
     *                    `5.0`, `7.0` (i.e point zero) will be returned without
     *                    `.0`, in essence they are returned in integer format.
     *  
     * @used-for: mathematical-operations
     *  
     * @title: Returns an array of modal values(a.k.a items) in the collection or null if collection is empty.
     * 
     * @psalm-suppress ArgumentTypeCoercion 
     */
    public function mode(): array|null
    {    
        $counts = [];
        $count = $this->count();

        if ($count === 0) { return null; }

        foreach ( $this->versatile_collections_items as $item ) {
            
            if( !\is_int($item) ) {
                
                // string concatenation for non-ints which are not 
                // valid as keys to a php array 
                $item = $this->itemToString($item);
            }
            
            $counts[$item] = \array_key_exists($item, $counts) ? ++$counts[$item] : 1;
        }

        $highest_count = \max($counts);
        $modal_values = [];

        // get all items with counts === $highest_count
        // they are the modal items we are looking for.
        foreach( $counts as $item => $item_count ) {
            
            if( $item_count === $highest_count ) {
                
                // if is_string($item) then, it was
                // originally a float that was cast
                // to a string because array keys in
                // php can only be ints or strings.
                $modal_values[] = 
                    \is_string($item) ? $this->itemFromString($item) : $item;
            }
        }

        return $modal_values;
    }
    
    /**
     * @return int|float the product of all values in the collection.
     *  
     * @used-for: mathematical-operations
     *  
     * @title: Returns the product of all of the values(a.k.a items) in the collection or one if collection is empty.
     */
    public function product(): float
    {    
        return \array_product($this->versatile_collections_items);
    }

    /**
     * Sum of all the values in this collection
     *  
     * @return float|int sum of all the values in this collection or zero if the collection is empty
     *  
     * @used-for: mathematical-operations
     *  
     * @title: Returns the sum of all of the values(a.k.a items) in the collection or zero if collection is empty.
     */
    public function sum(): float
    {
        return (float)\array_sum($this->versatile_collections_items);
    }
}
