<?php

namespace Base;

use \Project as ChildProject;
use \ProjectQuery as ChildProjectQuery;
use \Exception;
use \PDO;
use Map\ProjectTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `project` table.
 *
 * @method     ChildProjectQuery orderByProjectId($order = Criteria::ASC) Order by the project_id column
 * @method     ChildProjectQuery orderByProjectName($order = Criteria::ASC) Order by the project_name column
 * @method     ChildProjectQuery orderByProjectDepartment($order = Criteria::ASC) Order by the project_department column
 *
 * @method     ChildProjectQuery groupByProjectId() Group by the project_id column
 * @method     ChildProjectQuery groupByProjectName() Group by the project_name column
 * @method     ChildProjectQuery groupByProjectDepartment() Group by the project_department column
 *
 * @method     ChildProjectQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProjectQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProjectQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProjectQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProjectQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProjectQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProjectQuery leftJoinDepartment($relationAlias = null) Adds a LEFT JOIN clause to the query using the Department relation
 * @method     ChildProjectQuery rightJoinDepartment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Department relation
 * @method     ChildProjectQuery innerJoinDepartment($relationAlias = null) Adds a INNER JOIN clause to the query using the Department relation
 *
 * @method     ChildProjectQuery joinWithDepartment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Department relation
 *
 * @method     ChildProjectQuery leftJoinWithDepartment() Adds a LEFT JOIN clause and with to the query using the Department relation
 * @method     ChildProjectQuery rightJoinWithDepartment() Adds a RIGHT JOIN clause and with to the query using the Department relation
 * @method     ChildProjectQuery innerJoinWithDepartment() Adds a INNER JOIN clause and with to the query using the Department relation
 *
 * @method     ChildProjectQuery leftJoinTasks($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tasks relation
 * @method     ChildProjectQuery rightJoinTasks($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tasks relation
 * @method     ChildProjectQuery innerJoinTasks($relationAlias = null) Adds a INNER JOIN clause to the query using the Tasks relation
 *
 * @method     ChildProjectQuery joinWithTasks($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tasks relation
 *
 * @method     ChildProjectQuery leftJoinWithTasks() Adds a LEFT JOIN clause and with to the query using the Tasks relation
 * @method     ChildProjectQuery rightJoinWithTasks() Adds a RIGHT JOIN clause and with to the query using the Tasks relation
 * @method     ChildProjectQuery innerJoinWithTasks() Adds a INNER JOIN clause and with to the query using the Tasks relation
 *
 * @method     \DepartmentQuery|\TasksQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProject|null findOne(?ConnectionInterface $con = null) Return the first ChildProject matching the query
 * @method     ChildProject findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildProject matching the query, or a new ChildProject object populated from the query conditions when no match is found
 *
 * @method     ChildProject|null findOneByProjectId(int $project_id) Return the first ChildProject filtered by the project_id column
 * @method     ChildProject|null findOneByProjectName(string $project_name) Return the first ChildProject filtered by the project_name column
 * @method     ChildProject|null findOneByProjectDepartment(int $project_department) Return the first ChildProject filtered by the project_department column
 *
 * @method     ChildProject requirePk($key, ?ConnectionInterface $con = null) Return the ChildProject by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProject requireOne(?ConnectionInterface $con = null) Return the first ChildProject matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProject requireOneByProjectId(int $project_id) Return the first ChildProject filtered by the project_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProject requireOneByProjectName(string $project_name) Return the first ChildProject filtered by the project_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProject requireOneByProjectDepartment(int $project_department) Return the first ChildProject filtered by the project_department column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProject[]|Collection find(?ConnectionInterface $con = null) Return ChildProject objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildProject> find(?ConnectionInterface $con = null) Return ChildProject objects based on current ModelCriteria
 *
 * @method     ChildProject[]|Collection findByProjectId(int|array<int> $project_id) Return ChildProject objects filtered by the project_id column
 * @psalm-method Collection&\Traversable<ChildProject> findByProjectId(int|array<int> $project_id) Return ChildProject objects filtered by the project_id column
 * @method     ChildProject[]|Collection findByProjectName(string|array<string> $project_name) Return ChildProject objects filtered by the project_name column
 * @psalm-method Collection&\Traversable<ChildProject> findByProjectName(string|array<string> $project_name) Return ChildProject objects filtered by the project_name column
 * @method     ChildProject[]|Collection findByProjectDepartment(int|array<int> $project_department) Return ChildProject objects filtered by the project_department column
 * @psalm-method Collection&\Traversable<ChildProject> findByProjectDepartment(int|array<int> $project_department) Return ChildProject objects filtered by the project_department column
 *
 * @method     ChildProject[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildProject> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ProjectQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProjectQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Project', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProjectQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProjectQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildProjectQuery) {
            return $criteria;
        }
        $query = new ChildProjectQuery();
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
     * @return ChildProject|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProjectTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProjectTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProject A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT project_id, project_name, project_department FROM project WHERE project_id = :p0';
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
            /** @var ChildProject $obj */
            $obj = new ChildProject();
            $obj->hydrate($row);
            ProjectTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProject|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ProjectTableMap::COL_PROJECT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ProjectTableMap::COL_PROJECT_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the project_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProjectId(1234); // WHERE project_id = 1234
     * $query->filterByProjectId(array(12, 34)); // WHERE project_id IN (12, 34)
     * $query->filterByProjectId(array('min' => 12)); // WHERE project_id > 12
     * </code>
     *
     * @param mixed $projectId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProjectId($projectId = null, ?string $comparison = null)
    {
        if (is_array($projectId)) {
            $useMinMax = false;
            if (isset($projectId['min'])) {
                $this->addUsingAlias(ProjectTableMap::COL_PROJECT_ID, $projectId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($projectId['max'])) {
                $this->addUsingAlias(ProjectTableMap::COL_PROJECT_ID, $projectId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProjectTableMap::COL_PROJECT_ID, $projectId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the project_name column
     *
     * Example usage:
     * <code>
     * $query->filterByProjectName('fooValue');   // WHERE project_name = 'fooValue'
     * $query->filterByProjectName('%fooValue%', Criteria::LIKE); // WHERE project_name LIKE '%fooValue%'
     * $query->filterByProjectName(['foo', 'bar']); // WHERE project_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $projectName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProjectName($projectName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($projectName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProjectTableMap::COL_PROJECT_NAME, $projectName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the project_department column
     *
     * Example usage:
     * <code>
     * $query->filterByProjectDepartment(1234); // WHERE project_department = 1234
     * $query->filterByProjectDepartment(array(12, 34)); // WHERE project_department IN (12, 34)
     * $query->filterByProjectDepartment(array('min' => 12)); // WHERE project_department > 12
     * </code>
     *
     * @see       filterByDepartment()
     *
     * @param mixed $projectDepartment The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProjectDepartment($projectDepartment = null, ?string $comparison = null)
    {
        if (is_array($projectDepartment)) {
            $useMinMax = false;
            if (isset($projectDepartment['min'])) {
                $this->addUsingAlias(ProjectTableMap::COL_PROJECT_DEPARTMENT, $projectDepartment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($projectDepartment['max'])) {
                $this->addUsingAlias(ProjectTableMap::COL_PROJECT_DEPARTMENT, $projectDepartment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProjectTableMap::COL_PROJECT_DEPARTMENT, $projectDepartment, $comparison);

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
                ->addUsingAlias(ProjectTableMap::COL_PROJECT_DEPARTMENT, $department->getDepartmentId(), $comparison);
        } elseif ($department instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ProjectTableMap::COL_PROJECT_DEPARTMENT, $department->toKeyValue('PrimaryKey', 'DepartmentId'), $comparison);

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
                ->addUsingAlias(ProjectTableMap::COL_PROJECT_ID, $tasks->getTaskProject(), $comparison);

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
     * @param ChildProject $project Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($project = null)
    {
        if ($project) {
            $this->addUsingAlias(ProjectTableMap::COL_PROJECT_ID, $project->getProjectId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the project table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProjectTableMap::clearInstancePool();
            ProjectTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProjectTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProjectTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProjectTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
