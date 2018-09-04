## Methods common to all Collection Classes implementing **CollectionInterface**
Most of the examples in this section use the **\VersatileCollections\GenericCollection** class, 
but are applicable to all collection classes that have implemented **\VersatileCollections\CollectionInterface**.

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
    $collection = new \VersatileCollections\NumericsCollection(
        $item1, $item2, $item3
    );

    $collection->appendItem(777); // integer acceptable
    $collection->appendItem(7.5); // float acceptable
    //$collection->appendItem('7.5'); // string not acceptable

    // At this point, $collection now contains:
    // [ 0=>4, 1=>5.0, 2=>7, 3=>777, 4=>7.5 ]
```

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

### containsItemWithKey($key, $item): bool
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

### containsKey($key): bool
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

### containsKeys(array $keys): bool
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

### count(): int
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

### everyNth($n, $position_of_first_nth_item = 0): \VersatileCollections\CollectionInterface
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

### firstItem(): mixed
Retrieves and returns the first item in a collection. See `lastItem()` if you want to get the last item.

```php
<?php
    $collection = new \VersatileCollections\GenericCollection(
        'One', 'Two', 'Three', 'Four'
    );
    $collection->firstItem(); // === 'One'
```

### getAllWhereKeysIn(array $keys): \VersatileCollections\CollectionInterface
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

### getAllWhereKeysNotIn(array $keys): \VersatileCollections\CollectionInterface
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

### getAndRemoveFirstItem(): mixed
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

### getAndRemoveLastItem(): mixed
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

### getCollectionsOfSizeN($max_size_of_each_collection=1): \VersatileCollections\CollectionInterface
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

### getKeys(): \VersatileCollections\GenericCollection
Get a collection (**GenericCollection**) of keys to a collection.

```php
<?php

    $collection = \VersatileCollections\GenericCollection::makeNew(
       ['first_key'=>'first item', 'second_key'=>'second item']
    );

    $collection->getKeys(); // a collection containing  [ 0=>'first_key', 1=>'second_key']
```

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

### isEmpty(): bool
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

### lastItem(): mixed
Retrieves and returns the last item in a collection. See `firstItem()` if you want to get the first item.

```php
<?php
    $collection = new \VersatileCollections\GenericCollection(
        'One', 'Two', 'Three', 'Four'
    );
    $collection->lastItem(); // === 'Four'
```

### makeAllKeysNumeric($starting_key=0): $this
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

### map(callable $callback, $preserve_keys=true, $bind_callback_to_this=true): \VersatileCollections\CollectionInterface
Applies the callback to the items in the collection and returns a new 
collection containing all the items in the original collection after
applying the callback function to each one.

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
        new \VersatileCollections\IntsCollection(1, 2, 3, 4, 5);

    $multiplied = $int_collection->map(
        function ($key, $item) {
            return $item * 2;
        },
        false,
        false
    );
    $multiplied->toArray(); // === [2, 4, 6, 8, 10]

    $multiplied = $int_collection->map(
        function ($key, $item) {
            return $item * $this->count();
        },
        false,
        true
    );
    $multiplied->toArray(); // === [5, 10, 15, 20, 25])

    // preserved keys
    $int_collection = new \VersatileCollections\IntsCollection();
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

### mergeMeWith(array $items): $this
Adds all items from `$items` to the collection object this method is being called on.
Items in `$items` with existing keys in the original collection will overwrite 
the existing items in the original collection.<br>
Use `unionWith()` and `unionMeWith()` if you want items from the original collection
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

### mergeWith(array $items): \VersatileCollections\CollectionInterface
Works exactly like `mergeMeWith(array $items)`, except that the original
collection is not modified, but instead the merged items are returned in
a new collection.<br>
Use `unionWith()` and `unionMeWith()` if you want items from the original collection
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

### offsetExists($key): bool
Returns true if the specified key exists in a collection or false if not.<br>
You shouldn't need to call this method since it is automatically used by the
ArrayAccess API.

### offsetGet($key): mixed
Returns the item associated with the specified key if the key exists in the collection.<br>
You shouldn't need to call this method since it is automatically used by the
ArrayAccess API.

### offsetSet($key, $val): void
Add an item (`$val`) to the collection with the specified key (`$key`).<br>
You shouldn't need to call this method since it is automatically used by the
ArrayAccess API.

### offsetUnset($key): void
Remove an item associated with the specified key (`$key`) from the collection.<br>
You shouldn't need to call this method since it is automatically used by the
ArrayAccess API.

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
    $collection = new \VersatileCollections\GenericCollection(
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'
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
    $collection = new \VersatileCollections\IntsCollection(
        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 2
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