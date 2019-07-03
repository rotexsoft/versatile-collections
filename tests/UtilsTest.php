<?php
use VersatileCollections\Utils;

/**
 * Description of ArraysCollectionTest
 *
 * @author aadegbam
 */
class UtilsTest extends \PHPUnit\Framework\TestCase{
    
    protected function setUp() { 
        
        parent::setUp();
    }

    public function testThatGetClosureFromCallableWorksAsExpected() {
        
        $this->assertTrue(
            Utils::getClosureFromCallable('my_callback_function') instanceof \Closure
        ); // from non-anonymous & non-class function
        
        $this->assertTrue(
            Utils::getClosureFromCallable([\Ancestor::class, 'who']) instanceof \Closure    
        ); // static method call on a class
        
        $this->assertTrue(
            Utils::getClosureFromCallable([ (new \Descendant() ), 'echoOut']) instanceof \Closure    
        ); // instance method call on a class instance
        
        $this->assertTrue(
            Utils::getClosureFromCallable(\Descendant::class.'::who') instanceof \Closure    
        ); // static method call string syntax
        
        $this->assertTrue(
            Utils::getClosureFromCallable([\Descendant::class, 'parent::who']) instanceof \Closure    
        ); // parent class' static method call
        
        $this->assertTrue(
            Utils::getClosureFromCallable( (new \Descendant()) ) instanceof \Closure    
        ); // instance of class that has __invoke()
        
        $anon_func = function($a) {
            return $a * 2;
        };
        $this->assertTrue(
            Utils::getClosureFromCallable($anon_func) instanceof \Closure    
        ); // anonymous function a.k.a Closure
    }

    /**
     * 
     * @expectedException \InvalidArgumentException
     * 
     */
    public function testThatBindObjectAndScopeToClosureWorksAsExpected() {
        
        $this->assertTrue(
            Utils::getClosureFromCallable('my_callback_function') instanceof \Closure
        ); // from non-anonymous & non-class function
        
        $this->assertTrue(
            Utils::getClosureFromCallable([\Ancestor::class, 'who']) instanceof \Closure    
        ); // static method call on a class
        
        $this->assertTrue(
            Utils::getClosureFromCallable([ (new \Descendant() ), 'echoOut']) instanceof \Closure    
        ); // instance method call on a class instance
        
        $this->assertTrue(
            Utils::getClosureFromCallable(\Descendant::class.'::who') instanceof \Closure    
        ); // static method call string syntax
        
        $this->assertTrue(
            Utils::getClosureFromCallable([\Descendant::class, 'parent::who']) instanceof \Closure    
        ); // parent class' static method call
        
        $this->assertTrue(
            Utils::getClosureFromCallable( (new \Descendant()) ) instanceof \Closure    
        ); // instance of class that has __invoke()
        
        $anon_func = function($a) {
            return $a * 2;
        };
        $this->assertTrue(
            Utils::bindObjectAndScopeToClosure($anon_func, $this) instanceof \Closure    
        ); // anonymous function a.k.a Closure
        
        // Code should generate Exception: binding $this to a static Closure
        Utils::bindObjectAndScopeToClosure(
            Utils::getClosureFromCallable([\Ancestor::class, 'who']), 
            $this
        );
    }
    
    public function testThatGetExceptionAsStrWorksAsExpected() {
        
        $e1 = new \DescendantException('Descendant Thrown', 911);
        $e2 = new \AncestorException('Ancestor Thrown', 777, $e1);
        $e3 = new \Exception('Base Thrown', 187, $e2);
        
        $ex_as_str = Utils::getExceptionAsStr($e3);

        $this->assertContains('187', $ex_as_str);
        $this->assertContains('Base Thrown', $ex_as_str);
        $this->assertContains('777', $ex_as_str);
        $this->assertContains('AncestorException', $ex_as_str);
        $this->assertContains('Ancestor Thrown', $ex_as_str);
        $this->assertContains('911', $ex_as_str);
        $this->assertContains('DescendantException', $ex_as_str);
        $this->assertContains('Descendant Thrown', $ex_as_str);
    }
}

function my_callback_function() { echo 'hello world!'; }