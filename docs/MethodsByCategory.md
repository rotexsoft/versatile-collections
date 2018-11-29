# Collection Methods by Category

## Accessing or Extracting Keys and / or Items in a Collection
* VersatileCollections\CollectionInterface
  * [__get](MethodDescriptions.md#__get): Retrieves an item associated with a specified key in the collection.
  * [offsetGet](MethodDescriptions.md#offsetGet): Retrieves an item associated with a specified key in the collection.
  * [toArray](MethodDescriptions.md#toArray): Returns all items in the collection and their corresponding keys in an array.
  * [firstItem](MethodDescriptions.md#firstItem): Returns the first item in the collection or null if the collection is empty.
  * [lastItem](MethodDescriptions.md#lastItem): Returns the last item in the collection or null if the collection is empty.
  * [getKeys](MethodDescriptions.md#getKeys): Returns a new instance of \VersatileCollections\GenericCollection containing all the keys in the original collection.
  * [reduce](MethodDescriptions.md#reduce): Iteratively reduces the collection items to a single value using a callback function.
  * [reduceWithKeyAccess](MethodDescriptions.md#reduceWithKeyAccess): Iteratively reduces the collection items to a single value using a callback function.
  * [getIfExists](MethodDescriptions.md#getIfExists): Returns the item in the collection with the specified key (if such an item exists) or the specified default value otherwise.
  * [getItems](MethodDescriptions.md#getItems): Returns a new collection with all items in the original collection. All the keys in the new collection will be consecutive integer keys starting from zero.
  * [each](MethodDescriptions.md#each): Iterates through a collection and executes a callback over each item.
  * [map](MethodDescriptions.md#map): Applies a callback to the items in a collection and returns a new collection containing all items in the original collection after applying the callback function to each one. The original collection is not modified.
  * [getAndRemoveLastItem](MethodDescriptions.md#getAndRemoveLastItem): Removes and returns the last item from a collection.
  * [pull](MethodDescriptions.md#pull): Removes and returns the item with the specified key from a collection (if it exists) or returns a default value.
  * [randomKey](MethodDescriptions.md#randomKey): Gets one key randomly from a collection.
  * [randomItem](MethodDescriptions.md#randomItem): Gets one item randomly from a collection.
  * [randomKeys](MethodDescriptions.md#randomKeys): Gets a specified number of unique keys randomly from a collection and returns them in a new collection.
  * [randomItems](MethodDescriptions.md#randomItems): Gets a specified number of items randomly from a collection and returns them in a new collection.
  * [searchByVal](MethodDescriptions.md#searchByVal): Searches the collection for a given value and returns the first corresponding key in the collection whose item matches the given value if successful or false if not.
  * [searchAllByVal](MethodDescriptions.md#searchAllByVal): Searches the collection for a given value and returns an array of all corresponding key(s) in the collection whose item(s) match the given value or else returns false.
  * [searchByCallback](MethodDescriptions.md#searchByCallback): Searches the collection using a callback. Returns an array of all corresponding key(s) in the collection for which the callback returns true or else returns false.
  * [getAndRemoveFirstItem](MethodDescriptions.md#getAndRemoveFirstItem): Returns and removes the first item in a collection.
  * [slice](MethodDescriptions.md#slice): Extracts a slice from a collection and returns the slice as a new collection. The original collection is not modified.
  * [splice](MethodDescriptions.md#splice): Removes and returns in a new collection, a portion of a collection and optionally replaces the removed portion with some specified items.
  * [take](MethodDescriptions.md#take): Returns the first or last specified number of items in a collection in a new collection. Original collection is not modified.
  * [unique](MethodDescriptions.md#unique): Returns a new collection of unique items from an existing collection. This method uses strict comparison for testing uniqueness.
  * [column](MethodDescriptions.md#column): Returns a new collection containing the values from a specified field in each item in a collection. Corresponding keys in the returned collection could be specified as another field in each item in the collection. MUST be a collection whose items are arrays and / or objects.
  * [getAllWhereKeysIn](MethodDescriptions.md#getAllWhereKeysIn): Returns a new collection of items from an existing collection whose keys are present in the specified keys.
  * [getAllWhereKeysNotIn](MethodDescriptions.md#getAllWhereKeysNotIn): Returns a new collection of items from an existing collection whose keys are not present in the specified keys.
  * [paginate](MethodDescriptions.md#paginate): Returns a new collection of at most a specified number of items present in the specified page.
  * [diff](MethodDescriptions.md#diff): Returns a new collection containing items in an existing collection that are not present in the specified array of items.
  * [diffUsing](MethodDescriptions.md#diffUsing): Returns a new collection containing items in an existing collection that are not present in the specified array of items using a specified callback to test for item presence.
  * [diffAssoc](MethodDescriptions.md#diffAssoc): Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items.
  * [diffAssocUsing](MethodDescriptions.md#diffAssocUsing): Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items using a callback to test for key presence.
  * [diffKeys](MethodDescriptions.md#diffKeys): Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items.
  * [diffKeysUsing](MethodDescriptions.md#diffKeysUsing): Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items using a specified callback to test for key presence.
  * [intersectByKeys](MethodDescriptions.md#intersectByKeys): Returns a new collection of items from an existing collection whose keys are present in an array of specified keys.
  * [intersectByItems](MethodDescriptions.md#intersectByItems): Returns a new collection of items from an existing collection that are present in an array of specified items.
  * [intersectByKeysAndItems](MethodDescriptions.md#intersectByKeysAndItems): Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items.
  * [intersectByKeysUsingCallback](MethodDescriptions.md#intersectByKeysUsingCallback): Returns a new collection of items from an existing collection whose keys are present in an array of specified keys using a specified callback for testing key presence.
  * [intersectByItemsUsingCallback](MethodDescriptions.md#intersectByItemsUsingCallback): Returns a new collection of items from an existing collection that are present in an array of specified items using a specified callback for testing item presence.
  * [intersectByKeysAndItemsUsingCallbacks](MethodDescriptions.md#intersectByKeysAndItemsUsingCallbacks): Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items using one specified callback for testing key presence and another specified callback for testing item presence.


## Adding Items to a Collection
* VersatileCollections\CollectionInterface
  * [__set](MethodDescriptions.md#__set): Adds an item with a specified key to the collection.
  * [offsetSet](MethodDescriptions.md#offsetSet): Adds an item with a specified key to the collection.
  * [appendCollection](MethodDescriptions.md#appendCollection): Appends all items from a specified collection to the end of a collection. Note that appended items will be assigned numeric keys.
  * [appendItem](MethodDescriptions.md#appendItem): Appends a specified item to the end of a collection.
  * [prependCollection](MethodDescriptions.md#prependCollection): Prepends all items from a specified collection to the front of a collection.
  * [prependItem](MethodDescriptions.md#prependItem): Prepends a specified item (with a specified key, if specified) to the front of a collection.
  * [mergeWith](MethodDescriptions.md#mergeWith): Adds all specified items to a collection and returns a new collection containing the result. The original collection is not modified. New items with the same keys as existing items will overwrite the existing items.
  * [mergeMeWith](MethodDescriptions.md#mergeMeWith): Adds all specified items to a collection. The original collection is modified. New items with the same keys as existing items will overwrite the existing items.
  * [push](MethodDescriptions.md#push): Appends a specified item to the end of a collection.
  * [put](MethodDescriptions.md#put): Adds a specified key and item pair to a collection. If the specified key already exists, the specified item will overwrite the existing item.
  * [unionWith](MethodDescriptions.md#unionWith): Appends specified items to a collection and returns the result in a new collection. New items with the same keys as existing items will not overwrite the existing items. Original collection is not modified.
  * [unionMeWith](MethodDescriptions.md#unionMeWith): Appends specified items to a collection. New items with the same keys as existing items will not overwrite the existing items. Original collection is modified.


## Checking if Item(s) exist in a Collection
* VersatileCollections\CollectionInterface
  * [__isset](MethodDescriptions.md#__isset): Checks if an item with a specified key exists in the collection.
  * [offsetExists](MethodDescriptions.md#offsetExists): Checks if an item with a specified key exists in the collection.
  * [getIfExists](MethodDescriptions.md#getIfExists): Returns the item in the collection with the specified key (if such an item exists) or the specified default value otherwise.
  * [containsItem](MethodDescriptions.md#containsItem): Checks if a collection contains a specified item (using strict comparison).
  * [containsItemWithKey](MethodDescriptions.md#containsItemWithKey): Checks if a collection contains a specified item (using strict comparison) together with the specified key.
  * [containsItems](MethodDescriptions.md#containsItems): Checks if a collection contains all specified items (using strict comparison for each comparison).


## Checking if Key(s) exist in a Collection
* VersatileCollections\CollectionInterface
  * [containsItemWithKey](MethodDescriptions.md#containsItemWithKey): Checks if a collection contains a specified item (using strict comparison) together with the specified key.
  * [containsKey](MethodDescriptions.md#containsKey): Checks if a collection contains a specified key.
  * [containsKeys](MethodDescriptions.md#containsKeys): Checks if a collection contains all specified keys.


## Creating Collections
* VersatileCollections\CollectionInterface
  * [makeNew](MethodDescriptions.md#makeNew): Creates a new collection from an array of items. Items must be rightly typed if collection class is strictly typed.
  * [getKeys](MethodDescriptions.md#getKeys): Returns a new instance of \VersatileCollections\GenericCollection containing all the keys in the original collection.
  * [filterAll](MethodDescriptions.md#filterAll): Filters out items in the collection via a callback function and returns filtered items in a new collection.
  * [filterFirstN](MethodDescriptions.md#filterFirstN): Filters out the first N items in the collection via a callback function and returns filtered items in a new collection.
  * [reverse](MethodDescriptions.md#reverse): Reverses the order of items in the collection and returns the reversed items in a new collection.
  * [mergeWith](MethodDescriptions.md#mergeWith): Adds all specified items to a collection and returns a new collection containing the result. The original collection is not modified. New items with the same keys as existing items will overwrite the existing items.
  * [yieldCollectionsOfSizeN](MethodDescriptions.md#yieldCollectionsOfSizeN): Returns a generator that yields collections each having a specified maximum number of items. Original keys are preserved in each returned collection.
  * [getCollectionsOfSizeN](MethodDescriptions.md#getCollectionsOfSizeN): Returns a collection of collections; with each sub-collection having a specified maximum number of items. Original keys are preserved in each sub-collection.
  * [getItems](MethodDescriptions.md#getItems): Returns a new collection with all items in the original collection. All the keys in the new collection will be consecutive integer keys starting from zero.
  * [map](MethodDescriptions.md#map): Applies a callback to the items in a collection and returns a new collection containing all items in the original collection after applying the callback function to each one. The original collection is not modified.
  * [everyNth](MethodDescriptions.md#everyNth): Creates a new collection consisting of every n-th element in a collection.
  * [shuffle](MethodDescriptions.md#shuffle): Shuffles all the items in a collection and returns the shuffled items in a new collection. The original collection is not modified.
  * [slice](MethodDescriptions.md#slice): Extracts a slice from a collection and returns the slice as a new collection. The original collection is not modified.
  * [sort](MethodDescriptions.md#sort): Sorts a collection's items in ascending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortDesc](MethodDescriptions.md#sortDesc): Sorts a collection's items in descending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortByKey](MethodDescriptions.md#sortByKey): Sorts a collection's items by keys in ascending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortDescByKey](MethodDescriptions.md#sortDescByKey): Sorts a collection's items by keys in descending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortByMultipleFields](MethodDescriptions.md#sortByMultipleFields): Sorts a collection of associative arrays or objects by specified field name(s) while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [splice](MethodDescriptions.md#splice): Removes and returns in a new collection, a portion of a collection and optionally replaces the removed portion with some specified items.
  * [split](MethodDescriptions.md#split): Splits a collection into a specified number of collections and returns a collection containing those collections.
  * [take](MethodDescriptions.md#take): Returns the first or last specified number of items in a collection in a new collection. Original collection is not modified.
  * [unionWith](MethodDescriptions.md#unionWith): Appends specified items to a collection and returns the result in a new collection. New items with the same keys as existing items will not overwrite the existing items. Original collection is not modified.
  * [unique](MethodDescriptions.md#unique): Returns a new collection of unique items from an existing collection. This method uses strict comparison for testing uniqueness.
  * [getAsNewType](MethodDescriptions.md#getAsNewType): Creates a new collection of the specified type with the keys and items from an existing collection. The specified collection type MUST be compatible with the existing collection's type.
  * [getAllWhereKeysIn](MethodDescriptions.md#getAllWhereKeysIn): Returns a new collection of items from an existing collection whose keys are present in the specified keys.
  * [getAllWhereKeysNotIn](MethodDescriptions.md#getAllWhereKeysNotIn): Returns a new collection of items from an existing collection whose keys are not present in the specified keys.
  * [paginate](MethodDescriptions.md#paginate): Returns a new collection of at most a specified number of items present in the specified page.
  * [diff](MethodDescriptions.md#diff): Returns a new collection containing items in an existing collection that are not present in the specified array of items.
  * [diffUsing](MethodDescriptions.md#diffUsing): Returns a new collection containing items in an existing collection that are not present in the specified array of items using a specified callback to test for item presence.
  * [diffAssoc](MethodDescriptions.md#diffAssoc): Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items.
  * [diffAssocUsing](MethodDescriptions.md#diffAssocUsing): Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items using a callback to test for key presence.
  * [diffKeys](MethodDescriptions.md#diffKeys): Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items.
  * [diffKeysUsing](MethodDescriptions.md#diffKeysUsing): Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items using a specified callback to test for key presence.
  * [intersectByKeys](MethodDescriptions.md#intersectByKeys): Returns a new collection of items from an existing collection whose keys are present in an array of specified keys.
  * [intersectByItems](MethodDescriptions.md#intersectByItems): Returns a new collection of items from an existing collection that are present in an array of specified items.
  * [intersectByKeysAndItems](MethodDescriptions.md#intersectByKeysAndItems): Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items.
  * [intersectByKeysUsingCallback](MethodDescriptions.md#intersectByKeysUsingCallback): Returns a new collection of items from an existing collection whose keys are present in an array of specified keys using a specified callback for testing key presence.
  * [intersectByItemsUsingCallback](MethodDescriptions.md#intersectByItemsUsingCallback): Returns a new collection of items from an existing collection that are present in an array of specified items using a specified callback for testing item presence.
  * [intersectByKeysAndItemsUsingCallbacks](MethodDescriptions.md#intersectByKeysAndItemsUsingCallbacks): Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items using one specified callback for testing key presence and another specified callback for testing item presence.


## Deleting Items from a Collection
* VersatileCollections\CollectionInterface
  * [__unset](MethodDescriptions.md#__unset): Removes an item associated with the specified key from the collection.
  * [offsetUnset](MethodDescriptions.md#offsetUnset): Removes an item associated with the specified key from the collection.
  * [getAndRemoveLastItem](MethodDescriptions.md#getAndRemoveLastItem): Removes and returns the last item from a collection.
  * [pull](MethodDescriptions.md#pull): Removes and returns the item with the specified key from a collection (if it exists) or returns a default value.
  * [getAndRemoveFirstItem](MethodDescriptions.md#getAndRemoveFirstItem): Returns and removes the first item in a collection.
  * [splice](MethodDescriptions.md#splice): Removes and returns in a new collection, a portion of a collection and optionally replaces the removed portion with some specified items.
  * [removeAll](MethodDescriptions.md#removeAll): Removes items from a collection (whose keys are specified) or (all items if no keys were specified).


## Finding or Searching for Items in a Collection
* VersatileCollections\CollectionInterface
  * [filterAll](MethodDescriptions.md#filterAll): Filters out items in the collection via a callback function and returns filtered items in a new collection.
  * [filterFirstN](MethodDescriptions.md#filterFirstN): Filters out the first N items in the collection via a callback function and returns filtered items in a new collection.
  * [searchByVal](MethodDescriptions.md#searchByVal): Searches the collection for a given value and returns the first corresponding key in the collection whose item matches the given value if successful or false if not.
  * [searchAllByVal](MethodDescriptions.md#searchAllByVal): Searches the collection for a given value and returns an array of all corresponding key(s) in the collection whose item(s) match the given value or else returns false.
  * [searchByCallback](MethodDescriptions.md#searchByCallback): Searches the collection using a callback. Returns an array of all corresponding key(s) in the collection for which the callback returns true or else returns false.
  * [getAllWhereKeysIn](MethodDescriptions.md#getAllWhereKeysIn): Returns a new collection of items from an existing collection whose keys are present in the specified keys.
  * [getAllWhereKeysNotIn](MethodDescriptions.md#getAllWhereKeysNotIn): Returns a new collection of items from an existing collection whose keys are not present in the specified keys.
  * [diff](MethodDescriptions.md#diff): Returns a new collection containing items in an existing collection that are not present in the specified array of items.
  * [diffUsing](MethodDescriptions.md#diffUsing): Returns a new collection containing items in an existing collection that are not present in the specified array of items using a specified callback to test for item presence.
  * [diffAssoc](MethodDescriptions.md#diffAssoc): Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items.
  * [diffAssocUsing](MethodDescriptions.md#diffAssocUsing): Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items using a callback to test for key presence.
  * [diffKeys](MethodDescriptions.md#diffKeys): Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items.
  * [diffKeysUsing](MethodDescriptions.md#diffKeysUsing): Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items using a specified callback to test for key presence.
  * [intersectByKeys](MethodDescriptions.md#intersectByKeys): Returns a new collection of items from an existing collection whose keys are present in an array of specified keys.
  * [intersectByItems](MethodDescriptions.md#intersectByItems): Returns a new collection of items from an existing collection that are present in an array of specified items.
  * [intersectByKeysAndItems](MethodDescriptions.md#intersectByKeysAndItems): Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items.
  * [intersectByKeysUsingCallback](MethodDescriptions.md#intersectByKeysUsingCallback): Returns a new collection of items from an existing collection whose keys are present in an array of specified keys using a specified callback for testing key presence.
  * [intersectByItemsUsingCallback](MethodDescriptions.md#intersectByItemsUsingCallback): Returns a new collection of items from an existing collection that are present in an array of specified items using a specified callback for testing item presence.
  * [intersectByKeysAndItemsUsingCallbacks](MethodDescriptions.md#intersectByKeysAndItemsUsingCallbacks): Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items using one specified callback for testing key presence and another specified callback for testing item presence.


## Getting Information about a Collection
* VersatileCollections\CollectionInterface
  * [count](MethodDescriptions.md#count): Returns the number of items in the collection.
  * [getKeys](MethodDescriptions.md#getKeys): Returns a new instance of \VersatileCollections\GenericCollection containing all the keys in the original collection.
  * [isEmpty](MethodDescriptions.md#isEmpty): Returns true if there are one or more items in the collection or false otherwise.


## Looping / Iterating through a Collection
* VersatileCollections\CollectionInterface
  * [getIterator](MethodDescriptions.md#getIterator): Returns an Iterator object that can be used to iterate through the collection.
  * [transform](MethodDescriptions.md#transform): Transforms each item in the collection via a callback function.
  * [reduce](MethodDescriptions.md#reduce): Iteratively reduces the collection items to a single value using a callback function.
  * [reduceWithKeyAccess](MethodDescriptions.md#reduceWithKeyAccess): Iteratively reduces the collection items to a single value using a callback function.
  * [each](MethodDescriptions.md#each): Iterates through a collection and executes a callback over each item.
  * [map](MethodDescriptions.md#map): Applies a callback to the items in a collection and returns a new collection containing all items in the original collection after applying the callback function to each one. The original collection is not modified.


## Modifying the Item(s) in a Collection
* VersatileCollections\CollectionInterface
  * [setValForEachItem](MethodDescriptions.md#setValForEachItem): Sets the specified field in each array or object in the collection to a specified value.
  * [transform](MethodDescriptions.md#transform): Transforms each item in the collection via a callback function.
  * [splice](MethodDescriptions.md#splice): Removes and returns in a new collection, a portion of a collection and optionally replaces the removed portion with some specified items.


## Modifying the Key(s) in a Collection
* VersatileCollections\CollectionInterface
  * [makeAllKeysNumeric](MethodDescriptions.md#makeAllKeysNumeric): Converts all keys in a collection to consecutive integer keys starting from the specified integer value.
  * [getItems](MethodDescriptions.md#getItems): Returns a new collection with all items in the original collection. All the keys in the new collection will be consecutive integer keys starting from zero.
  * [unique](MethodDescriptions.md#unique): Returns a new collection of unique items from an existing collection. This method uses strict comparison for testing uniqueness.


## Ordering or Sorting Items in a Collection
* VersatileCollections\CollectionInterface
  * [reverse](MethodDescriptions.md#reverse): Reverses the order of items in the collection and returns the reversed items in a new collection.
  * [reverseMe](MethodDescriptions.md#reverseMe): Reverses the order of items in the collection. Original collection is modified.
  * [shuffle](MethodDescriptions.md#shuffle): Shuffles all the items in a collection and returns the shuffled items in a new collection. The original collection is not modified.
  * [sort](MethodDescriptions.md#sort): Sorts a collection's items in ascending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortDesc](MethodDescriptions.md#sortDesc): Sorts a collection's items in descending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortByKey](MethodDescriptions.md#sortByKey): Sorts a collection's items by keys in ascending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortDescByKey](MethodDescriptions.md#sortDescByKey): Sorts a collection's items by keys in descending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortByMultipleFields](MethodDescriptions.md#sortByMultipleFields): Sorts a collection of associative arrays or objects by specified field name(s) while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
  * [sortMe](MethodDescriptions.md#sortMe): Sorts a collection's items in ascending order while maintaining key association. The original collection is modified.
  * [sortMeDesc](MethodDescriptions.md#sortMeDesc): Sorts a collection's items in descending order while maintaining key association. The original collection is modified.
  * [sortMeByKey](MethodDescriptions.md#sortMeByKey): Sorts a collection's items by keys in ascending order while maintaining key association. The original collection is modified.
  * [sortMeDescByKey](MethodDescriptions.md#sortMeDescByKey): Sorts a collection's items by keys in descending order while maintaining key association. The original collection is modified.
  * [sortMeByMultipleFields](MethodDescriptions.md#sortMeByMultipleFields): Sorts a collection of associative arrays or objects by specified field name(s) while maintaining key association. The original collection is modified.


## Other Collection Operations
* VersatileCollections\CollectionInterface
  * [pipeAndReturnCallbackResult](MethodDescriptions.md#pipeAndReturnCallbackResult): Executes the given callback on a collection and returns whatever value the callback returned.
  * [pipeAndReturnSelf](MethodDescriptions.md#pipeAndReturnSelf): Executes the given callback on a collection and returns the collection itself.
  * [tap](MethodDescriptions.md#tap): Invokes a specified callback on a copy of a collection and returns the original collection.
  * [whenTrue](MethodDescriptions.md#whenTrue): Conditionally executes a specified callback on a collection if first argument is truthy or executes a specified default callback otherwise and returns the value returned by the executed callback. If no callback could be executed, null is returned.
  * [whenFalse](MethodDescriptions.md#whenFalse): Conditionally executes a specified callback on a collection if first argument is falsy or executes a specified default callback otherwise and returns the value returned by the executed callback. If no callback could be executed, null is returned.
  * [allSatisfyConditions](MethodDescriptions.md#allSatisfyConditions): Iterates through a collection and executes a callback (that returns a boolean) over each item and returns true if the callback returns true for all items or false otherwise.


