<?php
/**
 * Description of Descendant
 *
 * @author rotimi
 */
class Descendant extends Ancestor {
    
    public static function who() {
        
        echo 'Child '. self::class . PHP_EOL;
    }
    
    public function __invoke($name) {
        
        echo 'Hello ', $name, "\n";
    }
    
    public function echoOut($param) {
        
        echo $param;
    }
}
