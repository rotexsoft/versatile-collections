# Collection Methods

* [Methods common to all Collection Classes implementing CollectionInterface](#Methods-common-to-all-Collection-Classes-implementing-CollectionInterface)
* [Non-CollectionInterface Methods common to all Collection Classes using CollectionInterfaceImplementationTrait](#Non-CollectionInterface-Methods-common-to-all-Collection-Classes-using-CollectionInterfaceImplementationTrait)
* [Methods specific to various Strictly-Typed Collection classes](#Methods-specific-to-various-Strictly-Typed-Collection-classes)

------------------------------------------------------------------------------------------------
<div id="Methods-common-to-all-Collection-Classes-implementing-CollectionInterface"></div>

## Methods common to all Collection Classes implementing **CollectionInterface**
Most of the examples in this section use the **\VersatileCollections\GenericCollection** class, 
but are applicable to all collection classes that have implemented **\VersatileCollections\CollectionInterface**.

|                                                                    |                                                                                                    |                                                                        |
|---                                                                 |---                                                                                                 |---                                                                     |
|[__get](#CollectionInterface-__get)                                 |[getIterator](#CollectionInterface-getIterator)                                                     |[removeAll](#CollectionInterface-removeAll)                             |
|[__isset](#CollectionInterface-__isset)                             |[getKeys](#CollectionInterface-getKeys)                                                             |[reverse](#CollectionInterface-reverse)                                 |
|[__set](#CollectionInterface-__set)                                 |[intersectByItems](#CollectionInterface-intersectByItems)                                           |[reverseMe](#CollectionInterface-reverseMe)                             |
|[__unset](#CollectionInterface-__unset)                             |[intersectByItemsUsingCallback](#CollectionInterface-intersectByItemsUsingCallback)                 |[searchAllByVal](#CollectionInterface-searchAllByVal)                   |
|[allSatisfyConditions](#CollectionInterface-allSatisfyConditions)   |[intersectByKeys](#CollectionInterface-intersectByKeys)                                             |[searchByCallback](#CollectionInterface-searchByCallback)               |
|[appendCollection](#CollectionInterface-appendCollection)           |[intersectByKeysAndItems](#CollectionInterface-intersectByKeysAndItems)                             |[searchByVal](#CollectionInterface-searchByVal)                         |
|[appendItem](#CollectionInterface-appendItem)                       |[intersectByKeysAndItemsUsingCallbacks](#CollectionInterface-intersectByKeysAndItemsUsingCallbacks) |[setValForEachItem](#CollectionInterface-setValForEachItem)             |
|[column](#CollectionInterface-column)                               |[intersectByKeysUsingCallback](#CollectionInterface-intersectByKeysUsingCallback)                   |[shuffle](#CollectionInterface-shuffle)                                 |
|[containsItem](#CollectionInterface-containsItem)                   |[isEmpty](#CollectionInterface-isEmpty)                                                             |[slice](#CollectionInterface-slice)                                     |
|[containsItemWithKey](#CollectionInterface-containsItemWithKey)     |[lastItem](#CollectionInterface-lastItem)                                                           |[sort](#CollectionInterface-sort)                                       |
|[containsItems](#CollectionInterface-containsItems)                 |[makeAllKeysNumeric](#CollectionInterface-makeAllKeysNumeric)                                       |[sortByKey](#CollectionInterface-sortByKey)                             |
|[containsKey](#CollectionInterface-containsKey)                     |[makeNew](#CollectionInterface-makeNew)                                                             |[sortByMultipleFields](#CollectionInterface-sortByMultipleFields)       |
|[containsKeys](#CollectionInterface-containsKeys)                   |[map](#CollectionInterface-map)                                                                     |[sortDesc](#CollectionInterface-sortDesc)                               |
|[count](#CollectionInterface-count)                                 |[mergeMeWith](#CollectionInterface-mergeMeWith)                                                     |[sortDescByKey](#CollectionInterface-sortDescByKey)                     |
|[diff](#CollectionInterface-diff)                                   |[mergeWith](#CollectionInterface-mergeWith)                                                         |[sortMe](#CollectionInterface-sortMe)                                   |
|[diffAssoc](#CollectionInterface-diffAssoc)                         |[offsetExists](#CollectionInterface-offsetExists)                                                   |[sortMeByKey](#CollectionInterface-sortMeByKey)                         |
|[diffAssocUsing](#CollectionInterface-diffAssocUsing)               |[offsetGet](#CollectionInterface-offsetGet)                                                         |[sortMeByMultipleFields](#CollectionInterface-sortMeByMultipleFields)   |
|[diffKeys](#CollectionInterface-diffKeys)                           |[offsetSet](#CollectionInterface-offsetSet)                                                         |[sortMeDesc](#CollectionInterface-sortMeDesc)                           |
|[diffKeysUsing](#CollectionInterface-diffKeysUsing)                 |[offsetUnset](#CollectionInterface-offsetUnset)                                                     |[sortMeDescByKey](#CollectionInterface-sortMeDescByKey)                 |
|[diffUsing](#CollectionInterface-diffUsing)                         |[paginate](#CollectionInterface-paginate)                                                           |[splice](#CollectionInterface-splice)                                   |
|[each](#CollectionInterface-each)                                   |[pipeAndReturnCallbackResult](#CollectionInterface-pipeAndReturnCallbackResult)                     |[split](#CollectionInterface-split)                                     |
|[everyNth](#CollectionInterface-everyNth)                           |[pipeAndReturnSelf](#CollectionInterface-pipeAndReturnSelf)                                         |[take](#CollectionInterface-take)                                       |
|[filterAll](#CollectionInterface-filterAll)                         |[prependCollection](#CollectionInterface-prependCollection)                                         |[tap](#CollectionInterface-tap)                                         |
|[filterFirstN](#CollectionInterface-filterFirstN)                   |[prependItem](#CollectionInterface-prependItem)                                                     |[toArray](#CollectionInterface-toArray)                                 |
|[firstItem](#CollectionInterface-firstItem)                         |[pull](#CollectionInterface-pull)                                                                   |[transform](#CollectionInterface-transform)                             |
|[getAllWhereKeysIn](#CollectionInterface-getAllWhereKeysIn)         |[push](#CollectionInterface-push)                                                                   |[unionMeWith](#CollectionInterface-unionMeWith)                         |
|[getAllWhereKeysNotIn](#CollectionInterface-getAllWhereKeysNotIn)   |[put](#CollectionInterface-put)                                                                     |[unionWith](#CollectionInterface-unionWith)                             |
|[getAndRemoveFirstItem](#CollectionInterface-getAndRemoveFirstItem) |[randomItem](#CollectionInterface-randomItem)                                                       |[unique](#CollectionInterface-unique)                                   |
|[getAndRemoveLastItem](#CollectionInterface-getAndRemoveLastItem)   |[randomItems](#CollectionInterface-randomItems)                                                     |[whenFalse](#CollectionInterface-whenFalse)                             |
|[getAsNewType](#CollectionInterface-getAsNewType)                   |[randomKey](#CollectionInterface-randomKey)                                                         |[whenTrue](#CollectionInterface-whenTrue)                               |
|[getCollectionsOfSizeN](#CollectionInterface-getCollectionsOfSizeN) |[randomKeys](#CollectionInterface-randomKeys)                                                       |[yieldCollectionsOfSizeN](#CollectionInterface-yieldCollectionsOfSizeN) |
|[getIfExists](#CollectionInterface-getIfExists)                     |[reduce](#CollectionInterface-reduce)                                                               |                                                                        |
|[getItems](#CollectionInterface-getItems)                           |[reduceWithKeyAccess](#CollectionInterface-reduceWithKeyAccess)                                     |                                                                        |


------------------------------------------------------------------------------------------------
<div id="CollectionInterface-__isset"></div>

### __isset($key): bool
Returns true if the specified key exists in a collection or false if not.<br>
You shouldn't need to call this method since it is automatically called when you
try to check for the existence of an item with a specified key in a collection 
using the isset construct like so:<br> 
>`isset($collection->key)`.

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-__get"></div>

### __get($key): mixed
Returns the item associated with the specified key if the key exists in the collection.<br>
You shouldn't need to call this method since it is automatically called when you
try to get an item from a collection using this syntax:<br> 
>`$collection->key`.

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-__set"></div>

### __set($key, $val): void
Add an item (`$val`) to the collection with the specified key (`$key`).<br>
You shouldn't need to call this method since it is automatically called when you
try to add an item to a collection using this syntax:<br> 
>`$collection->key = $val`.

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-__unset"></div>

### __unset($key): void
Remove an item associated with the specified key (`$key`) from the collection.<br>
You shouldn't need to call this method since it is automatically called when you
try to remove an item from a collection using the unset construct like so:<br> 
>`unset($collection->key)`.

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-allSatisfyConditions"></div>

### allSatisfyConditions(callable $callback, $bind_callback_to_this=true): bool
Iterate through a collection and execute a callback over each item (the callback
checks if each item satisfies one or more condition(s) and returns true if an item 
satisfies the condition(s) or false if not) and return true if all items satisfy 
the condition(s) tested in the callback or false otherwise.

* **$callback**: a callback with the following signature **function($key, $item) : bool**. 
It should return `true` if the current item `$item` satisfies one or more condition(s) or `false` otherwise.
* **$bind_callback_to_this**: `true` if the variable **$this** inside the supplied **$callback** should refer to the collection object 
this method is being invoked on, else `false` if you don't want the supplied **$callback** to be bound to the collection object this 
method is being invoked on.

```php
<?php
    $c = \VersatileCollections\GenericCollection::makeNew(
        [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
    );

    // All items less than 11: true
    $c->allSatisfyConditions(
        function($key, $item) {
            return $this->count() > 0 && $item < 11;
        }
    ); // === true

    // All items greater than 5: false
    $c->allSatisfyConditions(
        function($key, $item) {
            return $item > 5;
        }
    ); // === false
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-appendCollection"></div>

### appendCollection(CollectionInterface $other): $this
Appends all items from `$other` collection to the end of a collection.<br>
Appended items will be assigned numeric keys, so as to avoid overwriting item(s)
in the original collection with same key(s).<br>
>For strictly typed collections, `$other` must be of the same type as the collection's type 
or a sub-type of the the collection's type or else an Exception will be thrown.<br>

For example, you cannot append an instance of **StringsCollection** to an instance 
of **ArraysCollection**, but you can append an instance of **FloatsCollection** to
an instance of **NumericsCollection** (since **FloatsCollection** is a sub-type of
**NumericsCollection**).

```php
<?php 
    $item1 = "4";
    $item2 = 5.0;
    $item3 = 7;
    $collection = \VersatileCollections\GenericCollection::makeNew(
        [$item1, $item2, $item3]
    );

    $other_item1 = "114";
    $other_item2 = 35.5;
    $other_item3 = 777;
    $other_collection = \VersatileCollections\GenericCollection::makeNew(
        [$other_item1, $other_item2, $other_item3]
    );

    $collection->appendCollection($other_collection);

    // At this point, $collection now contains:
    // [ 0=>'4', 1=>5.0, 2=>7, 3=>'114', 4=>35.5, 5=>777 ]

    ////////////////////////
    // Inheritance example
    ////////////////////////
    $numeric_collection = \VersatileCollections\NumericsCollection::makeNew(
        [1.0, 2.0, 3, 4, 5, 6]
    );
    
    // append a sub-class collection
    $int_collection = \VersatileCollections\IntsCollection::makeNew([8, 9, 10, 11]);
    $numeric_collection->appendCollection($int_collection);
    $numeric_collection->toArray(); // === [1.0, 2.0, 3, 4, 5, 6, 8, 9, 10, 11]

    // append another sub-class collection
    $float_collection = \VersatileCollections\FloatsCollection::makeNew([8.5, 9.7, 10.8, 11.9]);
    $numeric_collection->appendCollection($float_collection);
    $numeric_collection->toArray(); // === [1.0, 2.0, 3, 4, 5, 6, 8, 9, 10, 11, 8.5, 9.7, 10.8, 11.9]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-appendItem"></div>

### appendItem($item): $this
Appends an item to the end of a collection.<br>
>For strictly typed collections, `$item` must be of the same type as the collection's type 
or a sub-type of the the collection's type or else an Exception will be thrown.<br>

For example, you cannot append a string to an instance of **ArraysCollection**,
but you can append a **float** or an **integer** to an instance of **NumericsCollection** 
(since **floats** and **integers** are numeric).

```php
<?php 
    $item1 = 4;
    $item2 = 5.0;
    $item3 = 7;
    $collection = \VersatileCollections\NumericsCollection::makeNew(
        [$item1, $item2, $item3]
    );

    $collection->appendItem(777); // integer acceptable
    $collection->appendItem(7.5); // float acceptable
    //$collection->appendItem('7.5'); // string not acceptable

    // At this point, $collection now contains:
    // [ 0=>4, 1=>5.0, 2=>7, 3=>777, 4=>7.5 ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-column"></div>

### column($column_key, $index_key=null): \VersatileCollections\GenericCollection
Returns a collection containing the values from a single column in the collection. 
Works like php's array_column.<br>
**$column_key** is the name of the property in each object or the key in each array
in the collection whose values are to be returned in a new collection.<br>
**$index_key** is the name of the property in each object or the key in each array
in the collection whose values are to be used as keys to the values to be 
returned in a new collection. These values to be used as keys can only be
strings or integers otherwise an exception will be thrown.

>Will only work on collections containing items that are arrays and/or objects.<br>

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
    $collection = \VersatileCollections\GenericCollection::makeNew($data);

    // get a collection of of the values associated with the `title` property
    // of each object in the collection.
    $collection->column('title'); 
    // returns a collection containing
    // [ 0=>'Boo', 1=>'Coo', 2=>'Doo', 3=>'Foo', 4=>'Goo', 5=>'Hoo' ]

    // you can also specify the object property whose corresponding values should
    // be used as the keys in the collection to be returned. Let's use the `id` 
    // property for the keys:
    $collection->column('title', 'id'); 
    // returns a collection containing
    // [ 17=>'Boo', 27=>'Coo', 37=>'Doo', 47=>'Foo', 57=>'Goo', 67=>'Hoo' ]

    // collection of arrays
    $data = [];
    $data[] = ['id' => 17, 777 => 67, 'edition' => 2, 'title'=>"Boo"];
    $data[] = ['id' => 27, 777 => 86, 'edition' => 1, 'title'=>"Coo"];
    $data[] = ['id' => 37, 777 => 85, 'edition' => 6, 'title'=>"Doo"];
    $data[] = ['id' => 47, 777 => 98, 'edition' => 2, 'title'=>"Foo"];
    $data[] = ['id' => 57, 777 => 86, 'edition' => 6, 'title'=>"Goo"];
    $data[] = ['id' => 67, 777 => 67, 'edition' => 7, 'title'=>"Hoo"];
    $collection = \VersatileCollections\GenericCollection::makeNew($data);

    // get a collection of of the values associated with the `title` key
    // of each array in the collection.
    $collection->column('title'); 
    // returns a collection containing
    // [ 0=>'Boo', 1=>'Coo', 2=>'Doo', 3=>'Foo', 4=>'Goo', 5=>'Hoo' ]

    // you can also specify the array key whose corresponding values should
    // be used as the keys in the collection to be returned. Let's use the `id` 
    // key for the keys:
    $collection->column('title', 'id'); 
    // returns a collection containing
    // [ 17=>'Boo', 27=>'Coo', 37=>'Doo', 47=>'Foo', 57=>'Goo', 67=>'Hoo' ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-containsItem"></div>

### containsItem($item): bool
Check if a collection contains an item using strict comparison.

```php
<?php 
    $item1 = "4";
    $item2 = 5.0;
    $item3 = 7;
    $item4 = true;
    $item5 = false;
    $item6 = tmpfile();
    $item7 = new \ArrayObject();
    $item8 = function(){ return 'Hello World!'; };

    $collection = \VersatileCollections\GenericCollection::makeNew(
        [$item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8]
    );

    $collection->containsItem($item1); // true
    $collection->containsItem($item2); // true
    $collection->containsItem($item3); // true
    $collection->containsItem($item4); // true
    $collection->containsItem($item5); // true
    $collection->containsItem($item6); // true
    $collection->containsItem($item7); // true
    $collection->containsItem($item8); // true
    $collection->containsItem('not in collection'); // false
    $collection->containsItem(4); // false
    $collection->containsItem('5.0'); // false
    $collection->containsItem('7'); // false
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-containsItemWithKey"></div>

### containsItemWithKey($key, $item): bool
Check if a collection contains a specified item with the specified key using strict comparison for the item.

```php
<?php 
    $item1 = "4";
    $item2 = 5.0;
    $item3 = 7;

    $collection = 
        \VersatileCollections\GenericCollection::makeNew([$item1, $item2, $item3]);

    $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
    $collection->item2 = ['name'=>'Jane', 'age'=>'20',];

    $collection->containsItemWithKey(0, $item1); // true
    $collection->containsItemWithKey('0', $item1); // true (Key 0 & '0' are the same, 
                                                   // same for '1' & 1, etc.)
    $collection->containsItemWithKey(1, $item2); // true
    $collection->containsItemWithKey(2, $item3); // true
    $collection->containsItemWithKey('item1', ['name'=>'Joe', 'age'=>'10',]); // true
    $collection->containsItemWithKey('item2', ['name'=>'Jane', 'age'=>'20',]); // true
    $collection->containsItemWithKey('not in collection', $item1); // false
    $collection->containsItemWithKey('item1', 'not in collection'); // false
    $collection->containsItemWithKey([], $item1); // false
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-containsItems"></div>

### containsItems(array $items): bool
Check if all the specified items exist in a collection. Strict comparison is used for checking each item.

```php
<?php 
    $item1 = "4";
    $item2 = 5.0;
    $item3 = 7;
    $item4 = ['name'=>'Joe', 'age'=>'10',];
    $item5 = ['name'=>'Jane', 'age'=>'20',];

    $collection = 
        \VersatileCollections\GenericCollection::makeNew([$item1, $item2, $item3]);

    $collection->item1 = $item4;
    $collection->item2 = $item5;

    $collection->containsItems([$item1]); // true
    $collection->containsItems([$item1, $item2]); // true
    $collection->containsItems([$item1, $item2, $item3]); // true
    $collection->containsItems([$item1, $item2, $item3, $item4]); // true
    $collection->containsItems([$item1, $item2, $item3, $item4, $item5]); // true
    $collection->containsItems(['not in collection']); // false
    $collection->containsItems([$item1, $item2, $item5, 'not in collection']); // false

    $collection[] = 55;
    $collection->containsItems([$item1, $item2, $item3, $item4, $item5, 55]); // true
    $collection->containsItems([$item1, $item4, 'not in collection', 55]); // false
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-containsKey"></div>

### containsKey($key): bool
Check if a key exists in a collection.

```php
<?php 
    $item1 = "4";
    $item2 = 5.0;
    $item3 = 7;

    $collection = 
        \VersatileCollections\GenericCollection::makeNew([$item1, $item2, $item3]);

    $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
    $collection->item2 = ['name'=>'Jane', 'age'=>'20',];

    $collection->containsKey(0); // true
    $collection->containsKey('0'); // true 
                                   // (0 & '0' are the same 
                                   // as far as keys are concerned)
    $collection->containsKey(1); // true
    $collection->containsKey(2); // true
    $collection->containsKey('item1'); // true
    $collection->containsKey('item2'); // true
    $collection->containsKey('not in collection'); // false
    $collection->containsKey([]); // false
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-containsKeys"></div>

### containsKeys(array $keys): bool
Check if all the specified keys exist in a collection.

```php
<?php 
    $item1 = "4";
    $item2 = 5.0;
    $item3 = 7;

    $collection = 
        \VersatileCollections\GenericCollection::makeNew([$item1, $item2, $item3]);

    $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
    $collection->item2 = ['name'=>'Jane', 'age'=>'20',];

    $collection->containsKeys([0]); // true
    $collection->containsKeys([0, 1]); // true
    $collection->containsKeys([0, 1, 2]); // true
    $collection->containsKeys([0, 1, 2, 'item1']); // true
    $collection->containsKeys([0, 1, 2, 'item1', 'item2']); // true
    $collection->containsKeys(['not in collection']); // false
    $collection->containsKeys([0, 1, 2, 'item1', 'item2', 'not in collection']); // false
    $collection->containsKeys([0, 1, 2, 'item1', 'item2', 3]); // false

    $collection[] = 55; // will be automatically assigned the key `3` under the hood
    $collection->containsKeys([0, 1, 2, 'item1', 'item2', 3]); // true
    $collection->containsKeys([0, 1, 2, 'item1', 'item2', 'not in collection', 3]); // false
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-count"></div>

### count(): int
Returns the number of items in collection.

```php
<?php
    $collection = 
        \VersatileCollections\GenericCollection::makeNew(["4", 5.0, 7]);
    $collection->count(); // === 3

    $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
    $collection->count(); // === 4

    $collection->item2 = ['name'=>'Jane', 'age'=>'20',];
    $collection->count(); // === 5
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-diff"></div>

### diff(array $items): \VersatileCollections\CollectionInterface
Get the items in the collection that are not present in the given items.
* **$items**: items in the collection that are not present in `$items` are returned by this method 

```php
<?php
    $c = \VersatileCollections\GenericCollection::makeNew(['id' => 1, 'first_word' => 'Hello']);
    $c->diff(['first_word' => 'Hello', 'last_word' => 'World'])->toArray(); // === ['id' => 1]

    $c = \VersatileCollections\GenericCollection::makeNew(['en_GB', 'fr', 'HR']);
    // diff is case sensitive
    $c->diff(['en_gb', 'hr'])->toArray(); // === ['en_GB', 'fr', 'HR']

    $c = \VersatileCollections\GenericCollection::makeNew(['id' => 1, 'first_word' => 'Hello']);
    $c->diff([])->toArray(); // === ['id' => 1, 'first_word' => 'Hello']
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-diffUsing"></div>

### diffUsing(array $items, callable $callback): \VersatileCollections\CollectionInterface
Get the items in the collection that are not present in the given items using a callback for the comparison.
* **$items**: items in the collection that are not present in `$items` are returned by this method
* **$callback**: a callback used to check if an item in the collection is equal to an item in `$item`
The function must have the following signature: **function ( mixed $a, mixed $b ): int**.
The comparison function must return an integer less than, equal to, or greater than zero 
if the first argument is considered to be respectively less than, equal to, 
or greater than the second. 

```php
<?php
    $c = \VersatileCollections\GenericCollection::makeNew(['en_GB', 'fr', 'HR']);
    // allow for case insensitive difference
    $c->diffUsing(['en_gb', 'hr'], 'strcasecmp')->getItems()->toArray(); // === ['fr']

    $c = \VersatileCollections\GenericCollection::makeNew(['en_GB', 'fr', 'HR']);
    $c->diffUsing([], 'strcasecmp')->getItems()->toArray(); // === ['en_GB', 'fr', 'HR']
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-diffAssoc"></div>

### diffAssoc(array $items): \VersatileCollections\CollectionInterface
Get the items in the collection whose keys and values are not present in the given items.
* **$items**: items in the collection whose keys and values are not present in `$items` are returned by this method 

```php
<?php
    $c1 = \VersatileCollections\GenericCollection::makeNew(
        ['id'=>1, 'first_word'=>'Hello', 'not_affected'=>'value']
    );
    $c1->diffAssoc(
        ['id'=>123, 'foo_bar'=>'Hello', 'not_affected'=>'value']
    )->toArray(); // === ['id' => 1, 'first_word' => 'Hello']
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-diffAssocUsing"></div>

### diffAssocUsing(array $items, callable $key_comparator): \VersatileCollections\CollectionInterface
Get the items in the collection whose keys and values are not present in the given items.
* **$items**: 
* **$key_comparator**: a callback used to check if a key for an item in the collection is equal to a key for an item in `$item`
The function must have the following signature: **function( mixed $a, mixed $b ): int**
The comparison function must return an integer less than, equal to, or greater than zero 
if the first argument is considered to be respectively less than, equal to, 
or greater than the second. 

```php
<?php
    $c1 = \VersatileCollections\GenericCollection::makeNew(
        [ 'a'=>'green', 'b'=>'brown', 'c'=>'blue', 'red' ]
    );

    // demonstrate that diffAssoc wont support case insensitivity
    $c1->diffAssoc([ 'A'=>'green', 'yellow', 'red' ])
       ->toArray(); // === ['a'=>'green', 'b'=>'brown', 'c'=>'blue', 0=>'red']

    // allow for case insensitive difference
    $c1->diffAssocUsing([ 'A'=>'green', 'yellow', 'red' ], 'strcasecmp')
       ->toArray(); // === [ 'b'=>'brown', 'c'=>'blue', 0=>'red' ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-diffKeys"></div>

### diffKeys(array $items): \VersatileCollections\CollectionInterface
Get the items in the collection whose keys are not present in the given items.
* **$items**: items in the collection whose keys are not present in `$items` are returned by this method

```php
<?php
	
    $c1 = \VersatileCollections\GenericCollection::makeNew(
        [ 'id'=>1, 'first_word'=>'Hello' ]
    );
    $c1->diffKeys(
        [ 'id'=>123, 'foo_bar'=>'Hello' ]
    )->toArray(); // === ['first_word'=>'Hello']
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-diffKeysUsing"></div>

### diffKeysUsing(array $items, callable $key_comparator): \VersatileCollections\CollectionInterface
Get the items in the collection whose keys and values are not present in the given items.
* **$items**: 
* **$key_comparator**: a callback used to check if a key for an item in the collection is equal to a key for an item in `$items`
The function must have the following signature: **function( mixed $a, mixed $b ): int**
The comparison function must return an integer less than, equal to, or greater than zero 
if the first argument is considered to be respectively less than, equal to, 
or greater than the second. 

```php
<?php
    $c1 = \VersatileCollections\GenericCollection::makeNew(['id' => 1, 'first_word' => 'Hello']);

    // demonstrate that diffKeys wont support case insensitivity
    $c1->diffKeys(['ID'=>123, 'foo_bar'=>'Hello'])
       ->toArray(); // ['id'=>1, 'first_word'=> 'Hello']

    // allow for case insensitive difference
    $c1->diffKeysUsing(['ID'=>123, 'foo_bar'=>'Hello'], 'strcasecmp')
       ->toArray(); // === ['first_word' => 'Hello']
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-each"></div>

### each(callable $callback, $termination_value=false, $bind_callback_to_this=true): $this
Iterate through a collection and execute a callback over each item during the iteration.<br>
* **$callback**: a callback with the following signature **function($key, $item)**. 
To stop iteration at any point, the callback should return the value specified via **$termination_value**.
* **$termination_value**: a value that should be returned by **$callback** signifying that iteration through a collection should stop.
* **$bind_callback_to_this**: `true` if the variable **$this** inside the supplied **$callback** should refer to the collection object 
this method is being invoked on, else `false` if you don't want the supplied **$callback** to be bound to the collection object this 
method is being invoked on.

```php
<?php

    $collection = \VersatileCollections\GenericCollection::makeNew(
        [1, 2, 3, 4, 5, 6]
    );
    
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    // Iterate through a collection, printing out each key and item
    // during each iteration
    $collection->each(
        function($key, $item) {
            echo "{$key}:{$item}, ";
        }
    ); // outputs: 0:1, 1:2, 2:3, 3:4, 4:5, 5:6,

    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    // You can even do more fancy stuff, like sum all numbers in the 
    // collection above and store the result in a variable.
    $accumulator = 0; // will hold the sum
    $collection->each(
        function($key, $item) use (&$accumulator) {
            
            $accumulator += $item;
        }
    ); // At this point $accumulator === 21

    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    // You can sum the first half of the collection 
    // i.e. 1 + 2 + 3
    $accumulator = 0; // will hold the sum
    $counter = 1; // keeps track of the number of iterations
    $collection->each(
        function($key, $item) use (&$accumulator, &$counter) {
            
            $accumulator += $item;
            
            // $this here refers to $collection
            if( ((int)ceil($this->count() / 2)) === $counter++ ) {

                return -999; // we have gotten half way through
                             // the collection at this point,
                             // we want to stop further iteration.
            }
        }, 
        -999, // if -999 is returned from the callback, stop iteration immediately 
        true  // bind the callback to the collection object this method is being 
              // called on, in this case $collection.
    ); // At this point $accumulator === 6
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-everyNth"></div>

### everyNth($n, $position_of_first_nth_item = 0): \VersatileCollections\CollectionInterface
Create a new collection consisting of every n-th element.
* **$n**: the number representing n. 
* **$position_of_first_nth_item**: position in the collection to start counting for the nth elements.
`0` represents the position of the first item in the collection.
```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h']
    );

    // every 4th item starting from the 0-indexed 0th position (actually 1st)
    $collection->everyNth(4); // returns a collection containing
                              // ['a',  'e']

    // every 4th item starting from the 0-indexed 3rd position (actually 4th)
    $collection->everyNth(4, 3); // returns a collection containing
                                 // ['d',  'h']
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-filterAll"></div>

### filterAll(callable $filterer, $copy_keys=false, $bind_callback_to_this=true, $remove_filtered_items=false): \VersatileCollections\CollectionInterface
Filter all items in a collection matching criteria specified in a callback function and return filtered items in a new collection.
* **$filterer**: a callback with the following signature `function($key, $item)` 
that must return true if an item should be filtered out, or false if not. 
* **$copy_keys**: true if the corresponding key for each filtered item 
in the original collection should be copied into the new collection to be returned.
* **$bind_callback_to_this**: `true` if the variable **$this** inside the supplied **$filterer** callback should refer to the collection object 
this method is being invoked on, else `false` if you don't want the supplied **$filterer** callback to be bound to the collection object this 
method is being invoked on.
* **$remove_filtered_items**: `true` if the filtered items should be removed from the collection this method is being invoked on,
else `false` if the filtered items should not be removed from the collection this method is being invoked on.

```php
<?php
    $collection_of_ints = 
        \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
    
    ///////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////
    // Filter all even numbers from the collection.
    // Don't preserve keys in the collection of filtered items
    $collection_of_even_ints = $collection_of_ints->filterAll(

        function($key, $item) {

            return ($item % 2) === 0;
        }    
    ); 
    // At this point $collection_of_even_ints contains
    //  [2, 4, 6, 8, 10]
    //
    // and $collection_of_ints still contains
    //  [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]

    //////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////
    // Filter all even numbers from the first half of the collection.
    // Preserve keys in the collection of filtered items 
    // and remove filtered items from the original collection
    $collection_of_even_ints = $collection_of_ints->filterAll(

        function($key, $item) {
        
            // tracker of current iteration position
            global $current_position; 
            
            if( !$current_position ) { 
                
                $current_position = 1; 
            }
            
            return 
                (
                    $current_position++ 
                    < ((int)ceil($this->count() / 2))
                ) // are we still in the first half of the collection?
                && (($item % 2) === 0); // is the current item an even number
        },
        true, // preserve keys  in the collection of filtered items
        true, // make sure $this === $collection_of_ints inside the callback
        true  // remove filtered items
    );
    // At this point $collection_of_even_ints contains
    //  [ 1=>2, 3=>4 ]
    //
    // and $collection_of_ints now contains
    //  [ 0=>1, 2=>3, 4=>5, 5=>6, 6=>7, 7=>8, 8=>9, 9=>10 ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-filterFirstN"></div>

### filterFirstN(callable $filterer, $max_number_of_filtered_items=null, $copy_keys=false, $bind_callback_to_this=true, $remove_filtered_items=false): \VersatileCollections\CollectionInterface
Filter first `N` items in a collection matching criteria specified in a callback function and return filtered items in a new collection.
* **$filterer**: a callback with the following signature `function($key, $item)` 
that must return true if an item should be filtered out, or false if not. 
* **$max_number_of_filtered_items**: Number of filtered items to be returned. Null means return all filtered items.
* **$copy_keys**: true if the corresponding key for each filtered item 
in the original collection should be copied into the new collection to be returned.
* **$bind_callback_to_this**: `true` if the variable **$this** inside the supplied **$filterer** callback should refer to the collection object 
this method is being invoked on, else `false` if you don't want the supplied **$filterer** callback to be bound to the collection object this 
method is being invoked on.
* **$remove_filtered_items**: `true` if the filtered items should be removed from the collection this method is being invoked on,
else `false` if the filtered items should not be removed from the collection this method is being invoked on.

```php
<?php
    $collection_of_ints = 
        \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
    
    ///////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////
    // Filter first three even numbers from the collection.
    // Don't preserve keys in the collection of filtered items
    $collection_of_even_ints = $collection_of_ints->filterFirstN(

        function($key, $item) {

            return ($item % 2) === 0;
        },
        3
    ); 
    // At this point $collection_of_even_ints contains
    //  [ 2, 4, 6 ]
    //
    // and $collection_of_ints still contains
    //  [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]

    ////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////
    // Filter first two even numbers from the first half of the collection.
    // Preserve keys in the collection of filtered items 
    // and remove filtered items from the original collection
    $collection_of_even_ints = $collection_of_ints->filterFirstN(

        function($key, $item) {
        
            // tracker of current iteration position
            global $current_position; 
            
            if( !$current_position ) { 
                
                $current_position = 1; 
            }
            
            return 
                (
                    $current_position++ 
                    < ((int)ceil($this->count() / 2))
                ) // are we still in the first half of the collection?
                && (($item % 2) === 0); // is the current item an even number
        },
        2,    // filter first two matching items
        true, // preserve keys  in the collection of filtered items
        true, // make sure $this === $collection_of_ints inside the callback
        true  // remove filtered items
    );
    // At this point $collection_of_even_ints contains
    //  [ 1=>2, 3=>4 ]
    //
    // and $collection_of_ints now contains
    //  [ 0=>1, 2=>3, 4=>5, 5=>6, 6=>7, 7=>8, 8=>9, 9=>10 ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-firstItem"></div>

### firstItem(): mixed
Retrieves and returns the first item in a collection. See `lastItem()` if you want to get the last item.

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        ['One', 'Two', 'Three', 'Four']
    );
    $collection->firstItem(); // === 'One'
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-getAllWhereKeysIn"></div>

### getAllWhereKeysIn(array $keys): \VersatileCollections\CollectionInterface
Return a collection of items whose keys are present in `$keys`. 
Keys are preserved in the new collection.<br>
If the keys in `$keys` do not exist in the collection, an empty collection object is returned.

```php
<?php

    $collection = \VersatileCollections\GenericCollection::makeNew();
    $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
    $collection->item2 = ['name'=>'Jane', 'age'=>'20',];
    $collection->item3 = ['name'=>'Janice', 'age'=>'30',];

    $new_collection = $collection->getAllWhereKeysIn(['item1', 'item3']);

    // $new_collection now contains:
    //  [
    //      'item1' => [ 'name'=>'Joe', 'age' => '10', ],
    //      'item3' => [ 'name'=>'Janice', 'age'=>'30', ],
    //  ]

    // $collection still contains
    //  [
    //      'item1' => [ 'name'=>'Joe', 'age'=>'10', ],
    //      'item2' => [ 'name'=>'Jane', 'age'=>'20', ],
    //      'item3' => [ 'name'=>'Janice', 'age'=>'30', ],
    //  ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-getAllWhereKeysNotIn"></div>

### getAllWhereKeysNotIn(array $keys): \VersatileCollections\CollectionInterface
Return a collection of items whose keys are not present in `$keys`. 
Keys are preserved in the new collection.<br>
If all the keys in the collection are also in `$keys`, an empty collection object is returned.

```php
<?php

    $collection = \VersatileCollections\GenericCollection::makeNew();
    $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
    $collection->item2 = ['name'=>'Jane', 'age'=>'20',];
    $collection->item3 = ['name'=>'Janice', 'age'=>'30',];

    $new_collection = $collection->getAllWhereKeysNotIn(['item1', 'item3']);

    // $new_collection now contains:
    //  [
    //      'item2' => [ 'name'=>'Jane', 'age'=>'20', ],
    //  ]

    // $collection still contains
    //  [
    //      'item1' => [ 'name'=>'Joe', 'age'=>'10', ],
    //      'item2' => [ 'name'=>'Jane', 'age'=>'20', ],
    //      'item3' => [ 'name'=>'Janice', 'age'=>'30', ],
    //  ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-getAndRemoveFirstItem"></div>

### getAndRemoveFirstItem(): mixed
Get and remove the first item from the collection. NULL is returned if the collection is empty.

```php
<?php
        
    $collection = \VersatileCollections\GenericCollection::makeNew(
        ['a', 'b', 'c', 'd']
    );

    $collection->getAndRemoveFirstItem(); // === 'a'
    // At this point $collection contains [ 'b', 'c', 'd' ]

    $collection->getAndRemoveFirstItem(); // === 'b'
    // At this point $collection contains [ 'c', 'd' ]

    $collection->getAndRemoveFirstItem(); // === 'c'
    // At this point $collection contains [ 'd' ]

    $collection->getAndRemoveFirstItem(); // === 'd'
    // At this point $collection contains [] (i.e. it is empty)

    $collection->getAndRemoveFirstItem(); // === NULL 
                                          // Because collection is empty
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-getAndRemoveLastItem"></div>

### getAndRemoveLastItem(): mixed
Get and remove the last item from the collection. NULL is returned if the collection is empty.

```php
<?php
        
    $collection = \VersatileCollections\GenericCollection::makeNew(
        ['a', 'b', 'c', 'd']
    );

    $collection->getAndRemoveLastItem(); // === 'd'
    // At this point $collection contains [ 'a', 'b', 'c' ]

    $collection->getAndRemoveLastItem(); // === 'c'
    // At this point $collection contains [ 'a', 'b' ]

    $collection->getAndRemoveLastItem(); // === 'b'
    // At this point $collection contains [ 'a' ]

    $collection->getAndRemoveLastItem(); // === 'a'
    // At this point $collection contains [] (i.e. it is empty)

    $collection->getAndRemoveLastItem(); // === NULL 
                                          // Because collection is empty
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-getAsNewType"></div>

### getAsNewType($new_collection_class=\VersatileCollections\GenericCollection::class): \VersatileCollections\CollectionInterface
Create a new collection of the specified type with the keys and items of the collection object this method is being invoked on.<br>
It's a neat way of casting one type of collection to another type. The types must be compatible. 
For example, it is safe to convert an instance of **GenericCollection** (containing only integers) to a new instance of 
**IntsCollection** or **NumericsCollection**, but an Excption will be thrown if you try to convert an instance of 
**GenericCollection** (containing only integers) to a new instance of **ObjectsCollection**, since integers are not objects. <br>

* **$new_collection_class**: name of a collection class that implements
\VersatileCollections\CollectionInterface (e.g. `\VersatileCollections\NumericsCollection::class`) 
or any compatible instance of \VersatileCollections\CollectionInterface

>Only keys and items from the original collection will be copied into the new collection, 
other properties of the original collection like methods added via addMethod(), 
addMethodForAllInstances() and addStaticMethod() will not be copied.
The original collection will not be modified.

```php
<?php
    // a GenericCollection containing integers
    $generic_ints_collection = 
        \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5]);

    // create a new IntsCollection from the GenericCollection containing integers
    $ints_collection = $generic_ints_collection->getAsNewType(
        \VersatileCollections\IntsCollection::class
    ); // safe operation

    // create a new NumericsCollection from the GenericCollection containing integers
    $numerics_collection = $generic_ints_collection->getAsNewType(
        \VersatileCollections\NumericsCollection::class
    ); // safe operation

    // Exception will be thrown if you try to create a new ObjectsCollection 
    // from the GenericCollection containing integers
    // $objects_collection = $generic_ints_collection->getAsNewType(
    //     \VersatileCollections\ObjectsCollection::class
    // ); // unsafe operation
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-getCollectionsOfSizeN"></div>

### getCollectionsOfSizeN($max_size_of_each_collection=1): \VersatileCollections\CollectionInterface
Break-up a collection into a new collection (**GenericCollection**) of sub-collections (each having a maximum size of **N**). 
Each sub-collection will be of the same type as the collection object this method is being called on. 
The collection object this method is being called on is not modified.<br>
You can also use **yieldCollectionsOfSizeN($max_size_of_each_collection=1)** which returns a 
Generator (instead of a new collection) that yields each sub-collection.

```php
<?php

    $collection = \VersatileCollections\GenericCollection::makeNew(
        [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
    );

    $sub_collections = $collection->getCollectionsOfSizeN(3);

    foreach ( $sub_collections as $sub_collection ) {
        
        var_export($sub_collection->toArray());
    }
    
    // Will generate the output below:
    //    [ 0=>1,    1=>2,  2=>3   ]
    //    [ 3=>4,    4=>5,  5=>6   ]
    //    [ 6=>7,    7=>8,  8=>9   ]
    //    [ 9=>10,  10=>11, 11=>12 ]
    //    [ 12=>13, 13=>14         ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-getIfExists"></div>

### getIfExists($key, $default_value=null): mixed
Try to get an item from the collection with the specified key (`$key`) 
or return `$default_value` if key does not exist in the collection.

```php
<?php

    $collection = \VersatileCollections\GenericCollection::makeNew(
       ['first_key'=>'first item', 'second_key'=>'second item']
    );

    $collection->getIfExists('first_key'); // === 'first item'
    $collection->getIfExists('second_key'); // === 'second item'
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-getItems"></div>

### getItems(): \VersatileCollections\CollectionInterface
Get a new collection (of the same type as the original collection) of items in a collection without the corresponding keys in the original collection.
Items in the new collection will have sequentially increasing numeric keys starting from 0.

```php
<?php

    $collection = \VersatileCollections\GenericCollection::makeNew(
       ['first_key'=>'first item', 'second_key'=>'second item']
    );

    $collection->getItems(); // a collection containing [ 0=>'first item', 1=>'second item' ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-getIterator"></div>

### getIterator(): \Iterator
Returns an **Iterator** object that can be used to traverse a collection. 
You will not normally need to call this method since it's a fulfilment of php's
**IteratorAggregate** interface and is automatically used under the hood whenever 
you iterate over a collection object via a **foreach** loop.<br>
You should use the **each()** method to iterate over a collection (it has a 
fluent interface which supports method chaining), but if you want, you can also 
use a `foreach` loop, `for` loop, `while` loop or `do-while` loop to iterate over 
a collection, but you should not have to.

```php
<?php

    $collection = \VersatileCollections\IntsCollection::makeNew([1,2,3,4,5,6,7]);

    // Because of getIterator() you can loop through a collection object using
    // a foreach loop as illustrated below below:
    foreach( $collection as $key => $item ) {
        
        // do stuff with $key and $item
    }
    
    // OR

    // For loop
    $iterator = $collection->getIterator();
    
    for( $iterator->rewind(); $iterator->valid(); $iterator->next() ) {
        
        $key = $iterator->key();
        $item = $iterator->current();
        
        // do stuff with $key and $item
    }
    
    // OR
    
    // While loop
    $iterator->rewind();
    
    while( $iterator->valid() ) {
        
        $key = $iterator->key();
        $item = $iterator->current();

        // do stuff with $key and $item
        
        $iterator->next();
    }
    
    // OR
    
    // Do-While loop
    $iterator->rewind();
    
    do{
        if( $iterator->valid() ) {
            $key = $iterator->key();
            $item = $iterator->current();
            
            // do stuff with $key and $item
            
            $iterator->next();
        }
    } while( $iterator->valid() );
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-getKeys"></div>

### getKeys(): \VersatileCollections\GenericCollection
Get a collection (**GenericCollection**) of keys to a collection.

```php
<?php

    $collection = \VersatileCollections\GenericCollection::makeNew(
       ['first_key'=>'first item', 'second_key'=>'second item']
    );

    $collection->getKeys(); // a collection containing  [ 0=>'first_key', 1=>'second_key']
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-intersectByItems"></div>

### intersectByItems(array $arr): \VersatileCollections\CollectionInterface
Create a collection of items from the original collection that are present in `$arr`

```php
<?php
    $array1 = ["a" => "green", "red", "blue"];
    $array2 = ["b" => "green", "yellow", "red"];
    $collection = \VersatileCollections\GenericCollection::makeNew($array1);

    $collection->intersectByItems($array2)
               ->toArray(); // === ["a" => "green", 0 => "red"]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-intersectByItemsUsingCallback"></div>

### intersectByItemsUsingCallback(array $arr, callable $item_comparator): \VersatileCollections\CollectionInterface 
Create a collection of items from the original collection that are present in `$arr` using a callback for the item comparison

* **$item_comparator**:  a callback used to check if an item in the collection is equal to an item in `$arr`.
The function must have the following signature: **function( mixed $a, mixed $b ): int**.
The comparison function must return an integer less than, equal to, or greater than zero 
if the first argument is considered to be respectively less than, equal to, 
or greater than the second.

```php
<?php
    $array2 = ["a" => "GREEN", "B" => "brown", "yellow", "red"];
    $array1 = ["a" => "green", "b" => "brown", "c" => "blue", "red"];
    $collection = \VersatileCollections\GenericCollection::makeNew($array1);

    $collection->intersectByItemsUsingCallback($array2, "strcasecmp")
               ->toArray(); // === ["a"=>"green", "b"=>"brown", 0=>"red"]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-intersectByKeys"></div>

### intersectByKeys(array $arr): \VersatileCollections\CollectionInterface
Create a collection of items from the original collection whose keys are present in `$arr`

```php
<?php
    $array1 = ['blue'=>1, 'red'=>2, 'green'=>3, 'purple'=>4];
    $array2 = ['green'=>5, 'blue'=>6, 'yellow'=>7, 'cyan'=>8];
    $collection = \VersatileCollections\GenericCollection::makeNew($array1);

    $collection->intersectByKeys($array2)
               ->toArray(); // === ['blue'=>1, 'green'=>3]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-intersectByKeysUsingCallback"></div>

### intersectByKeysUsingCallback(array $arr, callable $key_comparator): \VersatileCollections\CollectionInterface 
Create a collection of items from the original collection whose keys are present in $arr using a callback for the key comparison

* **$key_comparator**: a callback used to check if a key in the collection is equal to a key in `$arr`.
The function must have the following signature: **function( mixed $a, mixed $b ): int**.
The comparison function must return an integer less than, equal to, or greater than zero 
if the first argument is considered to be respectively less than, equal to, 
or greater than the second.

```php
<?php
    $key_compare_func = function ($key1, $key2) {

        if ($key1 == $key2)
            return 0;
        else if ($key1 > $key2)
            return 1;
        else
            return -1;
    };

    $array1 = ['blue'  => 1, 'red'  => 2, 'green'  => 3, 'purple' => 4];
    $array2 = ['green' => 5, 'blue' => 6, 'yellow' => 7, 'cyan'   => 8];
    $collection = \VersatileCollections\GenericCollection::makeNew($array1);

    $collection->intersectByKeysUsingCallback($array2, $key_compare_func)
               ->toArray(); // === ['blue'=>1, 'green'=>3]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-intersectByKeysAndItems"></div>

### intersectByKeysAndItems(array $arr): \VersatileCollections\CollectionInterface
Create a collection of items from the original collection whose keys and corresponding items /values are present in `$arr`

```php
<?php
    $array1 = ["a" => "green", "b" => "brown", "c" => "blue", "red"];
    $array2 = ["a" => "green", "b" => "yellow", "blue", "red"];
    $collection = \VersatileCollections\GenericCollection::makeNew($array1);

    $collection->intersectByKeysAndItems($array2)
               ->toArray(); // === ["a" => "green"]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-intersectByKeysAndItemsUsingCallbacks"></div>

### intersectByKeysAndItemsUsingCallbacks(array $arr, callable $key_comparator=null, callable $item_comparator=null): \VersatileCollections\CollectionInterface 
Create a collection of items from the original collection whose keys and corresponding items /values are present in `$arr` using callbacks for key and item comparisons

* **$key_comparator**: a callback used to check if a key in the collection is equal to a key in `$arr`.
The function must have the following signature: **function( mixed $a, mixed $b ): int**.
The comparison function must return an integer less than, equal to, or greater than zero 
if the first argument is considered to be respectively less than, equal to, 
or greater than the second.
* **$item_comparator**: a callback used to check if an item in the collection is equal to an item in `$arr`.
The function must have the following signature: **function( mixed $a, mixed $b ): int**.
The comparison function must return an integer less than, equal to, or greater than zero 
if the first argument is considered to be respectively less than, equal to, 
or greater than the second.

```php
<?php
    //////////////////////////////////////////////////////////////////////////////
    // null key callback and null item callback
    $array1 = ["a" => "green", "b" => "brown", "c" => "blue", "red"];
    $array2 = ["a" => "green", "b" => "yellow", "blue", "red"];
    $collection = \VersatileCollections\GenericCollection::makeNew($array1);

    $collection->intersectByKeysAndItemsUsingCallbacks($array2, null, null)
               ->toArray(); // === ["a" => "green"]

    //////////////////////////////////////////////////////////////////////////////
    // non-null key callback and non-null item callback
    $array1 = ["a" => "green", "b" => "brown", "c" => "blue", "red"];
    $array2 = ["a" => "GREEN", "B" => "brown", "yellow", "red"];
    $collection = \VersatileCollections\GenericCollection::makeNew($array1);

    $collection->intersectByKeysAndItemsUsingCallbacks($array2, "strcasecmp", "strcasecmp")
               ->toArray(); // === ["a" => "green", "b" => "brown"]

    //////////////////////////////////////////////////////////////////////////////
    // null key callback and non-null item callback
    $array1 = ["a" => "green", "b" => "brown", "c" => "blue", "red"];
    $array2 = ["a" => "GREEN", "B" => "brown", "yellow", "red"];
    $collection = \VersatileCollections\GenericCollection::makeNew($array1);

    $collection->intersectByKeysAndItemsUsingCallbacks($array2, null, "strcasecmp")
               ->toArray();// === ["a" => "green"]

    //////////////////////////////////////////////////////////////////////////////
    // non-null key callback and null item callback
    $array1 = ["a" => "green", "b" => "brown", "c" => "blue", "red"];
    $array2 = ["a" => "GREEN", "B" => "brown", "yellow", "red"];
    $collection = \VersatileCollections\GenericCollection::makeNew($array1);

    $collection->intersectByKeysAndItemsUsingCallbacks($array2, "strcasecmp", null)
               ->toArray(); // === ["b" => "brown"]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-isEmpty"></div>

### isEmpty(): bool
Return true if there are one or more items in the collection or false otherwise.

```php
<?php

    $collection = \VersatileCollections\GenericCollection::makeNew();
    $collection->isEmpty(); // === true

    $collection = \VersatileCollections\GenericCollection::makeNew(
       ['first_key'=>'first item', 'second_key'=>'second item']
    );
    $collection->isEmpty(); // === false
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-lastItem"></div>

### lastItem(): mixed
Retrieves and returns the last item in a collection. See `firstItem()` if you want to get the first item.

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        ['One', 'Two', 'Three', 'Four']
    );
    $collection->lastItem(); // === 'Four'
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-makeAllKeysNumeric"></div>

### makeAllKeysNumeric($starting_key=0): $this
Convert all keys in the collection to consecutive integer keys starting from `$starting_key`.
* **$starting_key**: a positive integer value that will be the value of the first key.
A negative integer value will be converted to zero.

```php
<?php

    $collection = \VersatileCollections\GenericCollection::makeNew();
    $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
    $collection->item2 = ['name'=>'Jane', 'age'=>'20',];
    $collection->item3 = ['name'=>'Janice', 'age'=>'30',];

    // $collection initially contains:
    //  [
    //      'item1' => [ 'name'=>'Joe', 'age'=>'10' ],
    //      'item2' => [ 'name'=>'Jane', 'age' => '20' ],
    //      'item3' => [ 'name' => 'Janice', 'age' => '30' ]
    //  ]

    // no args
    $collection->makeAllKeysNumeric();
    // $collection now contains:
    //  [
    //      0 => [ 'name'=>'Joe', 'age'=>'10' ],
    //      1 => [ 'name'=>'Jane', 'age' => '20' ],
    //      2 => [ 'name' => 'Janice', 'age' => '30' ]
    //  ]
    
    // reset collection to initial state
    $collection = \VersatileCollections\GenericCollection::makeNew();
    $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
    $collection->item2 = ['name'=>'Jane', 'age'=>'20',];
    $collection->item3 = ['name'=>'Janice', 'age'=>'30',];
    
    // with starting key value of 777
    $collection->makeAllKeysNumeric(777);
    // $collection now contains:
    //  [
    //      777 => [ 'name'=>'Joe', 'age'=>'10' ],
    //      778 => [ 'name'=>'Jane', 'age' => '20' ],
    //      779 => [ 'name' => 'Janice', 'age' => '30' ]
    //  ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-makeNew"></div>

### static makeNew(array $items=[], $preserve_keys=true): \VersatileCollections\CollectionInterface
Creates a new collection from an array.<br>
THIS IS THE STRONGLY RECOMMENDED WAY TO CREATE COLLECTION OBJECTS (if you forget 
to unpack arguments when creating collection objects via the constructor, you 
will end up with a collection containing only one item, which is the array 
passed to the constructor which you forgot to unpack).
* **$items**: an array of items to be stored in the new collection that will be created.
* **$preserve_keys**: true if keys in `$items` will be preserved in the created collection.

```php
<?php

    $data = [];
    $data['item1'] = ['name'=>'Joe', 'age'=>'10',];
    $data['item2'] = ['name'=>'Jane', 'age'=>'20',];
    $data['item3'] = ['name'=>'Janice', 'age'=>'30',];

    $collection = \VersatileCollections\GenericCollection::makeNew($data);
    // Keys preserved and $collection contains:
    //  [
    //      'item1' => [ 'name'=>'Joe', 'age'=>'10' ],
    //      'item2' => [ 'name'=>'Jane', 'age' => '20' ],
    //      'item3' => [ 'name' => 'Janice', 'age' => '30' ]
    //  ]
    
    $collection = \VersatileCollections\GenericCollection::makeNew($data, false);
    // Keys not preserved and $collection contains:
    //  [
    //      0 => [ 'name'=>'Joe', 'age'=>'10' ],
    //      1 => [ 'name'=>'Jane', 'age' => '20' ],
    //      2 => [ 'name' => 'Janice', 'age' => '30' ]
    //  ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-map"></div>

### map(callable $callback, $preserve_keys=true, $bind_callback_to_this=true): \VersatileCollections\CollectionInterface
Applies the callback to the items in the collection and returns a new 
collection containing all the items in the original collection after
applying the callback function to each one. The original collection 
is not modified.

* **$callback**: a callback with the following signature: **function($key, $item): mixed**. 
It should perform an operation on each item and return the result of the operation on each item.
* **$preserve_keys**: true if keys in the returned collection should match the keys in the 
original collection, else false for sequentially incrementing integer keys (starting from 0)
in the returned collection.
* **$bind_callback_to_this**: true if the variable `$this` inside the supplied 
$callback should refer to the collection object this method is being invoked on.

```php
<?php
    $int_collection = 
        \VersatileCollections\IntsCollection::makeNew([1, 2, 3, 4, 5]);

    $multiplied = $int_collection->map(
        function ($key, $item) {
            return $item * 2;
        },
        false,
        false
    );
    $int_collection->toArray(); // === [1, 2, 3, 4, 5]
    $multiplied->toArray(); // === [2, 4, 6, 8, 10]

    $multiplied = $int_collection->map(
        function ($key, $item) {
            return $item * $this->count();
        },
        false,
        true
    );
    $int_collection->toArray(); // === [1, 2, 3, 4, 5]
    $multiplied->toArray(); // === [5, 10, 15, 20, 25])

    // preserved keys
    $int_collection = \VersatileCollections\IntsCollection::makeNew();
    $int_collection[5] = 1;
    $int_collection[6] = 2;
    $int_collection[7] = 3;
    $int_collection[8] = 4;
    $int_collection[9] = 5;

    $multiplied = $int_collection->map(
        function ($key, $item) {
            return $item * $this->count();
        },
        true,
        true
    );
    $multiplied->toArray(); // === [5=>5, 6=>10, 7=>15, 8=>20, 9=>25]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-mergeMeWith"></div>

### mergeMeWith(array $items): $this
Adds all items from `$items` to the collection object this method is being called on.
Items in `$items` with existing keys in the original collection will overwrite 
the existing items in the original collection.<br>
Use `unionWith()` or `unionMeWith()` if you want items from the original collection
to be used when same keys exist in both `$items` and the original collection.

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        [ 'a'=>1, 'b'=>2, 'c'=>3, 'd'=>4, 'e'=>5 ]
    );

    $collection->mergeMeWith(
        [ 'a'=>15, 'b'=>25, 'c'=>35, 'd'=>45 ]
    );
    $collection->toArray(); // [ 'a'=>15, 'b'=>25, 'c'=>35, 'd'=>45, 'e'=>5 ]

    // overwrite all items
    $collection->mergeMeWith(
        [ 'a'=>152, 'b'=>252, 'c'=>352, 'd'=>452, 'e'=>552 ]
    );
    $collection->toArray(); // [ 'a'=>152, 'b'=>252, 'c'=>352, 'd'=>452, 'e'=>552 ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-mergeWith"></div>

### mergeWith(array $items): \VersatileCollections\CollectionInterface
Works exactly like `mergeMeWith(array $items)`, except that the original
collection is not modified, but instead the merged items are returned in
a new collection.<br>
Use `unionWith()` or `unionMeWith()` if you want items from the original collection
to be used when same keys exist in both `$items` and the original collection.

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        [ 'a'=>1, 'b'=>2, 'c'=>3, 'd'=>4, 'e'=>5 ]
    );

    $merged = $collection->mergeWith(
        [ 'a'=>15, 'b'=>25, 'c'=>35, 'd'=>45 ]
    );
    $merged->toArray(); // [ 'a'=>15, 'b'=>25, 'c'=>35, 'd'=>45, 'e'=>5 ]
    $collection->toArray(); // [ 'a'=>1, 'b'=>2, 'c'=>3, 'd'=>4, 'e'=>5 ]

    // overwrite all items
    $merged = $collection->mergeWith(
        [ 'a'=>152, 'b'=>252, 'c'=>352, 'd'=>452, 'e'=>552 ]
    );
    $merged->toArray(); // [ 'a'=>152, 'b'=>252, 'c'=>352, 'd'=>452, 'e'=>552 ]
    $collection->toArray(); // [ 'a'=>1, 'b'=>2, 'c'=>3, 'd'=>4, 'e'=>5 ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-offsetExists"></div>

### offsetExists($key): bool
Returns true if the specified key exists in a collection or false if not.<br>
You shouldn't need to call this method since it is automatically used by the
ArrayAccess API.

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-offsetGet"></div>

### offsetGet($key): mixed
Returns the item associated with the specified key if the key exists in the collection.<br>
You shouldn't need to call this method since it is automatically used by the
ArrayAccess API.

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-offsetSet"></div>

### offsetSet($key, $val): void
Add an item (`$val`) to the collection with the specified key (`$key`).<br>
You shouldn't need to call this method since it is automatically used by the
ArrayAccess API.

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-offsetUnset"></div>

### offsetUnset($key): void
Remove an item associated with the specified key (`$key`) from the collection.<br>
You shouldn't need to call this method since it is automatically used by the
ArrayAccess API.

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-paginate"></div>

### paginate($page_number, $num_items_per_page): \VersatileCollections\CollectionInterface
Get a collection of at most `$num_items_per_page` items starting from the
`(($page_number * $num_items_per_page) - $num_items_per_page + 1)th` position
in the collection.<br>

This method assumes positions in the collection are 1-indexed rather
than zero-indexed. For example item 'a' in this array (['a', 'b', 'c'])
is at the first position as far as the documentation of this method is 
concerned as opposed to the zeroeth position (which is how you would
actually reference it php code).<br>

For example given a collection containing:
``` 
          [ 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h' ]
             ^    ^    ^    ^    ^    ^    ^    ^
 position    1    2    3    4    5    6    7    8
```

calling `paginate(2, 3)` on that collection means you want to get a collection 
of at most 3 items starting from the 2nd page which is actually the 
(((2 * 3) - 3 + 1) == 4th) position in that collection which should 
return a collection containing:
``` 
    [ 'd', 'e', 'f' ]
```
* **$page_number**: Page number. It must be a positive integer starting from 1.
If a value less than 1 is supplied, it will be bumped up to 1.
If it has a value larger than the total number of available pages 
(i.e. `($this->count() / $num_items_per_page)` assuming  
`1 <= $num_items_per_page <= $this->count()`), 
an empty collection will be returned.
* **$num_items_per_page**: The number of items in the collection to be returned. 
It must be a positive integer starting from 1. If a value less than 1 is supplied, 
it will be bumped up to 1. If it has a value larger than `$this->count()`, all items 
from position `$page_number` in the collection till the end of the collection will be returned.

```php
<?php
    $empty_c = \VersatileCollections\GenericCollection::makeNew();
    $c = \VersatileCollections\GenericCollection::makeNew(
        [ 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h' ]
    );

    $empty_c->paginate(1, 2)->toArray(); // === []
    // paginate(0, 2) === paginate(1, 2), 0 is converted to 1
    $c->paginate(0, 2)->toArray(); // === ['a', 'b']
    $c->paginate(1, 2)->toArray(); // === ['a', 'b']

    // -2 and 0 below will be converted to 1
    // i.e. paginate(0, -2) === paginate(0, 1) === paginate(1, 1)
    $c->paginate(0, -2)->toArray(); // === ['a']

    // -777 below will be converted to 1
    // i.e. paginate(-777, 2) === paginate(1, 2)
    $c->paginate(-777, 2)->toArray(); // === ['a', 'b']

    $c->paginate(2, 2)->toArray(); // === [2=>'c', 3=>'d']
    $c->paginate(2, 3)->toArray(); // === [3=>'d', 4=>'e', 5=>'f']

    // number of items in page > $c->count()
    $c->paginate(2, 777)
      ->toArray(); // === [1=>'b', 2=>'c', 3=>'d', 4=>'e', 5=>'f', 6=>'g', 7=>'h']

    // only 4 pages of two items per page available in 
    //  [ 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h' ]
    // requesting a 5th page should return an empty collection
    $c->paginate(5, 2)->toArray(); // === []
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-pipeAndReturnCallbackResult"></div>

### pipeAndReturnCallbackResult(callable $callback): mixed
Pass the collection to the given callback and return whatever value is
returned from executing the given callback.<br>
This method is very useful for chaining a series of operations to be 
performed on a collection object especially when the output of prior
operations are needed as input for the next operation.

* **$callback**: a callback with the following signature
**function($collection):mixed**. The `$collection` argument 
in the callback's signature is the collection object this 
`pipeAndReturnCallbackResult` method is being invoked on.

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h']
    );

    $counter = function($collection) { return $collection->count(); };
    $to_array = function($collection) { return $collection->toArray(); };

    $collection->pipeAndReturnCallbackResult($counter); // === 8
    $collection->pipeAndReturnCallbackResult($to_array); 
                    // === ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h']

    ////////////////////////////////////////////////
    // More interesting operation chaining example:
    ////////////////////////////////////////////////
    $data = [];
    $data[] = ['id' => 17, 'age' => 21, 'score' => 75, 'name'=>"Jake"];
    $data[] = ['id' => 27, 'age' => 23, 'score' => 70, 'name'=>"Jane"];
    $data[] = ['id' => 37, 'age' => 24, 'score' => 80, 'name'=>"Abel"];
    $data[] = ['id' => 47, 'age' => 31, 'score' => 99, 'name'=>"Abby"];
    $data[] = ['id' => 57, 'age' => 18, 'score' => 90, 'name'=>"Tara"];
    $data[] = ['id' => 67, 'age' => 40, 'score' => 89, 'name'=>"Tory"];
    $collection = 
        \VersatileCollections\GenericCollection::makeNew($data);

    $collection_of_items_with_age_gte_20_and_lte_30_and_score_gte_75 =
        $collection
            ->pipeAndReturnCallbackResult(
                function($collection){

                    return $collection->filterAll(

                        function($key, $item) {

                            return $item['age'] >= 20 && $item['age'] <= 30;
                        },
                        true // copy keys
                    );  // filter all students with age >=20 and age <=30
                }
            ) // at this point we should have a collection of students 
              // with age >=20 and age <=30
              // we are now going to further filter these results for
              // students with score >= 75 in the second call to
              // pipeAndReturnCallbackResult below
            ->pipeAndReturnCallbackResult(
                function($collection){

                    return $collection->filterAll(

                        function($key, $item) {

                            return $item['score'] >= 75;
                        },
                        true // copy keys
                    );  // filter all students with score >= 75
                }
            ); // at this point we should have a collection of students 
               // with age >=20 and age <=30 and score >= 75

    // $collection_of_items_with_age_gte_20_and_lte_30_and_score_gte_75 
    // now contains:
    //      [
    //          0 => ['id' => 17, 'age' => 21, 'score' => 75, 'name'=>"Jake"],
    //          2 => ['id' => 37, 'age' => 24, 'score' => 80, 'name'=>"Abel"]
    //      ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-pipeAndReturnSelf"></div>

### pipeAndReturnSelf(callable $callback): $this
Pass the collection to the given callback and return the collection object 
the `pipeAndReturnSelf` method is being called on.<br>
This method is very useful for chaining a series of operations to be 
performed on a collection object.

* **$callback**: a callback with the following signature
**function($collection):void**. The `$collection` argument 
in the callback's signature is the collection object this 
`pipeAndReturnSelf` method is being invoked on.

```php
<?php
    $average = 0;
    $max = 0;
    $median = 0;
    $min = 0;
    $mode = 0;
    $product = 0;
    $sum = 0;
    $collection = \VersatileCollections\IntsCollection::makeNew(
        [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 2]
    );

    $collection
        ->pipeAndReturnSelf(
            function($collection)use(&$average) {

                $average = $collection->average(); 
            }
        ) // calculate average
        ->pipeAndReturnSelf(
            function($collection)use(&$max) {

                $max = $collection->max();
            }
        ) // calculate max
        ->pipeAndReturnSelf(
            function($collection)use(&$median) {

                $median = $collection->median();
            }
        ) // calculate median
        ->pipeAndReturnSelf(
            function($collection)use(&$min) {

                $min = $collection->min();
            }
        ) // calculate min
        ->pipeAndReturnSelf(
            function($collection)use(&$mode) {
        
                $mode = implode(', ', $collection->mode());
            }
        ) // calculate mode
        ->pipeAndReturnSelf(
            function($collection)use(&$product) {

                $product = $collection->product();
            }
        ) // calculate product
        ->pipeAndReturnSelf(
            function($collection)use(&$sum) {

                $sum = $collection->sum();
            }
        ) // calculate sum
        ->pipeAndReturnSelf(
            function($collection)
            use(&$average, &$max, &$median, &$min, &$mode, &$product, &$sum) {
                echo " Average: $average, Max: $max, Median: $median,"
                   . " Min: $min, Mode: $mode, Product: $product, Sum: $sum";
            }
        ); // finally print out the results below:
//  Average: 5.1818181818182, Max: 10, Median: 5, Min: 1, Mode: 2, Product: 7257600, Sum: 57
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-prependCollection"></div>

### prependCollection(CollectionInterface $other): $this
Prepends all items from `$other` collection to the front of a collection.<br>
Note that all numeric keys will be modified to start counting from zero while 
literal keys won't be changed.<br>
>For strictly typed collections, `$other` must be of the same type as the collection's type 
or a sub-type of the the collection's type or else an Exception will be thrown.<br>

For example, you cannot prepend an instance of **StringsCollection** to an instance 
of **ArraysCollection**, but you can prepend an instance of **FloatsCollection** to
an instance of **NumericsCollection** (since **FloatsCollection** is a sub-type of
**NumericsCollection**).

```php
<?php 
    $item1 = "4";
    $item2 = 5.0;
    $item3 = 7;
    $collection = \VersatileCollections\GenericCollection::makeNew(
        [$item1, $item2, $item3]
    );

    $other_item1 = "114";
    $other_item2 = 35.5;
    $other_item3 = 777;
    $other_collection = \VersatileCollections\GenericCollection::makeNew(
        [$other_item1, $other_item2, $other_item3]
    );
    $collection->prependCollection($other_collection);

    // At this point, $collection now contains:
    // [ 0=>'114', 1=>35.5, 2=>777, 3=>'4', 4=>5.0, 5=>7 ]

    ////////////////////////
    // Inheritance example
    ////////////////////////
    $numeric_collection = \VersatileCollections\NumericsCollection::makeNew(
        [1.0, 2.0, 3, 4, 5, 6]
    );
    
    // append a sub-class collection
    $int_collection = \VersatileCollections\IntsCollection::makeNew([8, 9, 10, 11]);
    $numeric_collection->prependCollection($int_collection);
    $numeric_collection->toArray(); // === [8, 9, 10, 11, 1.0, 2.0, 3, 4, 5, 6]

    // append another sub-class collection
    $float_collection = \VersatileCollections\FloatsCollection::makeNew([8.5, 9.7, 10.8, 11.9]);
    $numeric_collection->prependCollection($float_collection);
    $numeric_collection->toArray(); // === [8.5, 9.7, 10.8, 11.9, 8, 9, 10, 11, 1.0, 2.0, 3, 4, 5, 6]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-prependItem"></div>

### prependItem($item, $key=null): $this
Prepends an item to the front of a collection (an optional key (string or integer) could be supplied).<br>
>For strictly typed collections, `$item` must be of the same type as the collection's type 
or a sub-type of the the collection's type or else an Exception will be thrown.<br>

For example, you cannot prepend a string to an instance of **ArraysCollection**,
but you can prepend a **float** or an **integer** to an instance of **NumericsCollection** 
(since **floats** and **integers** are numeric).

```php
<?php 
    $collection = \VersatileCollections\NumericsCollection::makeNew([4, 5.0, 7]);
    $collection->prependItem(777); // integer acceptable
    $collection->prependItem(7.5); // float acceptable
    //$collection->prependItem('7.5'); // string not acceptable
    $collection->toArray(); // [ 0=>7.5, 1=>777, 2=>4, 3=>5.0, 4=>7 ]

    //////////////////////////////////////
    // More Examples:
    /////////////////////////////////////
    $numeric_collection = \VersatileCollections\NumericsCollection::makeNew(
        [1.9, 2.9, 3, 4, 5, 6]
    );
    $numeric_collection->toArray(); // === [ 0=>1.9, 1=>2.9, 2=>3, 3=>4, 4=>5, 5=>6 ]

    $numeric_collection->prependItem(777);
    $numeric_collection->toArray(); // === [ 0=>777, 1=>1.9, 2=>2.9, 3=>3, 4=>4, 5=>5, 6=>6 ]
    
    // overwrite the value associated with the existing key `1` 
    // which is currently associated with the value `1.9`
    $numeric_collection->prependItem(888, 1); 
    $numeric_collection->toArray(); // === [ 1=>888, 0=>777, 2=>2.9, 3=>3, 4=>4, 5=>5, 6=>6 ]
    
    $numeric_collection->prependItem(999, 'custom_key');
    $numeric_collection->toArray(); 
                // === [ 'custom_key'=>999, 1=>888, 0=>777, 2=>2.9, 3=>3, 4=>4, 5=>5, 6=>6 ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-pull"></div>

### pull($key, $default = null): mixed
Get and remove an item with the specified key from the collection.<br> 
A default value will be returned if the specified key does not exist in the collection.

```php
<?php 
    $collection = \VersatileCollections\GenericCollection::makeNew();
    $collection['item1'] = 22;
    $collection['item2'] = 23;
    $collection['item3'] = 24;
    $collection['item4'] = 25;

    $collection->pull('item1'); // === 22
    $collection->toArray(); // === [ 'item2'=>23, 'item3'=>24, 'item4'=>25 ]

    $collection->pull('item2'); // === 23
    $collection->toArray(); // === [ 'item3'=>24, 'item4'=>25 ]

    $collection->pull('item3'); // === 24
    $collection->toArray(); // === [ 'item4'=>25 ]

    $collection->pull('item4')); // === 25
    $collection->toArray(); // === []

    // default value returned for non-existent key
    $collection->pull('key_4_non_existent_item', -999); // === -999
    $collection->toArray(); // === []
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-push"></div>

### push($item): $this
Alias of appendItem($item).

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-put"></div>

### put($key, $value): $this
Insert an item (`$value`) into the collection using the specified key (`$key`).<br>
If the key already exists in the collection, its value will be updated with `$value`.

```php
<?php 
    $collection = \VersatileCollections\GenericCollection::makeNew();
    $collection->toArray(); // === []
    
    $collection->put('item1', 12);
    $collection->toArray(); // === [ 'item1'=>12 ]

    $collection->put('item2', 13);
    $collection->toArray(); // === [ 'item1'=>12, 'item2'=>13 ]

    $collection->put('item3', 14);
    $collection->toArray(); // === [ 'item1'=>12, 'item2'=>13, 'item3'=>14 ]

    $collection->put('item4',15);
    $collection->toArray(); // === [ 'item1'=>12, 'item2'=>13, 'item3'=>14, 'item4'=>15 ]

    $collection['item1'] = 22;
    $collection['item2'] = 23;
    $collection['item3'] = 24;
    $collection['item4'] = 25;
    $collection->toArray(); // === [ 'item1'=>22, 'item2'=>23, 'item3'=>24, 'item4'=>25 ]

    $collection->put('item1', 32);
    $collection->toArray(); // === [ 'item1'=>32, 'item2'=>23, 'item3'=>24, 'item4'=>25 ]

    $collection->put('item2', 33);
    $collection->toArray(); // === [ 'item1'=>32, 'item2'=>33, 'item3'=>24, 'item4'=>25 ]

    $collection->put('item3', 34);
    $collection->toArray(); // === [ 'item1'=>32, 'item2'=>33, 'item3'=>34, 'item4'=>25 ]

    $collection->put('item4',35);
    $collection->toArray(); // === [ 'item1'=>32, 'item2'=>33, 'item3'=>34, 'item4'=>35 ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-randomItem"></div>

### randomItem(): mixed
Get one item randomly from the collection.<br>
A length exception (`\LengthException`) is thrown if this method is called on an empty collection.

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-randomItems"></div>

### randomItems($number=1, $preserve_keys=false): \VersatileCollections\CollectionInterface
Get a specified number of items randomly from the collection and return them in a new collection.<br>
A length exception (`\LengthException`) is thrown if this method is called on an empty collection.<br>
An `\InvalidArgumentException` is thrown if `$number` is either not an integer or if it is bigger than the number of items in the collection.

* **$number**: number of random items to be returned
* **$preserve_keys**: true if the key associated with each random item should be 
used in the new collection returned by this method, otherwise false if the new 
collection returned should have sequential integer keys starting at zero.

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-randomKey"></div>

### randomKey(): mixed
Get one key randomly from the collection.<br>
A length exception (`\LengthException`) is thrown if this method is called on an empty collection.

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-randomKeys"></div>

### randomKeys($number=1): \VersatileCollections\GenericCollection
Get a specified number of unique keys randomly from the collection and return them in a new collection.<br>
A length exception (`\LengthException`) is thrown if this method is called on an empty collection.<br>
An `\InvalidArgumentException` is thrown if `$number` is either not an integer or if it is bigger than the number of items in the collection.

* **$number**: number of random keys to be returned

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-reduce"></div>

### reduce(callable $reducer, $initial_value=NULL): mixed
Iteratively reduce the collection items to a single value using a callback function.

* **$reducer**: a callback with the following signature: **function(mixed $carry , mixed $item): mixed**. 
    * `$carry:` Holds the return value of the previous iteration; in the case of the first iteration it instead holds the value of initial.
    * `$item:` Holds the value of the current iteration.
* **$initial_value**: If the optional initial value is available, it will be used at the beginning of the process,
or as a final result in case the collection is empty.

```php
<?php
    $int_collection = 
        \VersatileCollections\IntsCollection::makeNew([1, 2, 3]);

    $sum = $int_collection->reduce(
        function ($carry, $item) {
             return $carry + $item;
        },
        0
    ); // at this point $sum === 6
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-reduceWithKeyAccess"></div>

### reduceWithKeyAccess(callable $reducer, $initial_value=NULL): mixed
Iteratively reduce the collection items to a single value using a callback function.<br>
The callback function will have access to the key for each item.

* **$reducer**: a callback with the following signature: **function(mixed $carry , mixed $item, string|int $key): mixed**. 
    * `$carry:` Holds the return value of the previous iteration; in the case of the first iteration it instead holds the value of initial.
    * `$item:` Holds the value of the current iteration.
    * `$key:` Holds the corresponding key of the current iteration.
* **$initial_value**: If the optional initial is available, it will be used at the beginning of the process, or as a final result in case the collection is empty.

```php
<?php
    $int_collection = 
        \VersatileCollections\IntsCollection::makeNew([1, 2, 3]);

    $sum = $int_collection->reduceWithKeyAccess(
        function ($carry, $item, $key) {
                
            // you can do stuff with $key if you want

            return $carry + $item;
        },
        0
    ); // at this point $sum === 6
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-removeAll"></div>

### removeAll(array $keys=[]): $this
Remove items from the collection (whose keys are present in `$keys`) or (all items if `$keys` is empty) and return `$this`.<br>
* **$keys**: optional array of keys for the items to be removed.

```php
<?php
    $c = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5]);
    $c->removeAll();
    $c->toArray(); // === []

    // removing with specified keys
    $c = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5]);
    $c->removeAll([0,2,4]);
    $c->toArray(); // === [ 1=>2, 3=>4 ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-reverse"></div>

### reverse(): \VersatileCollections\CollectionInterface
Reverse order of items in the collection and return the reversed items in a new collection.<br>

```php
<?php
    $data = \VersatileCollections\GenericCollection::makeNew(['zaeed', 'alan']);
    $reversed = $data->reverse();
    $reversed->toArray(); // === [ 1=>'alan', 0=>'zaeed' ]

    $data = \VersatileCollections\GenericCollection::makeNew(
        [ 'name'=>'taylor', 'framework'=>'laravel' ]
    );
    $reversed = $data->reverse();
    $reversed->toArray(); // === [ 'framework'=>'laravel', 'name'=>'taylor' ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-reverseMe"></div>

### reverseMe(): $this
Reverse order of items in the collection. Original collection will be modified.<br>

```php
<?php
    $data = \VersatileCollections\GenericCollection::makeNew(['zaeed', 'alan']);
    $data->reverseMe();
    $data->toArray(); // === [ 1=>'alan', 0=>'zaeed' ]

    $data = \VersatileCollections\GenericCollection::makeNew(
        [ 'name'=>'taylor', 'framework'=>'laravel' ]
    );
    $data->reverseMe();
    $data->toArray(); // === [ 'framework'=>'laravel', 'name'=>'taylor' ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-searchAllByVal"></div>

### searchAllByVal($value, $strict=false): mixed
Search the collection for a given value and return an array of all corresponding 
key(s) in the collection whose item(s) match the given value, if successful
or `false` if the given value is not found in the collection.

* **$value**: the value to be searched for. 
* **$strict**: true if strict comparison should be used when searching, else false for loose comparison.

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        ['blue', 'red', 'green', 'red', 1, 'blue', '2', 1]
    );
    
    ////////////////////////////////////////////
    // non-strict searches
    ////////////////////////////////////////////

    // found at $collection[0] & $collection[5]
    $collection->searchAllByVal('blue'); // === [0, 5]
    
    // not found
    $collection->searchAllByVal('non existent item'); // === false

    ////////////////////////////////////////////
    // strict searches
    ////////////////////////////////////////////

    // found at $collection[4] & $collection[7]
    $collection->searchAllByVal(1, true); // === [4, 7]

    // not found
    $collection->searchAllByVal('1', true); // === false

    // found at $collection[6]
    $collection->searchAllByVal('2', true); // === [6]
    
    // not found
    $collection->searchAllByVal(2, true); // === false
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-searchByCallback"></div>

### searchByCallback(callable $callback, $bind_callback_to_this=true): mixed
Search the collection using a callback. The callback will be executed on each 
item and corresponding key in the collection. Returns an array of all 
corresponding key(s) in the collection for which the callback returns true
or false if the callback didn't return true for any iteration over the collection.

* **$callback**: a callback with the following signature **function($key, $item):bool**. 
It should return true if a `$key` should be returned or false otherwise.
    * `$key:` Holds a key in the collection for the current iteration.
    * `$item:` Holds an item in the collection for the current iteration.
* **$bind_callback_to_this**: true if the variable `$this` inside the supplied 
`$callback` should refer to the collection object this method is being invoked on.

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        ['blue', 'red', 'green', 'red', 1, 'blue', '2', 1]
    );

    $object_searcher = function($key, $item) {

        return is_object($item) && $this->count() > 0;
    };

    $int_searcher = function($key, $item) {

        return is_int($item) && $this->count() > 0;
    };

    $string_searcher = function($key, $item) {

        return is_string($item) && $this->count() > 0;
    };

    // found at $collection[4] & $collection[7]
    $collection->searchByCallback($int_searcher); // === [4, 7]

    // not found
    $collection->searchByCallback($object_searcher); // === false

    // found at $collection[0], $collection[1], $collection[2], $collection[3],
    // $collection[5] & $collection[6] 
    $collection->searchByCallback($string_searcher); // === [0, 1, 2, 3, 5, 6]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-searchByVal"></div>

### searchByVal($value, $strict=false): mixed
Search the collection for a given value & return the first corresponding key 
if successful or `false` if the given value is not found in the collection.

* **$value**: the value to be searched for. 
* **$strict**: true if strict comparison should be used when searching, else false for loose comparison.

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        ['blue', 'red', 'green', 'red', 1, 'blue', '2', 1]
    );
    
    ////////////////////////////////////////////
    // non-strict searches
    ////////////////////////////////////////////

    // found at $collection[0]
    $collection->searchByVal('blue'); // === 0

    // not found
    $collection->searchByVal('non existent item'); // === false

    ////////////////////////////////////////////
    // strict searches
    ////////////////////////////////////////////

    // found at $collection[4]
    $collection->searchByVal(1, true); // === 4

    // not found
    $collection->searchByVal('1', true); // === false

    // found at $collection[6]
    $collection->searchByVal('2', true); // === 6

    // not found
    $collection->searchByVal(2, true); // === false
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-setValForEachItem"></div>

### setValForEachItem($field_name, $field_val, $add_field_if_not_present=false): $this
This method works only on collections of arrays and / or objects. It set's the 
specified field in each array or property in each object to the given value.

* **$field_name**: the name of the field / property in each array / object whose 
value is to be set. 
* **$field_val**: value to be set for the specified field.
* **$add_field_if_not_present**: true to add the specified field and value if it 
does not exist in one or more array(s) / object(s) in the collection.

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew();
    $collection->item1 = [ 'name'=>'Joe', 'age'=>'10' ];
    $collection->item2 = [ 'name'=>'Jane', 'age'=>'20' ];
    $collection->item3 = (object)[ 'name'=>'Janice', 'age'=>'30' ]; // instance of StdClass
    
    // at this point $collection contains:
    // [
    //     'item1' => [ 'name'=>'Joe', 'age'=>'10' ],
    //     'item2' => [ 'name'=>'Jane', 'age'=>'20' ],
    //     'item3' => stdClass::__set_state([ 'name'=>'Janice', 'age'=>'30' ]),
    // ]
    
    // set the age field in each item to '50' 
    $collection->setValForEachItem('age', '50');

    // at this point $collection contains:
    // [
    //     'item1' => [ 'name'=>'Joe', 'age'=>'50' ],
    //     'item2' => [ 'name'=>'Jane', 'age'=>'50' ],
    //     'item3' => stdClass::__set_state([ 'name'=>'Janice', 'age'=>'50' ]),
    // ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-shuffle"></div>

### shuffle($preserve_keys=true): \VersatileCollections\CollectionInterface
Shuffle all the items in the collection and return shuffled items in a new collection.
If collection is empty, this method will return an empty collection.

* **$preserve_keys**: true if the key associated with each shuffled item should 
be used in the new collection returned by this method, otherwise false if the 
new collection returned should have sequential integer keys starting at zero. 

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5]);
    
    /////////////////////////////////////////////////////////////////
    // NOTE: results will always differ for each call to this method
    // for the same collection because it is a shuffle operation.
    // //////////////////////////////////////////////////////////////
    
    // keys preserved 
    $collection->shuffle(); // contains [ 4=>5, 1=>2, 2=>3, 0=>1, 3=>4 ]
    
    // keys not preserved
    $collection->shuffle(false); // contains  [ 0=>5, 1=>4, 2=>2, 3=>1, 4=>3 ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-slice"></div>

### slice($offset, $length=null): \VersatileCollections\CollectionInterface
Extract a slice of the collection.<br>
The collection itself should is not modified (i.e. sliced items will still 
remain in the collection this method is being called with).

* **$offset**: If offset is non-negative, the sequence will start at that 
offset in the array. If offset is negative, the sequence will start that far 
from the end of the array. 
* **$length**: If length is given and is positive, then the sequence will have 
up to that many elements in it. If the array is shorter than the length, then 
only the available array elements will be present. If length is given and is 
negative then the sequence will stop that many elements from the end of the 
array. If it is omitted, then the sequence will have everything from offset 
up until the end of the array.

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        [1, 2, 3, 4, 5, 6, 7, 8]
    );
    $collection->slice(-3)->toArray(); // === [ 5=>6, 6=>7, 7=>8 ]
    $collection->slice(-5, 3)->toArray(); // === [ 3=>4, 4=>5, 5=>6 ]
    $collection->slice(-6, -2)->toArray(); // === [ 2=>3, 3=>4, 4=>5, 5=>6 ]
    $collection->slice(3)->toArray(); // === [ 3=>4, 4=>5, 5=>6, 6=>7, 7=>8 ]
    $collection->slice(3)->toArray(); // === [ 3=>4, 4=>5, 5=>6, 6=>7, 7=>8 ]
    $collection->slice(3, 3)->toArray(); // === [ 3=>4, 4=>5, 5=>6 ]
    $collection->slice(3, -1)->toArray(); // === [ 3=>4, 4=>5, 5=>6, 6=>7 ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-sort"></div>

### sort(callable $callable=null, \VersatileCollections\SortType $type=null): \VersatileCollections\CollectionInterface
Sort the collection's items in ascending order while maintaining key association.<br>
A new collection containing the sorted items is returned.
The original collection itself is not modified.

* **$callable**: a callback with the following signature **function(mixed $a, mixed $b):int**. 
The callback function must return an INTEGER less than, equal to, or greater than zero if the 
first argument is considered to be respectively less than, equal to, or greater than the second.
If callback is not supplied, the native php sorting function `asort` is used for the sorting.
* **$type**: an object indicating the sort type. 
See **\VersatileCollections\SortType::$valid_sort_types** for available sort types.

```php
<?php
    $sorted_collection = 
        (\VersatileCollections\GenericCollection::makeNew([5, 3, 1, 2, 4]))->sort();
    $sorted_collection->toArray(); // === [ 2=>1, 3=>2, 1=>3, 4=>4, 0=>5 ]

    $sorted_collection = 
        (\VersatileCollections\GenericCollection::makeNew([-1, -3, -2, -4, -5, 0, 5, 3, 1, 2, 4]))
            ->sort();
    $sorted_collection->toArray(); 
        // === [ 4=>-5, 3=>-4, 1=>-3, 2=>-2, 0=>-1, 5=>0, 8=>1, 9=>2, 7=>3, 10=>4, 6=>5 ]

    $sorted_collection = 
        (\VersatileCollections\GenericCollection::makeNew(['foo', 'bar-10', 'bar-1']))->sort();
    $sorted_collection->toArray(); // === [ 2=>'bar-1', 1=>'bar-10', 0=>'foo' ]

    $sorted_collection = 
        (\VersatileCollections\GenericCollection::makeNew(["orange2", "Orange3", "Orange1", "orange20"]))
            ->sort(null, new \VersatileCollections\SortType((SORT_NATURAL | SORT_FLAG_CASE)));
    $sorted_collection->toArray(); // === [ 2=>'Orange1', 0=>'orange2', 1=>'Orange3', 3=>'orange20' ]

    $collection = \VersatileCollections\GenericCollection::makeNew([
        (object)[ 'name'=>'Johnny Cash', 'age'=>50 ],
        (object)[ 'name'=>'Suzzie Cash', 'age'=>23 ],
        (object)[ 'name'=>'Jacky Bauer', 'age'=>43 ],
        (object)[ 'name'=>'Janet Fonda', 'age'=>55 ]
    ]);
    $sorted_collection = $collection->sort();
    // $sorted_collection->toArray() contains:
    //  [ 
    //      2 => stdClass::__set_state(['name'=>'Jacky Bauer',    'age'=>43]), 
    //      3 => stdClass::__set_state(['name'=>'Janet Fonda',    'age'=>55]), 
    //      0 => stdClass::__set_state(['name'=>'Johnny Cash',    'age'=>50]), 
    //      1 => stdClass::__set_state(['name'=>'Suzzie Cash',    'age'=>23])
    //  ]

    $age_sorter = function($a, $b) {

        return ($a->age < $b->age)? -1 : (($a->age === $b->age)? 0:1); 
    };
    $sorted_collection = $collection->sort($age_sorter); // sort by callback
    // $sorted_collection->toArray() contains:
    //    [ 
    //        1 => stdClass::__set_state(['name'=>'Suzzie Cash',    'age'=>23]), 
    //        2 => stdClass::__set_state(['name'=>'Jacky Bauer',    'age'=>43]), 
    //        0 => stdClass::__set_state(['name'=>'Johnny Cash',    'age'=>50]), 
    //        3 => stdClass::__set_state(['name'=>'Janet Fonda',    'age'=>55])
    //    ]
    
    $name_sorter = function($a, $b) {

        return strcmp($a->name, $b->name); 
    };
    $sorted_collection = $collection->sort($name_sorter); // sort by callback
    // $sorted_collection->toArray() contains:
    //    [
    //        2 => stdClass::__set_state(['name' => 'Jacky Bauer', 'age' => 43]),
    //        3 => stdClass::__set_state(['name' => 'Janet Fonda', 'age' => 55]),
    //        0 => stdClass::__set_state(['name' => 'Johnny Cash', 'age' => 50]),
    //        1 => stdClass::__set_state(['name' => 'Suzzie Cash', 'age' => 23])
    //    ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-sortByKey"></div>

### sortByKey(callable $callable=null, \VersatileCollections\SortType $type=null): \VersatileCollections\CollectionInterface
Sort the collection's items by keys in ascending order while maintaining key association.<br>
A new collection containing the sorted items is returned.
The original collection itself is not modified.

* **$callable**: a callback with the following signature **function(mixed $a, mixed $b):int**. 
The callback function must return an INTEGER less than, equal to, or greater than zero if the 
first argument is considered to be respectively less than, equal to, or greater than the second.
If callback is not supplied, the native php sorting function `ksort` is used for the sorting.
* **$type**: an object indicating the sort type. 
See **\VersatileCollections\SortType::$valid_sort_types** for available sort types.

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        ["d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple"]
    );
    $sorted_collection = $collection->sortByKey();
    $sorted_collection->toArray(); // === [ "a"=>"orange", "b"=>"banana", "c"=>"apple", "d"=>"lemon" ]

    $collection = \VersatileCollections\GenericCollection::makeNew(
        ["3"=>"lemon", "0"=>"orange", "1"=>"banana", "2"=>"apple"]
    );
    $sorted_collection = $collection->sortByKey();
    $sorted_collection->toArray(); // === [ "0"=>"orange", "1"=>"banana", "2"=>"apple", "3"=>"lemon" ]

    $collection = \VersatileCollections\GenericCollection::makeNew(
        [ 3=>"lemon", 0=>"orange", 1=>"banana", 2=>"apple", "d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple"]
    );
    $sorted_collection = $collection->sortByKey(null, new \VersatileCollections\SortType(SORT_NUMERIC));
    $sorted_collection->toArray();
        // ===
        //    [
        //        0=>'orange', 'd'=>'lemon', 'a'=>'orange', 'b'=>'banana',
        //        'c'=>'apple', 1=>'banana', 2=>'apple', 3=>'lemon',
        //    ]

    $string_sorter = function($a, $b) {

        return $a.'' < $b.'' ? -1 : (($a.'' == $b.'')? 0 : 1); 
    };
    $sorted_collection = $collection->sortByKey($string_sorter); // sort by callback
    $sorted_collection->toArray();
        // ===
        //    [
        //        0=>'orange', 1=>'banana', 2=>'apple', 3=>'lemon',
        //        'a'=>'orange', 'b'=>'banana', 'c'=>'apple', 'd'=>'lemon'
        //    ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-sortByMultipleFields"></div>

### sortByMultipleFields(\VersatileCollections\MultiSortParameters ...$param): \VersatileCollections\CollectionInterface
Sort a collection of associative arrays or objects by specified field name(s) 
and return a new collection containing the sorted items with their original 
key associations preserved. It can even sort by private and protected object properties<br>
The original collection itself is not modified.

* **$param**: one or more objects indicating the field(s) to sort by and the corresponding sort direction(s) and type(s).<br>
See **\VersatileCollections\MultiSortParameters::$valid_sort_types** for available sort types for each field.<br>
See **\VersatileCollections\MultiSortParameters::$valid_sort_directions** for available sort directions for each field.

```php
<?php
    ////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////
    // Collection of Arrays
    $data = [];
    $data[0] = [ 'volume'=>67, 'edition'=>2 ];
    $data[1] = [ 'volume'=>86, 'edition'=>2 ];
    $data[2] = [ 'volume'=>85, 'edition'=>6 ];
    $data[3] = [ 'volume'=>86, 'edition'=>1 ];

    $collection = \VersatileCollections\GenericCollection::makeNew($data);
    $sort_param = new \VersatileCollections\MultiSortParameters('volume', SORT_ASC, SORT_NUMERIC);
    $sort_param2 = new \VersatileCollections\MultiSortParameters('edition', SORT_DESC, SORT_NUMERIC);
    
    // sort by volume asc, edition desc
    $sorted_collection_asc_desc = $collection->sortByMultipleFields($sort_param, $sort_param2);
    $sorted_collection_asc_desc->toArray();
    //    [
    //        0 => [ 'volume'=>67, 'edition'=>2 ],
    //        2 => [ 'volume'=>85, 'edition'=>6 ],
    //        1 => [ 'volume'=>86, 'edition'=>2 ],
    //        3 => [ 'volume'=>86, 'edition'=>1 ]
    //    ]
        
    $sort_param2->setSortDirection(SORT_ASC);
    
    // sort by volume asc, edition asc
    $sorted_collection_asc_asc = $collection->sortByMultipleFields($sort_param, $sort_param2);
    $sorted_collection_asc_asc->toArray();
    //    [
    //        0 => [ 'volume'=>67, 'edition'=>2 ],
    //        2 => [ 'volume'=>85, 'edition'=>6 ],
    //        3 => [ 'volume'=>86, 'edition'=>1 ],
    //        1 => [ 'volume'=>86, 'edition'=>2 ]
    //    ]

    ////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////
    // Collection of StdClass Objects
    $data = [];
    $data[0] = ((object)[ 'volume'=>67, 'edition'=>2 ]);
    $data[1] = ((object)[ 'volume'=>86, 'edition'=>2 ]);
    $data[2] = ((object)[ 'volume'=>85, 'edition'=>6 ]);
    $data[3] = ((object)[ 'volume'=>86, 'edition'=>1 ]);

    $collection = \VersatileCollections\GenericCollection::makeNew($data);
    $sort_param = new \VersatileCollections\MultiSortParameters('volume', SORT_ASC, SORT_NUMERIC);
    $sort_param2 = new \VersatileCollections\MultiSortParameters('edition', SORT_DESC, SORT_NUMERIC);
    
    // sort by volume asc, edition desc
    $sorted_collection_asc_desc = $collection->sortByMultipleFields($sort_param, $sort_param2);
    $sorted_collection_asc_desc->toArray();
    //    [
    //        0 => stdClass::__set_state([ 'volume'=>67, 'edition'=>2 ]),
    //        2 => stdClass::__set_state([ 'volume'=>85, 'edition'=>6 ]),
    //        1 => stdClass::__set_state([ 'volume'=>86, 'edition'=>2 ]),
    //        3 => stdClass::__set_state([ 'volume'=>86, 'edition'=>1 ])
    //    ]
    
    $sort_param2->setSortDirection(SORT_ASC);
    
    // sort by volume asc, edition asc
    $sorted_collection_asc_asc = $collection->sortByMultipleFields($sort_param, $sort_param2);
    $sorted_collection_asc_asc->toArray();
    //    [
    //        0 => stdClass::__set_state(['volume'=>67, 'edition'=>2 ]),
    //        2 => stdClass::__set_state(['volume'=>85, 'edition'=>6 ]),
    //        3 => stdClass::__set_state(['volume'=>86, 'edition'=>1 ]),
    //        1 => stdClass::__set_state(['volume'=>86, 'edition'=>2 ])
    //    ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-sortDesc"></div>

### sortDesc(callable $callable=null, \VersatileCollections\SortType $type=null): \VersatileCollections\CollectionInterface
Sort the collection's items in descending order while maintaining key association.<br>
A new collection containing the sorted items is returned.
The original collection itself is not modified.

* **$callable**: a callback with the following signature **function(mixed $a, mixed $b):int**. 
The callback function must return an INTEGER less than, equal to, or greater than zero if the 
second argument is considered to be respectively less than, equal to, or greater than the first.
If callback is not supplied, the native php sorting function `arsort` is used for the sorting.
* **$type**: an object indicating the sort type. 
See **\VersatileCollections\SortType::$valid_sort_types** for available sort types.

See `sort(callable $callable=null, \VersatileCollections\SortType $type=null)` for code samples.

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-sortDescByKey"></div>

### sortDescByKey(callable $callable=null, \VersatileCollections\SortType $type=null): \VersatileCollections\CollectionInterface
Sort the collection's items by keys in descending order while maintaining key association.<br>
A new collection containing the sorted items is returned.
The original collection itself is not modified.

* **$callable**: a callback with the following signature **function(mixed $a, mixed $b):int**. 
The callback function must return an INTEGER less than, equal to, or greater than zero if the 
second argument is considered to be respectively less than, equal to, or greater than the first.
If callback is not supplied, the native php sorting function `krsort` is used for the sorting.
* **$type**: an object indicating the sort type. 
See **\VersatileCollections\SortType::$valid_sort_types** for available sort types.

See `sortByKey(callable $callable=null, \VersatileCollections\SortType $type=null)` for code samples.

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-sortMe"></div>

### sortMe(callable $callable=null, \VersatileCollections\SortType $type=null): \VersatileCollections\CollectionInterface
Sort the collection's items in ascending order while maintaining key association.<br>
The original collection itself is modified and returned.

* **$callable**: a callback with the following signature **function(mixed $a, mixed $b):int**. 
The callback function must return an INTEGER less than, equal to, or greater than zero if the 
first argument is considered to be respectively less than, equal to, or greater than the second.
If callback is not supplied, the native php sorting function `asort` is used for the sorting.
* **$type**: an object indicating the sort type. 
See **\VersatileCollections\SortType::$valid_sort_types** for available sort types.

```php
<?php
    $sorted_collection = 
        (\VersatileCollections\GenericCollection::makeNew([5, 3, 1, 2, 4]))->sortMe();
    $sorted_collection->toArray(); // === [ 2=>1, 3=>2, 1=>3, 4=>4, 0=>5 ]

    $sorted_collection = 
        (\VersatileCollections\GenericCollection::makeNew([-1, -3, -2, -4, -5, 0, 5, 3, 1, 2, 4]))
            ->sortMe();
    $sorted_collection->toArray(); 
        // === [ 4=>-5, 3=>-4, 1=>-3, 2=>-2, 0=>-1, 5=>0, 8=>1, 9=>2, 7=>3, 10=>4, 6=>5 ]

    $sorted_collection = 
        (\VersatileCollections\GenericCollection::makeNew(['foo', 'bar-10', 'bar-1']))->sortMe();
    $sorted_collection->toArray(); // === [ 2=>'bar-1', 1=>'bar-10', 0=>'foo' ]

    $sorted_collection = 
        (\VersatileCollections\GenericCollection::makeNew(["orange2", "Orange3", "Orange1", "orange20"]))
            ->sortMe(null, new \VersatileCollections\SortType((SORT_NATURAL | SORT_FLAG_CASE)));
    $sorted_collection->toArray(); // === [ 2=>'Orange1', 0=>'orange2', 1=>'Orange3', 3=>'orange20' ]

    $collection = \VersatileCollections\GenericCollection::makeNew([
        (object)[ 'name'=>'Johnny Cash', 'age'=>50 ],
        (object)[ 'name'=>'Suzzie Cash', 'age'=>23 ],
        (object)[ 'name'=>'Jacky Bauer', 'age'=>43 ],
        (object)[ 'name'=>'Janet Fonda', 'age'=>55 ]
    ]);
    $collection->sortMe();
    // $collection->toArray() contains:
    //  [ 
    //      2 => stdClass::__set_state(['name'=>'Jacky Bauer',    'age'=>43]), 
    //      3 => stdClass::__set_state(['name'=>'Janet Fonda',    'age'=>55]), 
    //      0 => stdClass::__set_state(['name'=>'Johnny Cash',    'age'=>50]), 
    //      1 => stdClass::__set_state(['name'=>'Suzzie Cash',    'age'=>23])
    //  ]

    $age_sorter = function($a, $b) {

        return ($a->age < $b->age)? -1 : (($a->age === $b->age)? 0:1); 
    };
    $collection->sortMe($age_sorter); // sort by callback
    // $collection->toArray() contains:
    //    [ 
    //        1 => stdClass::__set_state(['name'=>'Suzzie Cash',    'age'=>23]), 
    //        2 => stdClass::__set_state(['name'=>'Jacky Bauer',    'age'=>43]), 
    //        0 => stdClass::__set_state(['name'=>'Johnny Cash',    'age'=>50]), 
    //        3 => stdClass::__set_state(['name'=>'Janet Fonda',    'age'=>55])
    //    ]
    
    $name_sorter = function($a, $b) {

        return strcmp($a->name, $b->name); 
    };
    $collection->sortMe($name_sorter); // sort by callback
    // $collection->toArray() contains:
    //    [
    //        2 => stdClass::__set_state(['name' => 'Jacky Bauer', 'age' => 43]),
    //        3 => stdClass::__set_state(['name' => 'Janet Fonda', 'age' => 55]),
    //        0 => stdClass::__set_state(['name' => 'Johnny Cash', 'age' => 50]),
    //        1 => stdClass::__set_state(['name' => 'Suzzie Cash', 'age' => 23])
    //    ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-sortMeByKey"></div>

### sortMeByKey(callable $callable=null, \VersatileCollections\SortType $type=null): \VersatileCollections\CollectionInterface
Sort the collection's items by keys in ascending order while maintaining key association.<br>
The original collection itself is modified and returned.

* **$callable**: a callback with the following signature **function(mixed $a, mixed $b):int**. 
The callback function must return an INTEGER less than, equal to, or greater than zero if the 
first argument is considered to be respectively less than, equal to, or greater than the second.
If callback is not supplied, the native php sorting function `ksort` is used for the sorting.
* **$type**: an object indicating the sort type. 
See **\VersatileCollections\SortType::$valid_sort_types** for available sort types.

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        ["d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple"]
    );
    $collection->sortMeByKey();
    $collection->toArray(); // === [ "a"=>"orange", "b"=>"banana", "c"=>"apple", "d"=>"lemon" ]

    $collection = \VersatileCollections\GenericCollection::makeNew(
        ["3"=>"lemon", "0"=>"orange", "1"=>"banana", "2"=>"apple"]
    );
    $collection->sortMeByKey();
    $collection->toArray(); // === [ "0"=>"orange", "1"=>"banana", "2"=>"apple", "3"=>"lemon" ]

    $collection = \VersatileCollections\GenericCollection::makeNew(
        [ 3=>"lemon", 0=>"orange", 1=>"banana", 2=>"apple", "d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple"]
    );
    $collection->sortMeByKey(null, new \VersatileCollections\SortType(SORT_NUMERIC));
    $collection->toArray();
        // ===
        //    [
        //        0=>'orange', 'd'=>'lemon', 'a'=>'orange', 'b'=>'banana',
        //        'c'=>'apple', 1=>'banana', 2=>'apple', 3=>'lemon',
        //    ]

    $string_sorter = function($a, $b) {

        return $a.'' < $b.'' ? -1 : (($a.'' == $b.'')? 0 : 1); 
    };
    $collection->sortMeByKey($string_sorter); // sort by callback
    $collection->toArray();
        // ===
        //    [
        //        0=>'orange', 1=>'banana', 2=>'apple', 3=>'lemon',
        //        'a'=>'orange', 'b'=>'banana', 'c'=>'apple', 'd'=>'lemon'
        //    ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-sortMeByMultipleFields"></div>

### sortMeByMultipleFields(\VersatileCollections\MultiSortParameters ...$param): \VersatileCollections\CollectionInterface
Sort a collection of associative arrays or objects by specified field name(s) 
and return a new collection containing the sorted items with their original 
key associations preserved. It can even sort by private and protected object properties<br>
The original collection itself is modified and returned.

* **$param**: one or more objects indicating the field(s) to sort by and the corresponding sort direction(s) and type(s).<br>
See **\VersatileCollections\MultiSortParameters::$valid_sort_types** for available sort types for each field.<br>
See **\VersatileCollections\MultiSortParameters::$valid_sort_directions** for available sort directions for each field.

```php
<?php
    ////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////
    // Collection of Arrays
    $data = [];
    $data[0] = [ 'volume'=>67, 'edition'=>2 ];
    $data[1] = [ 'volume'=>86, 'edition'=>2 ];
    $data[2] = [ 'volume'=>85, 'edition'=>6 ];
    $data[3] = [ 'volume'=>86, 'edition'=>1 ];

    $collection = \VersatileCollections\GenericCollection::makeNew($data);
    $sort_param = new \VersatileCollections\MultiSortParameters('volume', SORT_ASC, SORT_NUMERIC);
    $sort_param2 = new \VersatileCollections\MultiSortParameters('edition', SORT_DESC, SORT_NUMERIC);
    
    // sort by volume asc, edition desc
    $collection->sortMeByMultipleFields($sort_param, $sort_param2);
    $collection->toArray();
    //    [
    //        0 => [ 'volume'=>67, 'edition'=>2 ],
    //        2 => [ 'volume'=>85, 'edition'=>6 ],
    //        1 => [ 'volume'=>86, 'edition'=>2 ],
    //        3 => [ 'volume'=>86, 'edition'=>1 ]
    //    ]
        
    $sort_param2->setSortDirection(SORT_ASC);
    
    // sort by volume asc, edition asc
    $collection->sortMeByMultipleFields($sort_param, $sort_param2);
    $collection->toArray();
    //    [
    //        0 => [ 'volume'=>67, 'edition'=>2 ],
    //        2 => [ 'volume'=>85, 'edition'=>6 ],
    //        3 => [ 'volume'=>86, 'edition'=>1 ],
    //        1 => [ 'volume'=>86, 'edition'=>2 ]
    //    ]

    ////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////
    // Collection of StdClass Objects
    $data = [];
    $data[0] = ((object)[ 'volume'=>67, 'edition'=>2 ]);
    $data[1] = ((object)[ 'volume'=>86, 'edition'=>2 ]);
    $data[2] = ((object)[ 'volume'=>85, 'edition'=>6 ]);
    $data[3] = ((object)[ 'volume'=>86, 'edition'=>1 ]);

    $collection = \VersatileCollections\GenericCollection::makeNew($data);
    $sort_param = new \VersatileCollections\MultiSortParameters('volume', SORT_ASC, SORT_NUMERIC);
    $sort_param2 = new \VersatileCollections\MultiSortParameters('edition', SORT_DESC, SORT_NUMERIC);
    
    // sort by volume asc, edition desc
    $collection->sortMeByMultipleFields($sort_param, $sort_param2);
    $collection->toArray();
    //    [
    //        0 => stdClass::__set_state([ 'volume'=>67, 'edition'=>2 ]),
    //        2 => stdClass::__set_state([ 'volume'=>85, 'edition'=>6 ]),
    //        1 => stdClass::__set_state([ 'volume'=>86, 'edition'=>2 ]),
    //        3 => stdClass::__set_state([ 'volume'=>86, 'edition'=>1 ])
    //    ]
    
    $sort_param2->setSortDirection(SORT_ASC);
    
    // sort by volume asc, edition asc
    $collection->sortMeByMultipleFields($sort_param, $sort_param2);
    $collection->toArray();
    //    [
    //        0 => stdClass::__set_state(['volume'=>67, 'edition'=>2 ]),
    //        2 => stdClass::__set_state(['volume'=>85, 'edition'=>6 ]),
    //        3 => stdClass::__set_state(['volume'=>86, 'edition'=>1 ]),
    //        1 => stdClass::__set_state(['volume'=>86, 'edition'=>2 ])
    //    ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-sortMeDesc"></div>

### sortMeDesc(callable $callable=null, \VersatileCollections\SortType $type=null): \VersatileCollections\CollectionInterface
Sort the collection's items in descending order while maintaining key association.<br>
The original collection itself is modified and returned.

* **$callable**: a callback with the following signature **function(mixed $a, mixed $b):int**. 
The callback function must return an INTEGER less than, equal to, or greater than zero if the 
second argument is considered to be respectively less than, equal to, or greater than the first.
If callback is not supplied, the native php sorting function `arsort` is used for the sorting.
* **$type**: an object indicating the sort type. 
See **\VersatileCollections\SortType::$valid_sort_types** for available sort types.

See `sortMe(callable $callable=null, \VersatileCollections\SortType $type=null)` for code samples.

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-sortMeDescByKey"></div>

### sortMeDescByKey(callable $callable=null, \VersatileCollections\SortType $type=null): \VersatileCollections\CollectionInterface
Sort the collection's items by keys in descending order while maintaining key association.<br>
The original collection itself is modified and returned.

* **$callable**: a callback with the following signature **function(mixed $a, mixed $b):int**. 
The callback function must return an INTEGER less than, equal to, or greater than zero if the 
second argument is considered to be respectively less than, equal to, or greater than the first.
If callback is not supplied, the native php sorting function `krsort` is used for the sorting.
* **$type**: an object indicating the sort type. 
See **\VersatileCollections\SortType::$valid_sort_types** for available sort types.

See `sortMeByKey(callable $callable=null, \VersatileCollections\SortType $type=null)` for code samples.

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-splice"></div>

### splice($offset, $length=null, array $replacement=[]): \VersatileCollections\CollectionInterface
Remove a portion of the collection and optionally replace with items in $replacement.<br>
This method modifies the original collection.

* **$offset**: If offset is positive then the start of removed portion is at that 
offset from the beginning of the collection. If offset is negative then it starts 
that far from the end of the collection.
* **$length**: If length is omitted, removes everything from offset to the end of 
the collection. If length is specified & is positive, then that many elements will 
be removed. If length is specified and is negative then the end of the removed 
portion will be that many elements from the end of the collection. If length is 
specified and is zero, no elements will be removed. Tip: to remove everything 
from offset to the end of the collection when replacement is also specified, 
use $this->count() for length.

* **$replacement**: If replacement array is specified, then the removed items are 
replaced with items from this array. If offset and length are such that nothing is 
removed, then the items from the replacement array are inserted in the place 
specified by the offset. Note that keys in replacement array are not preserved.

```php
<?php

    $data = \VersatileCollections\GenericCollection::makeNew(['foo', 'baz']);
    $cut = $data->splice(1);
    $data->toArray(); // === [ 0=>'foo' ]
    $cut->toArray(); // === [ 0=>'baz' ]

    $data = \VersatileCollections\GenericCollection::makeNew(['foo', 'baz']);
    $cut = $data->splice(1, 0, ['bar']);
    $data->toArray(); // === [ 0=>'foo', 1=>'bar', 2=>'baz']
    $cut->toArray(); // === [ ]

    $data = \VersatileCollections\GenericCollection::makeNew(['foo', 'baz']);
    $cut = $data->splice(1, 1);
    $data->toArray(); // === [ 0=>'foo']
    $cut->toArray(); // === [ 0=>'baz']

    $data = \VersatileCollections\GenericCollection::makeNew(['foo', 'baz']);
    $cut = $data->splice(1, 1, ['bar']);
    $data->toArray(); // === [ 0=>'foo', 1=>'bar' ]
    $cut->toArray(); // === [ 0=>'baz']
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-split"></div>

### split($numberOfGroups): \VersatileCollections\CollectionInterface
Split a collection into a certain number of groups.

* **$numberOfGroups**: number of groups the collection will be split into.

```php
<?php

    $collection = \VersatileCollections\GenericCollection::makeNew(
        [ 1, 2, 3, 4, 5, 6, 7 ]
    );
    var_export($collection->split(0)->toArray()); // === []

    $_1_group_with_7_items = $collection->split(1);
    var_export($_1_group_with_7_items->toArray());
    //    array (
    //      0 => VersatileCollections\GenericCollection::__set_state(array(
    //         'versatile_collections_items' =>
    //        array (
    //          0 => 1,
    //          1 => 2,
    //          2 => 3,
    //          3 => 4,
    //          4 => 5,
    //          5 => 6,
    //          6 => 7,
    //        ),
    //         'versatile_collections_methods_for_this_instance' =>
    //        array (
    //        ),
    //      )),
    //    )
    
    $_7_groups_with_1_item_each = $collection->split(7);
    var_export($_7_groups_with_1_item_each->toArray()); // ===
    //    array (
    //      0 => VersatileCollections\GenericCollection::__set_state(array(
    //         'versatile_collections_items' =>
    //        array (
    //          0 => 1,
    //        ),
    //         'versatile_collections_methods_for_this_instance' =>
    //        array (
    //        ),
    //      )),
    //      1 => VersatileCollections\GenericCollection::__set_state(array(
    //         'versatile_collections_items' =>
    //        array (
    //          1 => 2,
    //        ),
    //         'versatile_collections_methods_for_this_instance' =>
    //        array (
    //        ),
    //      )),
    //      2 => VersatileCollections\GenericCollection::__set_state(array(
    //         'versatile_collections_items' =>
    //        array (
    //          2 => 3,
    //        ),
    //         'versatile_collections_methods_for_this_instance' =>
    //        array (
    //        ),
    //      )),
    //      3 => VersatileCollections\GenericCollection::__set_state(array(
    //         'versatile_collections_items' =>
    //        array (
    //          3 => 4,
    //        ),
    //         'versatile_collections_methods_for_this_instance' =>
    //        array (
    //        ),
    //      )),
    //      4 => VersatileCollections\GenericCollection::__set_state(array(
    //         'versatile_collections_items' =>
    //        array (
    //          4 => 5,
    //        ),
    //         'versatile_collections_methods_for_this_instance' =>
    //        array (
    //        ),
    //      )),
    //      5 => VersatileCollections\GenericCollection::__set_state(array(
    //         'versatile_collections_items' =>
    //        array (
    //          5 => 6,
    //        ),
    //         'versatile_collections_methods_for_this_instance' =>
    //        array (
    //        ),
    //      )),
    //      6 => VersatileCollections\GenericCollection::__set_state(array(
    //         'versatile_collections_items' =>
    //        array (
    //          6 => 7,
    //        ),
    //         'versatile_collections_methods_for_this_instance' =>
    //        array (
    //        ),
    //      )),
    //    )

    $_4_groups_with_at_most_2_items_each = $collection->split(4);
    var_export($_4_groups_with_at_most_2_items_each->toArray());
    //    array (
    //      0 => VersatileCollections\GenericCollection::__set_state(array(
    //         'versatile_collections_items' =>
    //        array (
    //          0 => 1,
    //          1 => 2,
    //        ),
    //         'versatile_collections_methods_for_this_instance' =>
    //        array (
    //        ),
    //      )),
    //      1 => VersatileCollections\GenericCollection::__set_state(array(
    //         'versatile_collections_items' =>
    //        array (
    //          2 => 3,
    //          3 => 4,
    //        ),
    //         'versatile_collections_methods_for_this_instance' =>
    //        array (
    //        ),
    //      )),
    //      2 => VersatileCollections\GenericCollection::__set_state(array(
    //         'versatile_collections_items' =>
    //        array (
    //          4 => 5,
    //          5 => 6,
    //        ),
    //         'versatile_collections_methods_for_this_instance' =>
    //        array (
    //        ),
    //      )),
    //      3 => VersatileCollections\GenericCollection::__set_state(array(
    //         'versatile_collections_items' =>
    //        array (
    //          6 => 7,
    //        ),
    //         'versatile_collections_methods_for_this_instance' =>
    //        array (
    //        ),
    //      )),
    //    )
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-take"></div>

### take($limit): \VersatileCollections\CollectionInterface
Take the first or last `$limit` items and return them in a new collection. 
The items will not be removed from the original collection.

* **$limit**: If positive, then first `$limit` items will be returned. 
If negative, then last `$limit` items will be returned.
If zero, then empty collection will be returned.

```php
<?php
        
    $data = \VersatileCollections\GenericCollection::makeNew(
        ['taylor', 'dayle', 'shawn']
    );
    $data->take(2)->toArray(); // === [ 0=>'taylor', 1=>'dayle' ]
    $data->take(0)->toArray(); // === []
    $data->take(-2)->toArray(); // === [ 1=>'dayle', 2=>'shawn' ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-tap"></div>

### tap(callable $callback): $this
Execute the given callback on a copy of a collection and then return the original collection.<br>
The original collection is not modified.

* **$callback**: a callback with the following signature: **function(\VersatileCollections\CollectionInterface $collection):void**

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        [1, 2, 3]
    );

    $fromTap = [];
    $collection = $collection->tap(function ($collection) use (&$fromTap) {
        
        $fromTap = $collection->slice(0, 1)->toArray();
        $collection->removeAll(); // empty copy
    });

    $fromTap; // === [1]
    
    // Original collection is not modified even though
    // all items were removed from the copy inside the
    // callback above.
    $collection->toArray(); // === [1, 2, 3]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-toArray"></div>

### toArray(): array
Returns the underlying array containing all items in a collection object.

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        [1, 2, 3]
    );
    $collection->toArray(); // === [1, 2, 3]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-transform"></div>

### transform(callable $transformer, $bind_callback_to_this=true): $this
This method iterates over the collection and calls the given callback with each 
item in the collection. The items in the collection will be replaced by the values 
returned by the callback.<br>
>If you want the values returned by the callback to be returned in a new collection
instead of replacing the items in the original collection, then use 
`map(callable $callback, $preserve_keys=true, $bind_callback_to_this=true): \VersatileCollections\CollectionInterface`.

* **$transformer**: a callback with the following signature: **function($key, $item): mixed**. 
Its return value that will replace each item in the original collection.
* **$bind_callback_to_this**: true if the variable `$this` inside the supplied 
`$callback` should refer to the collection object this method is being invoked on.

```php
<?php
    ////////////////////////////////////////////////////////////////////////////
    $collection_of_ints = 
        \VersatileCollections\GenericCollection::makeNew([2, 4, 6, 8]);

    // transform the collection by replacing each item with a square of itself
    $collection_of_ints->transform(
        function($key, $item) { return $item * $item; }    
    );
    $collection_of_ints->toArray(); // === [4, 16, 36, 64]

    ////////////////////////////////////////////////////////////////////////////
    $collection_of_ints = 
        \VersatileCollections\GenericCollection::makeNew([2, 4, 6, 8]);
    
    // Reference $this in callback
    // Transform the collection by replacing each item with the item multiplied
    // by the number of items in the collection (in this case 4).
    $collection_of_ints->transform(
        function($key, $item) { return $item * $this->count(); },
        true
    );
    $collection_of_ints->toArray(); // === [8, 16, 24, 32]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-unionMeWith"></div>

### unionMeWith(array $items): $this
Union the collection with the given items by trying to append all items from `$items` to 
the collection. For keys that exist in both `$items` and the collection, the items from
the collection will be used and the corresponding item in `$items` will be ignored.<br>
This method modifies the original collection.

> Use `mergeWith()` or `mergeMeWith()` if you want items from `$items` to be used
when same keys exist in both `$items` and the collection.

* **$items**: items to union with the collection

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        [ 1=>['a'], 2=>['b'] ]
    );
    $collection->unionMeWith([ 3=>['c'], 1=>['b'] ]);
    $collection->toArray(); // === [ 1=>['a'], 2=>['b'], 3=>['c'] ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-unionWith"></div>

### unionWith(array $items): \VersatileCollections\CollectionInterface
Union the collection with the given items by trying to append all items from 
`$items` to the collection and return the result in a new collection.
For keys that exist in both `$items` and the collection, the items from
the collection will be used and the corresponding item in `$items` will be ignored.<br>
This method does not modify the original collection.

> Use `mergeWith()` or `mergeMeWith()` if you want items from `$items` to be used
when same keys exist in both `$items` and the collection.

* **$items**: items to union with the collection

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        [ 1=>['a'], 2=>['b'] ]
    );
    $union = $collection->unionWith([ 3=>['c'], 1=>['b'] ]);
    $union->toArray(); // === [ 1=>['a'], 2=>['b'], 3=>['c'] ]
    $collection->toArray(); // === [ 1=>['a'], 2=>['b'] ]
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-unique"></div>

### unique(): \VersatileCollections\CollectionInterface
Get a new collection of unique items from an existing collection. The keys are not 
preserved in the returned collection. The uniqueness test is done via strict comparison (===). 

>Non-strict comparison is unsafe for collections containing objects, for 
example you can't cast an object to a double or int. To get unique items 
using non-strict comparison see `\VersatileCollections\ScalarsCollection::uniqueNonStrict()`.

```php
<?php
    $object = new ArrayObject();
    $object2 = new ArrayObject();

    $collection = \VersatileCollections\GenericCollection::makeNew();
    $collection->item1 = "4";
    $collection->item2 = 5.0;
    $collection->item3 = 7;
    $collection->item4 = true;
    $collection->item5 = false;
    $collection->item12 = "4";
    $collection->item22 = 5.0;
    $collection->item32 = 7;
    $collection->item42 = true;
    $collection->item52 = false;
    $collection->item123 = 4;
    $collection->item223 = '5.0';
    $collection->item323 = '7';
    $collection->item423 = 'true';
    $collection->item523 = 'false';
    $collection->item623 = $object;
    $collection->item723 = $object2;
    $collection->item823 = $object;
    $collection->item923 = $object2;

    \VersatileCollections\GenericCollection::makeNew()->unique()->toArray(); // === [];
    $collection->unique()->toArray(); 
        // === ['4', 5.0, 7, true, false, 4, '5.0', '7','true', 'false', $object, $object2];
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-whenFalse"></div>

### whenFalse( $falsy_value, callable $callback, callable $default=null): mixed
Execute `$callback` on the collection and return its return value if the first argument
(`$falsy_value`) is falsy or if the first argument is truthy and `$default` is not null 
execute the `$default` callback on the collection and return its return value or 
return NULL as a last resort.

* **$falsy_value**: a value or expression that is evaluated to a boolean
* **$callback**: a callback with the following signature:
**function(\VersatileCollections\CollectionInterface $collection):mixed**.
It will be invoked on the collection object from which this method is being 
called if `$falsy_value` is falsy.
* **$default**: a callback with the following signature
**function(\VersatileCollections\CollectionInterface $collection): mixed**. 
It will be invoked on the collection object from which this method is being 
called if `$falsy_value` is not falsy. If `$default` is null and `$falsy_value` 
is not falsy, NULL will be returned by this method.

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        ['michael', 'tom']
    );

    // Add `adam` to the collection if first argument is falsy 
    $collection->whenFalse(false, function ($collection) {
        
        return $collection->push('adam');
    });
    $collection->toArray(); // === ['michael', 'tom', 'adam']

    // Test return null
    $result = $collection->whenFalse(true, function ($collection) {
        
        return $collection->push('adam');
    }); // $result === null
    $collection->toArray(); // === ['michael', 'tom', 'adam']

    // Default callback gets executed when first argument is not falsy
    // and the third argument is not null
    $collection->whenFalse(
        true, 
        function ($collection) {

            return $collection->push('adam');
        }, 
        function ($collection) {

            return $collection->push('taylor');
        }
    );
    $collection->toArray(); // === ['michael', 'tom', 'adam', 'taylor']
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-whenTrue"></div>

### whenTrue( $truthy_value, callable $callback, callable $default=null): mixed
Execute `$callback` on the collection and return its return value if the first argument
(`$truthy_value`) is truthy or if the first argument is falsy and `$default` is not null 
execute the `$default` callback on the collection and return its return value 
or return NULL as a last resort.

* **$falsy_value**: a value or expression that is evaluated to a boolean
* **$callback**: a callback with the following signature:
**function(\VersatileCollections\CollectionInterface $collection):mixed**.
It will be invoked on the collection object from which this method is being 
called if `$truthy_value` is truthy.
* **$default**: a callback with the following signature
**function(\VersatileCollections\CollectionInterface $collection): mixed**. 
It will be invoked on the collection object from which this method is being 
called if `$truthy_value` is not truthy. If `$default` is null and `$truthy_value` 
is not truthy, NULL will be returned by this method.

```php
<?php

    $collection = \VersatileCollections\GenericCollection::makeNew(
        ['michael', 'tom']
    );

    // Add `adam` to the collection if first argument is truthy 
    $collection->whenTrue(true, function ($collection) {
        
        return $collection->push('adam');
    });
    $collection->toArray(); // === ['michael', 'tom', 'adam']

    // Test return null
    $result = $collection->whenTrue(false, function ($collection) {
        
        return $collection->push('adam');
    });// $result === null
    $collection->toArray(); // === ['michael', 'tom', 'adam']

    // Default callback gets executed when first argument is not truthy
    // and the third argument is not null
    $collection->whenTrue(
        false, 
        function ($collection) {

            return $collection->push('adam');
        }, 
        function ($collection) {

            return $collection->push('taylor');
        }
    );
    $collection->toArray(); // === ['michael', 'tom', 'adam', 'taylor']
```

------------------------------------------------------------------------------------------------
<div id="CollectionInterface-yieldCollectionsOfSizeN"></div>

### yieldCollectionsOfSizeN($max_size_of_each_collection=1): \Generator
Returns a generator that yields collections each having a maximum of 
`$max_size_of_each_collection` items. Original keys are preserved in 
each returned collection.

* **$max_size_of_each_collection**: maximum number of items in each collection 
that will be yielded by the generator returned by this method. If its value is 
greater than the total number of items in the collection or if its value is less 
than zero or if it has a non-numeric value it will be set to a value of 1. If it 
has a float value, it will be automatically cast into an integer.

```php
<?php
    $collection = \VersatileCollections\GenericCollection::makeNew(
        [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
    );

    $sub_collection_generator = $collection->yieldCollectionsOfSizeN(3);

    foreach ( $sub_collection_generator as $sub_collection ) {
        
        var_export($sub_collection->toArray());
    }
    
    // Will generate the output below:
    //    [ 0=>1,    1=>2,  2=>3   ]
    //    [ 3=>4,    4=>5,  5=>6   ]
    //    [ 6=>7,    7=>8,  8=>9   ]
    //    [ 9=>10,  10=>11, 11=>12 ]
    //    [ 12=>13, 13=>14         ]
```

------------------------------------------------------------------------------------------------
<div id="Non-CollectionInterface-Methods-common-to-all-Collection-Classes-using-CollectionInterfaceImplementationTrait"></div>

## Non-`CollectionInterface` Methods common to all Collection Classes using `CollectionInterfaceImplementationTrait`

------------------------------------------------------------------------------------------------
<div id="CollectionInterfaceImplementationTrait-addMethod"></div>

### addMethod($name, callable $callable, $has_return_val=false, $bind_to_this=true): $this
Register a callback (with the name `$name`) to a single instance of the collection 
class that can later be called on the object. 

> Methods registered to a single instance 
of the collection class having the same name as a method added for all instances 
(via `addMethodForAllInstances()`) will override the method implementation for 
all instances.

* **$name**: name of the method being added / registered
* **$callable**: method being added
* **$has_return_val**: true means that return value from `$callable` will be returned when the method is called, else false for no value to be returned from `$callback`
* **$bind_to_this**: true means `$callable` will be bound to the collection object

```php
<?php
    $collection_obj = \VersatileCollections\GenericCollection::makeNew();

    $method_name = 'getCount'; // name of the method you are adding / registering
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

------------------------------------------------------------------------------------------------
<div id="CollectionInterfaceImplementationTrait-addMethodForAllInstances"></div>

### static addMethodForAllInstances($name, callable $callable, $has_return_val=false, $bind_to_this_on_invocation=true): $this
Register a callback (with the name `$name`) to all instances of a collection 
class and all its sub-classes that can later be called on any of those instances. 

> Methods registered to a single instance 
of the collection class having the same name as a method added for all instances 
(via `addMethodForAllInstances()`) will override the method implementation for 
all instances.

* **$name**: name of the method being added / registered
* **$callable**: method being added
* **$has_return_val**: true means that return value from `$callable` will be returned when the method is called, else false for no value to be returned from `$callback`
* **$bind_to_this_on_invocation**: true means `$callable` will be bound to each collection object instance when the method is invoked on each instance

```php
<?php
    $collection_obj = \VersatileCollections\GenericCollection::makeNew();

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

    $parent_collection_object = \VersatileCollections\ScalarsCollection::makeNew([1, 2]);
    
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

    $child_collection_object = \VersatileCollections\StringsCollection::makeNew(['1', '2', '3']);
        
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

------------------------------------------------------------------------------------------------
<div id="CollectionInterfaceImplementationTrait-addStaticMethod"></div>

### static addStaticMethod($name, callable $callable, $has_return_val=false): $this
Register a callback (with the name `$name`) to a collection class and all its sub-classes 
that can later be statically called on any of those classes. 

> Methods registered to a single instance 
of the collection class having the same name as a method added for all instances 
(via `addMethodForAllInstances()`) will override the method implementation for 
all instances.

* **$name**: name of the method being added / registered
* **$callable**: method being added
* **$has_return_val**: true means that return value from `$callable` will be returned when the method is called, else false for no value to be returned from `$callback`

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

------------------------------------------------------------------------------------------------
<div id="CollectionInterfaceImplementationTrait-__call"></div>

### __call($name, $arguments): mixed
Responds to method calls for methods registered via `addMethod()` & 
`addMethodForAllInstances()`.<br> 
You should not have to directly call this method, since it's automatically called
by php whenever you call methods registered via `addMethod()` & `addMethodForAllInstances()`.

* **$name**: name of the method being called
* **$arguments**: optional array of arguments the method is being called with

------------------------------------------------------------------------------------------------
<div id="CollectionInterfaceImplementationTrait-__callStatic"></div>

### static __callStatic($name, $arguments): mixed
Responds to method calls for methods registered via `addStaticMethod()`.<br> 
You should not have to directly call this method, since it's automatically called
by php whenever you call methods registered via `addStaticMethod()`.

* **$name**: name of the method being called
* **$arguments**: optional array of arguments the method is being called with

------------------------------------------------------------------------------------------------
<div id="CollectionInterfaceImplementationTrait-__construct"></div>

### __construct(...$items)
Constructor for collection objects.<br>
Classes that implement `\VersatileCollections\CollectionInterface` do not necessarily
have to implement their constructor using this signature, but it is a strongly 
recommended signature especially for strictly-typed collections.
>IT IS STRONGLY RECOMENDED THAT YOU USE THE static `makeNew()` method to create 
new collection objects.

* **...$items**: one or more items to be added to a new collection or an array of items to be
added to a collection via argument unpacking

------------------------------------------------------------------------------------------------
<div id="Methods-specific-to-various-Strictly-Typed-Collection-classes"></div>

## Methods specific to various Strictly-Typed Collection classes

* [NumericsCollection](#VersatileCollections-NumericsCollection)
* [ObjectsCollection](#VersatileCollections-ObjectsCollection)
* [ScalarsCollection](#VersatileCollections-ScalarsCollection)

------------------------------------------------------------------------------------------------
<div id="VersatileCollections-NumericsCollection"></div>

NumericsCollection:
------------------------------------------------------------------------------------------------
<div id="NumericsCollection-average"></div>

### average(): mixed
Returns the average of all of the values(a.k.a items) in the collection or null if collection is empty.

```php
<?php
    $collection = \VersatileCollections\NumericsCollection::makeNew(
        [1.0, 2.0, 3, 4, 5, 6]
    );

    var_dump($collection->average()); // === 3.5
```

------------------------------------------------------------------------------------------------
<div id="NumericsCollection-max"></div>

### max(): mixed
Returns the maximum of all of the values(a.k.a items) in the collection or null if collection is empty.

```php
<?php
    $collection = \VersatileCollections\NumericsCollection::makeNew(
        [1.0, 2.0, 3, 4, 5, 6]
    );

    var_dump($collection->max()); // === 6
```

------------------------------------------------------------------------------------------------
<div id="NumericsCollection-median"></div>

### median(): mixed
Returns the median of all of the values(a.k.a items) in the collection or null if collection is empty.

```php
<?php
    $collection = \VersatileCollections\NumericsCollection::makeNew(
        [4.0, 5.0, 7, 8, 9, 10]
    );

    $collection2 = \VersatileCollections\NumericsCollection::makeNew(
        [20, 3, 5.0, 7, 8, 9, 10.5]
    );

    // 6 items, average of the sum of the items at index 2 and 
    // index 3 is the median value when items in collection are
    //sorted in ascending numeric order
    var_dump($collection->median()); // === 7.5

    // 7 items, item at index 3 is the median value when
    // items in collection are sorted in ascending numeric order
    var_dump($collection2->median()); // === 8
```

------------------------------------------------------------------------------------------------
<div id="NumericsCollection-min"></div>

### min(): mixed
Returns the minimum of all of the values(a.k.a items) in the collection or null if collection is empty.

```php
<?php
    $collection = \VersatileCollections\NumericsCollection::makeNew(
        [1.0, 2.0, 3, 4, 5, 6]
    );

    var_dump($collection->min()); // === 1.0
```

------------------------------------------------------------------------------------------------
<div id="NumericsCollection-mode"></div>

### mode(): mixed
Returns an array of modal values(a.k.a items) in the collection or null if collection is empty.

```php
<?php
    // each item occurs once
    $collection = \VersatileCollections\NumericsCollection::makeNew(
        [10.5, 9, 8, 7, 5.0, 3]
    );
    var_dump($collection->mode()); // === [10.5, 9, 8, 7, 5, 3]

    // 10.5 and 3 each occur twice and have the highest occurence rate
    $collection2 = \VersatileCollections\NumericsCollection::makeNew(
        [10.5, 9, 8, 7, 5.0, 3, 10.5, 3]
    );
    var_dump($collection2->mode()); // === [10.5, 3]
```

------------------------------------------------------------------------------------------------
<div id="NumericsCollection-product"></div>

### product(): int|float
Returns the product of all of the values(a.k.a items) in the collection or one if collection is empty.

```php
<?php
    $collection = \VersatileCollections\NumericsCollection::makeNew(
        [100, 2.5]
    );
    var_dump($collection->product()); // === 250.0

    $collection2 = \VersatileCollections\NumericsCollection::makeNew(
        [3.5, 2.5]
    );
    var_dump($collection2->product()); // === 8.75

    $collection3 = \VersatileCollections\NumericsCollection::makeNew(
        [3, 2]
    );
    var_dump($collection3->product()); // === 6

    $collection4 = \VersatileCollections\NumericsCollection::makeNew(
        []
    );
    var_dump($collection4->product()); // === 1
```

------------------------------------------------------------------------------------------------
<div id="NumericsCollection-sum"></div>

### sum(): int|float
Returns the sum of all of the values(a.k.a items) in the collection or zero if collection is empty.

```php
<?php
    $collection = \VersatileCollections\NumericsCollection::makeNew(
        [4.0, 5.0, 7, 8, 9, 10]
    );
    var_dump($collection->sum()); // === 43.0

    $collection2 = \VersatileCollections\NumericsCollection::makeNew(
        [4.0, 5.0, 7, 8, 9, 10.5]
    );
    var_dump($collection2->sum()); // === 43.5

    $collection3 = \VersatileCollections\NumericsCollection::makeNew(
        []
    );
    var_dump($collection3->sum()); // === 0
```

------------------------------------------------------------------------------------------------
<div id="VersatileCollections-ObjectsCollection"></div>

ObjectsCollection:
------------------------------------------------------------------------------------------------
<div id="ObjectsCollection-__call"></div>

### __call($method_name, $arguments): mixed
Tries to call the specified method with the specified arguments and return its return value if 
it was registered via either `addMethod` or `addMethodForAllInstances` or tries to call the 
specified method with the specified arguments on each item in the collection and returns an 
array of return values keyed by each item's key in the collection. An exception of type 
**\VersatileCollections\Exceptions\InvalidCollectionOperationException** is thrown 
if the method could not be called. 
> You should not have to directly call this method, since it's automatically called by php.

```php
<?php
    class TestValueObject {
        protected $name;
        protected $age;

        public function __construct($name='', $age='') {
            $this->age = $age;
            $this->name = $name;
        }

        public function getName() { return $this->name; }
        public function setName($name) { $this->name = $name; }

        public function getAge() { return $this->age; }
        public function setAge($age) { $this->age = $age; }
    }

    $collection = \VersatileCollections\ObjectsCollection::makeNew();

    // add items to the collection
    $collection->item1 = new TestValueObject('Johnny Cash', 50);
    $collection->item2 = new TestValueObject('Suzzy Something', 23);
    $collection->item3 = new TestValueObject('Jack Bauer', 43);
    $collection->item4 = new TestValueObject('Jane Fonda', 55);

    $ages = $collection->getAge(); // causes php to invoke $collection->__call('getAge', [])
                                   // which under the hood calls getAge() on each object in 
                                   // $collection and stores each return value in an array
                                   // and finally returns that array

    var_dump($ages); // === ['item1' => 50, 'item2' => 23, 'item3' => 43, 'item4' => 55]

    $collection->setAge(99); // causes php to invoke $collection->__call('setAge', [99])
                             // which under the hood calls setAge(99) on each object in 
                             // $collection and stores each return value in an array
                             // and finally returns that array. In this case 
                             // TestValueObject::setAge() does not return any
                             // value, so we don't care about a return value.

    $ages = $collection->getAge(); // we call getAge again to verify that 
                                   // the call to setAge above set the age
                                   // value of each object in the collection to 99

    var_dump($ages); // === ['item1' => 99, 'item2' => 99, 'item3' => 99, 'item4' => 99]

    $collection->addMethod(
        'getAge', 
        function() {

            return 'You just called getAge registered via addMethod';
        }, 
        true
    );

    // The example below demonstrates that methods registered via 
    // addMethod or addMethodForAllInstances on an instance of the
    // ObjectsCollection class will be called even though a method
    // with the same name exists in each object inside the collection,
    // in this case getAge()
    var_dump($collection->getAge()); // === 'You just called getAge registered via addMethod'

    // We add another method whose name does not conflict
    // with any of the methods present in the objects in 
    // the collection.
    $collection->addMethod(
        'toUpper', 
        function() {

            foreach($this as $item) {

                $item->setName( strtoupper($item->getName()) );
            }
        }, 
        true
    );

    $collection->toUpper(); // triggers the execution of the 'toUpper' method registered above
    $names = $collection->getName(); // calls the getName method on each object in the collection
                                     // and returns the names for all the objects in the collection
                                     // in an array. You will notice that the call to toUpper above
                                     // caused each name to be capitalized.
    var_dump($names); 
    // === ['item1'=>'JOHNNY CASH', 'item2'=>'SUZZY SOMETHING', 'item3'=>'JACK BAUER', 'item4'=>'JANE FONDA']

    // Calling a method that does not exist in the collection object or
    // in the objects in the collection and has not been registered via 
    // addMethod or addMethodForAllInstances will cause the 
    // \VersatileCollections\Exceptions\InvalidCollectionOperationException
    // to be thrown.
    //$collection->nonExistentMethod();
```

------------------------------------------------------------------------------------------------
<div id="VersatileCollections-ScalarsCollection"></div>

ScalarsCollection:
------------------------------------------------------------------------------------------------
<div id="ScalarsCollection-uniqueNonStrict"></div>

### uniqueNonStrict(): \VersatileCollections\CollectionInterface
Returns a new collection of unique items from an existing collection. 
This method uses non-strict comparison for testing uniqueness. 
The keys are not preserved in the returned collection.

```php
<?php
    $empty_collection = \VersatileCollections\ScalarsCollection::makeNew();

    $collection = \VersatileCollections\ScalarsCollection::makeNew();
    $collection->item1 = "4";
    $collection->item2 = 5.0;
    $collection->item3 = 7;
    $collection->item4 = true;
    $collection->item5 = false;
    $collection->item12 = "4";
    $collection->item22 = 5.0;
    $collection->item32 = 7;
    $collection->item42 = true;
    $collection->item52 = false;
    $collection->item123 = 4;
    $collection->item223 = '5.0';
    $collection->item323 = '7';
    $collection->item423 = 'true';
    $collection->item523 = 'false';

    var_dump($empty_collection->uniqueNonStrict()->toArray()); // === []
    
    var_dump($collection->uniqueNonStrict()->toArray()); 
                // === ['4', 5.0, 7, false, 'true', 'false']
    
    var_dump($collection->unique()->toArray()); 
                // === ['4', 5.0, 7, true, false, 4, '5.0', '7', 'true', 'false']
```
