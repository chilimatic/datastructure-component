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
    public function __construct(INode $parentNode = null, string $key, $data, string $comment = '');

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getById(string $id);

    /**
     * @param mixed $key
     *
     * @param filter\AbstractFilter $filter
     *
     * @return mixed
     */
    public function getByKey (string $key, AbstractFilter $filter = null);

    /**
     * @param mixed $key
     *
     * @return mixed
     */
    public function getLastByKey(string $key);
}