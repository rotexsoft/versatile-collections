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
}
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
* **`toArray()`:** returns a copy of the underlying array storing the items in a collection object
* **`count()`:** returns the number of items in a collection object
* **`firstItem()`:** returns the first item in a collection object
* **`lastItem()`:** returns the last item in a collection object
* **`getKeys()`:** returns an array containing the keys to each item in a collection object
* **`setValForEachItem($field_name, $field_val, $add_field_if_not_present=false)`:** this method is useful for collections where each item is either an object or an array. It sets a value for a field / key in each item (object / array) in the collection. See example below:

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
        // because we paased a third parameter value of true, allowing setValForEachItem to
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
        $collection = new \BaseCollectionTestImplementation();
        $collection[] = (object)['name'=>'Joe', 'age'=>'10',];
        $collection[] = (object)['name'=>'Jane', 'age'=>'20',];
        $collection[] = (object)['name'=>'Janice', 'age'=>'30',];

        // set the `age` field for each collection item to 24
        $collection->setValForEachItem('age', 24);

        // will throw an exception because there is no `hobby` propety in each item's object
        // $collection->setValForEachItem('hobby', 'Baseball');

        // Now, add a hobby property to each collection item with a value of `Baseball`.
        // Will not throw an exception even though there is no `hobby` property in each item's
        // object because we paased a third parameter value of true, allowing setValForEachItem to
        // add non-existent property to each item.
        $collection->setValForEachItem('hobby', 'Baseball', true);

        var_dump($collection);
    ```

    ```
        object(BaseCollectionTestImplementation)#3 (1) {
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

More details about the collection objects in this package are contained in the links below:

* [Generic Collections](GenericCollections.md)
* [Strictly Typed Collections](StrictlyTypedCollections.md)
    * [Callables Collections](CallablesCollections.md)
    * [Float Collections](FloatCollections.md)
    * [Int Collections](IntCollections.md)
    * [Object Collections](ObjectCollections.md)
    * [Resource Collections](ResourceCollections.md)
    * [Scalar Collections](ScalarCollections.md)
    * [String Collections](StringCollections.md)
