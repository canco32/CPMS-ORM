<?php

namespace Map;

use \Tasks;
use \TasksQuery;
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
 * This class defines the structure of the 'tasks' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class TasksTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '.Map.TasksTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'tasks';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Tasks';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Tasks';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Tasks';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the task_id field
     */
    public const COL_TASK_ID = 'tasks.task_id';

    /**
     * the column name for the task_name field
     */
    public const COL_TASK_NAME = 'tasks.task_name';

    /**
     * the column name for the task_project field
     */
    public const COL_TASK_PROJECT = 'tasks.task_project';

    /**
     * the column name for the task_employee field
     */
    public const COL_TASK_EMPLOYEE = 'tasks.task_employee';

    /**
     * the column name for the task_date field
     */
    public const COL_TASK_DATE = 'tasks.task_date';

    /**
     * the column name for the task_deadline field
     */
    public const COL_TASK_DEADLINE = 'tasks.task_deadline';

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
        self::TYPE_PHPNAME       => ['TaskId', 'TaskName', 'TaskProject', 'TaskEmployee', 'TaskDate', 'TaskDeadline', ],
        self::TYPE_CAMELNAME     => ['taskId', 'taskName', 'taskProject', 'taskEmployee', 'taskDate', 'taskDeadline', ],
        self::TYPE_COLNAME       => [TasksTableMap::COL_TASK_ID, TasksTableMap::COL_TASK_NAME, TasksTableMap::COL_TASK_PROJECT, TasksTableMap::COL_TASK_EMPLOYEE, TasksTableMap::COL_TASK_DATE, TasksTableMap::COL_TASK_DEADLINE, ],
        self::TYPE_FIELDNAME     => ['task_id', 'task_name', 'task_project', 'task_employee', 'task_date', 'task_deadline', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['TaskId' => 0, 'TaskName' => 1, 'TaskProject' => 2, 'TaskEmployee' => 3, 'TaskDate' => 4, 'TaskDeadline' => 5, ],
        self::TYPE_CAMELNAME     => ['taskId' => 0, 'taskName' => 1, 'taskProject' => 2, 'taskEmployee' => 3, 'taskDate' => 4, 'taskDeadline' => 5, ],
        self::TYPE_COLNAME       => [TasksTableMap::COL_TASK_ID => 0, TasksTableMap::COL_TASK_NAME => 1, TasksTableMap::COL_TASK_PROJECT => 2, TasksTableMap::COL_TASK_EMPLOYEE => 3, TasksTableMap::COL_TASK_DATE => 4, TasksTableMap::COL_TASK_DEADLINE => 5, ],
        self::TYPE_FIELDNAME     => ['task_id' => 0, 'task_name' => 1, 'task_project' => 2, 'task_employee' => 3, 'task_date' => 4, 'task_deadline' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'TaskId' => 'TASK_ID',
        'Tasks.TaskId' => 'TASK_ID',
        'taskId' => 'TASK_ID',
        'tasks.taskId' => 'TASK_ID',
        'TasksTableMap::COL_TASK_ID' => 'TASK_ID',
        'COL_TASK_ID' => 'TASK_ID',
        'task_id' => 'TASK_ID',
        'tasks.task_id' => 'TASK_ID',
        'TaskName' => 'TASK_NAME',
        'Tasks.TaskName' => 'TASK_NAME',
        'taskName' => 'TASK_NAME',
        'tasks.taskName' => 'TASK_NAME',
        'TasksTableMap::COL_TASK_NAME' => 'TASK_NAME',
        'COL_TASK_NAME' => 'TASK_NAME',
        'task_name' => 'TASK_NAME',
        'tasks.task_name' => 'TASK_NAME',
        'TaskProject' => 'TASK_PROJECT',
        'Tasks.TaskProject' => 'TASK_PROJECT',
        'taskProject' => 'TASK_PROJECT',
        'tasks.taskProject' => 'TASK_PROJECT',
        'TasksTableMap::COL_TASK_PROJECT' => 'TASK_PROJECT',
        'COL_TASK_PROJECT' => 'TASK_PROJECT',
        'task_project' => 'TASK_PROJECT',
        'tasks.task_project' => 'TASK_PROJECT',
        'TaskEmployee' => 'TASK_EMPLOYEE',
        'Tasks.TaskEmployee' => 'TASK_EMPLOYEE',
        'taskEmployee' => 'TASK_EMPLOYEE',
        'tasks.taskEmployee' => 'TASK_EMPLOYEE',
        'TasksTableMap::COL_TASK_EMPLOYEE' => 'TASK_EMPLOYEE',
        'COL_TASK_EMPLOYEE' => 'TASK_EMPLOYEE',
        'task_employee' => 'TASK_EMPLOYEE',
        'tasks.task_employee' => 'TASK_EMPLOYEE',
        'TaskDate' => 'TASK_DATE',
        'Tasks.TaskDate' => 'TASK_DATE',
        'taskDate' => 'TASK_DATE',
        'tasks.taskDate' => 'TASK_DATE',
        'TasksTableMap::COL_TASK_DATE' => 'TASK_DATE',
        'COL_TASK_DATE' => 'TASK_DATE',
        'task_date' => 'TASK_DATE',
        'tasks.task_date' => 'TASK_DATE',
        'TaskDeadline' => 'TASK_DEADLINE',
        'Tasks.TaskDeadline' => 'TASK_DEADLINE',
        'taskDeadline' => 'TASK_DEADLINE',
        'tasks.taskDeadline' => 'TASK_DEADLINE',
        'TasksTableMap::COL_TASK_DEADLINE' => 'TASK_DEADLINE',
        'COL_TASK_DEADLINE' => 'TASK_DEADLINE',
        'task_deadline' => 'TASK_DEADLINE',
        'tasks.task_deadline' => 'TASK_DEADLINE',
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
        $this->setName('tasks');
        $this->setPhpName('Tasks');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Tasks');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('tasks_task_id_seq');
        // columns
        $this->addPrimaryKey('task_id', 'TaskId', 'INTEGER', true, null, null);
        $this->addColumn('task_name', 'TaskName', 'VARCHAR', true, null, null);
        $this->addForeignKey('task_project', 'TaskProject', 'INTEGER', 'project', 'project_id', true, null, null);
        $this->addForeignKey('task_employee', 'TaskEmployee', 'INTEGER', 'employees', 'employee_id', true, null, null);
        $this->addColumn('task_date', 'TaskDate', 'TIMESTAMP', true, null, null);
        $this->addColumn('task_deadline', 'TaskDeadline', 'TIMESTAMP', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Employees', '\\Employees', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':task_employee',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('Project', '\\Project', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':task_project',
    1 => ':project_id',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TaskId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TaskId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TaskId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TaskId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TaskId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TaskId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('TaskId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? TasksTableMap::CLASS_DEFAULT : TasksTableMap::OM_CLASS;
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
     * @return array (Tasks object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = TasksTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TasksTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TasksTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TasksTableMap::OM_CLASS;
            /** @var Tasks $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TasksTableMap::addInstanceToPool($obj, $key);
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
            $key = TasksTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TasksTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Tasks $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TasksTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TasksTableMap::COL_TASK_ID);
            $criteria->addSelectColumn(TasksTableMap::COL_TASK_NAME);
            $criteria->addSelectColumn(TasksTableMap::COL_TASK_PROJECT);
            $criteria->addSelectColumn(TasksTableMap::COL_TASK_EMPLOYEE);
            $criteria->addSelectColumn(TasksTableMap::COL_TASK_DATE);
            $criteria->addSelectColumn(TasksTableMap::COL_TASK_DEADLINE);
        } else {
            $criteria->addSelectColumn($alias . '.task_id');
            $criteria->addSelectColumn($alias . '.task_name');
            $criteria->addSelectColumn($alias . '.task_project');
            $criteria->addSelectColumn($alias . '.task_employee');
            $criteria->addSelectColumn($alias . '.task_date');
            $criteria->addSelectColumn($alias . '.task_deadline');
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
            $criteria->removeSelectColumn(TasksTableMap::COL_TASK_ID);
            $criteria->removeSelectColumn(TasksTableMap::COL_TASK_NAME);
            $criteria->removeSelectColumn(TasksTableMap::COL_TASK_PROJECT);
            $criteria->removeSelectColumn(TasksTableMap::COL_TASK_EMPLOYEE);
            $criteria->removeSelectColumn(TasksTableMap::COL_TASK_DATE);
            $criteria->removeSelectColumn(TasksTableMap::COL_TASK_DEADLINE);
        } else {
            $criteria->removeSelectColumn($alias . '.task_id');
            $criteria->removeSelectColumn($alias . '.task_name');
            $criteria->removeSelectColumn($alias . '.task_project');
            $criteria->removeSelectColumn($alias . '.task_employee');
            $criteria->removeSelectColumn($alias . '.task_date');
            $criteria->removeSelectColumn($alias . '.task_deadline');
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
        return Propel::getServiceContainer()->getDatabaseMap(TasksTableMap::DATABASE_NAME)->getTable(TasksTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Tasks or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Tasks object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TasksTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Tasks) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TasksTableMap::DATABASE_NAME);
            $criteria->add(TasksTableMap::COL_TASK_ID, (array) $values, Criteria::IN);
        }

        $query = TasksQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TasksTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TasksTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tasks table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return TasksQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Tasks or Criteria object.
     *
     * @param mixed $criteria Criteria or Tasks object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TasksTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Tasks object
        }

        if ($criteria->containsKey(TasksTableMap::COL_TASK_ID) && $criteria->keyContainsValue(TasksTableMap::COL_TASK_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TasksTableMap::COL_TASK_ID.')');
        }


        // Set the correct dbName
        $query = TasksQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
