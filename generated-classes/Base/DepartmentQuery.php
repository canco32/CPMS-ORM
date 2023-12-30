<?php

namespace Base;

use \Department as ChildDepartment;
use \DepartmentQuery as ChildDepartmentQuery;
use \Exception;
use \PDO;
use Map\DepartmentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `department` table.
 *
 * @method     ChildDepartmentQuery orderByDepartmentId($order = Criteria::ASC) Order by the department_id column
 * @method     ChildDepartmentQuery orderByDepartmentName($order = Criteria::ASC) Order by the department_name column
 *
 * @method     ChildDepartmentQuery groupByDepartmentId() Group by the department_id column
 * @method     ChildDepartmentQuery groupByDepartmentName() Group by the department_name column
 *
 * @method     ChildDepartmentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDepartmentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDepartmentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDepartmentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDepartmentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDepartmentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDepartmentQuery leftJoinEmployees($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employees relation
 * @method     ChildDepartmentQuery rightJoinEmployees($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employees relation
 * @method     ChildDepartmentQuery innerJoinEmployees($relationAlias = null) Adds a INNER JOIN clause to the query using the Employees relation
 *
 * @method     ChildDepartmentQuery joinWithEmployees($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employees relation
 *
 * @method     ChildDepartmentQuery leftJoinWithEmployees() Adds a LEFT JOIN clause and with to the query using the Employees relation
 * @method     ChildDepartmentQuery rightJoinWithEmployees() Adds a RIGHT JOIN clause and with to the query using the Employees relation
 * @method     ChildDepartmentQuery innerJoinWithEmployees() Adds a INNER JOIN clause and with to the query using the Employees relation
 *
 * @method     ChildDepartmentQuery leftJoinProject($relationAlias = null) Adds a LEFT JOIN clause to the query using the Project relation
 * @method     ChildDepartmentQuery rightJoinProject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Project relation
 * @method     ChildDepartmentQuery innerJoinProject($relationAlias = null) Adds a INNER JOIN clause to the query using the Project relation
 *
 * @method     ChildDepartmentQuery joinWithProject($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Project relation
 *
 * @method     ChildDepartmentQuery leftJoinWithProject() Adds a LEFT JOIN clause and with to the query using the Project relation
 * @method     ChildDepartmentQuery rightJoinWithProject() Adds a RIGHT JOIN clause and with to the query using the Project relation
 * @method     ChildDepartmentQuery innerJoinWithProject() Adds a INNER JOIN clause and with to the query using the Project relation
 *
 * @method     \EmployeesQuery|\ProjectQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDepartment|null findOne(?ConnectionInterface $con = null) Return the first ChildDepartment matching the query
 * @method     ChildDepartment findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildDepartment matching the query, or a new ChildDepartment object populated from the query conditions when no match is found
 *
 * @method     ChildDepartment|null findOneByDepartmentId(int $department_id) Return the first ChildDepartment filtered by the department_id column
 * @method     ChildDepartment|null findOneByDepartmentName(string $department_name) Return the first ChildDepartment filtered by the department_name column
 *
 * @method     ChildDepartment requirePk($key, ?ConnectionInterface $con = null) Return the ChildDepartment by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDepartment requireOne(?ConnectionInterface $con = null) Return the first ChildDepartment matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDepartment requireOneByDepartmentId(int $department_id) Return the first ChildDepartment filtered by the department_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDepartment requireOneByDepartmentName(string $department_name) Return the first ChildDepartment filtered by the department_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDepartment[]|Collection find(?ConnectionInterface $con = null) Return ChildDepartment objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildDepartment> find(?ConnectionInterface $con = null) Return ChildDepartment objects based on current ModelCriteria
 *
 * @method     ChildDepartment[]|Collection findByDepartmentId(int|array<int> $department_id) Return ChildDepartment objects filtered by the department_id column
 * @psalm-method Collection&\Traversable<ChildDepartment> findByDepartmentId(int|array<int> $department_id) Return ChildDepartment objects filtered by the department_id column
 * @method     ChildDepartment[]|Collection findByDepartmentName(string|array<string> $department_name) Return ChildDepartment objects filtered by the department_name column
 * @psalm-method Collection&\Traversable<ChildDepartment> findByDepartmentName(string|array<string> $department_name) Return ChildDepartment objects filtered by the department_name column
 *
 * @method     ChildDepartment[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDepartment> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class DepartmentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\DepartmentQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Department', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDepartmentQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDepartmentQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildDepartmentQuery) {
            return $criteria;
        }
        $query = new ChildDepartmentQuery();
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
     * @return ChildDepartment|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DepartmentTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DepartmentTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDepartment A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT department_id, department_name FROM department WHERE department_id = :p0';
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
            /** @var ChildDepartment $obj */
            $obj = new ChildDepartment();
            $obj->hydrate($row);
            DepartmentTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDepartment|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(DepartmentTableMap::COL_DEPARTMENT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(DepartmentTableMap::COL_DEPARTMENT_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the department_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDepartmentId(1234); // WHERE department_id = 1234
     * $query->filterByDepartmentId(array(12, 34)); // WHERE department_id IN (12, 34)
     * $query->filterByDepartmentId(array('min' => 12)); // WHERE department_id > 12
     * </code>
     *
     * @param mixed $departmentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDepartmentId($departmentId = null, ?string $comparison = null)
    {
        if (is_array($departmentId)) {
            $useMinMax = false;
            if (isset($departmentId['min'])) {
                $this->addUsingAlias(DepartmentTableMap::COL_DEPARTMENT_ID, $departmentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($departmentId['max'])) {
                $this->addUsingAlias(DepartmentTableMap::COL_DEPARTMENT_ID, $departmentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DepartmentTableMap::COL_DEPARTMENT_ID, $departmentId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the department_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDepartmentName('fooValue');   // WHERE department_name = 'fooValue'
     * $query->filterByDepartmentName('%fooValue%', Criteria::LIKE); // WHERE department_name LIKE '%fooValue%'
     * $query->filterByDepartmentName(['foo', 'bar']); // WHERE department_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $departmentName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDepartmentName($departmentName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($departmentName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DepartmentTableMap::COL_DEPARTMENT_NAME, $departmentName, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \Employees object
     *
     * @param \Employees|ObjectCollection $employees the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployees($employees, ?string $comparison = null)
    {
        if ($employees instanceof \Employees) {
            $this
                ->addUsingAlias(DepartmentTableMap::COL_DEPARTMENT_ID, $employees->getEmployeeDepartment(), $comparison);

            return $this;
        } elseif ($employees instanceof ObjectCollection) {
            $this
                ->useEmployeesQuery()
                ->filterByPrimaryKeys($employees->getPrimaryKeys())
                ->endUse();

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
     * @param \Project|ObjectCollection $project the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProject($project, ?string $comparison = null)
    {
        if ($project instanceof \Project) {
            $this
                ->addUsingAlias(DepartmentTableMap::COL_DEPARTMENT_ID, $project->getProjectDepartment(), $comparison);

            return $this;
        } elseif ($project instanceof ObjectCollection) {
            $this
                ->useProjectQuery()
                ->filterByPrimaryKeys($project->getPrimaryKeys())
                ->endUse();

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
     * @param ChildDepartment $department Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($department = null)
    {
        if ($department) {
            $this->addUsingAlias(DepartmentTableMap::COL_DEPARTMENT_ID, $department->getDepartmentId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the department table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DepartmentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DepartmentTableMap::clearInstancePool();
            DepartmentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DepartmentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DepartmentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DepartmentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DepartmentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
