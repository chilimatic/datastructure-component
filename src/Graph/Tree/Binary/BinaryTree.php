<?php
namespace chilimatic\lib\Datastructure\Graph\Tree\Binary;

/**
 * Class BinaryTree
 * @package chilimatic\lib\Datastructure\Graph\Tree\Binary
 */
class BinaryTree
{

    /**
     * @var BinaryNode
     */
    protected $root;

    /**
     * @return bool
     */
    public function isEmpty() {
        return $this->root === null;
    }

    /**
     * @param $key
     * @param $data
     */
    public function insert(string $key, $data) {
        $node = new BinaryNode($key, $data);

        if ($this->root === null) {
            $this->root = $node;
        } else {
            $this->insertNode($node, $this->root);
        }
    }

    /**
     * @param BinaryNode $node
     * @param BinaryNode $subtree
     */
    public function insertNode(BinaryNode $node, BinaryNode &$subtree = null) {
        if ($subtree === null) {
            $subtree = $node;
        } else {
            if ($node->getKeySum() >= $subtree->getKeySum()) {
                $this->insertNode($node, $subtree->rightNode);
            } else  {
                $this->insertNode($node, $subtree->leftNode);
            }
        }
    }

    /**
     * @param $key
     *
     * @return mixed|null
     */
    public function findByKey(string $key) {
        if (!$this->root) {
            return null;
        }

        return $this->root->findByKey($key);
    }

    /**
     * @return BinaryNode
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param BinaryNode $root
     *
     * @return $this
     */
    public function setRoot($root)
    {
        $this->root = $root;

        return $this;
    }
}