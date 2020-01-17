<?php
declare(strict_types=1);
namespace VersatileCollections;

/**
 * Description of SortParameters
 *
 * @author Rotimi Ade
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
    
    public function __construct(string $field_name, ?int $sort_direction=null, ?int $sort_type=null) {
        
        if( $this->validateFieldName($field_name) ) {
            
            $this->field_name = $field_name;
        }
        
        if( !is_null($sort_direction) && $this->validateSortDirection($sort_direction) ) {
            
            $this->sort_direction = $sort_direction; 
        }
        
        if( !is_null($sort_type) && $this->validateSortType($sort_type) ) {
            
            $this->sort_type = $sort_type;
        }
    }
    
    public function getFieldName(): string {
        
        return $this->field_name;
    }

    public function getSortDirection(): int {
        
        return $this->sort_direction;
    }

    public function getSortType(): int {
        
        return $this->sort_type;
    }

    /**
     * @return mixed[]
     */
    public static function getValidSortDirections(): array {
        
        return static::$valid_sort_directions;
    }

    /**
     * @return mixed[]
     */
    public static function getValidSortTypes(): array {
        
        return static::$valid_sort_types;
    }

    public function setFieldName(string $field_name): self {
        
        if( $this->validateFieldName($field_name) ) {
            
            $this->field_name = $field_name;
        }
        
        return $this;
    }

    public function setSortDirection(int $sort_direction): self {
        
        if ( $this->validateSortDirection($sort_direction) ) {
            
            $this->sort_direction = $sort_direction;
        }
        
        return $this;
    }

    public function setSortType(int $sort_type): self {
        
        if( $this->validateSortType($sort_type) ) {
            
            $this->sort_type = $sort_type;
        }
        
        return $this;
    }
    
    protected function validateFieldName(string $field_name): bool {
        
        if( strlen($field_name) <= 0 ) {
            
            $class = get_class($this);
            $function = __FUNCTION__;
            $msg = "Error [{$class}::{$function}(...)]:Missing \$field_name"
                . " in `{$class}::{$function}(...)` "
                . PHP_EOL . " `\$field_name`: " . var_to_string($field_name);
            
            throw new Exceptions\MissingMultiSortParameterFieldName($msg);
        }
        
        return true;
    }
    
    protected function validateSortDirection(int $sort_direction): bool {
        
        if( !in_array($sort_direction, static::$valid_sort_directions, true) ) {
            
            $class = get_class($this);
            $function = __FUNCTION__;
            $msg = "Error [{$class}::{$function}(...)]:Invalid \$sort_direction supplied to "
                . "`{$class}::{$function}(...)` "
                . PHP_EOL . " `\$sort_direction`: " . var_to_string($sort_direction);
            
            throw new Exceptions\InvalidMultiSortParameterException($msg);
        }
        
        return in_array($sort_direction, static::$valid_sort_directions, true);
    }
    
    protected function validateSortType(int $sort_type): bool {
        
        if( !in_array($sort_type, static::$valid_sort_types, true) ) {
            
            $class = get_class($this);
            $function = __FUNCTION__;
            $msg = "Error [{$class}::{$function}(...)]:Invalid \$sort_type supplied to "
                . "`{$class}::{$function}(...)` "
                . PHP_EOL . " `\$sort_type`: " . var_to_string($sort_type);
            
            throw new Exceptions\InvalidMultiSortParameterException($msg);
        }
        
        return in_array($sort_type, static::$valid_sort_types, true);
    }
}
