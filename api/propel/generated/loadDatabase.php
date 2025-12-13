<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMapFromDumps(array (
  'default' => 
  array (
    'tablesByName' => 
    array (
      'Tasks' => '\\Models\\Map\\TasksTableMap',
    ),
    'tablesByPhpName' => 
    array (
      '\\Tasks' => '\\Models\\Map\\TasksTableMap',
    ),
  ),
));
