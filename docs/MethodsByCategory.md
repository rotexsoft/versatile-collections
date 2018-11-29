# Collection Methods by Category

## Accessing or Extracting Keys and / or Items in a Collection
* [VersatileCollections\CollectionInterface::__get](MethodDescriptions.md#__get) : Retrieves an item associated with a specified key in the collection.
* [VersatileCollections\CollectionInterface::offsetGet](MethodDescriptions.md#offsetGet) : Retrieves an item associated with a specified key in the collection.
* [VersatileCollections\CollectionInterface::toArray](MethodDescriptions.md#toArray) : Returns all items in the collection and their corresponding keys in an array.
* [VersatileCollections\CollectionInterface::firstItem](MethodDescriptions.md#firstItem) : Returns the first item in the collection or null if the collection is empty.
* [VersatileCollections\CollectionInterface::lastItem](MethodDescriptions.md#lastItem) : Returns the last item in the collection or null if the collection is empty.
* [VersatileCollections\CollectionInterface::getKeys](MethodDescriptions.md#getKeys) : Returns a new instance of \VersatileCollections\GenericCollection containing all the keys in the original collection.
* [VersatileCollections\CollectionInterface::reduce](MethodDescriptions.md#reduce) : Iteratively reduces the collection items to a single value using a callback function.
* [VersatileCollections\CollectionInterface::reduceWithKeyAccess](MethodDescriptions.md#reduceWithKeyAccess) : Iteratively reduces the collection items to a single value using a callback function.
* [VersatileCollections\CollectionInterface::getIfExists](MethodDescriptions.md#getIfExists) : Returns the item in the collection with the specified key (if such an item exists) or the specified default value otherwise.
* [VersatileCollections\CollectionInterface::getItems](MethodDescriptions.md#getItems) : Returns a new collection with all items in the original collection. All the keys in the new collection will be consecutive integer keys starting from zero.
* [VersatileCollections\CollectionInterface::each](MethodDescriptions.md#each) : Iterates through a collection and executes a callback over each item.
* [VersatileCollections\CollectionInterface::map](MethodDescriptions.md#map) : Applies a callback to the items in a collection and returns a new collection containing all items in the original collection after applying the callback function to each one. The original collection is not modified.
* [VersatileCollections\CollectionInterface::getAndRemoveLastItem](MethodDescriptions.md#getAndRemoveLastItem) : Removes and returns the last item from a collection.
* [VersatileCollections\CollectionInterface::pull](MethodDescriptions.md#pull) : Removes and returns the item with the specified key from a collection (if it exists) or returns a default value.
* [VersatileCollections\CollectionInterface::randomKey](MethodDescriptions.md#randomKey) : Gets one key randomly from a collection.
* [VersatileCollections\CollectionInterface::randomItem](MethodDescriptions.md#randomItem) : Gets one item randomly from a collection.
* [VersatileCollections\CollectionInterface::randomKeys](MethodDescriptions.md#randomKeys) : Gets a specified number of unique keys randomly from a collection and returns them in a new collection.
* [VersatileCollections\CollectionInterface::randomItems](MethodDescriptions.md#randomItems) : Gets a specified number of items randomly from a collection and returns them in a new collection.
* [VersatileCollections\CollectionInterface::searchByVal](MethodDescriptions.md#searchByVal) : Searches the collection for a given value and returns the first corresponding key in the collection whose item matches the given value if successful or false if not.
* [VersatileCollections\CollectionInterface::searchAllByVal](MethodDescriptions.md#searchAllByVal) : Searches the collection for a given value and returns an array of all corresponding key(s) in the collection whose item(s) match the given value or else returns false.
* [VersatileCollections\CollectionInterface::searchByCallback](MethodDescriptions.md#searchByCallback) : Searches the collection using a callback. Returns an array of all corresponding key(s) in the collection for which the callback returns true or else returns false.
* [VersatileCollections\CollectionInterface::getAndRemoveFirstItem](MethodDescriptions.md#getAndRemoveFirstItem) : Returns and removes the first item in a collection.
* [VersatileCollections\CollectionInterface::slice](MethodDescriptions.md#slice) : Extracts a slice from a collection and returns the slice as a new collection. The original collection is not modified.
* [VersatileCollections\CollectionInterface::splice](MethodDescriptions.md#splice) : Removes and returns in a new collection, a portion of a collection and optionally replaces the removed portion with some specified items.
* [VersatileCollections\CollectionInterface::take](MethodDescriptions.md#take) : Returns the first or last specified number of items in a collection in a new collection. Original collection is not modified.
* [VersatileCollections\CollectionInterface::unique](MethodDescriptions.md#unique) : Returns a new collection of unique items from an existing collection. This method uses strict comparison for testing uniqueness.
* [VersatileCollections\CollectionInterface::column](MethodDescriptions.md#column) : Returns a new collection containing the values from a specified field in each item in a collection. Corresponding keys in the returned collection could be specified as another field in each item in the collection. MUST be a collection whose items are arrays and / or objects.
* [VersatileCollections\CollectionInterface::getAllWhereKeysIn](MethodDescriptions.md#getAllWhereKeysIn) : Returns a new collection of items from an existing collection whose keys are present in the specified keys.
* [VersatileCollections\CollectionInterface::getAllWhereKeysNotIn](MethodDescriptions.md#getAllWhereKeysNotIn) : Returns a new collection of items from an existing collection whose keys are not present in the specified keys.
* [VersatileCollections\CollectionInterface::paginate](MethodDescriptions.md#paginate) : Returns a new collection of at most a specified number of items present in the specified page.
* [VersatileCollections\CollectionInterface::diff](MethodDescriptions.md#diff) : Returns a new collection containing items in an existing collection that are not present in the specified array of items.
* [VersatileCollections\CollectionInterface::diffUsing](MethodDescriptions.md#diffUsing) : Returns a new collection containing items in an existing collection that are not present in the specified array of items using a specified callback to test for item presence.
* [VersatileCollections\CollectionInterface::diffAssoc](MethodDescriptions.md#diffAssoc) : Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items.
* [VersatileCollections\CollectionInterface::diffAssocUsing](MethodDescriptions.md#diffAssocUsing) : Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items using a callback to test for key presence.
* [VersatileCollections\CollectionInterface::diffKeys](MethodDescriptions.md#diffKeys) : Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items.
* [VersatileCollections\CollectionInterface::diffKeysUsing](MethodDescriptions.md#diffKeysUsing) : Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items using a specified callback to test for key presence.
* [VersatileCollections\CollectionInterface::intersectByKeys](MethodDescriptions.md#intersectByKeys) : Returns a new collection of items from an existing collection whose keys are present in an array of specified keys.
* [VersatileCollections\CollectionInterface::intersectByItems](MethodDescriptions.md#intersectByItems) : Returns a new collection of items from an existing collection that are present in an array of specified items.
* [VersatileCollections\CollectionInterface::intersectByKeysAndItems](MethodDescriptions.md#intersectByKeysAndItems) : Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items.
* [VersatileCollections\CollectionInterface::intersectByKeysUsingCallback](MethodDescriptions.md#intersectByKeysUsingCallback) : Returns a new collection of items from an existing collection whose keys are present in an array of specified keys using a specified callback for testing key presence.
* [VersatileCollections\CollectionInterface::intersectByItemsUsingCallback](MethodDescriptions.md#intersectByItemsUsingCallback) : Returns a new collection of items from an existing collection that are present in an array of specified items using a specified callback for testing item presence.
* [VersatileCollections\CollectionInterface::intersectByKeysAndItemsUsingCallbacks](MethodDescriptions.md#intersectByKeysAndItemsUsingCallbacks) : Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items using one specified callback for testing key presence and another specified callback for testing item presence.

## Adding Items to a Collection
* [VersatileCollections\CollectionInterface::__set](MethodDescriptions.md#__set) : Adds an item with a specified key to the collection.
* [VersatileCollections\CollectionInterface::offsetSet](MethodDescriptions.md#offsetSet) : Adds an item with a specified key to the collection.
* [VersatileCollections\CollectionInterface::appendCollection](MethodDescriptions.md#appendCollection) : Appends all items from a specified collection to the end of a collection. Note that appended items will be assigned numeric keys.
* [VersatileCollections\CollectionInterface::appendItem](MethodDescriptions.md#appendItem) : Appends a specified item to the end of a collection.
* [VersatileCollections\CollectionInterface::prependCollection](MethodDescriptions.md#prependCollection) : Prepends all items from a specified collection to the front of a collection.
* [VersatileCollections\CollectionInterface::prependItem](MethodDescriptions.md#prependItem) : Prepends a specified item (with a specified key, if specified) to the front of a collection.
* [VersatileCollections\CollectionInterface::mergeWith](MethodDescriptions.md#mergeWith) : Adds all specified items to a collection and returns a new collection containing the result. The original collection is not modified. New items with the same keys as existing items will overwrite the existing items.
* [VersatileCollections\CollectionInterface::mergeMeWith](MethodDescriptions.md#mergeMeWith) : Adds all specified items to a collection. The original collection is modified. New items with the same keys as existing items will overwrite the existing items.
* [VersatileCollections\CollectionInterface::push](MethodDescriptions.md#push) : Appends a specified item to the end of a collection.
* [VersatileCollections\CollectionInterface::put](MethodDescriptions.md#put) : Adds a specified key and item pair to a collection. If the specified key already exists, the specified item will overwrite the existing item.
* [VersatileCollections\CollectionInterface::unionWith](MethodDescriptions.md#unionWith) : Appends specified items to a collection and returns the result in a new collection. New items with the same keys as existing items will not overwrite the existing items. Original collection is not modified.
* [VersatileCollections\CollectionInterface::unionMeWith](MethodDescriptions.md#unionMeWith) : Appends specified items to a collection. New items with the same keys as existing items will not overwrite the existing items. Original collection is modified.

## Checking if Item(s) exist in a Collection
* [VersatileCollections\CollectionInterface::__isset](MethodDescriptions.md#__isset) : Checks if an item with a specified key exists in the collection.
* [VersatileCollections\CollectionInterface::offsetExists](MethodDescriptions.md#offsetExists) : Checks if an item with a specified key exists in the collection.
* [VersatileCollections\CollectionInterface::getIfExists](MethodDescriptions.md#getIfExists) : Returns the item in the collection with the specified key (if such an item exists) or the specified default value otherwise.
* [VersatileCollections\CollectionInterface::containsItem](MethodDescriptions.md#containsItem) : Checks if a collection contains a specified item (using strict comparison).
* [VersatileCollections\CollectionInterface::containsItemWithKey](MethodDescriptions.md#containsItemWithKey) : Checks if a collection contains a specified item (using strict comparison) together with the specified key.
* [VersatileCollections\CollectionInterface::containsItems](MethodDescriptions.md#containsItems) : Checks if a collection contains all specified items (using strict comparison for each comparison).

## Checking if Key(s) exist in a Collection
* [VersatileCollections\CollectionInterface::containsItemWithKey](MethodDescriptions.md#containsItemWithKey) : Checks if a collection contains a specified item (using strict comparison) together with the specified key.
* [VersatileCollections\CollectionInterface::containsKey](MethodDescriptions.md#containsKey) : Checks if a collection contains a specified key.
* [VersatileCollections\CollectionInterface::containsKeys](MethodDescriptions.md#containsKeys) : Checks if a collection contains all specified keys.

## Creating Collections
* [VersatileCollections\CollectionInterface::makeNew](MethodDescriptions.md#makeNew) : Creates a new collection from an array of items. Items must be rightly typed if collection class is strictly typed.
* [VersatileCollections\CollectionInterface::getKeys](MethodDescriptions.md#getKeys) : Returns a new instance of \VersatileCollections\GenericCollection containing all the keys in the original collection.
* [VersatileCollections\CollectionInterface::filterAll](MethodDescriptions.md#filterAll) : Filters out items in the collection via a callback function and returns filtered items in a new collection.
* [VersatileCollections\CollectionInterface::filterFirstN](MethodDescriptions.md#filterFirstN) : Filters out the first N items in the collection via a callback function and returns filtered items in a new collection.
* [VersatileCollections\CollectionInterface::reverse](MethodDescriptions.md#reverse) : Reverses the order of items in the collection and returns the reversed items in a new collection.
* [VersatileCollections\CollectionInterface::mergeWith](MethodDescriptions.md#mergeWith) : Adds all specified items to a collection and returns a new collection containing the result. The original collection is not modified. New items with the same keys as existing items will overwrite the existing items.
* [VersatileCollections\CollectionInterface::yieldCollectionsOfSizeN](MethodDescriptions.md#yieldCollectionsOfSizeN) : Returns a generator that yields collections each having a specified maximum number of items. Original keys are preserved in each returned collection.
* [VersatileCollections\CollectionInterface::getCollectionsOfSizeN](MethodDescriptions.md#getCollectionsOfSizeN) : Returns a collection of collections; with each sub-collection having a specified maximum number of items. Original keys are preserved in each sub-collection.
* [VersatileCollections\CollectionInterface::getItems](MethodDescriptions.md#getItems) : Returns a new collection with all items in the original collection. All the keys in the new collection will be consecutive integer keys starting from zero.
* [VersatileCollections\CollectionInterface::map](MethodDescriptions.md#map) : Applies a callback to the items in a collection and returns a new collection containing all items in the original collection after applying the callback function to each one. The original collection is not modified.
* [VersatileCollections\CollectionInterface::everyNth](MethodDescriptions.md#everyNth) : Creates a new collection consisting of every n-th element in a collection.
* [VersatileCollections\CollectionInterface::shuffle](MethodDescriptions.md#shuffle) : Shuffles all the items in a collection and returns the shuffled items in a new collection. The original collection is not modified.
* [VersatileCollections\CollectionInterface::slice](MethodDescriptions.md#slice) : Extracts a slice from a collection and returns the slice as a new collection. The original collection is not modified.
* [VersatileCollections\CollectionInterface::sort](MethodDescriptions.md#sort) : Sorts a collection's items in ascending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
* [VersatileCollections\CollectionInterface::sortDesc](MethodDescriptions.md#sortDesc) : Sorts a collection's items in descending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
* [VersatileCollections\CollectionInterface::sortByKey](MethodDescriptions.md#sortByKey) : Sorts a collection's items by keys in ascending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
* [VersatileCollections\CollectionInterface::sortDescByKey](MethodDescriptions.md#sortDescByKey) : Sorts a collection's items by keys in descending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
* [VersatileCollections\CollectionInterface::sortByMultipleFields](MethodDescriptions.md#sortByMultipleFields) : Sorts a collection of associative arrays or objects by specified field name(s) while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
* [VersatileCollections\CollectionInterface::splice](MethodDescriptions.md#splice) : Removes and returns in a new collection, a portion of a collection and optionally replaces the removed portion with some specified items.
* [VersatileCollections\CollectionInterface::split](MethodDescriptions.md#split) : Splits a collection into a specified number of collections and returns a collection containing those collections.
* [VersatileCollections\CollectionInterface::take](MethodDescriptions.md#take) : Returns the first or last specified number of items in a collection in a new collection. Original collection is not modified.
* [VersatileCollections\CollectionInterface::unionWith](MethodDescriptions.md#unionWith) : Appends specified items to a collection and returns the result in a new collection. New items with the same keys as existing items will not overwrite the existing items. Original collection is not modified.
* [VersatileCollections\CollectionInterface::unique](MethodDescriptions.md#unique) : Returns a new collection of unique items from an existing collection. This method uses strict comparison for testing uniqueness.
* [VersatileCollections\CollectionInterface::getAsNewType](MethodDescriptions.md#getAsNewType) : Creates a new collection of the specified type with the keys and items from an existing collection. The specified collection type MUST be compatible with the existing collection's type.
* [VersatileCollections\CollectionInterface::getAllWhereKeysIn](MethodDescriptions.md#getAllWhereKeysIn) : Returns a new collection of items from an existing collection whose keys are present in the specified keys.
* [VersatileCollections\CollectionInterface::getAllWhereKeysNotIn](MethodDescriptions.md#getAllWhereKeysNotIn) : Returns a new collection of items from an existing collection whose keys are not present in the specified keys.
* [VersatileCollections\CollectionInterface::paginate](MethodDescriptions.md#paginate) : Returns a new collection of at most a specified number of items present in the specified page.
* [VersatileCollections\CollectionInterface::diff](MethodDescriptions.md#diff) : Returns a new collection containing items in an existing collection that are not present in the specified array of items.
* [VersatileCollections\CollectionInterface::diffUsing](MethodDescriptions.md#diffUsing) : Returns a new collection containing items in an existing collection that are not present in the specified array of items using a specified callback to test for item presence.
* [VersatileCollections\CollectionInterface::diffAssoc](MethodDescriptions.md#diffAssoc) : Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items.
* [VersatileCollections\CollectionInterface::diffAssocUsing](MethodDescriptions.md#diffAssocUsing) : Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items using a callback to test for key presence.
* [VersatileCollections\CollectionInterface::diffKeys](MethodDescriptions.md#diffKeys) : Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items.
* [VersatileCollections\CollectionInterface::diffKeysUsing](MethodDescriptions.md#diffKeysUsing) : Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items using a specified callback to test for key presence.
* [VersatileCollections\CollectionInterface::intersectByKeys](MethodDescriptions.md#intersectByKeys) : Returns a new collection of items from an existing collection whose keys are present in an array of specified keys.
* [VersatileCollections\CollectionInterface::intersectByItems](MethodDescriptions.md#intersectByItems) : Returns a new collection of items from an existing collection that are present in an array of specified items.
* [VersatileCollections\CollectionInterface::intersectByKeysAndItems](MethodDescriptions.md#intersectByKeysAndItems) : Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items.
* [VersatileCollections\CollectionInterface::intersectByKeysUsingCallback](MethodDescriptions.md#intersectByKeysUsingCallback) : Returns a new collection of items from an existing collection whose keys are present in an array of specified keys using a specified callback for testing key presence.
* [VersatileCollections\CollectionInterface::intersectByItemsUsingCallback](MethodDescriptions.md#intersectByItemsUsingCallback) : Returns a new collection of items from an existing collection that are present in an array of specified items using a specified callback for testing item presence.
* [VersatileCollections\CollectionInterface::intersectByKeysAndItemsUsingCallbacks](MethodDescriptions.md#intersectByKeysAndItemsUsingCallbacks) : Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items using one specified callback for testing key presence and another specified callback for testing item presence.

## Deleting Items from a Collection
* [VersatileCollections\CollectionInterface::__unset](MethodDescriptions.md#__unset) : Removes an item associated with the specified key from the collection.
* [VersatileCollections\CollectionInterface::offsetUnset](MethodDescriptions.md#offsetUnset) : Removes an item associated with the specified key from the collection.
* [VersatileCollections\CollectionInterface::getAndRemoveLastItem](MethodDescriptions.md#getAndRemoveLastItem) : Removes and returns the last item from a collection.
* [VersatileCollections\CollectionInterface::pull](MethodDescriptions.md#pull) : Removes and returns the item with the specified key from a collection (if it exists) or returns a default value.
* [VersatileCollections\CollectionInterface::getAndRemoveFirstItem](MethodDescriptions.md#getAndRemoveFirstItem) : Returns and removes the first item in a collection.
* [VersatileCollections\CollectionInterface::splice](MethodDescriptions.md#splice) : Removes and returns in a new collection, a portion of a collection and optionally replaces the removed portion with some specified items.
* [VersatileCollections\CollectionInterface::removeAll](MethodDescriptions.md#removeAll) : Removes items from a collection (whose keys are specified) or (all items if no keys were specified).

## Finding or Searching for Items in a Collection
* [VersatileCollections\CollectionInterface::filterAll](MethodDescriptions.md#filterAll) : Filters out items in the collection via a callback function and returns filtered items in a new collection.
* [VersatileCollections\CollectionInterface::filterFirstN](MethodDescriptions.md#filterFirstN) : Filters out the first N items in the collection via a callback function and returns filtered items in a new collection.
* [VersatileCollections\CollectionInterface::searchByVal](MethodDescriptions.md#searchByVal) : Searches the collection for a given value and returns the first corresponding key in the collection whose item matches the given value if successful or false if not.
* [VersatileCollections\CollectionInterface::searchAllByVal](MethodDescriptions.md#searchAllByVal) : Searches the collection for a given value and returns an array of all corresponding key(s) in the collection whose item(s) match the given value or else returns false.
* [VersatileCollections\CollectionInterface::searchByCallback](MethodDescriptions.md#searchByCallback) : Searches the collection using a callback. Returns an array of all corresponding key(s) in the collection for which the callback returns true or else returns false.
* [VersatileCollections\CollectionInterface::getAllWhereKeysIn](MethodDescriptions.md#getAllWhereKeysIn) : Returns a new collection of items from an existing collection whose keys are present in the specified keys.
* [VersatileCollections\CollectionInterface::getAllWhereKeysNotIn](MethodDescriptions.md#getAllWhereKeysNotIn) : Returns a new collection of items from an existing collection whose keys are not present in the specified keys.
* [VersatileCollections\CollectionInterface::diff](MethodDescriptions.md#diff) : Returns a new collection containing items in an existing collection that are not present in the specified array of items.
* [VersatileCollections\CollectionInterface::diffUsing](MethodDescriptions.md#diffUsing) : Returns a new collection containing items in an existing collection that are not present in the specified array of items using a specified callback to test for item presence.
* [VersatileCollections\CollectionInterface::diffAssoc](MethodDescriptions.md#diffAssoc) : Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items.
* [VersatileCollections\CollectionInterface::diffAssocUsing](MethodDescriptions.md#diffAssocUsing) : Returns a new collection containing items in an existing collection whose keys and values are not present in the specified array of items using a callback to test for key presence.
* [VersatileCollections\CollectionInterface::diffKeys](MethodDescriptions.md#diffKeys) : Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items.
* [VersatileCollections\CollectionInterface::diffKeysUsing](MethodDescriptions.md#diffKeysUsing) : Returns a new collection containing items in an existing collection whose keys are not present in the specified array of items using a specified callback to test for key presence.
* [VersatileCollections\CollectionInterface::intersectByKeys](MethodDescriptions.md#intersectByKeys) : Returns a new collection of items from an existing collection whose keys are present in an array of specified keys.
* [VersatileCollections\CollectionInterface::intersectByItems](MethodDescriptions.md#intersectByItems) : Returns a new collection of items from an existing collection that are present in an array of specified items.
* [VersatileCollections\CollectionInterface::intersectByKeysAndItems](MethodDescriptions.md#intersectByKeysAndItems) : Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items.
* [VersatileCollections\CollectionInterface::intersectByKeysUsingCallback](MethodDescriptions.md#intersectByKeysUsingCallback) : Returns a new collection of items from an existing collection whose keys are present in an array of specified keys using a specified callback for testing key presence.
* [VersatileCollections\CollectionInterface::intersectByItemsUsingCallback](MethodDescriptions.md#intersectByItemsUsingCallback) : Returns a new collection of items from an existing collection that are present in an array of specified items using a specified callback for testing item presence.
* [VersatileCollections\CollectionInterface::intersectByKeysAndItemsUsingCallbacks](MethodDescriptions.md#intersectByKeysAndItemsUsingCallbacks) : Returns a new collection of items from an existing collection whose keys and corresponding items are present in an array of specified items using one specified callback for testing key presence and another specified callback for testing item presence.

## Getting Information about a Collection
* [VersatileCollections\CollectionInterface::count](MethodDescriptions.md#count) : Returns the number of items in the collection.
* [VersatileCollections\CollectionInterface::getKeys](MethodDescriptions.md#getKeys) : Returns a new instance of \VersatileCollections\GenericCollection containing all the keys in the original collection.
* [VersatileCollections\CollectionInterface::isEmpty](MethodDescriptions.md#isEmpty) : Returns true if there are one or more items in the collection or false otherwise.

## Looping / Iterating through a Collection
* [VersatileCollections\CollectionInterface::getIterator](MethodDescriptions.md#getIterator) : Returns an Iterator object that can be used to iterate through the collection.
* [VersatileCollections\CollectionInterface::transform](MethodDescriptions.md#transform) : Transforms each item in the collection via a callback function.
* [VersatileCollections\CollectionInterface::reduce](MethodDescriptions.md#reduce) : Iteratively reduces the collection items to a single value using a callback function.
* [VersatileCollections\CollectionInterface::reduceWithKeyAccess](MethodDescriptions.md#reduceWithKeyAccess) : Iteratively reduces the collection items to a single value using a callback function.
* [VersatileCollections\CollectionInterface::each](MethodDescriptions.md#each) : Iterates through a collection and executes a callback over each item.
* [VersatileCollections\CollectionInterface::map](MethodDescriptions.md#map) : Applies a callback to the items in a collection and returns a new collection containing all items in the original collection after applying the callback function to each one. The original collection is not modified.

## Modifying the Item(s) in a Collection
* [VersatileCollections\CollectionInterface::setValForEachItem](MethodDescriptions.md#setValForEachItem) : Sets the specified field in each array or object in the collection to a specified value.
* [VersatileCollections\CollectionInterface::transform](MethodDescriptions.md#transform) : Transforms each item in the collection via a callback function.
* [VersatileCollections\CollectionInterface::splice](MethodDescriptions.md#splice) : Removes and returns in a new collection, a portion of a collection and optionally replaces the removed portion with some specified items.

## Modifying the Key(s) in a Collection
* [VersatileCollections\CollectionInterface::makeAllKeysNumeric](MethodDescriptions.md#makeAllKeysNumeric) : Converts all keys in a collection to consecutive integer keys starting from the specified integer value.
* [VersatileCollections\CollectionInterface::getItems](MethodDescriptions.md#getItems) : Returns a new collection with all items in the original collection. All the keys in the new collection will be consecutive integer keys starting from zero.
* [VersatileCollections\CollectionInterface::unique](MethodDescriptions.md#unique) : Returns a new collection of unique items from an existing collection. This method uses strict comparison for testing uniqueness.

## Ordering or Sorting Items in a Collection
* [VersatileCollections\CollectionInterface::reverse](MethodDescriptions.md#reverse) : Reverses the order of items in the collection and returns the reversed items in a new collection.
* [VersatileCollections\CollectionInterface::reverseMe](MethodDescriptions.md#reverseMe) : Reverses the order of items in the collection. Original collection is modified.
* [VersatileCollections\CollectionInterface::shuffle](MethodDescriptions.md#shuffle) : Shuffles all the items in a collection and returns the shuffled items in a new collection. The original collection is not modified.
* [VersatileCollections\CollectionInterface::sort](MethodDescriptions.md#sort) : Sorts a collection's items in ascending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
* [VersatileCollections\CollectionInterface::sortDesc](MethodDescriptions.md#sortDesc) : Sorts a collection's items in descending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
* [VersatileCollections\CollectionInterface::sortByKey](MethodDescriptions.md#sortByKey) : Sorts a collection's items by keys in ascending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
* [VersatileCollections\CollectionInterface::sortDescByKey](MethodDescriptions.md#sortDescByKey) : Sorts a collection's items by keys in descending order while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
* [VersatileCollections\CollectionInterface::sortByMultipleFields](MethodDescriptions.md#sortByMultipleFields) : Sorts a collection of associative arrays or objects by specified field name(s) while maintaining key association. A new collection containing the sorted items is returned. The original collection is not modified.
* [VersatileCollections\CollectionInterface::sortMe](MethodDescriptions.md#sortMe) : Sorts a collection's items in ascending order while maintaining key association. The original collection is modified.
* [VersatileCollections\CollectionInterface::sortMeDesc](MethodDescriptions.md#sortMeDesc) : Sorts a collection's items in descending order while maintaining key association. The original collection is modified.
* [VersatileCollections\CollectionInterface::sortMeByKey](MethodDescriptions.md#sortMeByKey) : Sorts a collection's items by keys in ascending order while maintaining key association. The original collection is modified.
* [VersatileCollections\CollectionInterface::sortMeDescByKey](MethodDescriptions.md#sortMeDescByKey) : Sorts a collection's items by keys in descending order while maintaining key association. The original collection is modified.
* [VersatileCollections\CollectionInterface::sortMeByMultipleFields](MethodDescriptions.md#sortMeByMultipleFields) : Sorts a collection of associative arrays or objects by specified field name(s) while maintaining key association. The original collection is modified.

## Other Collection Operations
* [VersatileCollections\CollectionInterface::pipeAndReturnCallbackResult](MethodDescriptions.md#pipeAndReturnCallbackResult) : Executes the given callback on a collection and returns whatever value the callback returned.
* [VersatileCollections\CollectionInterface::pipeAndReturnSelf](MethodDescriptions.md#pipeAndReturnSelf) : Executes the given callback on a collection and returns the collection itself.
* [VersatileCollections\CollectionInterface::tap](MethodDescriptions.md#tap) : Invokes a specified callback on a copy of a collection and returns the original collection.
* [VersatileCollections\CollectionInterface::whenTrue](MethodDescriptions.md#whenTrue) : Conditionally executes a specified callback on a collection if first argument is truthy or executes a specified default callback otherwise and returns the value returned by the executed callback. If no callback could be executed, null is returned.
* [VersatileCollections\CollectionInterface::whenFalse](MethodDescriptions.md#whenFalse) : Conditionally executes a specified callback on a collection if first argument is falsy or executes a specified default callback otherwise and returns the value returned by the executed callback. If no callback could be executed, null is returned.
* [VersatileCollections\CollectionInterface::allSatisfyConditions](MethodDescriptions.md#allSatisfyConditions) : Iterates through a collection and executes a callback (that returns a boolean) over each item and returns true if the callback returns true for all items or false otherwise.

