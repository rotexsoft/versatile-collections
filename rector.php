<?php

declare(strict_types=1);

use Rector\Php74\Rector\Property\TypedPropertyRector;
use Rector\Set\ValueObject\SetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {

    // Define what rule sets will be applied
    $containerConfigurator->import(SetList::DEAD_CODE);
    $containerConfigurator->import(SetList::PHP_72);
    $containerConfigurator->import(SetList::PHP_73);
    //$containerConfigurator->import(SetList::PHP_74);
    //$containerConfigurator->import(SetList::PHP_80);
    $containerConfigurator->import(SetList::PSR_4);
    $containerConfigurator->import(SetList::TYPE_DECLARATION);
    
    // get parameters
    //$parameters = $containerConfigurator->parameters();

    // register a single rule
    //$services = $containerConfigurator->services();
    //$services->set(TypedPropertyRector::class);
};
