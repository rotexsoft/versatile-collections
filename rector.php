<?php
declare(strict_types=1);

use Rector\Php74\Rector\Property\TypedPropertyRector;
use Rector\Set\ValueObject\SetList;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfigurator): void {

    // Define what rule sets will be applied
    $rectorConfigurator->import(SetList::PHP_52);
    $rectorConfigurator->import(SetList::PHP_53);
    $rectorConfigurator->import(SetList::PHP_54);
    $rectorConfigurator->import(SetList::PHP_55);
    $rectorConfigurator->import(SetList::PHP_56);
    $rectorConfigurator->import(SetList::PHP_70);
    $rectorConfigurator->import(SetList::PHP_71);
    $rectorConfigurator->import(SetList::PHP_72);
    $rectorConfigurator->import(SetList::PHP_73);
    $rectorConfigurator->import(SetList::PHP_74);
    //$containerConfigurator->import(SetList::PHP_80);
    //$containerConfigurator->import(SetList::PHP_81);
    $rectorConfigurator->import(SetList::DEAD_CODE);
    //$rectorConfigurator->import(SetList::PSR_4);
    $rectorConfigurator->import(SetList::TYPE_DECLARATION);
    
    // get parameters
    //$parameters = $containerConfigurator->parameters();

    // register a single rule
    //$services = $containerConfigurator->services();
    //$services->set(TypedPropertyRector::class);
    
    // get services (needed for register a single rule)
    //$services = $rectorConfigurator->services();
    
    //TODO:PHP8 comment once PHP 8 becomes minimum version
    //$services->remove(Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPromotedPropertyRector::class);
};
