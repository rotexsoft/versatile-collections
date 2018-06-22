<?php
namespace VersatileCollections;

/**
 * Description of SortParameters
 *
 * @author aadegbam
 */
class MultiSortParameters {
    
    protected $field_name = null;
    protected $sort_direction = SORT_ASC;
    protected $sort_type = SORT_REGULAR;
    
    protected static $valid_sort_directions = [ SORT_ASC, SORT_DESC ];
    
    protected static $valid_sort_types = [
        SORT_REGULAR, SORT_NATURAL, SORT_NUMERIC, SORT_STRING, SORT_LOCALE_STRING,
        SORT_FLAG_CASE, (SORT_FLAG_CASE | SORT_STRING), (SORT_FLAG_CASE | SORT_NATURAL)
    ];
    
    public function __construct($field_name, $sort_direction=null, $sort_type=null) {
        
        if( !is_string($field_name) ) {
            
            $class = get_class($this);
            $function = __FUNCTION__;
            $msg = "Error [{$class}::{$function}(...)]:Invalid \$field_name supplied to "
                . "`{$class}::{$function}(...)` "
                . PHP_EOL . " `\$field_name`: " . var_to_string($field_name);
            
            throw new Exceptions\InvalidMultiSortParameter($msg);
            
        } else if( strlen($field_name) <= 0 ) {
            
            $class = get_class($this);
            $function = __FUNCTION__;
            $msg = "Error [{$class}::{$function}(...)]:Missing \$field_name"
                . " in `{$class}::{$function}(...)` "
                . PHP_EOL . " `\$field_name`: " . var_to_string($field_name);
            
            throw new Exceptions\MissingMultiSortParameterFieldName($msg);
            
        } else {
            
            $this->field_name = $field_name;
        }
        
        if( in_array($sort_direction, static::$valid_sort_directions, true) ) {
            
            $this->sort_direction = $sort_direction;
            
        } else if( 
            !in_array($sort_direction, static::$valid_sort_directions, true) 
            && !is_null($sort_direction)
        ) {
            $class = get_class($this);
            $function = __FUNCTION__;
            $msg = "Error [{$class}::{$function}(...)]:Invalid \$sort_direction supplied to "
                . "`{$class}::{$function}(...)` "
                . PHP_EOL . " `\$sort_direction`: " . var_to_string($sort_direction);
            
            throw new Exceptions\InvalidMultiSortParameter($msg);
        }
        
        if( in_array($sort_type, static::$valid_sort_types, true) ) {
            
            $this->sort_type = $sort_type;
            
        } else if( 
            !in_array($sort_type, static::$valid_sort_types, true) 
            && !is_null($sort_type)
        ) {
            $class = get_class($this);
            $function = __FUNCTION__;
            $msg = "Error [{$class}::{$function}(...)]:Invalid \$sort_type supplied to "
                . "`{$class}::{$function}(...)` "
                . PHP_EOL . " `\$sort_type`: " . var_to_string($sort_type);
            
            throw new Exceptions\InvalidMultiSortParameter($msg);
        }
    }
    
    public function getFieldName() {
        
        return $this->field_name;
    }

    public function getSortDirection() {
        
        return $this->sort_direction;
    }

    public function getSortType() {
        
        return $this->sort_type;
    }

    public static function getValidSortDirections() {
        
        return static::$valid_sort_directions;
    }

    public static function getValidSortTypes() {
        
        return static::$valid_sort_types;
    }

    public function setFieldName($field_name) {
        
        $this->field_name = $field_name;
        
        return $this;
    }

    public function setSortDirection($sort_direction) {
        
        $this->sort_direction = $sort_direction;
        
        return $this;
    }

    public function setSortType($sort_type) {
        
        $this->sort_type = $sort_type;
        
        return $this;
    }
}
