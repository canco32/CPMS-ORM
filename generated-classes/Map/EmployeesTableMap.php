<?php

namespace Map;

use \Employees;
use \EmployeesQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'employees' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EmployeesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '.Map.EmployeesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'employees';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Employees';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Employees';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Employees';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'employees.employee_id';

    /**
     * the column name for the employee_name field
     */
    public const COL_EMPLOYEE_NAME = 'employees.employee_name';

    /**
     * the column name for the employee_position field
     */
    public const COL_EMPLOYEE_POSITION = 'employees.employee_position';

    /**
     * the column name for the employee_department field
     */
    public const COL_EMPLOYEE_DEPARTMENT = 'employees.employee_department';

    /**
     * the column name for the employee_salary field
     */
    public const COL_EMPLOYEE_SALARY = 'employees.employee_salary';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['EmployeeId', 'EmployeeName', 'EmployeePosition', 'EmployeeDepartment', 'EmployeeSalary', ],
        self::TYPE_CAMELNAME     => ['employeeId', 'employeeName', 'employeePosition', 'employeeDepartment', 'employeeSalary', ],
        self::TYPE_COLNAME       => [EmployeesTableMap::COL_EMPLOYEE_ID, EmployeesTableMap::COL_EMPLOYEE_NAME, EmployeesTableMap::COL_EMPLOYEE_POSITION, EmployeesTableMap::COL_EMPLOYEE_DEPARTMENT, EmployeesTableMap::COL_EMPLOYEE_SALARY, ],
        self::TYPE_FIELDNAME     => ['employee_id', 'employee_name', 'employee_position', 'employee_department', 'employee_salary', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['EmployeeId' => 0, 'EmployeeName' => 1, 'EmployeePosition' => 2, 'EmployeeDepartment' => 3, 'EmployeeSalary' => 4, ],
        self::TYPE_CAMELNAME     => ['employeeId' => 0, 'employeeName' => 1, 'employeePosition' => 2, 'employeeDepartment' => 3, 'employeeSalary' => 4, ],
        self::TYPE_COLNAME       => [EmployeesTableMap::COL_EMPLOYEE_ID => 0, EmployeesTableMap::COL_EMPLOYEE_NAME => 1, EmployeesTableMap::COL_EMPLOYEE_POSITION => 2, EmployeesTableMap::COL_EMPLOYEE_DEPARTMENT => 3, EmployeesTableMap::COL_EMPLOYEE_SALARY => 4, ],
        self::TYPE_FIELDNAME     => ['employee_id' => 0, 'employee_name' => 1, 'employee_position' => 2, 'employee_department' => 3, 'employee_salary' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'EmployeeId' => 'EMPLOYEE_ID',
        'Employees.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'employees.employeeId' => 'EMPLOYEE_ID',
        'EmployeesTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'employees.employee_id' => 'EMPLOYEE_ID',
        'EmployeeName' => 'EMPLOYEE_NAME',
        'Employees.EmployeeName' => 'EMPLOYEE_NAME',
        'employeeName' => 'EMPLOYEE_NAME',
        'employees.employeeName' => 'EMPLOYEE_NAME',
        'EmployeesTableMap::COL_EMPLOYEE_NAME' => 'EMPLOYEE_NAME',
        'COL_EMPLOYEE_NAME' => 'EMPLOYEE_NAME',
        'employee_name' => 'EMPLOYEE_NAME',
        'employees.employee_name' => 'EMPLOYEE_NAME',
        'EmployeePosition' => 'EMPLOYEE_POSITION',
        'Employees.EmployeePosition' => 'EMPLOYEE_POSITION',
        'employeePosition' => 'EMPLOYEE_POSITION',
        'employees.employeePosition' => 'EMPLOYEE_POSITION',
        'EmployeesTableMap::COL_EMPLOYEE_POSITION' => 'EMPLOYEE_POSITION',
        'COL_EMPLOYEE_POSITION' => 'EMPLOYEE_POSITION',
        'employee_position' => 'EMPLOYEE_POSITION',
        'employees.employee_position' => 'EMPLOYEE_POSITION',
        'EmployeeDepartment' => 'EMPLOYEE_DEPARTMENT',
        'Employees.EmployeeDepartment' => 'EMPLOYEE_DEPARTMENT',
        'employeeDepartment' => 'EMPLOYEE_DEPARTMENT',
        'employees.employeeDepartment' => 'EMPLOYEE_DEPARTMENT',
        'EmployeesTableMap::COL_EMPLOYEE_DEPARTMENT' => 'EMPLOYEE_DEPARTMENT',
        'COL_EMPLOYEE_DEPARTMENT' => 'EMPLOYEE_DEPARTMENT',
        'employee_department' => 'EMPLOYEE_DEPARTMENT',
        'employees.employee_department' => 'EMPLOYEE_DEPARTMENT',
        'EmployeeSalary' => 'EMPLOYEE_SALARY',
        'Employees.EmployeeSalary' => 'EMPLOYEE_SALARY',
        'employeeSalary' => 'EMPLOYEE_SALARY',
        'employees.employeeSalary' => 'EMPLOYEE_SALARY',
        'EmployeesTableMap::COL_EMPLOYEE_SALARY' => 'EMPLOYEE_SALARY',
        'COL_EMPLOYEE_SALARY' => 'EMPLOYEE_SALARY',
        'employee_salary' => 'EMPLOYEE_SALARY',
        'employees.employee_salary' => 'EMPLOYEE_SALARY',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('employees');
        $this->setPhpName('Employees');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Employees');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('employees_employee_id_seq');
        // columns
        $this->addPrimaryKey('employee_id', 'EmployeeId', 'INTEGER', true, null, null);
        $this->addColumn('employee_name', 'EmployeeName', 'VARCHAR', true, null, null);
        $this->addColumn('employee_position', 'EmployeePosition', 'VARCHAR', true, null, null);
        $this->addForeignKey('employee_department', 'EmployeeDepartment', 'INTEGER', 'department', 'department_id', true, null, null);
        $this->addColumn('employee_salary', 'EmployeeSalary', 'VARCHAR', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Department', '\\Department', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employee_department',
    1 => ':department_id',
  ),
), null, null, null, false);
        $this->addRelation('Tasks', '\\Tasks', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':task_employee',
    1 => ':employee_id',
  ),
), null, null, 'Taskss', false);
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? EmployeesTableMap::CLASS_DEFAULT : EmployeesTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (Employees object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EmployeesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmployeesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmployeesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmployeesTableMap::OM_CLASS;
            /** @var Employees $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmployeesTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = EmployeesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmployeesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Employees $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmployeesTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(EmployeesTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(EmployeesTableMap::COL_EMPLOYEE_NAME);
            $criteria->addSelectColumn(EmployeesTableMap::COL_EMPLOYEE_POSITION);
            $criteria->addSelectColumn(EmployeesTableMap::COL_EMPLOYEE_DEPARTMENT);
            $criteria->addSelectColumn(EmployeesTableMap::COL_EMPLOYEE_SALARY);
        } else {
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.employee_name');
            $criteria->addSelectColumn($alias . '.employee_position');
            $criteria->addSelectColumn($alias . '.employee_department');
            $criteria->addSelectColumn($alias . '.employee_salary');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(EmployeesTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(EmployeesTableMap::COL_EMPLOYEE_NAME);
            $criteria->removeSelectColumn(EmployeesTableMap::COL_EMPLOYEE_POSITION);
            $criteria->removeSelectColumn(EmployeesTableMap::COL_EMPLOYEE_DEPARTMENT);
            $criteria->removeSelectColumn(EmployeesTableMap::COL_EMPLOYEE_SALARY);
        } else {
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.employee_name');
            $criteria->removeSelectColumn($alias . '.employee_position');
            $criteria->removeSelectColumn($alias . '.employee_department');
            $criteria->removeSelectColumn($alias . '.employee_salary');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(EmployeesTableMap::DATABASE_NAME)->getTable(EmployeesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Employees or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Employees object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Employees) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmployeesTableMap::DATABASE_NAME);
            $criteria->add(EmployeesTableMap::COL_EMPLOYEE_ID, (array) $values, Criteria::IN);
        }

        $query = EmployeesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmployeesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmployeesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the employees table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EmployeesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Employees or Criteria object.
     *
     * @param mixed $criteria Criteria or Employees object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Employees object
        }

        if ($criteria->containsKey(EmployeesTableMap::COL_EMPLOYEE_ID) && $criteria->keyContainsValue(EmployeesTableMap::COL_EMPLOYEE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EmployeesTableMap::COL_EMPLOYEE_ID.')');
        }


        // Set the correct dbName
        $query = EmployeesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
