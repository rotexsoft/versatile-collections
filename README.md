# versatile-collections

![Collection Classes](https://raw.githubusercontent.com/rotexsoft/versatile-collections/master/versatile-collections.png)

Use or extend the `GenericCollection` class to create collections that can contain items of differing types.

Extend the `StrictlyTypedCollection` class or directly use any of its sub-classes to create collections 
that will only contain items of the same type (e.g. objects, ints, floats, strings, callables, resources etc).

To create a custom strictly typed collection of objects belonging to a specific class, follow the pattern below 
(we are creating a collection of PDO objects below):

```php
<?php 

class PdoCollection extends \VersatileCollections\StrictlyTypedCollection {

    // Completely override __construct of
    // \VersatileCollections\StrictlyTypedCollection.
    //
    // The type-hint in the constructor's signature
    // will guarantee that only instances of \PDO
    // will be successfully injected into this class
    // at construct time
    public function __construct(\PDO ...$arr_objs) {
                
        $this->collection_items = $arr_objs;
    }

    // $this->checkType($item) will be used in 
    // \VersatileCollections\StrictlyTypedCollection::offsetSet($key, $val)
    // when items are added to this collection via
    // the $this['key_name'] = ....
    // or the  $this[] = .......
    // or $this->key_name = .....
    // syntax
    protected function checkType($item) {
        
        return is_object($item) 
               && 
               ( 
                    trim(get_class($item)) === ($this->getType()) 
               );
    }
    
    protected function getType() {
        
        return \PDO::class;
    }
}


```