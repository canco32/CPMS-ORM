<?php

namespace Base;

use \Employees as ChildEmployees;
use \EmployeesQuery as ChildEmployeesQuery;
use \Exception;
use \PDO;
use Map\EmployeesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `employees` table.
 *
 * @method     ChildEmployeesQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildEmployeesQuery orderByEmployeeName($order = Criteria::ASC) Order by the employee_name column
 * @method     ChildEmployeesQuery orderByEmployeePosition($order = Criteria::ASC) Order by the employee_position column
 * @method     ChildEmployeesQuery orderByEmployeeDepartment($order = Criteria::ASC) Order by the employee_department column
 * @method     ChildEmployeesQuery orderByEmployeeSalary($order = Criteria::ASC) Order by the employee_salary column
 *
 * @method     ChildEmployeesQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildEmployeesQuery groupByEmployeeName() Group by the employee_name column
 * @method     ChildEmployeesQuery groupByEmployeePosition() Group by the employee_position column
 * @method     ChildEmployeesQuery groupByEmployeeDepartment() Group by the employee_department column
 * @method     ChildEmployeesQuery groupByEmployeeSalary() Group by the employee_salary column
 *
 * @method     ChildEmployeesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeesQuery leftJoinDepartment($relationAlias = null) Adds a LEFT JOIN clause to the query using the Department relation
 * @method     ChildEmployeesQuery rightJoinDepartment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Department relation
 * @method     ChildEmployeesQuery innerJoinDepartment($relationAlias = null) Adds a INNER JOIN clause to the query using the Department relation
 *
 * @method     ChildEmployeesQuery joinWithDepartment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Department relation
 *
 * @method     ChildEmployeesQuery leftJoinWithDepartment() Adds a LEFT JOIN clause and with to the query using the Department relation
 * @method     ChildEmployeesQuery rightJoinWithDepartment() Adds a RIGHT JOIN clause and with to the query using the Department relation
 * @method     ChildEmployeesQuery innerJoinWithDepartment() Adds a INNER JOIN clause and with to the query using the Department relation
 *
 * @method     ChildEmployeesQuery leftJoinTasks($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tasks relation
 * @method     ChildEmployeesQuery rightJoinTasks($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tasks relation
 * @method     ChildEmployeesQuery innerJoinTasks($relationAlias = null) Adds a INNER JOIN clause to the query using the Tasks relation
 *
 * @method     ChildEmployeesQuery joinWithTasks($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tasks relation
 *
 * @method     ChildEmployeesQuery leftJoinWithTasks() Adds a LEFT JOIN clause and with to the query using the Tasks relation
 * @method     ChildEmployeesQuery rightJoinWithTasks() Adds a RIGHT JOIN clause and with to the query using the Tasks relation
 * @method     ChildEmployeesQuery innerJoinWithTasks() Adds a INNER JOIN clause and with to the query using the Tasks relation
 *
 * @method     \DepartmentQuery|\TasksQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmployees|null findOne(?ConnectionInterface $con = null) Return the first ChildEmployees matching the query
 * @method     ChildEmployees findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildEmployees matching the query, or a new ChildEmployees object populated from the query conditions when no match is found
 *
 * @method     ChildEmployees|null findOneByEmployeeId(int $employee_id) Return the first ChildEmployees filtered by the employee_id column
 * @method     ChildEmployees|null findOneByEmployeeName(string $employee_name) Return the first ChildEmployees filtered by the employee_name column
 * @method     ChildEmployees|null findOneByEmployeePosition(string $employee_position) Return the first ChildEmployees filtered by the employee_position column
 * @method     ChildEmployees|null findOneByEmployeeDepartment(int $employee_department) Return the first ChildEmployees filtered by the employee_department column
 * @method     ChildEmployees|null findOneByEmployeeSalary(string $employee_salary) Return the first ChildEmployees filtered by the employee_salary column
 *
 * @method     ChildEmployees requirePk($key, ?ConnectionInterface $con = null) Return the ChildEmployees by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployees requireOne(?ConnectionInterface $con = null) Return the first ChildEmployees matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployees requireOneByEmployeeId(int $employee_id) Return the first ChildEmployees filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployees requireOneByEmployeeName(string $employee_name) Return the first ChildEmployees filtered by the employee_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployees requireOneByEmployeePosition(string $employee_position) Return the first ChildEmployees filtered by the employee_position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployees requireOneByEmployeeDepartment(int $employee_department) Return the first ChildEmployees filtered by the employee_department column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployees requireOneByEmployeeSalary(string $employee_salary) Return the first ChildEmployees filtered by the employee_salary column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployees[]|Collection find(?ConnectionInterface $con = null) Return ChildEmployees objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildEmployees> find(?ConnectionInterface $con = null) Return ChildEmployees objects based on current ModelCriteria
 *
 * @method     ChildEmployees[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildEmployees objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildEmployees> findByEmployeeId(int|array<int> $employee_id) Return ChildEmployees objects filtered by the employee_id column
 * @method     ChildEmployees[]|Collection findByEmployeeName(string|array<string> $employee_name) Return ChildEmployees objects filtered by the employee_name column
 * @psalm-method Collection&\Traversable<ChildEmployees> findByEmployeeName(string|array<string> $employee_name) Return ChildEmployees objects filtered by the employee_name column
 * @method     ChildEmployees[]|Collection findByEmployeePosition(string|array<string> $employee_position) Return ChildEmployees objects filtered by the employee_position column
 * @psalm-method Collection&\Traversable<ChildEmployees> findByEmployeePosition(string|array<string> $employee_position) Return ChildEmployees objects filtered by the employee_position column
 * @method     ChildEmployees[]|Collection findByEmployeeDepartment(int|array<int> $employee_department) Return ChildEmployees objects filtered by the employee_department column
 * @psalm-method Collection&\Traversable<ChildEmployees> findByEmployeeDepartment(int|array<int> $employee_department) Return ChildEmployees objects filtered by the employee_department column
 * @method     ChildEmployees[]|Collection findByEmployeeSalary(string|array<string> $employee_salary) Return ChildEmployees objects filtered by the employee_salary column
 * @psalm-method Collection&\Traversable<ChildEmployees> findByEmployeeSalary(string|array<string> $employee_salary) Return ChildEmployees objects filtered by the employee_salary column
 *
 * @method     ChildEmployees[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildEmployees> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class EmployeesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\EmployeesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Employees', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildEmployeesQuery) {
            return $criteria;
        }
        $query = new ChildEmployeesQuery();
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
     * @return ChildEmployees|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployees A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT employee_id, employee_name, employee_position, employee_department, employee_salary FROM employees WHERE employee_id = :p0';
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
            /** @var ChildEmployees $obj */
            $obj = new ChildEmployees();
            $obj->hydrate($row);
            EmployeesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployees|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEE_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the employee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeId(1234); // WHERE employee_id = 1234
     * $query->filterByEmployeeId(array(12, 34)); // WHERE employee_id IN (12, 34)
     * $query->filterByEmployeeId(array('min' => 12)); // WHERE employee_id > 12
     * </code>
     *
     * @param mixed $employeeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeId($employeeId = null, ?string $comparison = null)
    {
        if (is_array($employeeId)) {
            $useMinMax = false;
            if (isset($employeeId['min'])) {
                $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_name column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeName('fooValue');   // WHERE employee_name = 'fooValue'
     * $query->filterByEmployeeName('%fooValue%', Criteria::LIKE); // WHERE employee_name LIKE '%fooValue%'
     * $query->filterByEmployeeName(['foo', 'bar']); // WHERE employee_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeName($employeeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEE_NAME, $employeeName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_position column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeePosition('fooValue');   // WHERE employee_position = 'fooValue'
     * $query->filterByEmployeePosition('%fooValue%', Criteria::LIKE); // WHERE employee_position LIKE '%fooValue%'
     * $query->filterByEmployeePosition(['foo', 'bar']); // WHERE employee_position IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeePosition The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeePosition($employeePosition = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeePosition)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEE_POSITION, $employeePosition, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_department column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeDepartment(1234); // WHERE employee_department = 1234
     * $query->filterByEmployeeDepartment(array(12, 34)); // WHERE employee_department IN (12, 34)
     * $query->filterByEmployeeDepartment(array('min' => 12)); // WHERE employee_department > 12
     * </code>
     *
     * @see       filterByDepartment()
     *
     * @param mixed $employeeDepartment The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeDepartment($employeeDepartment = null, ?string $comparison = null)
    {
        if (is_array($employeeDepartment)) {
            $useMinMax = false;
            if (isset($employeeDepartment['min'])) {
                $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEE_DEPARTMENT, $employeeDepartment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeDepartment['max'])) {
                $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEE_DEPARTMENT, $employeeDepartment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEE_DEPARTMENT, $employeeDepartment, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_salary column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeSalary('fooValue');   // WHERE employee_salary = 'fooValue'
     * $query->filterByEmployeeSalary('%fooValue%', Criteria::LIKE); // WHERE employee_salary LIKE '%fooValue%'
     * $query->filterByEmployeeSalary(['foo', 'bar']); // WHERE employee_salary IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeeSalary The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeSalary($employeeSalary = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeeSalary)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEE_SALARY, $employeeSalary, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \Department object
     *
     * @param \Department|ObjectCollection $department The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDepartment($department, ?string $comparison = null)
    {
        if ($department instanceof \Department) {
            return $this
                ->addUsingAlias(EmployeesTableMap::COL_EMPLOYEE_DEPARTMENT, $department->getDepartmentId(), $comparison);
        } elseif ($department instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EmployeesTableMap::COL_EMPLOYEE_DEPARTMENT, $department->toKeyValue('PrimaryKey', 'DepartmentId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByDepartment() only accepts arguments of type \Department or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Department relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDepartment(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Department');

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
            $this->addJoinObject($join, 'Department');
        }

        return $this;
    }

    /**
     * Use the Department relation Department object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DepartmentQuery A secondary query class using the current class as primary query
     */
    public function useDepartmentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDepartment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Department', '\DepartmentQuery');
    }

    /**
     * Use the Department relation Department object
     *
     * @param callable(\DepartmentQuery):\DepartmentQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDepartmentQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useDepartmentQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Department table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \DepartmentQuery The inner query object of the EXISTS statement
     */
    public function useDepartmentExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \DepartmentQuery */
        $q = $this->useExistsQuery('Department', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Department table for a NOT EXISTS query.
     *
     * @see useDepartmentExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DepartmentQuery The inner query object of the NOT EXISTS statement
     */
    public function useDepartmentNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \DepartmentQuery */
        $q = $this->useExistsQuery('Department', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Department table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \DepartmentQuery The inner query object of the IN statement
     */
    public function useInDepartmentQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \DepartmentQuery */
        $q = $this->useInQuery('Department', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Department table for a NOT IN query.
     *
     * @see useDepartmentInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \DepartmentQuery The inner query object of the NOT IN statement
     */
    public function useNotInDepartmentQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \DepartmentQuery */
        $q = $this->useInQuery('Department', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Tasks object
     *
     * @param \Tasks|ObjectCollection $tasks the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTasks($tasks, ?string $comparison = null)
    {
        if ($tasks instanceof \Tasks) {
            $this
                ->addUsingAlias(EmployeesTableMap::COL_EMPLOYEE_ID, $tasks->getTaskEmployee(), $comparison);

            return $this;
        } elseif ($tasks instanceof ObjectCollection) {
            $this
                ->useTasksQuery()
                ->filterByPrimaryKeys($tasks->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTasks() only accepts arguments of type \Tasks or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tasks relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTasks(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tasks');

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
            $this->addJoinObject($join, 'Tasks');
        }

        return $this;
    }

    /**
     * Use the Tasks relation Tasks object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TasksQuery A secondary query class using the current class as primary query
     */
    public function useTasksQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTasks($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tasks', '\TasksQuery');
    }

    /**
     * Use the Tasks relation Tasks object
     *
     * @param callable(\TasksQuery):\TasksQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTasksQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTasksQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Tasks table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \TasksQuery The inner query object of the EXISTS statement
     */
    public function useTasksExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \TasksQuery */
        $q = $this->useExistsQuery('Tasks', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Tasks table for a NOT EXISTS query.
     *
     * @see useTasksExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \TasksQuery The inner query object of the NOT EXISTS statement
     */
    public function useTasksNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \TasksQuery */
        $q = $this->useExistsQuery('Tasks', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Tasks table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \TasksQuery The inner query object of the IN statement
     */
    public function useInTasksQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \TasksQuery */
        $q = $this->useInQuery('Tasks', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Tasks table for a NOT IN query.
     *
     * @see useTasksInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \TasksQuery The inner query object of the NOT IN statement
     */
    public function useNotInTasksQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \TasksQuery */
        $q = $this->useInQuery('Tasks', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildEmployees $employees Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($employees = null)
    {
        if ($employees) {
            $this->addUsingAlias(EmployeesTableMap::COL_EMPLOYEE_ID, $employees->getEmployeeId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the employees table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmployeesTableMap::clearInstancePool();
            EmployeesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmployeesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmployeesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmployeesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
