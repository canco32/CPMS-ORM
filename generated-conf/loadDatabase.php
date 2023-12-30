<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMapFromDumps(array (
  'default' => 
  array (
    'tablesByName' => 
    array (
      'department' => '\\Map\\DepartmentTableMap',
      'employees' => '\\Map\\EmployeesTableMap',
      'project' => '\\Map\\ProjectTableMap',
      'tasks' => '\\Map\\TasksTableMap',
    ),
    'tablesByPhpName' => 
    array (
      '\\Department' => '\\Map\\DepartmentTableMap',
      '\\Employees' => '\\Map\\EmployeesTableMap',
      '\\Project' => '\\Map\\ProjectTableMap',
      '\\Tasks' => '\\Map\\TasksTableMap',
    ),
  ),
));
