<?php
namespace chilimatic\lib\Datastructure\Graph\Filter;

use chilimatic\lib\Traits\Comperator\StringValueBiggerThan;

/**
 * returns the "deepest nested Node"
 *
 * Class LastNode
 *
 * @package chilimatic\lib\Datastructure\Graph\Filter
 */
class LastNode extends AbstractFilter
{
    use StringValueBiggerThan;

    /**
     * @param \SplObjectStorage $param
     *
     * @return \SplObjectStorage
     */
    public function filter($param = null)
    {
        if (!$param) {
            return new \SplObjectStorage();
        }

        if ($param->count() === 1) {
            return $param;
        }

        $idValue          = $returnNode = null;
        $returnCollection = new \SplObjectStorage();
        foreach ($param as $node) {
            if (!$idValue || $this->compare($node->getId(), $idValue)) {
                $idValue    = $node->getId();
                $returnNode = $node;
            }
        }

        $returnCollection->attach($returnNode);

        return $returnCollection;
    }

}