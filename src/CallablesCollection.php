<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */
declare(strict_types=1);
namespace VersatileCollections;

/**
 * Description of CallablesCollection
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
 * @author Rotimi Ade
 */
class CallablesCollection implements StrictlyTypedCollectionInterface
{
    
    use StrictlyTypedCollectionInterfaceImplementationTrait;
    
    /**
     * @param callable[] ...$callables
     */
    public function __construct(callable ...$callables) {
        
        $this->versatile_collections_items = $callables;
    }

    public function checkType($item): bool {
        
        return \is_callable($item);
    }

    /**
     * @return string|array
     */
    public function getType() {
        
        return 'callable';
    }
}
