# Quick Start

The various Collection implementations in this package can be used directly or 
extended in your applications. 

These collections can be used as lists (like numerically
indexed php arrays) and maps (like associative php arrays).

To get started with this package you can start by using the `GenericCollection` class.

You can create an empty collection like so:

```php
$empty_generic_collection = new \VersatileCollections\GenericCollection();
```

Or you can create a collection with items like so:

```php
// a collection containing four strings
$generic_collection_with_items = 
    new \VersatileCollections\GenericCollection('item 1', 'item 2', 'item 3', 'item 4');
```

Or you can also create a collection with items like so:

```php
// another collection containing four strings
$items = ['item 1', 'item 2', 'item 3', 'item 4'];
$generic_collection_with_items = 
    new \VersatileCollections\GenericCollection(...$items);
```

> Note that the constructors for all collection classes use the variadic function signature. 
Therefore if you want to pass an array of items to the constructor you have to use the 
argument unpacking syntax (like in the last example above) or you could call the `static` 
method `\VersatileCollections\CollectionInterface::makeNewCollection(array $items=[])` which
can accept an array of items without the need for argument unpacking.

When collections are created with items (like in the last two examples above), 
the collection is in list mode (i.e. the keys for each item in the newly created
collection are sequential-numeric keys.) For example:

```php
    var_dump($generic_collection_with_items);
```

will generate the output below:

```
object(VersatileCollections\GenericCollection)#3 (1) {
  ["collection_items":protected]=>
  array(4) {
    [0]=>
    string(6) "item 1"
    [1]=>
    string(6) "item 2"
    [2]=>
    string(6) "item 3"
    [3]=>
    string(6) "item 4"
  }
}[Quick Start Guide](docs/QUICKSTART.md)
```

To continue working with the `$generic_collection_with_items` in list mode (i.e.
maintaining sequential numeric keys), you should keep adding more items using 
the syntax below:

```php
    $generic_collection_with_items[] = 'Item 5';
    $generic_collection_with_items[] = 'Item 6';
    $generic_collection_with_items[] = 'Item 7';
```

Now,

```php
    var_dump($generic_collection_with_items);
```

will generate the output below:

```
object(VersatileCollections\GenericCollection)#4 (1) {
  ["collection_items":protected]=>
  array(7) {
    [0]=>
    string(6) "item 1"
    [1]=>
    string(6) "item 2"
    [2]=>
    string(6) "item 3"
    [3]=>
    string(6) "item 4"
    [4]=>
    string(6) "Item 5"
    [5]=>
    string(6) "Item 6"
    [6]=>
    string(6) "Item 7"
  }
}
```

To work with collections in map-mode (like associative php arrays), always start
with an empty collection and then add items to the collection via either of the 
syntaxes below:

```php
    $empty_generic_collection->new_item = 'A new item';
```

or

```php
    $empty_generic_collection['another_new_item'] = 'Another new item';
```

Now,

```php
    var_dump($empty_generic_collection);
```

will generate the output below:

```
object(VersatileCollections\GenericCollection)#3 (1) {
  ["collection_items":protected]=>
  array(2) {
    ["new_item"]=>
    string(10) "A new item"
    ["another_new_item"]=>
    string(16) "Another new item"
  }
}
```

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
        
        $int_collection = new \VersatileCollections\IntCollection(
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
            new \VersatileCollections\IntCollection(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        
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
            new \VersatileCollections\IntCollection(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        
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
        $int_collection = new \VersatileCollections\IntCollection(
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
        $int_collection = new \VersatileCollections\IntCollection(
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15
        );
        
        $sub_collections = iterator_to_array($int_collection->getCollectionsOfSizeN(3));
        
        var_dump($sub_collections);
    ```
    which outputs
    ```
        array(5) {
          [0] =>
          class VersatileCollections\IntCollection#6 (1) {
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
          class VersatileCollections\IntCollection#7 (1) {
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
          class VersatileCollections\IntCollection#8 (1) {
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
          class VersatileCollections\IntCollection#9 (1) {
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
          class VersatileCollections\IntCollection#10 (1) {
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
* **`makeNewCollection(array $items=[])`:** A static factory method for creating new collection objects from an array of items. Using this method eliminates the need for argument unpacking which is required by all collection constructors when you try to create new collection objects from an array of items.
    ```php
        $items = ['item 1', 'item 2', 'item 3', 'item 4'];
        $generic_collection_with_items = \VersatileCollections\GenericCollection::makeNewCollection($items);
    ```
* **`merge(CollectionInterface $other)`:** Adds all items from $other collection to $this collection. Items in $other with existing keys in $this will overwrite the existing items in $this.
    ```php
        $numeric_collection = new \VersatileCollections\NumericsCollection(
            1.0, 2.0, 3, 4, 5, 6
        ); // underlying array contains [ 0=>1.0, 1=>2.0, 2=>3, 3=>4, 4=>5, 5=>6 ]
        
        $int_collection = new \VersatileCollections\IntCollection(
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

        $int_collection = new \VersatileCollections\IntCollection(
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
* **`prependItem($item)`:** Prepends an $item to the front of $this collection.
    ```php
        $numeric_collection = new \VersatileCollections\NumericsCollection(
            1.0, 2.0, 3, 4, 5, 6
        );

        // prepend an item
        $numeric_collection->prependItem(99);

        var_dump( $numeric_collection->toArray() );
    ```
    outputs
    ```
        array(7) {
          [0] =>
          int(99)
          [1] =>
          double(1)
          [2] =>
          double(2)
          [3] =>
          int(3)
          [4] =>
          int(4)
          [5] =>
          int(5)
          [6] =>
          int(6)
        }
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
    * [Object Collections](ObjectCollections.md): a collection that can only contain [objects](http://php.net/manual/en/language.types.object.php) (any kind of object)
    * [Resource Collections](ResourceCollections.md): a collection that can only contain [resources](http://php.net/manual/en/language.types.resource.php)
    * [Scalar Collections](ScalarCollections.md): a collection that can only scalar values. I.e. any of [booleans](http://php.net/manual/en/language.types.boolean.php), [floats](http://php.net/manual/en/language.types.float.php), [integers](http://php.net/manual/en/language.types.integer.php) or [strings](http://php.net/manual/en/language.types.string.php). It accepts any mix of scalars, e.g. ints, booleans, floats and strings can all be present in an instance of this type of collection.
        * [Numeric Collections](NumericCollections.md): a collection that can only contain [floats](http://php.net/manual/en/language.types.float.php) and/or [integers](http://php.net/manual/en/language.types.integer.php)
            * [Float Collections](FloatCollections.md): a collection that can only contain [floats](http://php.net/manual/en/language.types.float.php)
            * [Int Collections](IntCollections.md): a collection that can only contain [integers](http://php.net/manual/en/language.types.integer.php)
        * [String Collections](StringCollections.md): a collection that can only contain [strings](http://php.net/manual/en/language.types.string.php)


