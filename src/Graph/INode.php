<?php
namespace chilimatic\lib\Datastructure\Graph;

use chilimatic\lib\Datastructure\Graph\Filter\AbstractFilter;

/**
 * Interface INode
 * @package chilimatic\lib\Datastructure\Graph
 */
interface INode
{

    /**
     * @param INode $parentNode
     * @param $key
     * @param $data
     * @param string $comment
     */
    public function __construct(INode $parentNode = null, $key, $data, $comment = '');

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getById($id);

    /**
     * @param mixed $key
     *
     * @param filter\AbstractFilter $filter
     *
     * @return mixed
     */
    public function getByKey ($key, AbstractFilter $filter = null);

    /**
     * @param mixed $key
     *
     * @return mixed
     */
    public function getLastByKey($key);
}