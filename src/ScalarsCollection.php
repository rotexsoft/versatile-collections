<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */
declare(strict_types=1);
namespace VersatileCollections;

/**
 * Description of ScalarsCollection
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
class ScalarsCollection implements StrictlyTypedCollectionInterface
{
    use StrictlyTypedCollectionInterfaceImplementationTrait;

    /**
     * This method should be overridden in sub-classes of this class
     */
    public function checkType(mixed $item): bool
    {
        return \is_scalar($item);
    }

    public function getTypes(): StringsCollection
    {
        return new StringsCollection('bool', 'float', 'int', 'string');
    }
    
    /**
     * Get a collection of unique items from an existing collection. The keys
     * are not preserved in the returned collection. The uniqueness test is
     * done via loose comparison (==). 
     * 
     * 
     * @used-for: accessing-or-extracting-keys-or-items, creating-new-collections, modifying-keys
     * 
     * @title: Returns a new collection of unique items from an existing collection. This method uses non-strict comparison for testing uniqueness. The keys are not preserved in the returned collection.
     * @psalm-suppress MissingClosureParamType  
     */
    public function uniqueNonStrict(): CollectionInterface
    {
        return static::makeNew(
            $this->reduce(
                
                function(array $carry, $item): array {

                    if( !\in_array($item, $carry, false)) {

                        $carry[] = $item;
                    }

                    return $carry;
                },
                []
            )
        );
    }
}
