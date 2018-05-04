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
