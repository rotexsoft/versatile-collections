# Versatile Collections
[![Build Status](https://img.shields.io/travis/rotexsoft/versatile-collections/master.png?style=flat-square)](https://travis-ci.org/rotexsoft/versatile-collections) &nbsp; 
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/39472c4a7ad5402aaf19a38e72ed651c)](https://www.codacy.com/app/rotexdegba/versatile-collections?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=rotexsoft/versatile-collections&amp;utm_campaign=Badge_Grade) &nbsp; 
[![Release](https://img.shields.io/github/release/rotexsoft/versatile-collections.png?style=flat-square)](https://github.com/rotexsoft/versatile-collections/releases/latest) &nbsp; 
[![License](https://img.shields.io/badge/license-BSD-brightgreen.png?style=flat-square)](https://github.com/rotexsoft/versatile-collections/blob/master/LICENSE) &nbsp; 

A collection package that can be extended to implement things such as a Dependency Injection Container,
RecordSet objects for housing database records, a bag of http cookies, or technically any collection of
items that can be looped over and whose items can each be accessed using array-access syntax or object
property syntax.

This package provides optional strict-typing of collection items and strives for 100 % unit-test coverage.

![Collection Classes](versatile-collections.png)

## Installation 

**Via composer:** (Requires PHP 5.6+)


    composer require rotexsoft/versatile-collections


## Basics 

If you are simply looking to store items of the same or differing types in a collection you can use simply use the **GenericCollection** class like so:

```php
<?php 

// items to be stored in your collection
$item1 = ['yabadoo'];                        // an array
$item2 = function(){ echo 'Hello World!'; }; // a callable
$item3 = 777.888;                            // a float
$item4 = 777;                                // an int
$item5 = new \stdClass();                    // an object
$item6 = new \ArrayObject([]);               // another object
$item7 = tmpfile();                          // a resource
$item8 = true;                               // a boolean
$item9 = "true";                             // a string

// Technique 1: pass the items to the constructor of the collection class
$collection = new \VersatileCollections\GenericCollection(
    $item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8, $item9
);

// Technique 2: pass the items in an array using argument unpacking
//              to the constructor of the collection class
$collection = new \VersatileCollections\GenericCollection(
    ...[$item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8, $item9]
);

// Technique 3: pass the items in an array to the static makeNew helper method
//              available in all collection classes
$collection = \VersatileCollections\GenericCollection::makeNew(
    [$item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8, $item9]
);

// Technique 4: create an empty collection object and subsequently add each
//              item to the collection via array assignment syntax or object
//              property assignment syntax or using the appendItem($item), 
//              prependItem($item, $key=null), push($item) or put($key, $value)
//              methods
$collection = new \VersatileCollections\GenericCollection(); // empty collection
// OR
$collection = \VersatileCollections\GenericCollection::makeNew(); // empty collection

$collection[] = $item1; // array assignment syntax without key
                        // the item is automatically assigned
                        // the next available integer key. In
                        // this case 0

$collection[] = $item2; // array assignment syntax without key
                        // the next available integer key in this
                        // case is 1

$collection['some_key'] = $item3; // array assignment syntax with specified key `some_key`

$collection->some_key = $item4; // object property assignment syntax with specified property
                                // `some_key`. This will update $collection['some_key']
                                // changing its value from $item3 to $item4

$collection->appendItem($item3)  // same effect as:
           ->appendItem($item5); //     $collection[] = $item3;
                                 //     $collection[] = $item5;
                                 // Adds an item to the end of the collection    
                                 // You can chain the method calls

$collection->prependItem($item6, 'new_key'); // adds an item with the optional
                                             // specified key to the front of
                                             // collection.
                                             // You can chain the method calls

$collection->push($item7);  // same effect as:
                            //     $collection[] = $item7;
                            // Adds an item to the end of the collection    
                            // You can chain the method calls

$collection->put('eight_item', $item8)  // same effect as:
           ->put('ninth_item', $item9); //     $collection['eight_item'] = $item8;
                                        //     $collection['ninth_item'] = $item9;
                                        // Adds an item with the specified key to 
                                        // the collection. If the specified key
                                        // already exists in the collection the
                                        // item previously associated with the 
                                        // key is overwritten with the new item.    
                                        // You can chain the method calls

```

You can also make any class in your application behave exactly like **\VersatileCollections\GenericCollection** 
by implementing **\VersatileCollections\CollectionInterface** and using 
**\VersatileCollections\CollectionInterfaceImplementationTrait** in such classes.

If you want to enforce strict-typing, the following Collection classes are provided
in this package:

* **ArraysCollection :** a collection that only stores items that are arrays (i.e. items for which is_array is true)
* **CallablesCollection :** a collection that only stores items that are callables (i.e. items for which is_callable is true)
* **FloatsCollection :** a collection that only stores items that are floats (i.e. items for which is_float is true)
* **IntsCollection :** a collection that only stores items that are integers (i.e. items for which is_int is true)
* **NumericsCollection :** a collection that only stores items that are either floats or integers (i.e. items for which is_int or is_float is true)
* **ObjectsCollection :** a collection that only stores items that are objects (i.e. items for which is_object is true)
* **ResourcesCollection :** a collection that only stores items that are resources (i.e. items for which is_resource is true)
* **ScalarsCollection :** a collection that only stores items that are scalars (i.e. items for which is_scalar is true)
* **StringsCollection :** a collection that only stores items that are strings (i.e. items for which is_string is true)

To implement a custom collection that only contains objects that are instances of
a specific class (for example **\PDO**), your custom collection class must adhere to
the following requirements:

* Your custom collection class must implement **\VersatileCollections\StrictlyTypedCollectionInterface**

* It must use **\VersatileCollections\StrictlyTypedCollectionInterfaceImplementationTrait**

* It must implement the two methods below:

    * **public function checkType($item)** : it must return true if `$item` is of the expected type or false otherwise
    * **public function getType()** : it must return a string or an array of strings representing the name(s) of the expected type


* You can optionally override **StrictlyTypedCollectionInterfaceImplementationTrait::__construct(...$arr_objs)** with a constructor
with the same signature but with the specific type. For example, **__construct(\PDO ...$arr_objs)** ensures that only instances of
**\PDO** can be injected into the constructor via argument unpacking. 

The code example below shows how a custom collection class called **PdoCollection**, 
that only stores items that are instances of **\PDO**, can be implemented:

```php
<?php 

class PdoCollection implements \VersatileCollections\StrictlyTypedCollectionInterface {
    
    use \VersatileCollections\StrictlyTypedCollectionInterfaceImplementationTrait;
    
    public function __construct(\PDO ...$arr_objs) {
                
        $this->versatile_collections_items = $arr_objs;
    }

    /**
     * 
     * @return bool true if $item is of the expected type, else false
     * 
     */
    public function checkType($item) {
        
        return ($item instanceof \PDO);
    }
    
    /**
     * 
     * @return string|array a string or array of strings of type name(s) 
     *                      for items acceptable in instances of this 
     *                      collection class
     * 
     */
    public function getType() {
        
        return \PDO::class;
    }
}
```

You can declare your custom typed collection classes as **final** so that users of your 
classes will not be able to extend them and thereby circumvent the type-checking 
being enforced at construct time and item addition time.

## Documentation

* [Quick Start Guide](docs/QUICKSTART.md)
* [Generic Collections](docs/GenericCollections.md)
* Strictly Typed Collections
    * Array Collections
    * [Callables Collections](docs/CallablesCollections.md): a collection that can only contain [callables](http://php.net/manual/en/language.types.callable.php)
    * [Object Collections](docs/ObjectsCollections.md): a collection that can only contain [objects](http://php.net/manual/en/language.types.object.php) (any kind of object)
    * [Resource Collections](docs/ResourcesCollections.md): a collection that can only contain [resources](http://php.net/manual/en/language.types.resource.php)
    * [Scalar Collections](docs/ScalarsCollections.md): a collection that can only scalar values. I.e. any of [booleans](http://php.net/manual/en/language.types.boolean.php), [floats](http://php.net/manual/en/language.types.float.php), [integers](http://php.net/manual/en/language.types.integer.php) or [strings](http://php.net/manual/en/language.types.string.php). It accepts any mix of scalars, e.g. ints, booleans, floats and strings can all be present in an instance of this type of collection.
        * [Numeric Collections](docs/NumericCollections.md): a collection that can only contain [floats](http://php.net/manual/en/language.types.float.php) and/or [integers](http://php.net/manual/en/language.types.integer.php)
            * [Float Collections](docs/FloatsCollections.md): a collection that can only contain [floats](http://php.net/manual/en/language.types.float.php)
            * [Int Collections](docs/IntsCollections.md): a collection that can only contain [integers](http://php.net/manual/en/language.types.integer.php)
        * [String Collections](docs/StringsCollections.md): a collection that can only contain [strings](http://php.net/manual/en/language.types.string.php)

* Please submit an issue or a pull request if you find any issues with the documentation.

## Issues

* Please submit an issue or a pull request if you find any bugs or better and 
more efficient way(s) things could be implemented in this package.
