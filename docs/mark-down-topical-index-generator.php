<?php
require_once './vendor/autoload.php';
use \VersatileCollections\CollectionInterface;
use \VersatileCollections\ArraysCollection;
use \VersatileCollections\GenericCollection;
use \VersatileCollections\ObjectsCollection;
use \VersatileCollections\StringsCollection;
use \VersatileCollections\StrictlyTypedCollectionInterface;
use function \VersatileCollections\dump_var;

$used_for_tag_descriptions = [
    'accessing-or-extracting-keys-or-items' => "Accessing or Extracting Keys and / or Items in a Collection",
    'adding-items' => "Adding Items to a Collection",
    'adding-methods-at-runtime' => "Adding Methods to a Collection at Runtime",
    'checking-keys-presence' => "Checking if Key(s) exist in a Collection",
    'checking-items-presence' => "Checking if Item(s) exist in a Collection",
    'creating-new-collections' => "Creating Collections",
    'deleting-items' => "Deleting Items from a Collection",
    'finding-or-searching-for-items' => "Finding or Searching for Items in a Collection",
    'getting-collection-meta-data' => "Getting Information about a Collection",
    'iteration' => "Looping / Iterating through a Collection",
    'mathematical-operations' => "Mathematical Operations on Numeric Collections",
    'modifying-keys' => "Modifying the Key(s) in a Collection",
    'modifying-items' => "Modifying the Item(s) in a Collection",
    'ordering-or-sorting-items' => "Ordering or Sorting or Shuffling / Randomizing Items in a Collection",
    'other-operations' => "Other Collection Operations",
];

$doc_block_param_extractor = function($param, $comments, $chars_to_omit_in_value = []) {

    $value = "";
    
    if( !empty($param) && !empty($comments) ) {

        if( !is_string($param) ) { $param = (string)$param; }

        if( !is_string($comments) ) { $comments = (string)$comments; }

        $pos = strpos($comments, $param);

        if( $pos !== false ) {

            $pos += mb_strlen($param, 'UTF-8');

            while( $comments[$pos] !== PHP_EOL && $pos < mb_strlen($comments, 'UTF-8') ) {

                if( !in_array($comments[$pos], $chars_to_omit_in_value) ) {

                    $value .= $comments[$pos];    
                }

                $pos++;
            }

            $value = trim($value);
        } else { $value = null; }
    } else { $value = null; }

    return $value;
};

// first traverse the src directory  and include all *.php files and then get declared classes
$src_path  = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR;
$Directory = new RecursiveDirectoryIterator($src_path);
$Iterator = new RecursiveIteratorIterator($Directory);
$Regex = new RegexIterator($Iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

// include the php files so that classes contained in them will be declared
foreach ($Regex as $file) {

    //echo $file[0] . PHP_EOL;
    include_once $file[0];
    //dump_var($file);
}

$declared_classes_collection = GenericCollection::makeNew(get_declared_classes(), false);
$declared_traits_collection = GenericCollection::makeNew(get_declared_traits(), false);

$methods_by_category_markdown = $declared_classes_collection->filterAll(
    function($key, $item) {

        return is_subclass_of($item, CollectionInterface::class);
    }   
) // get a collection of the name of the classes that have implemented CollectionInterface
->pipeAndReturnCallbackResult(
    
    function(CollectionInterface $collection_of_collection_interface_sub_class_names)use($declared_traits_collection) {
    
        $methods_declared_in_collection_interface = 
            ObjectsCollection::makeNew(
                (new \ReflectionClass(StrictlyTypedCollectionInterface::class))->getMethods(),
                false
            )->getName();
        
        $methods_declared_in_traits_n_not_in_coll_interface = GenericCollection::makeNew();
        $methods_declared_in_traits_n_not_in_coll_interface_by_t_name = [];
        
        $declared_traits_collection->each(
            function ($key, $trait_name) use($methods_declared_in_traits_n_not_in_coll_interface, $methods_declared_in_collection_interface, &$methods_declared_in_traits_n_not_in_coll_interface_by_t_name) {
                
                $methods_2_exclude = ['__construct'];
                $rf_trait = (new \ReflectionClass($trait_name));
//                dump_var("Current Trait: $trait_name");
                
                $methods_declared_in_traits_n_not_in_coll_interface_by_t_name[$trait_name] = 
            
                    GenericCollection::makeNew(
                        ObjectsCollection::makeNew(
                            $rf_trait->getMethods(\ReflectionMethod::IS_PUBLIC),
                            false
                        )
                        ->filterAll(
                            function($key, \ReflectionMethod $current_method)use($rf_trait, $methods_2_exclude) {
                                
                                return $rf_trait->getFileName() === $current_method->getFileName() && !in_array($current_method->getName(), $methods_2_exclude);
                            }
                        ) // get only methods declared in the current trait's source file
                        ->getName()
                    )->diff($methods_declared_in_collection_interface); // get only methods declared in the current trait's source file
                                                                        // that are not declared in StrictlyTypedCollectionInterface
                                                                        // and CollectionInterface
                        
                $methods_declared_in_traits_n_not_in_coll_interface->appendCollection(
                    $methods_declared_in_traits_n_not_in_coll_interface_by_t_name[$trait_name]
                );
                
                $methods_declared_in_traits_n_not_in_coll_interface_by_t_name[$trait_name] =
                    $methods_declared_in_traits_n_not_in_coll_interface_by_t_name[$trait_name]->sort()->toArray();
            }
        );
        
        $methods_declared_in_traits_n_not_in_coll_interface = 
            $methods_declared_in_traits_n_not_in_coll_interface->toArray();
//print_r($methods_declared_in_traits_n_not_in_coll_interface_by_t_name);exit;
        
        $methods_implemented_by_class = [];
        
        $collection_of_collection_interface_sub_class_names->each(
            function($key, $class_name)use(&$methods_implemented_by_class) {
            
                $rfclass = new \ReflectionClass($class_name);
                $methods_2_exclude = ['__construct', 'checkType', 'getType'];

                // get an array of \ReflectionMethod objects for the public methods in 
                // \VersatileCollections\CollectionInterface and create a collection of 
                // \ReflectionMethod objects
                $methods_implemented_by_class[$class_name] = 
                    GenericCollection::makeNew(
                        ObjectsCollection::makeNew($rfclass->getMethods(ReflectionMethod::IS_PUBLIC), false)
                        ->filterAll(
                            function($key, \ReflectionMethod $current_method)use($rfclass, $methods_2_exclude) {
                            
                                return $current_method->getFileName() === $rfclass->getFileName() && (!in_array($current_method->getName(), $methods_2_exclude));
                            }
                        )
                        ->getName() // calls the getName() method on each
                                    // \ReflectionMethod object in the collection
                                    // via __call magic and returns an array of 
                                    // the names.
                                    // see \VersatileCollections\ObjectsCollection::__call();
                    )
                    ->sort()
                    ->toArray();
            }
        );
        
        ksort($methods_implemented_by_class);
        ksort($methods_declared_in_traits_n_not_in_coll_interface_by_t_name);
        
//        print_r($methods_implemented_by_class);
//        print_r($methods_declared_in_traits_n_not_in_coll_interface_by_t_name);
        
        return ArraysCollection::makeNew(array_merge($methods_implemented_by_class, $methods_declared_in_traits_n_not_in_coll_interface_by_t_name));
    }
) // returns a collection whose keys are class or trait names and items are
   // arrays of method names specific to the corresponding class or trait
->pipeAndReturnCallbackResult(
    
    function(CollectionInterface $collection_of_methods_specific_2_classes_n_traits)use($doc_block_param_extractor, $used_for_tag_descriptions) {
//dump_var($collection_of_methods_specific_2_classes_n_traits->toArray());exit;
        $topical_method_map = [];
    
        $methods_declared_in_collection_interface = ObjectsCollection::makeNew(
            (new \ReflectionClass(StrictlyTypedCollectionInterface::class))->getMethods(),
            false
        );
        
        $topical_method_map_updater = function(\ReflectionMethod $method, \ReflectionClass $methods_class=null)use($doc_block_param_extractor, &$topical_method_map) {
            
            if( ($comments = $method->getDocComment()) !== false) {

                $current_methods_name = $method->getName();
                $current_methods_class_name = 
                    is_null($methods_class)
                        ? $method->getDeclaringClass()->getName()
                        : $methods_class->getName();
                $title = $doc_block_param_extractor('@title:', $comments, []); //dump_var($title);
                $used_for_tags_str = $doc_block_param_extractor('@used-for:', $comments, []); //dump_var($used_for_tags_str);

                if($used_for_tags_str !== null) {

                    $used_for_tags = GenericCollection::makeNew( explode(', ', $used_for_tags_str) ); //dump_var($used_for_tags);
                    
                    if($title === null) {

                        $title = $current_methods_name;
                    }

                    $used_for_tags->each(
                        function($k, $tag)use(&$topical_method_map, $title, $current_methods_class_name, $current_methods_name) {

                            if(!array_key_exists($tag, $topical_method_map)) {

                                $topical_method_map[$tag] = [];
                            }

                            $topical_method_map[$tag][$current_methods_class_name][$current_methods_name] = $title;
                            
                        } // function($k, $tag)use(&$topical_method_map, $title, $current_methods_class_name, $current_methods_name)
                    ); // $used_for_tags->each( ... )
                } // if($used_for_tags_str !== null)
            } // if( ($comments = $current_method->getDocComment()) !== false)
        }; // $topical_method_map_updater = function(\ReflectionMethod $current_method, \ReflectionClass $current_methods_class=null)use($doc_block_param_extractor, &$topical_method_map)
        
        $methods_declared_in_collection_interface->each(
            
            function($key, \ReflectionMethod $current_method)use($topical_method_map_updater) {
            
                $topical_method_map_updater($current_method);
                
            } // function($key, \ReflectionMethod $current_method)use($topical_method_map_updater)
        ); // $methods_declared_in_collection_interface->each( ... )
        
        // add methods from other classes to $topical_method_map
        $collection_of_methods_specific_2_classes_n_traits->each(
            
            function($current_methods_class_name, array $method_names)use($topical_method_map_updater) {
            
                $methods_rf_class = new \ReflectionClass($current_methods_class_name);
                
                foreach ($method_names as $method_name) {
                    
                    $current_rf_method_obj = $methods_rf_class->getMethod($method_name);
                    
                    $topical_method_map_updater($current_rf_method_obj, $methods_rf_class);
                }
            
            } // function($current_methods_class_name, array $method_names)use($topical_method_map_updater)
            
        ); // $collection_of_methods_specific_2_classes_n_traits->each( ... )
        
        
        ksort($topical_method_map);
        //dump_var($topical_method_map);
        
        // Generate markdown to be returned
        $topical_method_map_mark_down = '# Collection Methods by Category'.PHP_EOL.PHP_EOL;
        
        foreach ($topical_method_map as $tag=>$tag_data) {
            
            $tag_desc = isset($used_for_tag_descriptions[$tag]) ? $used_for_tag_descriptions[$tag] : $tag;
            
            $topical_method_map_mark_down .= "  * [{$tag_desc}](#{$tag})".PHP_EOL;
        }
        
        $topical_method_map_mark_down .= PHP_EOL.PHP_EOL;
        
        foreach ($topical_method_map as $tag=>$tag_data) {
            
            $tag_desc = isset($used_for_tag_descriptions[$tag]) ? $used_for_tag_descriptions[$tag] : $tag;
            
            $topical_method_map_mark_down .= "------------------------------------------------------------------------------------------------".PHP_EOL;
            $topical_method_map_mark_down .= "<div id=\"{$tag}\"></div>".PHP_EOL.PHP_EOL;
            $topical_method_map_mark_down .= "## $tag_desc".PHP_EOL;
            
            foreach ($tag_data as $class_name => $methods_and_descs) {
             
                $class_name_parts = explode('\\', $class_name);
                $class_name_without_namespace = array_pop($class_name_parts);
                $topical_method_map_mark_down .= "* **`$class_name`**".PHP_EOL;
                
                ksort($methods_and_descs);
                
                foreach ($methods_and_descs as $method => $method_desc) {
                    
                    //$topical_method_map_mark_down .= "* [{$class_name}::{$method}](MethodDescriptions.md#{$method}) : $method_desc".PHP_EOL;
                    $topical_method_map_mark_down .= "  * [{$method}](MethodDescriptions.md#{$class_name_without_namespace}-{$method}): $method_desc".PHP_EOL;
                }
                
                //$topical_method_map_mark_down = substr($topical_method_map_mark_down, 0, -2); //strip last 2 chars (i.e. `, `)
                
                $topical_method_map_mark_down .= PHP_EOL;
            }
            
            $topical_method_map_mark_down .= PHP_EOL;
        }
        
        return $topical_method_map_mark_down;
    }
);

echo $methods_by_category_markdown;
