<?php

namespace EcclesiaCRM\Map;

use EcclesiaCRM\UserRole;
use EcclesiaCRM\UserRoleQuery;
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
 * This class defines the structure of the 'userrole_usrrol' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UserRoleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'EcclesiaCRM.Map.UserRoleTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'userrole_usrrol';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\EcclesiaCRM\\UserRole';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'EcclesiaCRM.UserRole';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the usrrol_id field
     */
    const COL_USRROL_ID = 'userrole_usrrol.usrrol_id';

    /**
     * the column name for the usrrol_name field
     */
    const COL_USRROL_NAME = 'userrole_usrrol.usrrol_name';

    /**
     * the column name for the usrrol_global field
     */
    const COL_USRROL_GLOBAL = 'userrole_usrrol.usrrol_global';

    /**
     * the column name for the usrrol_permissions field
     */
    const COL_USRROL_PERMISSIONS = 'userrole_usrrol.usrrol_permissions';

    /**
     * the column name for the usrrol_value field
     */
    const COL_USRROL_VALUE = 'userrole_usrrol.usrrol_value';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Name', 'Global', 'Permissions', 'Value', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'global', 'permissions', 'value', ),
        self::TYPE_COLNAME       => array(UserRoleTableMap::COL_USRROL_ID, UserRoleTableMap::COL_USRROL_NAME, UserRoleTableMap::COL_USRROL_GLOBAL, UserRoleTableMap::COL_USRROL_PERMISSIONS, UserRoleTableMap::COL_USRROL_VALUE, ),
        self::TYPE_FIELDNAME     => array('usrrol_id', 'usrrol_name', 'usrrol_global', 'usrrol_permissions', 'usrrol_value', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'Global' => 2, 'Permissions' => 3, 'Value' => 4, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'global' => 2, 'permissions' => 3, 'value' => 4, ),
        self::TYPE_COLNAME       => array(UserRoleTableMap::COL_USRROL_ID => 0, UserRoleTableMap::COL_USRROL_NAME => 1, UserRoleTableMap::COL_USRROL_GLOBAL => 2, UserRoleTableMap::COL_USRROL_PERMISSIONS => 3, UserRoleTableMap::COL_USRROL_VALUE => 4, ),
        self::TYPE_FIELDNAME     => array('usrrol_id' => 0, 'usrrol_name' => 1, 'usrrol_global' => 2, 'usrrol_permissions' => 3, 'usrrol_value' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('userrole_usrrol');
        $this->setPhpName('UserRole');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\EcclesiaCRM\\UserRole');
        $this->setPackage('EcclesiaCRM');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('usrrol_id', 'Id', 'SMALLINT', true, 11, null);
        $this->addColumn('usrrol_name', 'Name', 'VARCHAR', true, 256, null);
        $this->addColumn('usrrol_global', 'Global', 'LONGVARCHAR', false, null, null);
        $this->addColumn('usrrol_permissions', 'Permissions', 'LONGVARCHAR', false, null, null);
        $this->addColumn('usrrol_value', 'Value', 'LONGVARCHAR', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', '\\EcclesiaCRM\\User', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':usr_role_id',
    1 => ':usrrol_id',
  ),
), 'SET NULL', null, 'Users', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to userrole_usrrol     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        UserTableMap::clearInstancePool();
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
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
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? UserRoleTableMap::CLASS_DEFAULT : UserRoleTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (UserRole object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UserRoleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserRoleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserRoleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserRoleTableMap::OM_CLASS;
            /** @var UserRole $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserRoleTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = UserRoleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserRoleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UserRole $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserRoleTableMap::addInstanceToPool($obj, $key);
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
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UserRoleTableMap::COL_USRROL_ID);
            $criteria->addSelectColumn(UserRoleTableMap::COL_USRROL_NAME);
            $criteria->addSelectColumn(UserRoleTableMap::COL_USRROL_GLOBAL);
            $criteria->addSelectColumn(UserRoleTableMap::COL_USRROL_PERMISSIONS);
            $criteria->addSelectColumn(UserRoleTableMap::COL_USRROL_VALUE);
        } else {
            $criteria->addSelectColumn($alias . '.usrrol_id');
            $criteria->addSelectColumn($alias . '.usrrol_name');
            $criteria->addSelectColumn($alias . '.usrrol_global');
            $criteria->addSelectColumn($alias . '.usrrol_permissions');
            $criteria->addSelectColumn($alias . '.usrrol_value');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(UserRoleTableMap::DATABASE_NAME)->getTable(UserRoleTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UserRoleTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UserRoleTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UserRoleTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a UserRole or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or UserRole object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserRoleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \EcclesiaCRM\UserRole) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserRoleTableMap::DATABASE_NAME);
            $criteria->add(UserRoleTableMap::COL_USRROL_ID, (array) $values, Criteria::IN);
        }

        $query = UserRoleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserRoleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserRoleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the userrole_usrrol table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UserRoleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UserRole or Criteria object.
     *
     * @param mixed               $criteria Criteria or UserRole object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserRoleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UserRole object
        }

        if ($criteria->containsKey(UserRoleTableMap::COL_USRROL_ID) && $criteria->keyContainsValue(UserRoleTableMap::COL_USRROL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserRoleTableMap::COL_USRROL_ID.')');
        }


        // Set the correct dbName
        $query = UserRoleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UserRoleTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UserRoleTableMap::buildTableMap();
