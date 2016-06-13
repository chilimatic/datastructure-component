<?php
namespace chilimatic\lib\Datastructure\Graph;

/**
 * Class AbstractNode
 * @package chilimatic\lib\Datastructure\Graph
 */
abstract class AbstractNode
{

    /**
     * main config node
     *
     * @var Node
     */
    public $mainNode;

    /**
     * constructor
     *
     * @param mixed $param
     */
    public function __construct($param = null)
    {
        $this->init($param);
    }


    /**
     * loads the config based on the type / source
     *
     * @param mixed $param
     *
     * @return mixed
     */
    abstract public function init($param = null);

    /**
     * deletes a config
     *
     * @param string $key
     *
     * @return mixed
     */
    public function delete($key = '')
    {
        $node = $this->mainNode->getByKey($key);
        if ($node) {
            return $this->mainNode;
        }
        $this->mainNode->children->removeNode($node);

        return $this->mainNode;
    }

    /**
     * gets a specific parameter
     *
     * @param $var
     *
     * @return mixed
     */
    public function get($var)
    {
        $node = $this->mainNode->getByKey($var);
        if (!$node) {
            return null;
        }

        return $node->getData();
    }

    /**
     * gets a specific parameter
     *
     * @param $id
     *
     * @return mixed
     */
    public function getById($id)
    {
        $node = $this->mainNode->getById($id);
        if (!$node) {
            return null;
        }

        return $node->getData();
    }

    /**
     * sets a specific parameter
     *
     * @param $id
     * @param $val
     *
     * @return mixed
     */
    public function setById($id, $val)
    {
        // set the variable
        if (empty($id)) {
            return $this;
        }

        $node = new Node($this->mainNode, $id, $val);

        $this->mainNode->addChild($node);

        return $this;
    }

    /**
     * sets a specific parameter
     *
     * @param $key
     * @param $val
     *
     * @return mixed
     */
    public function set($key, $val)
    {
        // set the variable
        if (empty($key)) {
            return $this;
        }

        $node = new Node($this->mainNode, $key, $val);
        $this->mainNode->addChild($node);

        return $this;
    }
} 