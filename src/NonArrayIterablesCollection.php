<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */
declare(strict_types=1);
namespace VersatileCollections;

/**
 * Description of ObjectsCollection
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
class NonArrayIterablesCollection extends ObjectsCollection
{
    public function __construct(iterable ...$iterableObjects)
    {
        parent::strictlyTypedCollectionTrait__construct(...$iterableObjects);
    }

    public function checkType(mixed $item): bool 
    {
        return parent::checkType($item) && \is_iterable($item);
    }

    public function getTypes(): StringsCollection 
    {
        return new StringsCollection('iterable');
    }
}
