<?php
/**
 *
 * @author j
 * Date: 3/7/15
 * Time: 1:27 PM
 *
 * File: AbstractNodeFilter.php
 */

namespace chilimatic\lib\Datastructure\Graph\Filter;

use chilimatic\lib\Interfaces\IFlyWeightFilter;

abstract class AbstractFilter implements IFlyWeightFilter
{
    /**
     * @param null|mixed $param
     *
     * @return mixed
     */
    abstract public function filter($param = null);

    /**
     * @param null|mixed $param
     *
     * @return mixed
     */
    public function __invoke($param = null)
    {
        return $this->filter($param);
    }
}