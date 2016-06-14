<?php
namespace chilimatic\lib\Datastructure\Graph\Filter;
use chilimatic\lib\Interfaces\IFlyWeightTransformer;
use chilimatic\lib\Interfaces\IFlyWeightValidator;

/**
 * Class Factory
 *
 * @package chilimatic\lib\Datastructure\Graph\Filter
 */
class Factory
{
    /**
     * @var null|IFlyWeightValidator
     */
    private $validator;

    /**
     * @var null|IFlyWeightTransformer
     */
    private $transformer;

    /**
     * @param $filterName
     *
     * @return null|AbstractFilter
     */
    public function make($filterName)
    {
        if ($this->validator && !$this->validator->validate($filterName)) {
            return null;
        }

        if ($this->transformer) {
            $class = __NAMESPACE__ . '\\' . $this->transformer->transform($filterName);
        } else {
            $class = __NAMESPACE__ . '\\' . $filterName;
        }

        if (!class_exists($class)) {
            return null;
        }

        return new $class();
    }

    /**
     * @return IFlyWeightValidator|null
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @param IFlyWeightValidator $validator
     *
     * @return $this
     */
    public function setValidator(IFlyWeightValidator $validator) : self
    {
        $this->validator = $validator;

        return $this;
    }

    /**
     * @return IFlyWeightTransformer|null
     */
    public function getTransformer()
    {
        return $this->transformer;
    }

    /**
     * @param IFlyWeightTransformer $transformer
     *
     * @return $this
     */
    public function setTransformer(IFlyWeightTransformer $transformer) : self
    {
        $this->transformer = $transformer;

        return $this;
    }
}
