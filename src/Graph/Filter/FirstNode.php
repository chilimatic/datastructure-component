<?php
namespace chilimatic\lib\Datastructure\Graph\Filter;

use chilimatic\lib\Traits\Comperator\StringValueBiggerThan;

/**
 * Class LastNode
 *
 * @package chilimatic\lib\Datastructure\Graph\Filter
 */
class FirstNode extends AbstractFilter
{

    use StringValueBiggerThan;

    /**
     * @param \SplObjectStorage $param
     *
     * @return mixed
     */
    public function filter($param = null)
    {
        if (!$param) {
            return null;
        }

        if ($param->count() === 1) {
            return $param;
        }

        $idValue          = $returnNode = null;
        $returnCollection = new \SplObjectStorage();
        foreach ($param as $node) {
            if (!$idValue || $this->compare($idValue, $node->getId())) {
                $idValue    = $node->getId();
                $returnNode = $node;
            }
        }

        $returnCollection->attach($returnNode);

        return $returnCollection;
    }
}