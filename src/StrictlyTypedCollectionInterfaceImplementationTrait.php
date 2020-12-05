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

    /** @noinspection PhpUnhandledExceptionInspection */
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
     */
    public function appendCollection(CollectionInterface $other): CollectionInterface
    {
        
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

    /** @noinspection PhpUnhandledExceptionInspection */
    protected function isRightTypeOrThrowInvalidTypeException($item, string $calling_functions_name): bool {
        
        if( !$this->checkType($item) ) {

            $returned_type = $this->getType();
            $type = (\is_array($returned_type) && (\is_countable($returned_type) ? \count($returned_type) : 0) > 0)
                    ? \implode(' or ', $returned_type) : ((string)$returned_type);
            
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
     */
    public function prependCollection(CollectionInterface $other): CollectionInterface
    {
        
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
     * @noinspection PhpDocSignatureInspection
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function prependItem($item, $key=null): CollectionInterface
    {
        
        $this->isRightTypeOrThrowInvalidTypeException($item, __FUNCTION__);
        
        return static::parentPrependItem($item, $key);
    }
    
    /**
     *  
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
