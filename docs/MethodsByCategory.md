# Collection Methods by Category

  * [Accessing or Extracting Keys and / or Items in a Collection](#accessing-or-extracting-keys-or-items)
  * [Adding Items to a Collection](#adding-items)
  * [Adding Methods to a Collection at Runtime](#adding-methods-at-runtime)
  * [Checking if Item(s) exist in a Collection](#checking-items-presence)
  * [Checking if Key(s) exist in a Collection](#checking-keys-presence)
  * [Creating Collections](#creating-new-collections)
  * [Deleting Items from a Collection](#deleting-items)
  * [Finding or Searching for Items in a Collection](#finding-or-searching-for-items)
  * [Getting Information about a Collection](#getting-collection-meta-data)
  * [Looping / Iterating through a Collection](#iteration)
  * [Mathematical Operations on Numeric Collections](#mathematical-operations)
  * [Modifying the Item(s) in a Collection](#modifying-items)
  * [Modifying the Key(s) in a Collection](#modifying-keys)
  * [Ordering or Sorting Items in a Collection](#ordering-or-sorting-items)
  * [Other Collection Operations](#other-operations)


------------------------------------------------------------------------------------------------
<div id="accessing-or-extracting-keys-or-items"></div>

## Accessing or Extracting Keys and / or Items in a Collection
* **`VersatileCollections\CollectionInterface`**
  * [__get](MethodDescriptions.md#CollectionInterface-__get): Retrieves an item associated with a specified key in the collection.
  * [column](MethodDescriptions.md#CollectionInterface-column): Returns a new collection containing the values from a specified field in each item in a collection. Corresponding keys in the returned collection could be specified as another field in each item in the collection. MUST be a collection whose items are arrays and / or objects.
  * [diff](MethodDescriptions.md#CollectionInterface-diff): Returns a new collection containing items in an existing collection that are not present in the specified array of items.
  * [diffAssoc](MethodDescriptions.md#CollectionInterface-diffAssoc): Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items.
  * [diffAssocUsing](MethodDescriptions.md#CollectionInterface-diffAssocUsing): Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items using a callback to test for key presence.
  * [diffKeys](MethodDescriptions.md#CollectionInterface-diffKeys): Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items.
  * [diffKeysUsing](MethodDescriptions.md#CollectionInterface-diffKeysUsing): Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items using a specified callback to test for key presence.
  * [diffUsing](MethodDescriptions.md#CollectionInterface-diffUsing): Returns a new collection containing items in an existing collection that are not present in the specified array of items using a specified callback to test for item presence.
  * [each](MethodDescriptions.md#CollectionInterface-each): Iterates through a collection and executes a callback over each item.
  * [firstItem](MethodDescriptions.md#CollectionInterface-firstItem): Returns the first item in the collection or null if the collection is empty.
  * [getAllWhereKeysIn](MethodDescriptions.md#CollectionInterface-getAllWhereKeysIn): Returns a new collection of items from an existing collection whose keys are present in the specified keys.
  * [getAllWhereKeysNotIn](MethodDescriptions.md#CollectionInterface-getAllWhereKeysNotIn): Returns a new collection of items from an existing collection whose keys are not present in the specified keys.
  * [getAndRemoveFirstItem](MethodDescriptions.md#CollectionInterface-getAndRemoveFirstItem): Returns and removes the first item in a collection.
  * [getAndRemoveLastItem](MethodDescriptions.md#CollectionInterface-getAndRemoveLastItem): Removes and returns the last item from a collection.
  * [getIfExists](MethodDescriptions.md#CollectionInterface-getIfExists): Returns the item in the collection with the specified key (if such an item exists) or the specified default value otherwise.
  * [getItems](MethodDescriptions.md#CollectionInterface-getItems): Returns a new collection with all items in the original collection. All the keys in the new collection will be consecutive integer keys starting from zero.
  * [getKeys](MethodDescriptions.md#CollectionInterface-getKeys): Returns a new instance of \VersatileCollections\GenericCollection containing all the keys in the original collection.
  * [intersectByItems](MethodDescriptions.md#CollectionInterface-intersectByItems): Returns a new collection of items from an existing collection that are present in an array of specified items.
  * [intersectByItemsUsingCallback](MethodDescriptions.md#CollectionInterface-intersectByItemsUsingCallback): Returns a new collection of items from an existing collection that are present in an array of specified items using a specified callback for testing item presence.
  * [intersectByKeys](MethodDescriptions.md#CollectionInterface-intersectByKeys): Returns a new collection of items from an existing collection whose keys are present in an array of specified keys.
  * [intersectByKeysAndItems](MethodDescriptions.md#CollectionInterface-intersectByKeysAndItems): Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items.
  * [intersectByKeysAndItemsUsingCallbacks](MethodDescriptions.md#CollectionInterface-intersectByKeysAndItemsUsingCallbacks): Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items using one specified callback for testing key presence and another specified callback for testing item presence.
  * [intersectByKeysUsingCallback](MethodDescriptions.md#CollectionInterface-intersectByKeysUsingCallback): Returns a new collection of items from an existing collection whose keys are present in an array of specified keys using a specified callback for testing key presence.
  * [lastItem](MethodDescriptions.md#CollectionInterface-lastItem): Returns the last item in the collection or null if the collection is empty.
  * [map](MethodDescriptions.md#CollectionInterface-map): Applies a callback to the items in a collection and returns a new collection containing all items in the original collection after applying the callback function to each one. The original collection is not modified.
  * [offsetGet](MethodDescriptions.md#CollectionInterface-offsetGet): Retrieves an item associated with a specified key in the collection.
  * [paginate](MethodDescriptions.md#CollectionInterface-paginate): Returns a new collection of at most a specified number of items present in the specified page.
  * [pull](MethodDescriptions.md#CollectionInterface-pull): Removes and returns the item with the specified key from a collection (if it exists) or returns a default value.
  * [randomItem](MethodDescriptions.md#CollectionInterface-randomItem): Gets one item randomly from a collection.
  * [randomItems](MethodDescriptions.md#CollectionInterface-randomItems): Gets a specified number of items randomly from a collection and returns them in a new collection.
  * [randomKey](MethodDescriptions.md#CollectionInterface-randomKey): Gets one key randomly from a collection.
  * [randomKeys](MethodDescriptions.md#CollectionInterface-randomKeys): Gets a specified number of unique keys randomly from a collection and returns them in a new collection.
  * [reduce](MethodDescriptions.md#CollectionInterface-reduce): Iteratively reduces the collection items to a single value using a callback function.
  * [reduceWithKeyAccess](MethodDescriptions.md#CollectionInterface-reduceWithKeyAccess): Iteratively reduces the collection items to a single value using a callback function.
  * [searchAllByVal](MethodDescriptions.md#CollectionInterface-searchAllByVal): Searches the collection for a given value and returns an array of all corresponding key(s) in the collection whose item(s) match the given value or else returns false.
  * [searchByCallback](MethodDescriptions.md#CollectionInterface-searchByCallback): Searches the collection using a callback. Returns an array of all corresponding key(s) in the collection for which the callback returns true or else returns false.
  * [searchByVal](MethodDescriptions.md#CollectionInterface-searchByVal): Searches the collection for a given value and returns the first corresponding key in the collection whose item matches the given value if successful or false if not.
  * [slice](MethodDescriptions.md#CollectionInterface-slice): Extracts a slice from a collection and returns the slice as a new collection. The original collection is not modified.
  * [splice](MethodDescriptions.md#CollectionInterface-splice): Removes and returns in a new collection, a portion of a collection and optionally replaces the removed portion with some specified items.
  * [take](MethodDescriptions.md#CollectionInterface-take): Returns the first or last specified number of items in a collection in a new collection. Original collection is not modified.
  * [toArray](MethodDescriptions.md#CollectionInterface-toArray): Returns all items in the collection and their corresponding keys in an array.
  * [unique](MethodDescriptions.md#CollectionInterface-unique): Returns a new collection of unique items from an existing collection. This method uses strict comparison for testing uniqueness.

* **`VersatileCollections\ScalarsCollection`**
  * [uniqueNonStrict](MethodDescriptions.md#ScalarsCollection-uniqueNonStrict): Returns a new collection of unique items from an existing collection. This method uses non-strict comparison for testing uniqueness.


------------------------------------------------------------------------------------------------
<div id="adding-items"></div>

## Adding Items to a Collection
* **`VersatileCollections\CollectionInterface`**
  * [__set](MethodDescriptions.md#CollectionInterface-__set): Adds an item with a specified key to the collection.
  * [appendCollection](MethodDescriptions.md#CollectionInterface-appendCollection): Appends all items from a specified collection to the end of a collection. Note that appended items will be assigned numeric keys.
  * [appendItem](MethodDescriptions.md#CollectionInterface-appendItem): Appends a specified item to the end of a collection.
  * [mergeMeWith](MethodDescriptions.md#CollectionInterface-mergeMeWith): Adds all specified items to a collection. The original collection is modified. New items with the same keys as existing items will overwrite the existing items.
  * [mergeWith](MethodDescriptions.md#CollectionInterface-mergeWith): Adds all specified items to a collection and returns a new collection containing the result. The original collection is not modified. New items with the same keys as existing items will overwrite the existing items.
  * [offsetSet](MethodDescriptions.md#CollectionInterface-offsetSet): Adds an item with a specified key to the collection.
  * [prependCollection](MethodDescriptions.md#CollectionInterface-prependCollection): Prepends all items from a specified collection to the front of a collection.
  * [prependItem](MethodDescriptions.md#CollectionInterface-prependItem): Prepends a specified item (with a specified key, if specified) to the front of a collection.
  * [push](MethodDescriptions.md#CollectionInterface-push): Appends a specified item to the end of a collection.
  * [put](MethodDescriptions.md#CollectionInterface-put): Adds a specified key and item pair to a collection. If the specified key already exists, the specified item will overwrite the existing item.
  * [unionMeWith](MethodDescriptions.md#CollectionInterface-unionMeWith): Appends specified items to a collection. New items with the same keys as existing items will not overwrite the existing items. Original collection is modified.
  * [unionWith](MethodDescriptions.md#CollectionInterface-unionWith): Appends specified items to a collection and returns the result in a new collection. New items with the same keys as existing items will not overwrite the existing items. Original collection is not modified.


------------------------------------------------------------------------------------------------
<div id="adding-methods-at-runtime"></div>

## Adding Methods to a Collection at Runtime
* **`VersatileCollections\CollectionInterfaceImplementationTrait`**
  * [addMethod](MethodDescriptions.md#CollectionInterfaceImplementationTrait-addMethod): Registers a specified `callable` with a specified name to a single instance of a Collection class, so that the registered callable can be later called as an instance method with the specified name on the instance of the Collection class the callable was registered to.
  * [addMethodForAllInstances](MethodDescriptions.md#CollectionInterfaceImplementationTrait-addMethodForAllInstances): Registers a specified `callable` with a specified name to a Collection class, so that the registered callable can be later called as an instance method with the specified name on any instance of the Collection class or any of its sub-classes.
  * [addStaticMethod](MethodDescriptions.md#CollectionInterfaceImplementationTrait-addStaticMethod): Registers a specified `callable` with a specified name to a Collection class, so that the registered callable can be later called as a static method with the specified name on the Collection class or any of its sub-classes.


------------------------------------------------------------------------------------------------
<div id="checking-items-presence"></div>

## Checking if Item(s) exist in a Collection
* **`VersatileCollections\CollectionInterface`**
  * [__isset](MethodDescriptions.md#CollectionInterface-__isset): Checks if an item with a specified key exists in the collection.
  * [containsItem](MethodDescriptions.md#CollectionInterface-containsItem): Checks if a collection contains a specified item (using strict comparison).
  * [containsItemWithKey](MethodDescriptions.md#CollectionInterface-containsItemWithKey): Checks if a collection contains a specified item (using strict comparison) together with the specified key.
  * [containsItems](MethodDescriptions.md#CollectionInterface-containsItems): Checks if a collection contains all specified items (using strict comparison for each comparison).
  * [getIfExists](MethodDescriptions.md#CollectionInterface-getIfExists): Returns the item in the collection with the specified key (if such an item exists) or the specified default value otherwise.
  * [offsetExists](MethodDescriptions.md#CollectionInterface-offsetExists): Checks if an item with a specified key exists in the collection.


------------------------------------------------------------------------------------------------
<div id="checking-keys-presence"></div>

## Checking if Key(s) exist in a Collection
* **`VersatileCollections\CollectionInterface`**
  * [containsItemWithKey](MethodDescriptions.md#CollectionInterface-containsItemWithKey): Checks if a collection contains a specified item (using strict comparison) together with the specified key.
  * [containsKey](MethodDescriptions.md#CollectionInterface-containsKey): Checks if a collection contains a specified key.
  * [containsKeys](MethodDescriptions.md#CollectionInterface-containsKeys): Checks if a collection contains all specified keys.


------------------------------------------------------------------------------------------------
<div id="creating-new-collections"></div>

## Creating Collections
* **`VersatileCollections\CollectionInterface`**
  * [diff](MethodDescriptions.md#CollectionInterface-diff): Returns a new collection containing items in an existing collection that are not present in the specified array of items.
  * [diffAssoc](MethodDescriptions.md#CollectionInterface-diffAssoc): Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items.
  * [diffAssocUsing](MethodDescriptions.md#CollectionInterface-diffAssocUsing): Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items using a callback to test for key presence.
  * [diffKeys](MethodDescriptions.md#CollectionInterface-diffKeys): Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items.
  * [diffKeysUsing](MethodDescriptions.md#CollectionInterface-diffKeysUsing): Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items using a specified callback to test for key presence.
  * [diffUsing](MethodDescriptions.md#CollectionInterface-diffUsing): Returns a new collection containing items in an existing collection that are not present in the specified array of items using a specified callback to test for item presence.
  * [everyNth](MethodDescriptions.md#CollectionInterface-everyNth): Creates a new collection consisting of every n-th element in a collection.
  * [filterAll](MethodDescriptions.md#CollectionInterface-filterAll): Filters out items in the collection via a callback function and returns filtered items in a new collection.
  * [filterFirstN](MethodDescriptions.md#CollectionInterface-filterFirstN): Filters out the first N items in the collection via a callback function and returns filtered items in a new collection.
  * [getAllWhereKeysIn](MethodDescriptions.md#CollectionInterface-getAllWhereKeysIn): Returns a new collection of items from an existing collection whose keys are present in the specified keys.
  * [getAllWhereKeysNotIn](MethodDescriptions.md#CollectionInterface-getAllWhereKeysNotIn): Returns a new collection of items from an existing collection whose keys are not present in the specified keys.
  * [getAsNewType](MethodDescriptions.md#CollectionInterface-getAsNewType): Creates a new collection of the specified type with the keys and items from an existing collection. The specified collection type MUST be compatible with the existing collection's type.
  * [getCollectionsOfSizeN](MethodDescriptions.md#CollectionInterface-getCollectionsOfSizeN): Returns a collection of collections; with each sub-collection having a specified maximum number of items. Original keys are preserved in each sub-collection.
  * [getItems](MethodDescriptions.md#CollectionInterface-getItems): Returns a new collection with all items in the original collection. All the keys in the new collection will be consecutive integer keys starting from zero.
  * [getKeys](MethodDescriptions.md#CollectionInterface-getKeys): Returns a new instance of \VersatileCollections\GenericCollection containing all the keys in the original collection.
  * [intersectByItems](MethodDescriptions.md#CollectionInterface-intersectByItems): Returns a new collection of items from an existing collection that are present in an array of specified items.
  * [intersectByItemsUsingCallback](MethodDescriptions.md#CollectionInterface-intersectByItemsUsingCallback): Returns a new collection of items from an existing collection that are present in an array of specified items using a specified callback for testing item presence.
  * [intersectByKeys](MethodDescriptions.md#CollectionInterface-intersectByKeys): Returns a new collection of items from an existing collection whose keys are present in an array of specified keys.
  * [intersectByKeysAndItems](MethodDescriptions.md#CollectionInterface-intersectByKeysAndItems): Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items.
  * [intersectByKeysAndItemsUsingCallbacks](MethodDescriptions.md#CollectionInterface-intersectByKeysAndItemsUsingCallbacks): Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items using one specified callback for testing key presence and another specified callback for testing item presence.
  * [intersectByKeysUsingCallback](MethodDescriptions.md#CollectionInterface-intersectByKeysUsingCallback): Returns a new collection of items from an existing collection whose keys are present in an array of specified keys using a specified callback for testing key presence.
  * [makeNew](MethodDescriptions.md#CollectionInterface-makeNew): Creates a new collection from an array of items. Items must be rightly typed if collection class is strictly typed.
  * [map](MethodDescriptions.md#CollectionInterface-map): Applies a callback to the items in a collection and returns a new collection containing all items in the original collection after applying the callback function to each one. The original collection is not modified.
  * [mergeWith](MethodDescriptions.md#CollectionInterface-mergeWith): Adds all specified items to a collection and returns a new collection containing the result. The original collection is not modified. New items with the same keys as existing items will overwrite the existing items.
  * [paginate](MethodDescriptions.md#CollectionInterface-paginate): Returns a new collection of at most a specified number of items present in the specified page.
  * [reverse](MethodDescriptions.md#CollectionInterface-reverse): Reverses the order of items in the collection and returns the reversed items in a new collection.
  * [shuffle](MethodDescriptions.md#CollectionInterface-shuffle): Shuffles all the items in a collection and returns the shuffled items in a new collection. The original collection is not modified.
  * [slice](MethodDescriptions.md#CollectionInterface-slice): Extracts a slice from a collection and returns the slice as a new collection. The original collection is not modified.
  * [sort](MethodDescriptions.md#CollectionInterface-sort): Sorts a collection's items in ascending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortByKey](MethodDescriptions.md#CollectionInterface-sortByKey): Sorts a collection's items by keys in ascending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortByMultipleFields](MethodDescriptions.md#CollectionInterface-sortByMultipleFields): Sorts a collection of associative arrays or objects by specified field name(s) while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortDesc](MethodDescriptions.md#CollectionInterface-sortDesc): Sorts a collection's items in descending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortDescByKey](MethodDescriptions.md#CollectionInterface-sortDescByKey): Sorts a collection's items by keys in descending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [splice](MethodDescriptions.md#CollectionInterface-splice): Removes and returns in a new collection, a portion of a collection and optionally replaces the removed portion with some specified items.
  * [split](MethodDescriptions.md#CollectionInterface-split): Splits a collection into a specified number of collections and returns a collection containing those collections.
  * [take](MethodDescriptions.md#CollectionInterface-take): Returns the first or last specified number of items in a collection in a new collection. Original collection is not modified.
  * [unionWith](MethodDescriptions.md#CollectionInterface-unionWith): Appends specified items to a collection and returns the result in a new collection. New items with the same keys as existing items will not overwrite the existing items. Original collection is not modified.
  * [unique](MethodDescriptions.md#CollectionInterface-unique): Returns a new collection of unique items from an existing collection. This method uses strict comparison for testing uniqueness.
  * [yieldCollectionsOfSizeN](MethodDescriptions.md#CollectionInterface-yieldCollectionsOfSizeN): Returns a generator that yields collections each having a specified maximum number of items. Original keys are preserved in each returned collection.

* **`VersatileCollections\ScalarsCollection`**
  * [uniqueNonStrict](MethodDescriptions.md#ScalarsCollection-uniqueNonStrict): Returns a new collection of unique items from an existing collection. This method uses non-strict comparison for testing uniqueness.


------------------------------------------------------------------------------------------------
<div id="deleting-items"></div>

## Deleting Items from a Collection
* **`VersatileCollections\CollectionInterface`**
  * [__unset](MethodDescriptions.md#CollectionInterface-__unset): Removes an item associated with the specified key from the collection.
  * [getAndRemoveFirstItem](MethodDescriptions.md#CollectionInterface-getAndRemoveFirstItem): Returns and removes the first item in a collection.
  * [getAndRemoveLastItem](MethodDescriptions.md#CollectionInterface-getAndRemoveLastItem): Removes and returns the last item from a collection.
  * [offsetUnset](MethodDescriptions.md#CollectionInterface-offsetUnset): Removes an item associated with the specified key from the collection.
  * [pull](MethodDescriptions.md#CollectionInterface-pull): Removes and returns the item with the specified key from a collection (if it exists) or returns a default value.
  * [removeAll](MethodDescriptions.md#CollectionInterface-removeAll): Removes items from a collection (whose keys are specified) or (all items if no keys were specified).
  * [splice](MethodDescriptions.md#CollectionInterface-splice): Removes and returns in a new collection, a portion of a collection and optionally replaces the removed portion with some specified items.


------------------------------------------------------------------------------------------------
<div id="finding-or-searching-for-items"></div>

## Finding or Searching for Items in a Collection
* **`VersatileCollections\CollectionInterface`**
  * [diff](MethodDescriptions.md#CollectionInterface-diff): Returns a new collection containing items in an existing collection that are not present in the specified array of items.
  * [diffAssoc](MethodDescriptions.md#CollectionInterface-diffAssoc): Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items.
  * [diffAssocUsing](MethodDescriptions.md#CollectionInterface-diffAssocUsing): Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items using a callback to test for key presence.
  * [diffKeys](MethodDescriptions.md#CollectionInterface-diffKeys): Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items.
  * [diffKeysUsing](MethodDescriptions.md#CollectionInterface-diffKeysUsing): Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items using a specified callback to test for key presence.
  * [diffUsing](MethodDescriptions.md#CollectionInterface-diffUsing): Returns a new collection containing items in an existing collection that are not present in the specified array of items using a specified callback to test for item presence.
  * [filterAll](MethodDescriptions.md#CollectionInterface-filterAll): Filters out items in the collection via a callback function and returns filtered items in a new collection.
  * [filterFirstN](MethodDescriptions.md#CollectionInterface-filterFirstN): Filters out the first N items in the collection via a callback function and returns filtered items in a new collection.
  * [getAllWhereKeysIn](MethodDescriptions.md#CollectionInterface-getAllWhereKeysIn): Returns a new collection of items from an existing collection whose keys are present in the specified keys.
  * [getAllWhereKeysNotIn](MethodDescriptions.md#CollectionInterface-getAllWhereKeysNotIn): Returns a new collection of items from an existing collection whose keys are not present in the specified keys.
  * [intersectByItems](MethodDescriptions.md#CollectionInterface-intersectByItems): Returns a new collection of items from an existing collection that are present in an array of specified items.
  * [intersectByItemsUsingCallback](MethodDescriptions.md#CollectionInterface-intersectByItemsUsingCallback): Returns a new collection of items from an existing collection that are present in an array of specified items using a specified callback for testing item presence.
  * [intersectByKeys](MethodDescriptions.md#CollectionInterface-intersectByKeys): Returns a new collection of items from an existing collection whose keys are present in an array of specified keys.
  * [intersectByKeysAndItems](MethodDescriptions.md#CollectionInterface-intersectByKeysAndItems): Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items.
  * [intersectByKeysAndItemsUsingCallbacks](MethodDescriptions.md#CollectionInterface-intersectByKeysAndItemsUsingCallbacks): Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items using one specified callback for testing key presence and another specified callback for testing item presence.
  * [intersectByKeysUsingCallback](MethodDescriptions.md#CollectionInterface-intersectByKeysUsingCallback): Returns a new collection of items from an existing collection whose keys are present in an array of specified keys using a specified callback for testing key presence.
  * [searchAllByVal](MethodDescriptions.md#CollectionInterface-searchAllByVal): Searches the collection for a given value and returns an array of all corresponding key(s) in the collection whose item(s) match the given value or else returns false.
  * [searchByCallback](MethodDescriptions.md#CollectionInterface-searchByCallback): Searches the collection using a callback. Returns an array of all corresponding key(s) in the collection for which the callback returns true or else returns false.
  * [searchByVal](MethodDescriptions.md#CollectionInterface-searchByVal): Searches the collection for a given value and returns the first corresponding key in the collection whose item matches the given value if successful or false if not.


------------------------------------------------------------------------------------------------
<div id="getting-collection-meta-data"></div>

## Getting Information about a Collection
* **`VersatileCollections\CollectionInterface`**
  * [count](MethodDescriptions.md#CollectionInterface-count): Returns the number of items in the collection.
  * [getKeys](MethodDescriptions.md#CollectionInterface-getKeys): Returns a new instance of \VersatileCollections\GenericCollection containing all the keys in the original collection.
  * [isEmpty](MethodDescriptions.md#CollectionInterface-isEmpty): Returns true if there are one or more items in the collection or false otherwise.


------------------------------------------------------------------------------------------------
<div id="iteration"></div>

## Looping / Iterating through a Collection
* **`VersatileCollections\CollectionInterface`**
  * [each](MethodDescriptions.md#CollectionInterface-each): Iterates through a collection and executes a callback over each item.
  * [getIterator](MethodDescriptions.md#CollectionInterface-getIterator): Returns an Iterator object that can be used to iterate through the collection.
  * [map](MethodDescriptions.md#CollectionInterface-map): Applies a callback to the items in a collection and returns a new collection containing all items in the original collection after applying the callback function to each one. The original collection is not modified.
  * [reduce](MethodDescriptions.md#CollectionInterface-reduce): Iteratively reduces the collection items to a single value using a callback function.
  * [reduceWithKeyAccess](MethodDescriptions.md#CollectionInterface-reduceWithKeyAccess): Iteratively reduces the collection items to a single value using a callback function.
  * [transform](MethodDescriptions.md#CollectionInterface-transform): Transforms each item in the collection via a callback function.


------------------------------------------------------------------------------------------------
<div id="mathematical-operations"></div>

## Mathematical Operations on Numeric Collections
* **`VersatileCollections\NumericsCollection`**
  * [average](MethodDescriptions.md#NumericsCollection-average): Returns the average of all of the values(a.k.a items) in the collection or null if collection is empty.
  * [max](MethodDescriptions.md#NumericsCollection-max): Returns the maximum of all of the values(a.k.a items) in the collection or null if collection is empty.
  * [median](MethodDescriptions.md#NumericsCollection-median): Returns the median of all of the values(a.k.a items) in the collection or null if collection is empty.
  * [min](MethodDescriptions.md#NumericsCollection-min): Returns the minimum of all of the values(a.k.a items) in the collection or null if collection is empty.
  * [mode](MethodDescriptions.md#NumericsCollection-mode): Returns an array of modal values(a.k.a items) in the collection or null if collection is empty.
  * [product](MethodDescriptions.md#NumericsCollection-product): Returns the product of all of the values(a.k.a items) in the collection or one if collection is empty.
  * [sum](MethodDescriptions.md#NumericsCollection-sum): Returns the sum of all of the values(a.k.a items) in the collection or zero if collection is empty.


------------------------------------------------------------------------------------------------
<div id="modifying-items"></div>

## Modifying the Item(s) in a Collection
* **`VersatileCollections\CollectionInterface`**
  * [setValForEachItem](MethodDescriptions.md#CollectionInterface-setValForEachItem): Sets the specified field in each array or object in the collection to a specified value.
  * [splice](MethodDescriptions.md#CollectionInterface-splice): Removes and returns in a new collection, a portion of a collection and optionally replaces the removed portion with some specified items.
  * [transform](MethodDescriptions.md#CollectionInterface-transform): Transforms each item in the collection via a callback function.


------------------------------------------------------------------------------------------------
<div id="modifying-keys"></div>

## Modifying the Key(s) in a Collection
* **`VersatileCollections\CollectionInterface`**
  * [getItems](MethodDescriptions.md#CollectionInterface-getItems): Returns a new collection with all items in the original collection. All the keys in the new collection will be consecutive integer keys starting from zero.
  * [makeAllKeysNumeric](MethodDescriptions.md#CollectionInterface-makeAllKeysNumeric): Converts all keys in a collection to consecutive integer keys starting from the specified integer value.
  * [unique](MethodDescriptions.md#CollectionInterface-unique): Returns a new collection of unique items from an existing collection. This method uses strict comparison for testing uniqueness.

* **`VersatileCollections\ScalarsCollection`**
  * [uniqueNonStrict](MethodDescriptions.md#ScalarsCollection-uniqueNonStrict): Returns a new collection of unique items from an existing collection. This method uses non-strict comparison for testing uniqueness.


------------------------------------------------------------------------------------------------
<div id="ordering-or-sorting-items"></div>

## Ordering or Sorting Items in a Collection
* **`VersatileCollections\CollectionInterface`**
  * [reverse](MethodDescriptions.md#CollectionInterface-reverse): Reverses the order of items in the collection and returns the reversed items in a new collection.
  * [reverseMe](MethodDescriptions.md#CollectionInterface-reverseMe): Reverses the order of items in the collection. Original collection is modified.
  * [shuffle](MethodDescriptions.md#CollectionInterface-shuffle): Shuffles all the items in a collection and returns the shuffled items in a new collection. The original collection is not modified.
  * [sort](MethodDescriptions.md#CollectionInterface-sort): Sorts a collection's items in ascending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortByKey](MethodDescriptions.md#CollectionInterface-sortByKey): Sorts a collection's items by keys in ascending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortByMultipleFields](MethodDescriptions.md#CollectionInterface-sortByMultipleFields): Sorts a collection of associative arrays or objects by specified field name(s) while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortDesc](MethodDescriptions.md#CollectionInterface-sortDesc): Sorts a collection's items in descending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortDescByKey](MethodDescriptions.md#CollectionInterface-sortDescByKey): Sorts a collection's items by keys in descending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortMe](MethodDescriptions.md#CollectionInterface-sortMe): Sorts a collection's items in ascending order while maintaining key association. The original collection is modified.
  * [sortMeByKey](MethodDescriptions.md#CollectionInterface-sortMeByKey): Sorts a collection's items by keys in ascending order while maintaining key association. The original collection is modified.
  * [sortMeByMultipleFields](MethodDescriptions.md#CollectionInterface-sortMeByMultipleFields): Sorts a collection of associative arrays or objects by specified field name(s) while maintaining key association. The original collection is modified.
  * [sortMeDesc](MethodDescriptions.md#CollectionInterface-sortMeDesc): Sorts a collection's items in descending order while maintaining key association. The original collection is modified.
  * [sortMeDescByKey](MethodDescriptions.md#CollectionInterface-sortMeDescByKey): Sorts a collection's items by keys in descending order while maintaining key association. The original collection is modified.


------------------------------------------------------------------------------------------------
<div id="other-operations"></div>

## Other Collection Operations
* **`VersatileCollections\CollectionInterface`**
  * [allSatisfyConditions](MethodDescriptions.md#CollectionInterface-allSatisfyConditions): Iterates through a collection and executes a callback (that returns a boolean) over each item and returns true if the callback returns true for all items or false otherwise.
  * [pipeAndReturnCallbackResult](MethodDescriptions.md#CollectionInterface-pipeAndReturnCallbackResult): Executes the given callback on a collection and returns whatever value the callback returned.
  * [pipeAndReturnSelf](MethodDescriptions.md#CollectionInterface-pipeAndReturnSelf): Executes the given callback on a collection and returns the collection itself.
  * [tap](MethodDescriptions.md#CollectionInterface-tap): Invokes a specified callback on a copy of a collection and returns the original collection.
  * [whenFalse](MethodDescriptions.md#CollectionInterface-whenFalse): Conditionally executes a specified callback on a collection if first argument is falsy or executes a specified default callback otherwise and returns the value returned by the executed callback. If no callback could be executed, null is returned.
  * [whenTrue](MethodDescriptions.md#CollectionInterface-whenTrue): Conditionally executes a specified callback on a collection if first argument is truthy or executes a specified default callback otherwise and returns the value returned by the executed callback. If no callback could be executed, null is returned.

* **`VersatileCollections\ObjectsCollection`**
  * [__call](MethodDescriptions.md#ObjectsCollection-__call): Tries to call the specified method with the specified arguments and return its return value if it was registered via either `addMethod` or `addMethodForAllInstances` or tries to call the specified method with the specified arguments on each item in the collection and returns an array of return values keyed by each item's key in the collection. An exception of type **\VersatileCollections\Exceptions\InvalidCollectionOperationException** is thrown if the method could not be called.

* **`VersatileCollections\CollectionInterfaceImplementationTrait`**
  * [__call](MethodDescriptions.md#CollectionInterfaceImplementationTrait-__call): Tries to call the specified method with the specified arguments and return its return value if it was registered via either `addMethod` or `addMethodForAllInstances` . An exception of type **\BadMethodCallException** is thrown if the method could not be called.
  * [__callStatic](MethodDescriptions.md#CollectionInterfaceImplementationTrait-__callStatic): Tries to call the specified method with the specified arguments and return its return value if it was registered via `addStaticMethod`. An exception of type **\BadMethodCallException** is thrown if the method could not be called.


