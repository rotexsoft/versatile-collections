<?php
require_once './vendor/autoload.php';
use \VersatileCollections\ObjectsCollection;
use \VersatileCollections\StringsCollection;

$class = new \ReflectionClass(\VersatileCollections\CollectionInterface::class);

// get an array of \ReflectionMethod objects for the public methods in 
// \VersatileCollections\CollectionInterface
$interface_public_methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);

// Create a collection of \ReflectionMethod objects
$interface_methods_collection = 
    ObjectsCollection::makeNew($interface_public_methods);

// A callback that accepts a $collection of strings (in this case method names)
// and generates a mark down table with 3 columns from the collection.
$generateMarkDownTableFromStringCollectionOfMethodNames = function($collection) {

    // We want to generate a markdown table with three columns
    // let's calculate the maximum amount of items for each column.
    $max_col_length = ceil( $collection->count() / 3 );

    // Split the collection of all method names in to 3 collections
    // each having at most $max_col_length items
    $collection_of_3_columns = $collection->getCollectionsOfSizeN($max_col_length);

    // extract the 3 collections
    $collection_of_1st_col_items = $collection_of_3_columns->getAndRemoveFirstItem();
    $collection_of_2nd_col_items = $collection_of_3_columns->getAndRemoveFirstItem();
    $collection_of_3rd_col_items = $collection_of_3_columns->getAndRemoveFirstItem();

    $max_width_calculator = function ($carry, $item) {

        // because each mark down table cell will
        // potentially contain a link in the format below:
        //  "[{$item}](#{$item})"
        // we need to calculate the length of $item multiplied by 2
        // plus the following extra characters `[`, `]`, `(`, `#` and `)` 
        // plus two extra spaces (which is how we get the number 7 we are
        // adding)
        $current_item_length = ((strlen($item) * 2) + 7);

        return $carry > $current_item_length 
                ? $carry : $current_item_length;
    };

    $max_width_of_1st_column = $collection_of_1st_col_items->reduce(
        $max_width_calculator,
        -1 // Initial value of $carry (a negative length, which no string can possibly have)
    );

    $max_width_of_2nd_column = $collection_of_2nd_col_items->reduce(
        $max_width_calculator,
        -1 // start with a negative length, which no string can possibly have  
    );

    $max_width_of_3rd_column = $collection_of_3rd_col_items->reduce(
        $max_width_calculator,
        -1 // start with a negative length, which no string can possibly have 
    );

    $mark_down_table = ''.PHP_EOL;

    // generate table headers
    $mark_down_table .= '|'. str_repeat(' ', $max_width_of_1st_column);// column 1
    $mark_down_table .= '|'. str_repeat(' ', $max_width_of_2nd_column);// column 2
    $mark_down_table .= '|'. str_repeat(' ', $max_width_of_3rd_column);// column 3
    $mark_down_table .= '|'. PHP_EOL; // end row

    $mark_down_table .= '|---'. str_repeat(' ', $max_width_of_1st_column - 3);// column 1
    $mark_down_table .= '|---'. str_repeat(' ', $max_width_of_2nd_column - 3);// column 2
    $mark_down_table .= '|---'. str_repeat(' ', $max_width_of_3rd_column - 3);// column 3
    $mark_down_table .= '|'. PHP_EOL; // end row

    $generate_cell_content = function($current_method_name, $max_width_of_column) {

        $toc_link_for_column = 
            "[{$current_method_name}](#{$current_method_name})";
            
        $num_spaces_at_cell_end = 
            ($max_width_of_column - strlen($toc_link_for_column));

        return '|'. $toc_link_for_column
              . 
              (
                ( $num_spaces_at_cell_end > 0 )
                    ? str_repeat(' ', $num_spaces_at_cell_end ) : ''
              );
    };

    // loop through the three column collections in parallel
    $collection_of_1st_col_items->each(
        function($key, $_1st_column_method_name)
        use(
            &$mark_down_table, // by Ref because we want changes to affect original variable
            $generate_cell_content,
            $max_width_of_1st_column, $max_width_of_2nd_column, 
            $max_width_of_3rd_column, $collection_of_2nd_col_items, 
            $collection_of_3rd_col_items
        ) {
            // generate next cell for 1st column
            $mark_down_table .= $generate_cell_content(
                $_1st_column_method_name,
                $max_width_of_1st_column
            );

            // generate next cell for 2nd column
            $mark_down_table .= $generate_cell_content(
                $collection_of_2nd_col_items->getAndRemoveFirstItem(),
                $max_width_of_2nd_column
            );

            // generate next cell for 3rd column
            // The 3rd column could be shorter than the first two
            if( $collection_of_3rd_col_items->isEmpty() ) {

                // spit out blank cell
                $mark_down_table .= '|'. str_repeat(' ', $max_width_of_3rd_column);// column 3

            } else {

                $mark_down_table .= $generate_cell_content(
                    $collection_of_3rd_col_items->getAndRemoveFirstItem(),
                    $max_width_of_3rd_column
                );
            }

            $mark_down_table .= '|'. PHP_EOL; // end row

        } // function($key, $_1st_column_method_name) use .....
    ); // $collection_of_1st_col_items->each( ....

    return $mark_down_table.PHP_EOL;
    
}; // function($collection)

$mark_down_table_of_contents = 
    $interface_methods_collection->pipeAndReturnCallbackResult(
        function($collection) {

            return StringsCollection::makeNew(
                $collection->getName() // calls the getName() method on each
                                       // \ReflectionMethod object in $collection
                                       // via __call magic and returns an array of 
                                       // the names.
                                       // see \VersatileCollections\ObjectsCollection::__call()
            );
        }
    ) // at this point we have extracted the method names from the collection of
      // \ReflectionMethod objects. These method names are now in a new 
      // \VersatileCollections\StringsCollection instance
        
    ->sortMe() // we now sort the string collection in ascending order
            
    ->pipeAndReturnCallbackResult(
        $generateMarkDownTableFromStringCollectionOfMethodNames // our callback
    ); // return table of contents at this point

echo $mark_down_table_of_contents; // spit out the mark down table