<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace VersatileCollections;

/**
 * Below is a list of acceptable value(s), that could be comma separated, 
 * for the @used-for tag in phpdoc blocks for public methods in this trait:
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
trait StrictlyTypedCollectionInterfaceImplementationTrait
{
    use CollectionInterfaceImplementationTrait {
        CollectionInterfaceImplementationTrait::appendCollection as parentAppendCollection;
        CollectionInterfaceImplementationTrait::offsetSet as parentOffsetSet;
        CollectionInterfaceImplementationTrait::prependCollection as parentPrependCollection;
        CollectionInterfaceImplementationTrait::prependItem as parentPrependItem;
        CollectionInterfaceImplementationTrait::unionMeWith as parentUnionMeWith;
        CollectionInterfaceImplementationTrait::__call as parent__call;
    }

    /** 
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function __construct(mixed ...$arr_objs)
    {
        foreach ($arr_objs as $item) {
            
            $this->isRightTypeOrThrowInvalidTypeException($item, __FUNCTION__);
        }
        
        $this->versatile_collections_items = $arr_objs;
    }
    
    /**
     * @see \VersatileCollections\CollectionInterface::appendCollection()
     *
     * @noinspection PhpDocSignatureInspection
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function appendCollection(CollectionInterface $other): CollectionInterface
    {
        if( 
            $this::class !== $other::class
            && !\is_subclass_of($other, $this::class)
        ) {
            $class = $this::class;
            $other_class = $other::class;
            $calling_functions_name = __FUNCTION__;
            
            $msg = "Error ({$class}::{$calling_functions_name}):"
            . " Trying to append a collection of type `" .$other_class 
            . "` to a strictly typed collection of type `{$class}`"
            . PHP_EOL;
            
            throw new Exceptions\InvalidCollectionOperationException($msg);
        }
        
        return static::parentAppendCollection($other);
    }

    /**
     * @throws Exceptions\InvalidItemException
     *
     * @noinspection PhpUnhandledExceptionInspection
     */
    protected function isRightTypeOrThrowInvalidTypeException(mixed $item, string $calling_functions_name): bool 
    {
        if( !$this->checkType($item) ) {
            
            /** @var StringsCollection $returned_type */
            $returned_type = $this->getTypes();
            $type = ($returned_type->count() > 1)
                    ? \implode(' or ', $returned_type->toArray()) 
                    : (($returned_type->count() === 1) ? $returned_type->firstItem() : '');
            
            $class = $this::class;
            $msg = "Error ({$class}::{$calling_functions_name}):"
            . " Trying to add an item of type `" . Utils::gettype($item) 
            . "` to a strictly typed collection for items of type(s) `{$type}`"
            . PHP_EOL;
            
            throw new Exceptions\InvalidItemException($msg);
        }
        
        return true;
    }
    
    /**
     * @see \VersatileCollections\CollectionInterface::offsetSet()
     * 
     * @param string|int|null $key The requested key.
     * @param mixed $val The value to set it to.
     *
     * @noinspection PhpDocSignatureInspection
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function offsetSet($key, mixed $val): void 
    {
        $this->isRightTypeOrThrowInvalidTypeException($val, __FUNCTION__);
        
        static::parentOffsetSet($key, $val);
    }
    
    /**
     * @see \VersatileCollections\CollectionInterface::prependCollection()
     *
     * @noinspection PhpDocSignatureInspection
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function prependCollection(CollectionInterface $other): CollectionInterface 
    {
        if( 
            $this::class !== $other::class
            && !\is_subclass_of($other, $this::class)
        ) {
            $class = $this::class;
            $other_class = $other::class;
            $calling_functions_name = __FUNCTION__;
            $msg = "Error ({$class}::{$calling_functions_name}):"
            . " Trying to prepend a collection of type `" .$other_class 
            . "` to a strictly typed collection of type `{$class}`" . PHP_EOL;
            
            throw new Exceptions\InvalidCollectionOperationException($msg);
        }
        
        return static::parentPrependCollection($other);
    }
    
    /**
     * @see \VersatileCollections\CollectionInterface::prependItem()
     * 
     * @noinspection PhpDocSignatureInspection
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function prependItem(mixed $item, string|int|null $key=null): CollectionInterface 
    {
        $this->isRightTypeOrThrowInvalidTypeException($item, __FUNCTION__);
        
        return static::parentPrependItem($item, $key);
    }
    
    /**
     * @see \VersatileCollections\CollectionInterface::unionMeWith()
     *
     * @noinspection PhpDocSignatureInspection
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function unionMeWith(array $items): CollectionInterface 
    {
        foreach ($items as $item) {
            
            $this->isRightTypeOrThrowInvalidTypeException($item, __FUNCTION__);
        }
        
        return static::parentUnionMeWith($items);
    }
}
