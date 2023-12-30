<?php

namespace Base;

use \Tasks as ChildTasks;
use \TasksQuery as ChildTasksQuery;
use \Exception;
use \PDO;
use Map\TasksTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `tasks` table.
 *
 * @method     ChildTasksQuery orderByTaskId($order = Criteria::ASC) Order by the task_id column
 * @method     ChildTasksQuery orderByTaskName($order = Criteria::ASC) Order by the task_name column
 * @method     ChildTasksQuery orderByTaskProject($order = Criteria::ASC) Order by the task_project column
 * @method     ChildTasksQuery orderByTaskEmployee($order = Criteria::ASC) Order by the task_employee column
 * @method     ChildTasksQuery orderByTaskDate($order = Criteria::ASC) Order by the task_date column
 * @method     ChildTasksQuery orderByTaskDeadline($order = Criteria::ASC) Order by the task_deadline column
 *
 * @method     ChildTasksQuery groupByTaskId() Group by the task_id column
 * @method     ChildTasksQuery groupByTaskName() Group by the task_name column
 * @method     ChildTasksQuery groupByTaskProject() Group by the task_project column
 * @method     ChildTasksQuery groupByTaskEmployee() Group by the task_employee column
 * @method     ChildTasksQuery groupByTaskDate() Group by the task_date column
 * @method     ChildTasksQuery groupByTaskDeadline() Group by the task_deadline column
 *
 * @method     ChildTasksQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTasksQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTasksQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTasksQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTasksQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTasksQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTasksQuery leftJoinEmployees($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employees relation
 * @method     ChildTasksQuery rightJoinEmployees($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employees relation
 * @method     ChildTasksQuery innerJoinEmployees($relationAlias = null) Adds a INNER JOIN clause to the query using the Employees relation
 *
 * @method     ChildTasksQuery joinWithEmployees($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employees relation
 *
 * @method     ChildTasksQuery leftJoinWithEmployees() Adds a LEFT JOIN clause and with to the query using the Employees relation
 * @method     ChildTasksQuery rightJoinWithEmployees() Adds a RIGHT JOIN clause and with to the query using the Employees relation
 * @method     ChildTasksQuery innerJoinWithEmployees() Adds a INNER JOIN clause and with to the query using the Employees relation
 *
 * @method     ChildTasksQuery leftJoinProject($relationAlias = null) Adds a LEFT JOIN clause to the query using the Project relation
 * @method     ChildTasksQuery rightJoinProject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Project relation
 * @method     ChildTasksQuery innerJoinProject($relationAlias = null) Adds a INNER JOIN clause to the query using the Project relation
 *
 * @method     ChildTasksQuery joinWithProject($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Project relation
 *
 * @method     ChildTasksQuery leftJoinWithProject() Adds a LEFT JOIN clause and with to the query using the Project relation
 * @method     ChildTasksQuery rightJoinWithProject() Adds a RIGHT JOIN clause and with to the query using the Project relation
 * @method     ChildTasksQuery innerJoinWithProject() Adds a INNER JOIN clause and with to the query using the Project relation
 *
 * @method     \EmployeesQuery|\ProjectQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTasks|null findOne(?ConnectionInterface $con = null) Return the first ChildTasks matching the query
 * @method     ChildTasks findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTasks matching the query, or a new ChildTasks object populated from the query conditions when no match is found
 *
 * @method     ChildTasks|null findOneByTaskId(int $task_id) Return the first ChildTasks filtered by the task_id column
 * @method     ChildTasks|null findOneByTaskName(string $task_name) Return the first ChildTasks filtered by the task_name column
 * @method     ChildTasks|null findOneByTaskProject(int $task_project) Return the first ChildTasks filtered by the task_project column
 * @method     ChildTasks|null findOneByTaskEmployee(int $task_employee) Return the first ChildTasks filtered by the task_employee column
 * @method     ChildTasks|null findOneByTaskDate(string $task_date) Return the first ChildTasks filtered by the task_date column
 * @method     ChildTasks|null findOneByTaskDeadline(string $task_deadline) Return the first ChildTasks filtered by the task_deadline column
 *
 * @method     ChildTasks requirePk($key, ?ConnectionInterface $con = null) Return the ChildTasks by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTasks requireOne(?ConnectionInterface $con = null) Return the first ChildTasks matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTasks requireOneByTaskId(int $task_id) Return the first ChildTasks filtered by the task_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTasks requireOneByTaskName(string $task_name) Return the first ChildTasks filtered by the task_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTasks requireOneByTaskProject(int $task_project) Return the first ChildTasks filtered by the task_project column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTasks requireOneByTaskEmployee(int $task_employee) Return the first ChildTasks filtered by the task_employee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTasks requireOneByTaskDate(string $task_date) Return the first ChildTasks filtered by the task_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTasks requireOneByTaskDeadline(string $task_deadline) Return the first ChildTasks filtered by the task_deadline column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTasks[]|Collection find(?ConnectionInterface $con = null) Return ChildTasks objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildTasks> find(?ConnectionInterface $con = null) Return ChildTasks objects based on current ModelCriteria
 *
 * @method     ChildTasks[]|Collection findByTaskId(int|array<int> $task_id) Return ChildTasks objects filtered by the task_id column
 * @psalm-method Collection&\Traversable<ChildTasks> findByTaskId(int|array<int> $task_id) Return ChildTasks objects filtered by the task_id column
 * @method     ChildTasks[]|Collection findByTaskName(string|array<string> $task_name) Return ChildTasks objects filtered by the task_name column
 * @psalm-method Collection&\Traversable<ChildTasks> findByTaskName(string|array<string> $task_name) Return ChildTasks objects filtered by the task_name column
 * @method     ChildTasks[]|Collection findByTaskProject(int|array<int> $task_project) Return ChildTasks objects filtered by the task_project column
 * @psalm-method Collection&\Traversable<ChildTasks> findByTaskProject(int|array<int> $task_project) Return ChildTasks objects filtered by the task_project column
 * @method     ChildTasks[]|Collection findByTaskEmployee(int|array<int> $task_employee) Return ChildTasks objects filtered by the task_employee column
 * @psalm-method Collection&\Traversable<ChildTasks> findByTaskEmployee(int|array<int> $task_employee) Return ChildTasks objects filtered by the task_employee column
 * @method     ChildTasks[]|Collection findByTaskDate(string|array<string> $task_date) Return ChildTasks objects filtered by the task_date column
 * @psalm-method Collection&\Traversable<ChildTasks> findByTaskDate(string|array<string> $task_date) Return ChildTasks objects filtered by the task_date column
 * @method     ChildTasks[]|Collection findByTaskDeadline(string|array<string> $task_deadline) Return ChildTasks objects filtered by the task_deadline column
 * @psalm-method Collection&\Traversable<ChildTasks> findByTaskDeadline(string|array<string> $task_deadline) Return ChildTasks objects filtered by the task_deadline column
 *
 * @method     ChildTasks[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTasks> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class TasksQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\TasksQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tasks', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTasksQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTasksQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTasksQuery) {
            return $criteria;
        }
        $query = new ChildTasksQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildTasks|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TasksTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TasksTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTasks A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT task_id, task_name, task_project, task_employee, task_date, task_deadline FROM tasks WHERE task_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildTasks $obj */
            $obj = new ChildTasks();
            $obj->hydrate($row);
            TasksTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildTasks|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(TasksTableMap::COL_TASK_ID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(TasksTableMap::COL_TASK_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the task_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTaskId(1234); // WHERE task_id = 1234
     * $query->filterByTaskId(array(12, 34)); // WHERE task_id IN (12, 34)
     * $query->filterByTaskId(array('min' => 12)); // WHERE task_id > 12
     * </code>
     *
     * @param mixed $taskId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaskId($taskId = null, ?string $comparison = null)
    {
        if (is_array($taskId)) {
            $useMinMax = false;
            if (isset($taskId['min'])) {
                $this->addUsingAlias(TasksTableMap::COL_TASK_ID, $taskId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taskId['max'])) {
                $this->addUsingAlias(TasksTableMap::COL_TASK_ID, $taskId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TasksTableMap::COL_TASK_ID, $taskId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the task_name column
     *
     * Example usage:
     * <code>
     * $query->filterByTaskName('fooValue');   // WHERE task_name = 'fooValue'
     * $query->filterByTaskName('%fooValue%', Criteria::LIKE); // WHERE task_name LIKE '%fooValue%'
     * $query->filterByTaskName(['foo', 'bar']); // WHERE task_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $taskName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaskName($taskName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($taskName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TasksTableMap::COL_TASK_NAME, $taskName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the task_project column
     *
     * Example usage:
     * <code>
     * $query->filterByTaskProject(1234); // WHERE task_project = 1234
     * $query->filterByTaskProject(array(12, 34)); // WHERE task_project IN (12, 34)
     * $query->filterByTaskProject(array('min' => 12)); // WHERE task_project > 12
     * </code>
     *
     * @see       filterByProject()
     *
     * @param mixed $taskProject The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaskProject($taskProject = null, ?string $comparison = null)
    {
        if (is_array($taskProject)) {
            $useMinMax = false;
            if (isset($taskProject['min'])) {
                $this->addUsingAlias(TasksTableMap::COL_TASK_PROJECT, $taskProject['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taskProject['max'])) {
                $this->addUsingAlias(TasksTableMap::COL_TASK_PROJECT, $taskProject['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TasksTableMap::COL_TASK_PROJECT, $taskProject, $comparison);

        return $this;
    }

    /**
     * Filter the query on the task_employee column
     *
     * Example usage:
     * <code>
     * $query->filterByTaskEmployee(1234); // WHERE task_employee = 1234
     * $query->filterByTaskEmployee(array(12, 34)); // WHERE task_employee IN (12, 34)
     * $query->filterByTaskEmployee(array('min' => 12)); // WHERE task_employee > 12
     * </code>
     *
     * @see       filterByEmployees()
     *
     * @param mixed $taskEmployee The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaskEmployee($taskEmployee = null, ?string $comparison = null)
    {
        if (is_array($taskEmployee)) {
            $useMinMax = false;
            if (isset($taskEmployee['min'])) {
                $this->addUsingAlias(TasksTableMap::COL_TASK_EMPLOYEE, $taskEmployee['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taskEmployee['max'])) {
                $this->addUsingAlias(TasksTableMap::COL_TASK_EMPLOYEE, $taskEmployee['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TasksTableMap::COL_TASK_EMPLOYEE, $taskEmployee, $comparison);

        return $this;
    }

    /**
     * Filter the query on the task_date column
     *
     * Example usage:
     * <code>
     * $query->filterByTaskDate('2011-03-14'); // WHERE task_date = '2011-03-14'
     * $query->filterByTaskDate('now'); // WHERE task_date = '2011-03-14'
     * $query->filterByTaskDate(array('max' => 'yesterday')); // WHERE task_date > '2011-03-13'
     * </code>
     *
     * @param mixed $taskDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaskDate($taskDate = null, ?string $comparison = null)
    {
        if (is_array($taskDate)) {
            $useMinMax = false;
            if (isset($taskDate['min'])) {
                $this->addUsingAlias(TasksTableMap::COL_TASK_DATE, $taskDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taskDate['max'])) {
                $this->addUsingAlias(TasksTableMap::COL_TASK_DATE, $taskDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TasksTableMap::COL_TASK_DATE, $taskDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the task_deadline column
     *
     * Example usage:
     * <code>
     * $query->filterByTaskDeadline('2011-03-14'); // WHERE task_deadline = '2011-03-14'
     * $query->filterByTaskDeadline('now'); // WHERE task_deadline = '2011-03-14'
     * $query->filterByTaskDeadline(array('max' => 'yesterday')); // WHERE task_deadline > '2011-03-13'
     * </code>
     *
     * @param mixed $taskDeadline The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaskDeadline($taskDeadline = null, ?string $comparison = null)
    {
        if (is_array($taskDeadline)) {
            $useMinMax = false;
            if (isset($taskDeadline['min'])) {
                $this->addUsingAlias(TasksTableMap::COL_TASK_DEADLINE, $taskDeadline['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taskDeadline['max'])) {
                $this->addUsingAlias(TasksTableMap::COL_TASK_DEADLINE, $taskDeadline['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TasksTableMap::COL_TASK_DEADLINE, $taskDeadline, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \Employees object
     *
     * @param \Employees|ObjectCollection $employees The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployees($employees, ?string $comparison = null)
    {
        if ($employees instanceof \Employees) {
            return $this
                ->addUsingAlias(TasksTableMap::COL_TASK_EMPLOYEE, $employees->getEmployeeId(), $comparison);
        } elseif ($employees instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TasksTableMap::COL_TASK_EMPLOYEE, $employees->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByEmployees() only accepts arguments of type \Employees or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employees relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployees(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employees');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Employees');
        }

        return $this;
    }

    /**
     * Use the Employees relation Employees object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EmployeesQuery A secondary query class using the current class as primary query
     */
    public function useEmployeesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployees($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employees', '\EmployeesQuery');
    }

    /**
     * Use the Employees relation Employees object
     *
     * @param callable(\EmployeesQuery):\EmployeesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useEmployeesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Employees table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \EmployeesQuery The inner query object of the EXISTS statement
     */
    public function useEmployeesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \EmployeesQuery */
        $q = $this->useExistsQuery('Employees', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Employees table for a NOT EXISTS query.
     *
     * @see useEmployeesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \EmployeesQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \EmployeesQuery */
        $q = $this->useExistsQuery('Employees', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Employees table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \EmployeesQuery The inner query object of the IN statement
     */
    public function useInEmployeesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \EmployeesQuery */
        $q = $this->useInQuery('Employees', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Employees table for a NOT IN query.
     *
     * @see useEmployeesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \EmployeesQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \EmployeesQuery */
        $q = $this->useInQuery('Employees', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Project object
     *
     * @param \Project|ObjectCollection $project The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProject($project, ?string $comparison = null)
    {
        if ($project instanceof \Project) {
            return $this
                ->addUsingAlias(TasksTableMap::COL_TASK_PROJECT, $project->getProjectId(), $comparison);
        } elseif ($project instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TasksTableMap::COL_TASK_PROJECT, $project->toKeyValue('PrimaryKey', 'ProjectId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProject() only accepts arguments of type \Project or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Project relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProject(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Project');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Project');
        }

        return $this;
    }

    /**
     * Use the Project relation Project object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProjectQuery A secondary query class using the current class as primary query
     */
    public function useProjectQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProject($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Project', '\ProjectQuery');
    }

    /**
     * Use the Project relation Project object
     *
     * @param callable(\ProjectQuery):\ProjectQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProjectQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProjectQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Project table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \ProjectQuery The inner query object of the EXISTS statement
     */
    public function useProjectExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \ProjectQuery */
        $q = $this->useExistsQuery('Project', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Project table for a NOT EXISTS query.
     *
     * @see useProjectExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \ProjectQuery The inner query object of the NOT EXISTS statement
     */
    public function useProjectNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \ProjectQuery */
        $q = $this->useExistsQuery('Project', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Project table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \ProjectQuery The inner query object of the IN statement
     */
    public function useInProjectQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \ProjectQuery */
        $q = $this->useInQuery('Project', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Project table for a NOT IN query.
     *
     * @see useProjectInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \ProjectQuery The inner query object of the NOT IN statement
     */
    public function useNotInProjectQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \ProjectQuery */
        $q = $this->useInQuery('Project', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildTasks $tasks Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($tasks = null)
    {
        if ($tasks) {
            $this->addUsingAlias(TasksTableMap::COL_TASK_ID, $tasks->getTaskId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tasks table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TasksTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TasksTableMap::clearInstancePool();
            TasksTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TasksTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TasksTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TasksTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TasksTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
