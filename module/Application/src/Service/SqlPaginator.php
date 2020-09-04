<?php

namespace Application\Service;
use Zend\Paginator\Adapter\AdapterInterface;

/**
 * Paginate native doctrine 2 queries
 */
class SqlPaginator implements AdapterInterface
{
    /**
     * @var \Doctrine\ORM\NativeQuery
     */
    protected $query;
    protected $count;
    protected $page;

    /**
     * @param \Doctrine\ORM\NativeQuery $query
     */
    public function __construct($query,$page)
    {
        $this->query = $query;
        $this->page = $page;
    }

    /**
     * Returns the total number of rows in the result set.
     *
     * @return integer
     */
    public function count()
    {
        if(!$this->count)
        {
            $sql = "SELECT COUNT(*) from ({$this->query->getSql()}) AS T";
            $db = $this->query->getEntityManager()->getConnection();
            $this->count = (int) $db->fetchColumn($sql);
        }


        return $this->count;
    }

    /**
     * Returns an collection of items for a page.
     *
     * @param integer $offset Page offset
     * @param $perPage
     * @return array
     */
    public function getItems($offset, $perPage)
    {
        $offset = (($this->page - 1) * $perPage);
        $sql = $this->query->getSQL();
        $sql .= " LIMIT $perPage OFFSET {$offset}";
        $this->query->setSQL($sql);
        return $this->query->getResult();
    }
}