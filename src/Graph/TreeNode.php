<?php
namespace chilimatic\lib\Datastructure\Graph;

/**
 * Class TreeNode
 * @package chilimatic\lib\Datastructure\Graph
 */
class TreeNode extends Node
{

    /**
     * @var array
     */
    protected $treePath;

    /**
     * @var int
     */
    protected $maxDepth = 0;

    /**
     * @var int
     */
    protected $depth = 0;

    /**
     * @param int $depth
     *
     * @return null
     */
    private function searchTree(int $depth = 0)
    {
        $this->depth = $depth;
        foreach ($this->children->getList() as $node) {
            if ($depth > count($this->treePath)) {
                break;
            }

            if ($this->treePath[$depth] != $node->key) {
                continue;
            }

            /**
             * @var $node TreeNode
             */
            if (count($this->treePath) > $depth && $this->allowedToDiveDeeper($depth)) {
                $node->setTreePath($this->treePath);

                return $node->searchTree(++$depth);
            }
        }

        return $this;
    }

    /**
     * @param $depth
     *
     * @return bool
     */
    protected function allowedToDiveDeeper(int $depth) : bool
    {
        if ($this->maxDepth == 0) {
            return true;
        }

        return $this->maxDepth >= $depth;
    }

    /**
     * @param $key
     * @param $data
     * @param string $delimiter
     *
     * @return TreeNode|null
     */
    public function appendToBranch(string $key, $data, $delimiter = self::DEFAULT_KEY_DELIMITER)
    {
        $node = $this->findTreeBranch($key, $delimiter);

        /**
         * check if a whole tree structure is missing
         * build it if necessary
         */
        if ($this->getAmountMissingTreeNodes() > 1) {
            return $this->createTree($this->getMissingKeysByDepth(), $node);
        }

        /**
         * create just one missing node to a fully established tree with branches
         */
        $key     = array_pop(explode((string)$delimiter, trim((string)$key, (string)$delimiter)));
        $newNode = new self($node, $key, $data, $delimiter);
        $node->addChild($newNode);

        return null;
    }

    /**
     * returns the missing keys for the TreeNodes to be built
     *
     * @return array
     */
    public function getMissingKeysByDepth() : array
    {
        return array_slice(
            $this->getTreePath(),
            $this->getAmountMissingTreeNodes() * -1,
            $this->getAmountMissingTreeNodes()
        );
    }

    /**
     * recursive way to build tree structure
     *
     * @param array $keyParts
     * @param TreeNode $rootNode
     *
     * @return TreeNode
     */
    protected function createTree(&$keyParts, TreeNode $rootNode) : TreeNode
    {
        if (!count($keyParts)) {
            return $rootNode;
        }

        $newKey  = array_shift($keyParts);
        $newNode = new self($rootNode, $newKey, null, $rootNode->getKeyDelimiter());
        $rootNode->addChild($newNode);

        return $this->createTree($keyParts, $newNode);
    }


    /**
     * @param $key
     * @param string $delimiter
     *
     * @return $this|null
     */
    public function findTreeBranch(string $key, $delimiter = self::DEFAULT_KEY_DELIMITER)
    {
        $this->resetTreeSearch();
        $this->treePath = explode($delimiter, trim($key, $delimiter));
        if (($node = $this->searchTree()) != null) {
            return $node;
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getAmountMissingTreeNodes() : int
    {
        return count((array) $this->treePath) - ($this->depth + 1);
    }

    /**
     * resets the treePath
     */
    protected function resetTreeSearch()
    {
        $this->setTreePath([]);
    }


    /**
     * @return mixed
     */
    public function getTreePath()
    {
        return $this->treePath;
    }

    /**
     * @param mixed $treePath
     *
     * @return $this
     */
    public function setTreePath($treePath)
    {
        $this->treePath = $treePath;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxDepth() : int
    {
        return $this->maxDepth;
    }

    /**
     * @param int $maxDepth
     *
     * @return $this
     */
    public function setMaxDepth(int $maxDepth) : self
    {
        $this->maxDepth = $maxDepth;

        return $this;
    }

    /**
     * @return string
     */
    public function getKeyDelimiter() : string
    {
        return $this->keyDelimiter;
    }

    /**
     * @param string $keyDelimiter
     *
     * @return $this
     */
    public function setKeyDelimiter(string $keyDelimiter) : self
    {
        $this->keyDelimiter = $keyDelimiter;

        return $this;
    }
}