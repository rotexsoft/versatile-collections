# Versatile Collections

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
        
        return ($item instanceof \PDO);
    }
    
    protected function getType() {
        
        return \PDO::class;
    }
}


```

You can declare your custom typed collection classes as `final` so that users of your 
classes will not be able to extend them and thereby circumvent the type-checking 
being enforced at construct time and item addition time.


## Documentation

* [Quick Start Guide](docs/QUICKSTART.md)
* [Generic Collections](docs/GenericCollections.md)
* [Strictly Typed Collections](docs/StrictlyTypedCollections.md)
    * [Callables Collections](docs/CallablesCollections.md)
    * [Float Collections](docs/FloatCollections.md)
    * [Int Collections](docs/IntCollections.md)
    * [Object Collections](docs/ObjectCollections.md)
    * [Resource Collections](docs/ResourceCollections.md)
    * [Scalar Collections](docs/ScalarCollections.md)
    * [String Collections](docs/StringCollections.md)
* Please submit an issue or a pull request if you find any issues with the documentation.

## Issues

* Please submit an issue or a pull request if you find any bugs or better and 
more efficient way(s) things could be implemented in this package.