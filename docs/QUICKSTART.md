# **Quick Start**

## **Architecture**

* **CollectionInterface** (contains methods that non-strictly typed collections must implement)
    * **StrictlyTypedCollectionInterface** (extends **CollectionInterface** and also contains additional methods that strictly typed collections must implement)

* **CollectionInterfaceImplementationTrait** (contains implementation of methods specified in **CollectionInterface** and other helper methods)
    * **StrictlyTypedCollectionInterfaceImplementationTrait** (contains implementation of methods specified in **StrictlyTypedCollectionInterface** and other helper methods). Also uses **CollectionInterfaceImplementationTrait** trait.

The various Collection implementations in this package can be used directly or 
extended in your applications. 

### **Non-Strictly Typed Collections**
* **GenericCollection**: A collection class that can be used to store any type of data (use it if you don't require strict-typing). It implements **CollectionInterface** and uses the **CollectionInterfaceImplementationTrait** trait.
* If you already have one or more collection class(es) (that do not require strict-typing) in your application, but want to leverage some of the features in this package you can either:
    * make those class(es) extend **GenericCollection**
    * or make those class(es) implement **CollectionInterface** and also use the **CollectionInterfaceImplementationTrait** trait

### **Strictly Typed Collections**
This package provides the following strictly-typed collection classes that can be used out of the box.
Each of these classes or one of their parent class(es) implement **StrictlyTypedCollectionInterface** 
and use the **StrictlyTypedCollectionInterfaceImplementationTrait** trait.

* **ArraysCollection:** a collection that only stores items that are [arrays](http://php.net/manual/en/language.types.array.php) (i.e. items for which is_array is true)

* **CallablesCollection:** a collection that only stores items that are [callables](http://php.net/manual/en/language.types.callable.php) (i.e. items for which is_callable is true)

* **ObjectsCollection:** a collection that only stores items that are [objects](http://php.net/manual/en/language.types.object.php) (i.e. items for which is_object is true)

* **ResourcesCollection:** a collection that only stores items that are [resources](http://php.net/manual/en/language.types.resource.php) (i.e. items for which is_resource is true)

* **ScalarsCollection:** a collection that only stores items that are scalars (i.e. items for which is_scalar is true). Namely, [booleans](http://php.net/manual/en/language.types.boolean.php), [floats](http://php.net/manual/en/language.types.float.php), [integers](http://php.net/manual/en/language.types.integer.php) or [strings](http://php.net/manual/en/language.types.string.php). It accepts any mix of scalars, e.g. ints, booleans, floats and strings can all be present in an instance of this type of collection.
    
    * **NumericsCollection:** a collection that only stores items that are either [floats](http://php.net/manual/en/language.types.float.php) or [integers](http://php.net/manual/en/language.types.integer.php) (i.e. items for which is_int or is_float is true). Namely, [floats](http://php.net/manual/en/language.types.float.php) and/or [integers](http://php.net/manual/en/language.types.integer.php). Any mix of integers and floats can all be present in an instance of this type of collection.

        * **FloatsCollection:** a collection that only stores items that are [floats](http://php.net/manual/en/language.types.float.php) (i.e. items for which is_float is true)

        * **IntsCollection:** a collection that only stores items that are [integers](http://php.net/manual/en/language.types.integer.php) (i.e. items for which is_int is true)

    * **StringsCollection:** a collection that only stores items that are [strings](http://php.net/manual/en/language.types.string.php) (i.e. items for which is_string is true)
        
## **Features common to all Collection classes**

If you do not require strict-typing, simply use **GenericCollection**.

The code samples below use the **GenericCollection** class, but will work with other collection classes (with the right type of item(s)).

### **Creating Collection objects**

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

> Note that the constructors for all collection classes use the variadic function signature. 
Therefore if you want to pass an array of items to the constructor you have to use the argument 
unpacking syntax (like in the some of the examples above) or you could call the `static` method 
`\VersatileCollections\CollectionInterface::makeNew(array $items=[], $preserve_keys=true)` which
can accept an array of items without the need for argument unpacking, it can also preserve the 
keys in the **`$items`** array (this is actually the way to create a collection with desired
keys other than the sequential 0-based numeric keys that are generated when argument unpacking
is used with the constructor).

### **Dynamically Registering Methods**
You can add extra methods to your collection classes via one of the methods below:

* Adding a dynamic static method to a collection class:
```php
<?php 

    $method_name = 'getBlah'; // name of the method you are adding
    $method = function(){ return 'blah'; }; // method implementation
    $has_return_val = true; // true means the return value will be returned

    \VersatileCollections\GenericCollection::addStaticMethod(
        $method_name, $method, $has_return_val
    );

    // you can then call the newly added static method like so:
    \VersatileCollections\GenericCollection::getBlah(); // will return the string 'blah'

    // Addition of these static methods also respect inheritance rules.
    // For example adding a dynamic static method to a parent collection class will
    // also make the method available to all child classes and adding a dynamic static
    // method in a child class with the same name as a parent class' dynamic static method
    // will override the implementation of the dynamic static method registered at the parent
    // class level.

    // add to parent class
    \VersatileCollections\ScalarsCollection::addStaticMethod(
        'getBlah', 
        function() { return 'blah'; }, 
        true
    );

    // invoke from child class
    \VersatileCollections\StringsCollection::getBlah(); // will return the string
                                                        // 'blah'

    // add to specific class, which should override the one
    // added to the parent class
    \VersatileCollections\StringsCollection::addStaticMethod(
        'getBlah', 
        function() { return 'blah from child class'; }, 
        true
    );

    // invoke from child class after the override
    \VersatileCollections\StringsCollection::getBlah(); // will return the string
                                                        // 'blah from child class'
```

* Adding a dynamic instance method to **all instances** of a collection class and its sub-classes:
```php
<?php
    $collection_obj = new \VersatileCollections\GenericCollection();

    $method_name = 'getBlah'; // name of the method you are adding
    $method = function(){ return 'blah'; }; // method implementation
    $has_return_val = true; // true means the return value will be returned
    $bind_to_this = true; // true means $this inside $method will be a reference 
                          // to collection object $method is being invoked on 

    \VersatileCollections\GenericCollection::addMethodForAllInstances(
        $method_name, $method, $has_return_val, $bind_to_this
    );

    // you can then call the newly added instance method like so:
    $collection_obj->getBlah(); // will return the string 'blah'

    // Addition of these instance methods also respect inheritance rules.
    // For example adding a dynamic instance method to an instance of a parent collection class will
    // also make the method available to all child class instances and adding a dynamic instance
    // method in a child class with the same name as a parent class' dynamic instance method
    // will override the implementation of the dynamic instance method registered at the parent
    // class level.

    $parent_collection_object = new \VersatileCollections\ScalarsCollection(1, 2);
    
    // add to parent class
    \VersatileCollections\ScalarsCollection::addMethodForAllInstances(
        'getBlah', 
        function() { return "blah from ScalarsCollection with {$this->count()} items"; }, 
        true,
        true
    );
        
    // invoke from parent class
    $parent_collection_object->getBlah(); // will return the string
                                          // 'blah from ScalarsCollection with 2 items'

    $child_collection_object = new \VersatileCollections\StringsCollection('1', '2', '3');
        
    // invoke from child class
    $child_collection_object->getBlah(); // will return the string
                                         // 'blah from ScalarsCollection with 3 items'

    // add to specific class, which should override the one
    // added to the parent class
    \VersatileCollections\StringsCollection::addMethodForAllInstances(
        'getBlah', 
        function() { return "blah from StringsCollection with {$this->count()} items"; }, 
        true,
        true
    );

    // invoke from child class after the override
    $child_collection_object->getBlah(); // will return the string
                                         // 'blah from StringsCollection with 3 items'
```

* Adding a dynamic instance method to a **single instance** of a collection class:
```php
<?php 

    $collection_obj = new \VersatileCollections\GenericCollection();

    $method_name = 'getCount'; // name of the method you are adding
    $method = function(){ return $this->count(); }; // method implementation
    $has_return_val = true; // true means the return value will be returned
    $bind_to_this = true; // true means $this inside $method will be a reference 
                          // to $collection_obj

    $collection_obj->addMethod(
        $method_name, $method, $has_return_val, $bind_to_this
    );

    // you can then call the newly added instance method like so:
    $collection_obj->getCount(); // will return the value `0`

    // add another item to the collection
    $collection_obj[] = 'an item';

    // calling the newly added instance method after adding an item to the collection
    $collection_obj->getCount(); // will return an updated count value of `1`
```
> Dynamic instance methods added for a single instance having the same name as
dynamic instance method added for all instances will override the method 
implementation for all instances.

### **Accessing and Extracting Items from a Collection**

Items in the collection can be accessed using the array element access or
object property access syntax.

```php
<?php 

    $collection = \VersatileCollections\GenericCollection::makeNew(
       ['first_key'=>'first item', 'second_key'=>'second item']
    );

    // array access syntax
    $collection['first_key']; // === 'first item'

    // object property access syntax
    $collection->first_key; // === 'first item'
```

To get the first item in a collection, use **firstItem()** or **getAndRemoveFirstItem()**.
Similarly, use **lastItem()** or **getAndRemoveLastItem()** to get the last item in a collection.

```php
<?php 

    $collection = \VersatileCollections\GenericCollection::makeNew(
       ['first_key'=>'first item', 'second_key'=>'second item']
    );

    // get the first item
    $collection->firstItem(); // === 'first item'

    // get the last item
    $collection->lastItem(); // === 'second item'

    // at this point the collection still contains
    // ['first_key'=>'first item', 'second_key'=>'second item']

    // get and remove the first item
    $collection->getAndRemoveFirstItem(); // === 'first item'

    // get and remove the last item
    $collection->getAndRemoveLastItem(); // === 'second item'

    // at this point the collection is empty
```

To get an item with a specified key (if such a key exists in the collection) 
or a default value (if such a key doesn't exist in the collection), use 
**getIfExists($key, $default_value=null)** or **pull($key, $default = null)**.
The latter gets the item and also removes it from the collection.

```php
<?php 

    $collection = \VersatileCollections\GenericCollection::makeNew(
       ['first_key'=>'first item', 'second_key'=>'second item']
    );

    $collection->getIfExists('first_key'); // === 'first item'
    $collection->getIfExists('second_key'); // === 'second item'

    // at this point the collection still contains
    // ['first_key'=>'first item', 'second_key'=>'second item']

    // get and remove
    $collection->pull('first_key'); // === 'first item'
    $collection->pull('second_key'); // === 'second item'

    // at this point the collection is empty

    // default value
    $collection->pull('second_key', -999); // === -999
```

To get a collection of all the keys in a collection, use **getKeys()**.

To get a collection of all the items in a collection, use **getItems()**. 
This is an easy way of converting a collection to one with sequentially increasing
numeric keys with the first key being **0**.

For collections of arrays and / or objects, you can pluck a collection of values
associated with a specified array key in each array or specified property name 
in each object via the **column($column_key, $index_key=null)** method. 
Similar to php's array_column.

```php
<?php 

    // collection of objects
    $data = [];
    $data[] = (object)['id' => 17, 777 => 67, 'edition' => 2, 'title'=>"Boo"];
    $data[] = (object)['id' => 27, 777 => 86, 'edition' => 1, 'title'=>"Coo"];
    $data[] = (object)['id' => 37, 777 => 85, 'edition' => 6, 'title'=>"Doo"];
    $data[] = (object)['id' => 47, 777 => 98, 'edition' => 2, 'title'=>"Foo"];
    $data[] = (object)['id' => 57, 777 => 86, 'edition' => 6, 'title'=>"Goo"];
    $data[] = (object)['id' => 67, 777 => 67, 'edition' => 7, 'title'=>"Hoo"];
    $collection = new \VersatileCollections\GenericCollection(...$data);

    // get a collection of of the values associated with the `title` property
    // of each object in the collection.
    $collection->column('title'); // returns a collection containing
                                  // [ 0=>'Boo', 1=>'Coo', 2=>'Doo', 3=>'Foo', 4=>'Goo', 5=>'Hoo' ]

    // you can also specify the object property whose corresponding values should
    // be used as the keys in the collection to be returned. Let's use the `id` 
    // property for the keys:
    $collection->column('title', 'id'); // returns a collection containing
                                        // [ 17=>'Boo', 27=>'Coo', 37=>'Doo', 47=>'Foo', 57=>'Goo', 67=>'Hoo' ]

    // collection of arrays
    $data = [];
    $data[] = ['id' => 17, 777 => 67, 'edition' => 2, 'title'=>"Boo"];
    $data[] = ['id' => 27, 777 => 86, 'edition' => 1, 'title'=>"Coo"];
    $data[] = ['id' => 37, 777 => 85, 'edition' => 6, 'title'=>"Doo"];
    $data[] = ['id' => 47, 777 => 98, 'edition' => 2, 'title'=>"Foo"];
    $data[] = ['id' => 57, 777 => 86, 'edition' => 6, 'title'=>"Goo"];
    $data[] = ['id' => 67, 777 => 67, 'edition' => 7, 'title'=>"Hoo"];
    $collection = new \VersatileCollections\GenericCollection(...$data);

    // get a collection of of the values associated with the `title` key
    // of each array in the collection.
    $collection->column('title'); // returns a collection containing
                                  // [ 0=>'Boo', 1=>'Coo', 2=>'Doo', 3=>'Foo', 4=>'Goo', 5=>'Hoo' ]

    // you can also specify the array key whose corresponding values should
    // be used as the keys in the collection to be returned. Let's use the `id` 
    // key for the keys:
    $collection->column('title', 'id'); // returns a collection containing
                                        // [ 17=>'Boo', 27=>'Coo', 37=>'Doo', 47=>'Foo', 57=>'Goo', 67=>'Hoo' ]
```

To extract a collection of every nth element in a collection you can call the 
**everyNth($n, $position_of_first_nth_item = 0)** method.

```php
<?php 

    $collection = new \VersatileCollections\GenericCollection(
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'
    );

    // every 4th item starting from the 0-indexed 0th position (actually 1st)
    $collection->everyNth(4); // returns a collection containing
                              // ['a',  'e']

    // every 4th item starting from the 0-indexed 3rd position (actually 4th)
    $collection->everyNth(4, 3); // returns a collection containing
                                 // ['d',  'h']
```

To break-up a collection into a collection of sub-collections (each having a size of **N**), 
use **getCollectionsOfSizeN($max_size_of_each_collection=1)**.<br>
You can also use **yieldCollectionsOfSizeN($max_size_of_each_collection=1)** which returns a 
Generator that yields each sub-collection.
```php
<?php 

    $collection = new \VersatileCollections\GenericCollection(1,2,3,4,5,6,7);

    // Get sub-collections each containing at most 2 items
    $collection->getCollectionsOfSizeN(2); // returns a collection containing
                                           // [ 
                                           //   [0=>1,1=>2],  // sub-collection
                                           //   [2=>3, 3=>4], // sub-collection
                                           //   [4=>5, 5=>6], // sub-collection
                                           //   [6=>7]        // sub-collection
                                           // ]
```

To extract a slice of items from a collection with the corresponding keys preserved 
in the slice, use **slice($offset, $length = null)**.<br> 
It works exactly like php's [array_slice](http://php.net/manual/en/function.array-slice.php)
with **$preserve_keys** always set to true.
```php
<?php 

    $collection = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5, 6, 7, 8]);

    // Slice three items from the collection starting from the fourth item
    // NOTE: that the position is 0-indexed.
    $collection->slice(3, 3); // returns a collection containing
                              // [ 3=>4, 4=>5, 5=>6 ]
```

To remove a portion of a collection (and optionally replace it with something else)
with the removed portion returned as a new collection, use 
**splice($offset, $length=null, array $replacement=[])**.<br> 
It works exactly like php's [array_splice](http://php.net/manual/en/function.array-splice.php).
```php
<?php 

    $collection = new \VersatileCollections\GenericCollection("red", "green", "blue", "yellow");
    // remove the third element in the collection up until the last
    $collection->splice(2); // returns a collection containing
                            // [ 0=>'blue', 1=>'yellow' ]
    // $collection now contains [ 0=>'red', 1=>'green' ]


    $collection = new \VersatileCollections\GenericCollection("red", "green", "blue", "yellow");
    // remove the second element in the collection up until the last 
    // and replace all of them with an item: "orange"
    $collection->splice(1, count($collection), ["orange"]); // returns a collection containing 
                                                            // [ 0=>'green', 1=>'blue', 2=>'yellow' ]
    // $collection now contains [ 0=>'red', 1=>'orange' ]
```

To break-up a collection into a collection of **N** sub-collections, 
use **split($numberOfGroups)**.







You can get a random key, or a collection of random keys, or a random item, or 
a collection of random items from a collection by using **randomKey()**, 
**randomKeys($number=1)**, **randomItem()** or 
**randomItems($number=1, $preserve_keys=false)**









To access items in the collection, you can loop through the collection via 
`foreach` or call the `getIterator()` method on the collection object to get
the iterator and the use that iterator in whatever way you choose. You can also
access items using the object property syntax (e.g. `$empty_generic_collection->new_item`)
or array syntax (e.g. `$empty_generic_collection['another_new_item']`).

To delete items from the collection, you can call `unset` like so:

```php
    unset($empty_generic_collection->new_item);

    // OR 

    unset($empty_generic_collection['another_new_item']);
```

To check if a key exists in the collection, you can call `isset` like so:
```php
    isset($empty_generic_collection->new_item);

    // OR 

    isset($empty_generic_collection['another_new_item']);
```

## Other methods applicable to all Collection classes or their descendants:
* **`appendCollection(CollectionInterface $other)`:** Appends all items from $other collection to the end of $this collection. Note that appended items will be assigned numeric keys.
    ```php
        
        $numeric_collection = new \VersatileCollections\NumericsCollection(
            1.0, 2.0, 3, 4, 5, 6
        );
        
        $int_collection = new \VersatileCollections\IntsCollection(
            8, 9, 10, 11
        );
        
        // append a sub-class collection
        $numeric_collection->appendCollection($int_collection);

        var_dump( $numeric_collection->toArray() );
    ```
    outputs
    ```
        array(10) {
          [0] =>
          double(1)
          [1] =>
          double(2)
          [2] =>
          int(3)
          [3] =>
          int(4)
          [4] =>
          int(5)
          [5] =>
          int(6)
          [6] =>
          int(8)
          [7] =>
          int(9)
          [8] =>
          int(10)
          [9] =>
          int(11)
        }
    ```
* **`appendItem($item)`:** Appends an $item to the end of $this collection. Same effect as `$collection[] = 'some item';`
* **`containsItem($item)`:** Check if a collection contains an item
* **`containsKey($key)`:** Check if a key exists in a collection
* **`count()`:** Returns the number of items in a collection object
* **`filterAll(callable $filterer, $copy_keys=false)`:** Filter out items in the collection via a callback function and return filtered items in a new collection. Note that the filtered items are not removed from the original collection. `$filterer` is a callback with the following signature `function($key, $item)` that returns true if an item should be filtered out, or false if not
    ```php
        $collection_of_ints = 
            new \VersatileCollections\IntsCollection(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        
        // don't preserve keys
        $collection_of_even_ints = $collection_of_ints->filter(
            
            function($key, $item) {
            
                return ($item % 2) === 0;
            }    
        );
        
        // At this point
        // $collection_of_even_ints->toArray() === [2, 4, 6, 8, 10]
        
        // preserve keys 
        $collection_of_even_ints = $collection_of_ints->filter(
            
            function($key, $item) {
            
                return ($item % 2) === 0;
            },
            true
        );
        
        // At this point
        // $collection_of_even_ints->toArray() === [1=>2, 3=>4, 5=>6, 7=>8, 9=>10]
    ```
* **`filterFirstN(callable $filterer, $max_number_of_filtered_items_to_return =null, $copy_keys=false)`:** Filter out the first N items in the collection via a callback function and return filtered items in a new collection. Note that the filtered items are not removed from the original collection. `$filterer` is a callback with the following signature `function($key, $item)` that returns true if an item should be filtered out, or false if not
    ```php
        $collection_of_ints = 
            new \VersatileCollections\IntsCollection(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        
        // don't preserve keys
        $collection_of_all_even_ints = $collection_of_ints->filterFirstN(
            
            function($key, $item) {
            
                return ($item % 2) === 0;
            }    
        );
        
        // At this point
        // $collection_of_all_even_ints->toArray() === [2, 4, 6, 8, 10]
        
        // first 3
        $collection_of_first_3_even_ints = $collection_of_ints->filterFirstN(
            
            function($key, $item) {
            
                return ($item % 2) === 0;
            },
            3
        );

        // At this point
        // $collection_of_first_3_even_ints->toArray() === [2, 4, 6]
        
        // preserve keys 
        $collection_of_all_even_ints = $collection_of_ints->filterFirstN(
            
            function($key, $item) {
            
                return ($item % 2) === 0;
            },
            null,
            true
        );
        
        // At this point
        // $collection_of_all_even_ints->toArray() === [1=>2, 3=>4, 5=>6, 7=>8, 9=>10]

        $collection_of_first_3_even_ints = $collection_of_ints->filterFirstN(
            
            function($key, $item) {
            
                return ($item % 2) === 0;
            },
            3,
            true
        );
        
        // At this point
        // $collection_of_first_3_even_ints->toArray() === [1=>2, 3=>4, 5=>6]
    ```
* **`firstItem()`:** Returns the first item in a collection object
* **`getCollectionsOfSizeN($max_size_of_each_collection=1)`:** Returns a generator that yields collections each having a maximum of `$max_size_of_each_collection`. Original keys are preserved in each returned collection.
    ```php
        $int_collection = new \VersatileCollections\IntsCollection(
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15
        );
        
        $sub_collections_generator = $int_collection->getCollectionsOfSizeN(3);
        
        foreach( $sub_collections_generator as $sub_collection ) {
            
            var_dump( $sub_collection->toArray() );
        }
    ```
    outputs
    ```
        array(3) {
          [0] =>
          int(1)
          [1] =>
          int(2)
          [2] =>
          int(3)
        }

        array(3) {
          [3] =>
          int(4)
          [4] =>
          int(5)
          [5] =>
          int(6)
        }

        array(3) {
          [6] =>
          int(7)
          [7] =>
          int(8)
          [8] =>
          int(9)
        }

        array(3) {
          [9] =>
          int(10)
          [10] =>
          int(11)
          [11] =>
          int(12)
        }

        array(3) {
          [12] =>
          int(13)
          [13] =>
          int(14)
          [14] =>
          int(15)
        }
    ```
    You can use the `iterator_to_array()` function to convert the generator to an array of collections like so:
    ```php
        $int_collection = new \VersatileCollections\IntsCollection(
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15
        );
        
        $sub_collections = iterator_to_array($int_collection->getCollectionsOfSizeN(3));
        
        var_dump($sub_collections);
    ```
    which outputs
    ```
        array(5) {
          [0] =>
          class VersatileCollections\IntsCollection#6 (1) {
            protected $collection_items =>
            array(3) {
              [0] =>
              int(1)
              [1] =>
              int(2)
              [2] =>
              int(3)
            }
          }
          [1] =>
          class VersatileCollections\IntsCollection#7 (1) {
            protected $collection_items =>
            array(3) {
              [3] =>
              int(4)
              [4] =>
              int(5)
              [5] =>
              int(6)
            }
          }
          [2] =>
          class VersatileCollections\IntsCollection#8 (1) {
            protected $collection_items =>
            array(3) {
              [6] =>
              int(7)
              [7] =>
              int(8)
              [8] =>
              int(9)
            }
          }
          [3] =>
          class VersatileCollections\IntsCollection#9 (1) {
            protected $collection_items =>
            array(3) {
              [9] =>
              int(10)
              [10] =>
              int(11)
              [11] =>
              int(12)
            }
          }
          [4] =>
          class VersatileCollections\IntsCollection#10 (1) {
            protected $collection_items =>
            array(3) {
              [12] =>
              int(13)
              [13] =>
              int(14)
              [14] =>
              int(15)
            }
          }
        }
    ```
* **`getKeys()`:** Returns an array containing the keys to each item in a collection object
* **`getIfExists($key, $default_value=null)`:** Try to get an item with the specified key ($key) or return $default_value if key does not exist
* **`isEmpty()`:** Returns true if a collection object contains one or more items, else false
* **`lastItem()`:** Returns the last item in a collection object
* **`makeAllKeysNumeric()`:** Convert all keys in the collection to consecutive integer keys
    ```php
        $collection = new \VersatileCollections\GenericCollection();
        $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
        $collection->item2 = ['name'=>'Jane', 'age'=>'20',];
        $collection->item3 = ['name'=>'Janice', 'age'=>'30',];
        
        var_dump($collection->toArray());
    ```

    outputs

    ```
        array(3) {
          'item1' =>
          array(2) {
            'name' =>
            string(3) "Joe"
            'age' =>
            string(2) "10"
          }
          'item2' =>
          array(2) {
            'name' =>
            string(4) "Jane"
            'age' =>
            string(2) "20"
          }
          'item3' =>
          array(2) {
            'name' =>
            string(6) "Janice"
            'age' =>
            string(2) "30"
          }
        }
    ```

    now make all keys numeric like so:

    ```php
        $collection->makeAllKeysNumeric();

        var_dump($collection->toArray());
    ```

    code above now outputs:

    ```
        array(3) {
          [0] =>
          array(2) {
            'name' =>
            string(3) "Joe"
            'age' =>
            string(2) "10"
          }
          [1] =>
          array(2) {
            'name' =>
            string(4) "Jane"
            'age' =>
            string(2) "20"
          }
          [2] =>
          array(2) {
            'name' =>
            string(6) "Janice"
            'age' =>
            string(2) "30"
          }
        }
    ```
* **`makeNew(array $items=[], $preserve_keys=true)`:** A static factory method for creating new collection objects from an array of items. Using this method eliminates the need for argument unpacking which is required by all collection constructors when you try to create new collection objects from an array of items. The keys in the **`$items`** array will be maintained in the created collection if **$preserve_keys** is set to **true**. If **$preserve_keys** is set to **false**, the keys in the created collection will be sequentially numeric starting from **0** (only set **$preserve_keys** to **false** if **$items** contains no string keys, else a PHP fatal error will be thrown because this method uses argument unpacking when **$preserve_keys** is set to **false**). If you don't need to preserve the keys in **$items**, it is more efficient to set **$preserve_keys** to **false**.
    ```php
        $items = ['item 1', 'key_for_item_2'=>'item 2', 'item 3', 'item 4'];
        $generic_collection_with_items = \VersatileCollections\GenericCollection::makeNew($items);

        // $generic_collection_with_items->toArray() 
        //  === [ 0 => 'item 1', 'key_for_item_2' => 'item 2', 1 => 'item 3', 2 => 'item 4' ]
    ```
* **`merge(CollectionInterface $other)`:** Adds all items from $other collection to $this collection. Items in $other with existing keys in $this will overwrite the existing items in $this.
    ```php
        $numeric_collection = new \VersatileCollections\NumericsCollection(
            1.0, 2.0, 3, 4, 5, 6
        ); // underlying array contains [ 0=>1.0, 1=>2.0, 2=>3, 3=>4, 4=>5, 5=>6 ]
        
        $int_collection = new \VersatileCollections\IntsCollection(
            8, 9, 10, 11
        ); // underlying array contains [ 0=>8, 1=>9, 2=>10, 3=>11 ]

        // do the merge
        $numeric_collection->merge($int_collection);

        var_dump( $numeric_collection->toArray() );
    ```
    outputs
    ```
        array(6) {
          [0] =>
          int(8)
          [1] =>
          int(9)
          [2] =>
          int(10)
          [3] =>
          int(11)
          [4] =>
          int(5)
          [5] =>
          int(6)
        }
    ```
* **`prependCollection(CollectionInterface $other)`:** Prepends all items from $other collection to the front of $this collection. Note that all numerical keys will be modified to start counting from zero while literal keys won't be changed.
    ```php
        $numeric_collection = new \VersatileCollections\NumericsCollection(
            1.0, 2.0, 3, 4, 5, 6
        );

        $int_collection = new \VersatileCollections\IntsCollection(
            8, 9, 10, 11
        );

        // prepend a sub-class collection
        $numeric_collection->prependCollection($int_collection);

        var_dump( $numeric_collection->toArray() );
    ```
    outputs
    ```
        array(10) {
          [0] =>
          int(8)
          [1] =>
          int(9)
          [2] =>
          int(10)
          [3] =>
          int(11)
          [4] =>
          double(1)
          [5] =>
          double(2)
          [6] =>
          int(3)
          [7] =>
          int(4)
          [8] =>
          int(5)
          [9] =>
          int(6)
        }
    ```
* **`prependItem($item, $key=null)`:** Prepends an $item to the front of $this collection.
    ```php
        $numeric_collection = new \VersatileCollections\NumericsCollection(
            1.0, 2.0, 3, 4, 5, 6
        );

        // prepend an item
        $numeric_collection->prependItem(99, 'key_for99');
        $numeric_collection->prependItem(150);

        var_export( $numeric_collection->toArray() );
    ```
    outputs
    ```
        [ 0 => 150, 'key_for99' => 99, 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6 ]
    ```
* **`reduce(callable $reducer, $initial_value=NULL)`:** Iteratively reduce the collection items to a single value using a callback function. See [array_reduce](http://php.net/manual/en/function.array-reduce.php) documentation for definition of $reducer.
    ```php
        $collection = new \VersatileCollections\GenericCollection(
            50 , 23, 43, 55
        );

        $sum_of_items = $collection->reduce(
            function($carry, $item) {
            
                return $carry + $item;
            }
        );
        
        echo $sum_of_items; // will output 171

        $sum_of_items_plus_ten = $collection->reduce(
            function($carry, $item) {
            
                return $carry + $item;
            },
            10
        );
        
        echo $sum_of_items_plus_ten; // will output 181
    ```
* **`setValForEachItem($field_name, $field_val, $add_field_if_not_present=false)`:** This method is useful for collections where each item is either an object or an array. It sets a value for a field / key in each item (object / array) in the collection. See example below:

    ```php
        $empty_generic_collection = new \VersatileCollections\GenericCollection();

        $empty_generic_collection[] = ['name'=>'John Doe', 'age'=>20];
        $empty_generic_collection[] = ['name'=>'Jane Doe', 'age'=>30];
        $empty_generic_collection[] = ['name'=>'Jack Doe', 'age'=>40];
        $empty_generic_collection[] = ['name'=>'Jill Doe', 'age'=>50];

        // set the `age` field for each collection item to 25
        $empty_generic_collection->setValForEachItem('age', 25);

        // will throw an exception because there is no `hobby` key in each item's array
        // $empty_generic_collection->setValForEachItem('hobby', 'Baseball');

        // Now, add a hobby field to each collection item with a value of `Baseball`.
        // Will not throw an exception even though there is no `hobby` key in each item's array
        // because we passed a third parameter value of true, allowing setValForEachItem to
        // add non-existent keys to each item.
        $empty_generic_collection->setValForEachItem('hobby', 'Baseball', true);

        var_dump($empty_generic_collection);
    ```
    ```
        object(VersatileCollections\GenericCollection)#3 (1) {
          ["collection_items":protected]=>
          array(4) {
            [0]=>
            array(3) {
              ["name"]=>
              string(8) "John Doe"
              ["age"]=>
              int(25)
              ["hobby"]=>
              string(8) "Baseball"
            }
            [1]=>
            array(3) {
              ["name"]=>
              string(8) "Jane Doe"
              ["age"]=>
              int(25)
              ["hobby"]=>
              string(8) "Baseball"
            }
            [2]=>
            array(3) {
              ["name"]=>
              string(8) "Jack Doe"
              ["age"]=>
              int(25)
              ["hobby"]=>
              string(8) "Baseball"
            }
            [3]=>
            array(3) {
              ["name"]=>
              string(8) "Jill Doe"
              ["age"]=>
              int(25)
              ["hobby"]=>
              string(8) "Baseball"
            }
          }
        }
    ```
    `setValForEachItem` also works with a collection containing objects:

    ```php
        $collection = new \VersatileCollections\GenericCollection();
        $collection[] = (object)['name'=>'Joe', 'age'=>'10',];
        $collection[] = (object)['name'=>'Jane', 'age'=>'20',];
        $collection[] = (object)['name'=>'Janice', 'age'=>'30',];

        // set the `age` field for each collection item to 24
        $collection->setValForEachItem('age', 24);

        // will throw an exception because there is no `hobby` propety in each item's object
        // $collection->setValForEachItem('hobby', 'Baseball');

        // Now, add a hobby property to each collection item with a value of `Baseball`.
        // Will not throw an exception even though there is no `hobby` property in each item's
        // object because we passed a third parameter value of true, allowing setValForEachItem to
        // add non-existent property to each item.
        $collection->setValForEachItem('hobby', 'Baseball', true);

        var_dump($collection);
    ```

    ```
        object(GenericCollection)#3 (1) {
          ["collection_items":protected]=>
          array(3) {
            [0]=>
            object(stdClass)#2 (3) {
              ["name"]=>
              string(3) "Joe"
              ["age"]=>
              int(24)
              ["hobby"]=>
              string(8) "Baseball"
            }
            [1]=>
            object(stdClass)#4 (3) {
              ["name"]=>
              string(4) "Jane"
              ["age"]=>
              int(24)
              ["hobby"]=>
              string(8) "Baseball"
            }
            [2]=>
            object(stdClass)#5 (3) {
              ["name"]=>
              string(6) "Janice"
              ["age"]=>
              int(24)
              ["hobby"]=>
              string(8) "Baseball"
            }
          }
        }
    ```
* **`toArray()`:** Returns an array containing all items in the collection object
* **`transform(callable $transformer)`:** Modifies each item in a collection object via a callback with the following signature `function($key, $item)` that returns a value that will replace each item in the collection. The `$key` and `$item` parameters are each key and item pairs contained in the collection.
    ```php
        $collection_of_ints = 
            new \VersatileCollections\GenericCollection(2, 4, 6, 8);

        $collection_of_ints->transform(

            function($key, $item) {

                return $item * $item;
            }    
        );

        var_dump($collection_of_ints->toArray());
    ```

    outputs

    ```
        array(4) {
          [0] =>
          int(4)
          [1] =>
          int(16)
          [2] =>
          int(36)
          [3] =>
          int(64)
        }
    ```


All examples above work for all the collection classes provided in this package,
except for the strictly-typed collections which differ in that they enforce item 
type checking at collection construction-time and when item(s) are added to the 
collection.

More details about the collection objects in this package are contained in the links below:

* [Generic Collections](GenericCollections.md)
* [Strictly Typed Collections](StrictlyTypedCollections.md)
    * [Callables Collections](CallablesCollections.md): a collection that can only contain [callables](http://php.net/manual/en/language.types.callable.php)
    * [Object Collections](ObjectsCollections.md): a collection that can only contain [objects](http://php.net/manual/en/language.types.object.php) (any kind of object)
    * [Resource Collections](ResourcesCollections.md): a collection that can only contain [resources](http://php.net/manual/en/language.types.resource.php)
    * [Scalar Collections](ScalarsCollections.md): a collection that can only scalar values. I.e. any of [booleans](http://php.net/manual/en/language.types.boolean.php), [floats](http://php.net/manual/en/language.types.float.php), [integers](http://php.net/manual/en/language.types.integer.php) or [strings](http://php.net/manual/en/language.types.string.php). It accepts any mix of scalars, e.g. ints, booleans, floats and strings can all be present in an instance of this type of collection.
        * [Numeric Collections](NumericCollections.md): a collection that can only contain [floats](http://php.net/manual/en/language.types.float.php) and/or [integers](http://php.net/manual/en/language.types.integer.php)
            * [Float Collections](FloatsCollections.md): a collection that can only contain [floats](http://php.net/manual/en/language.types.float.php)
            * [Int Collections](IntsCollections.md): a collection that can only contain [integers](http://php.net/manual/en/language.types.integer.php)
        * [String Collections](StringsCollections.md): a collection that can only contain [strings](http://php.net/manual/en/language.types.string.php)