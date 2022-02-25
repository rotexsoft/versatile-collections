<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace VersatileCollections;

/**
 *
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
 *  
 */
trait StrictlyTypedCollectionInterfaceImplementationTrait {
    
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
     * @psalm-suppress MissingParamType
     */
    public function __construct(...$arr_objs) {
        
        foreach ($arr_objs as $item) {
            
            $this->isRightTypeOrThrowInvalidTypeException($item, __FUNCTION__);
        }
        
        $this->versatile_collections_items = $arr_objs;
    }
    
    /**
     *
     * @see \VersatileCollections\CollectionInterface::appendCollection()
     *
     * @noinspection PhpDocSignatureInspection
     * @noinspection PhpUnhandledExceptionInspection
     * @psalm-suppress LessSpecificImplementedReturnType
     */
    public function appendCollection(CollectionInterface $other): CollectionInterface {
        
        if( 
            \get_class($this) !== \get_class($other)
            && !\is_subclass_of($other, \get_class($this))
        ) {
            $class = \get_class($this);
            $other_class = \get_class($other);
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
     *
     * @param mixed $item
     * @throws Exceptions\InvalidItemException
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @psalm-suppress RedundantConditionGivenDocblockType
     * @psalm-suppress PossiblyInvalidCast
     * @psalm-suppress DocblockTypeContradiction
     * @psalm-suppress PossiblyInvalidArgument
     * @psalm-suppress RedundantCastGivenDocblockType
     */
    protected function isRightTypeOrThrowInvalidTypeException($item, string $calling_functions_name): bool {
        
        if( !$this->checkType($item) ) {
            
            /** @var StringsCollection $returned_type */
            $returned_type = $this->getTypes();
            $type = ($returned_type->count() > 1)
                    ? \implode(' or ', $returned_type->toArray()) 
                    : (($returned_type->count() === 1) ? $returned_type->firstItem() : '');
            
            $class = \get_class($this);
            $msg = "Error ({$class}::{$calling_functions_name}):"
            . " Trying to add an item of type `" . Utils::gettype($item) 
            . "` to a strictly typed collection for items of type(s) `{$type}`"
            . PHP_EOL;
            
            throw new Exceptions\InvalidItemException($msg);
        }
        
        return true;
    }
    
    /**
     *  
     * @see \VersatileCollections\CollectionInterface::offsetSet()
     * 
     * @param string|int|null $key The requested key.
     * @param mixed $val The value to set it to.
     *
     * @noinspection PhpDocSignatureInspection
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function offsetSet($key, $val): void {
        
        $this->isRightTypeOrThrowInvalidTypeException($val, __FUNCTION__);
        
        static::parentOffsetSet($key, $val);
    }
    
    /**
     *
     * @see \VersatileCollections\CollectionInterface::prependCollection()
     *
     * @noinspection PhpDocSignatureInspection
     * @noinspection PhpUnhandledExceptionInspection
     *
     * @psalm-suppress LessSpecificImplementedReturnType
     */
    public function prependCollection(CollectionInterface $other): CollectionInterface {
        
        if( 
            \get_class($this) !== \get_class($other)
            && !\is_subclass_of($other, \get_class($this))
        ) {
            $class = \get_class($this);
            $other_class = \get_class($other);
            $calling_functions_name = __FUNCTION__;
            $msg = "Error ({$class}::{$calling_functions_name}):"
            . " Trying to prepend a collection of type `" .$other_class 
            . "` to a strictly typed collection of type `{$class}`" . PHP_EOL;
            
            throw new Exceptions\InvalidCollectionOperationException($msg);
        }
        
        return static::parentPrependCollection($other);
    }
    
    /**
     *  
     * @see \VersatileCollections\CollectionInterface::prependItem()
     * 
     * @param mixed $item
     * @param string|int|null $key
     *
     * @noinspection PhpDocSignatureInspection
     * @noinspection PhpUnhandledExceptionInspection
     * @psalm-suppress LessSpecificImplementedReturnType
     */
    public function prependItem($item, $key=null): CollectionInterface {
        
        $this->isRightTypeOrThrowInvalidTypeException($item, __FUNCTION__);
        
        return static::parentPrependItem($item, $key);
    }
    
    /**
     *  
     * @see \VersatileCollections\CollectionInterface::unionMeWith()
     *
     * @noinspection PhpDocSignatureInspection
     * @noinspection PhpUnhandledExceptionInspection
     * @psalm-suppress LessSpecificImplementedReturnType
     */
    public function unionMeWith(array $items): CollectionInterface {
        
        foreach ($items as $item) {
            
            $this->isRightTypeOrThrowInvalidTypeException($item, __FUNCTION__);
        }
        
        return static::parentUnionMeWith($items);
    }
}
