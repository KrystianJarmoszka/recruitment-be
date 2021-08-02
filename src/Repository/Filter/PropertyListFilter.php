<?php

namespace App\Repository\Filter;

/**
 * Class PropertyListFilter
 * @package App\Repository\Filter
 */
class PropertyListFilter extends BaseFilter
{
    const LIMIT = 10;
    const GLOBAL_SEARCH_LIMIT = 5;

    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): PropertyListFilter
    {
        $this->name = $name;

        return $this;
    }
}
