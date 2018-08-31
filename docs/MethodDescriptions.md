## Methods common to all Collection Classes implementing **CollectionInterface**
Most of the examples in this section use the **\VersatileCollections\GenericCollection** class, 
but are applicable to all collection classes that have implemented **\VersatileCollections\CollectionInterface**.

### appendCollection(CollectionInterface $other)
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
                                   // (0 & '0' are the same 
                                   // as far as keys are concerned)
    $collection->containsKey(1); // true
    $collection->containsKey(2); // true
    $collection->containsKey('item1'); // true
    $collection->containsKey('item2'); // true
    $collection->containsKey('not in collection'); // false
    $collection->containsKey([]); // false
```

### containsKeys(array $keys)
Check if all the specified keys exist in a collection.

```php
<?php 
    $item1 = "4";
    $item2 = 5.0;
    $item3 = 7;

    $collection = 
        new \VersatileCollections\GenericCollection($item1, $item2, $item3);

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

### count()
Returns the number of items in collection.

```php
<?php
    $collection = 
        new \VersatileCollections\GenericCollection("4", 5.0, 7);
    $collection->count(); // === 3

    $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
    $collection->count(); // === 4

    $collection->item2 = ['name'=>'Jane', 'age'=>'20',];
    $collection->count(); // === 5
```

### each(callable $callback, $termination_value=false, $bind_callback_to_this=true)
Iterate through a collection and execute a callback over each item during the iteration.<br>
* **$callback**: a callback with the following signature **function($key, $item)**. 
To stop iteration at any point, the callback should return the value specified via **$termination_value**.
* **$termination_value**: a value that should be returned by **$callback** signifying that iteration through a collection should stop.
* **$bind_callback_to_this**: `true` if the variable **$this** inside the supplied **$callback** should refer to the collection object 
this method is being invoked on, else `false` if you don't want the supplied **$callback** to be bound to the collection object this 
method is being invoked on.

```php
<?php

    $collection = new \VersatileCollections\GenericCollection(
        1, 2, 3, 4, 5, 6
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

### everyNth($n, $position_of_first_nth_item = 0)
Create a new collection consisting of every n-th element.
* **$n**: the number representing n. 
* **$position_of_first_nth_item**: position in the collection to start counting for the nth elements.
`0` represents the position of the first item in the collection.
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

### filterAll(callable $filterer, $copy_keys=false, $bind_callback_to_this=true, $remove_filtered_items=false)
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
        new \VersatileCollections\GenericCollection(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
    
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

### filterFirstN(callable $filterer, $max_number_of_filtered_items=null, $copy_keys=false, $bind_callback_to_this=true, $remove_filtered_items=false)
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
        new \VersatileCollections\GenericCollection(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
    
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

### firstItem()
Retrieves and returns the first item in a collection. See `lastItem()` if you want to get the last item.

```php
<?php
    $collection = new \VersatileCollections\GenericCollection(
        'One', 'Two', 'Three', 'Four'
    );
    $collection->firstItem(); // === 'One'
```

### getAllWhereKeysIn(array $keys)
Return a collection of items whose keys are present in `$keys`. 
Keys are preserved in the new collection.<br>
If the keys in `$keys` do not exist in the collection, an empty collection object is returned.

```php
<?php

    $collection = new \VersatileCollections\GenericCollection();
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

### getAllWhereKeysNotIn(array $keys)
Return a collection of items whose keys are not present in `$keys`. 
Keys are preserved in the new collection.<br>
If all the keys in the collection are also in `$keys`, an empty collection object is returned.

```php
<?php

    $collection = new \VersatileCollections\GenericCollection();
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

### getAndRemoveFirstItem()
Get and remove the first item from the collection. NULL is returned if the collection is empty.

```php
<?php
        
    $collection = new \VersatileCollections\GenericCollection(
        'a', 'b', 'c', 'd'
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

### getAndRemoveLastItem()
Get and remove the last item from the collection. NULL is returned if the collection is empty.

```php
<?php
        
    $collection = new \VersatileCollections\GenericCollection(
        'a', 'b', 'c', 'd'
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

### getAsNewType($new_collection_class=\VersatileCollections\GenericCollection::class)
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

### getCollectionsOfSizeN($max_size_of_each_collection=1)
Break-up a collection into a new collection (**GenericCollection**) of sub-collections (each having a maximum size of **N**). 
Each sub-collection will be of the same type as the collection object this method is being called on. 
The collection object this method is being called on is not modified.<br>
You can also use **yieldCollectionsOfSizeN($max_size_of_each_collection=1)** which returns a 
Generator (instead of a new collection) that yields each sub-collection.

```php
<?php

    $collection = new \VersatileCollections\IntsCollection(1,2,3,4,5,6,7);

    // Get a collection of sub-collections each containing at most 2 items
    $collection->getCollectionsOfSizeN(2); // returns a collection containing
                                           // [ 
                                           //   [0=>1, 1=>2], // sub-collection of type IntsCollection
                                           //   [2=>3, 3=>4], // sub-collection of type IntsCollection
                                           //   [4=>5, 5=>6], // sub-collection of type IntsCollection
                                           //   [6=>7]        // sub-collection of type IntsCollection
                                           // ] // GenericCollection
```

### getIfExists($key, $default_value=null)
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

### getIterator()
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

    $collection = new \VersatileCollections\IntsCollection(1,2,3,4,5,6,7);

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

### getKeys()
Get a collection (**GenericCollection**) of keys to a collection.

```php
<?php

    $collection = \VersatileCollections\GenericCollection::makeNew(
       ['first_key'=>'first item', 'second_key'=>'second item']
    );

    $collection->getKeys(); // a collection containing  [ 0=>'first_key', 1=>'second_key']
```

### getValues()
Get a new collection (of the same type as the original collection) of items in a collection without the corresponding keys in the original collection.
Items in the new collection will have sequentially increasing numeric keys starting from 0.

```php
<?php

    $collection = \VersatileCollections\GenericCollection::makeNew(
       ['first_key'=>'first item', 'second_key'=>'second item']
    );

    $collection->getValues(); // a collection containing [ 0=>'first item', 1=>'second item' ]
```

### isEmpty()
Return true if there are one or more items in the collection or false otherwise.

```php
<?php

    $collection = new \VersatileCollections\GenericCollection();
    $collection->isEmpty(); // === true

    $collection = \VersatileCollections\GenericCollection::makeNew(
       ['first_key'=>'first item', 'second_key'=>'second item']
    );
    $collection->isEmpty(); // === false
```

### lastItem()
Retrieves and returns the last item in a collection. See `firstItem()` if you want to get the first item.

```php
<?php
    $collection = new \VersatileCollections\GenericCollection(
        'One', 'Two', 'Three', 'Four'
    );
    $collection->lastItem(); // === 'Four'
```

### makeAllKeysNumeric($starting_key=0)
Convert all keys in the collection to consecutive integer keys starting from `$starting_key`.
* **$starting_key**: a positive integer value that will be the value of the first key.
A negative integer value will be converted to zero.

```php
<?php

    $collection = new \VersatileCollections\GenericCollection();
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
    $collection = new \VersatileCollections\GenericCollection();
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

### static makeNew(array $items=[], $preserve_keys=true)
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



## Non-`CollectionInterface` Methods common to all Collection Classes using `CollectionInterfaceImplementationTrait`

__call [public]<br>
__callStatic [public] [static]<br>
__construct [public]<br>
addMethod [public]<br>
addMethodForAllInstances [public] [static]<br>
addStaticMethod [public] [static]<br>
<br>
**Protected methods you shouldn't need to directly call:**<br>
getKeyForDynamicMethod [protected] [static]<br>
performMultiSort [protected]<br>
performSort [protected]<br>
validateMethodName [protected] [static]<br>


## Methods specific to various Strictly-Typed Collection classes