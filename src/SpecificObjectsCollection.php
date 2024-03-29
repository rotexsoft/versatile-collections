<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */
declare(strict_types=1);
namespace VersatileCollections;

/**
 * Description of SpecificObjectsCollection
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
 */
final class SpecificObjectsCollection extends ObjectsCollection 
{
    private ?string $class_name = null;

    /** 
     * @noinspection PhpMissingParentConstructorInspection
     * @noinspection PhpUnnecessaryStaticReferenceInspection
     */
    protected function __construct(object ...$objects) 
    {    
        parent::__construct(...$objects);
    }

    /**
     * Create a new collection that only stores instances of the specified fully qualified class name or
     * its sub-classes or a new collection that stores any kind of object if no fully qualified class name
     * was specified (Essentially works like ObjectsCollection in the latter case).
     * 
     * @param string|null $class_name fully qualified name of the class whose instances or instances of its sub-classes alone would be stored in the collection.
     *                                Set it to null to make the collection work exactly like an instance of ObjectsCollection
     * @param iterable $items an iterable of objects to be stored in the new collection
     * @param bool $preserve_keys true to use the same keys in $items in the collection, , else false to use sequentially incrementing numeric keys starting from zero
     * 
     * @used-for: creating-new-collections
     * 
     * @title: Create a new collection that only stores instances of the specified fully qualified class name or its sub-classes or a new collection that stores any kind of object if no fully qualified class name was specified (Essentially works like ObjectsCollection in the latter case).
     * 
     * @noinspection PhpUnnecessaryStaticReferenceInspection
     * @psalm-suppress LessSpecificReturnStatement
     * @psalm-suppress MoreSpecificReturnType
     * @psalm-suppress NoInterfaceProperties
     */
    public static function makeNewForSpecifiedClassName(?string $class_name=null, iterable $items =[], bool $preserve_keys=true): StrictlyTypedCollectionInterface
    {
        // Class was specified, create collection for only instances of the specified class
        $new_collection = static::makeNew(); // make an empty collection first
        $new_collection->class_name = $class_name;

        foreach ($items as $key => $val) {

            if ($preserve_keys) {

                $new_collection[$key] = $val;

            } else {

                $new_collection[] = $val;
            }
        }
        
        return $new_collection;
    }

    /**
     * @return bool true if $item is of the expected type, else false
     */
    public function checkType(mixed $item): bool 
    {    
        return \is_null($this->class_name)
                ? parent::checkType($item)
                : ($item instanceof $this->class_name);
    }
    
    public function getTypes(): StringsCollection 
    {    
        return \is_null($this->class_name)
                ? parent::getTypes()
                : new StringsCollection($this->class_name);
    }
}
