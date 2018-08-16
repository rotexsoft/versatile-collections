## Methods common to all Collection Classes implementing `CollectionInterface`
Most of the examples in this section use the **\VersatileCollections\GenericCollection** class, 
but are applicable to all collection classes that have implemented **\VersatileCollections\CollectionInterface**.

### appendCollection(CollectionInterface $other)
Appends all items from $other collection to the end of a collection.<br>
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
    $collection = new \VersatileCollections\GenericCollection(
        $item1, $item2, $item3
    );

    $other_item1 = "114";
    $other_item2 = 35.5;
    $other_item3 = 777;
    $other_collection = new \VersatileCollections\GenericCollection(
        $other_item1, $other_item2, $other_item3
    );

    $collection->appendCollection($other_collection);

    // At this point, $collection now contains:
    // [ 0=>'4', 1=>5.0, 2=>7, 3=>'114', 4=>35.5, 5=>777 ]
```

### appendItem($item)
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
    $collection = new \VersatileCollections\NumericsCollection(
        $item1, $item2, $item3
    );

    $collection->appendItem(777); // integer acceptable
    $collection->appendItem(7.5); // float acceptable
    //$collection->appendItem('7.5'); // string not acceptable

    // At this point, $collection now contains:
    // [ 0=>4, 1=>5.0, 2=>7, 3=>777, 4=>7.5 ]
```

### column($column_key, $index_key=null)
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
    $collection = new \VersatileCollections\GenericCollection(...$data);

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
    $collection = new \VersatileCollections\GenericCollection(...$data);

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

### containsItem($item)
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

    $collection = new \VersatileCollections\GenericCollection(
        $item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8
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

### containsItemWithKey($key, $item)
Check if a collection contains a specified item with the specified key using strict comparison for the item.

```php
<?php 
    $item1 = "4";
    $item2 = 5.0;
    $item3 = 7;

    $collection = 
        new \VersatileCollections\GenericCollection($item1, $item2, $item3);

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

### containsItems(array $items)
Check if all the specified items exist in a collection. Strict comparison is used for checking each item.

```php
<?php 
    $item1 = "4";
    $item2 = 5.0;
    $item3 = 7;
    $item4 = ['name'=>'Joe', 'age'=>'10',];
    $item5 = ['name'=>'Jane', 'age'=>'20',];

    $collection = 
        new \VersatileCollections\GenericCollection($item1, $item2, $item3);

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

### containsKey($key)
Check if a key exists in a collection.

```php
<?php 

    $item1 = "4";
    $item2 = 5.0;
    $item3 = 7;

    $collection = 
        new \VersatileCollections\GenericCollection($item1, $item2, $item3);

    $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
    $collection->item2 = ['name'=>'Jane', 'age'=>'20',];

    $collection->containsKey(0); // true
    $collection->containsKey('0'); // true
    $collection->containsKey(1); // true
    $collection->containsKey(2); // true
    $collection->containsKey('item1'); // true
    $collection->containsKey('item2'); // true
    $collection->containsKey('not in collection'); // false
    $collection->containsKey([]); // false
```

## Non-`CollectionInterface` Methods common to all Collection Classes using `CollectionInterfaceImplementationTrait`



## Methods specific to various Strictly-Typed Collection classes