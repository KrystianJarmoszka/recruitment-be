<?php

namespace App\Repository\Filter;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class PropertyListFilter
 * @package App\Repository\Filter
 */
class PropertyListFilter extends BaseFilter
{
    const LIMIT = 30;
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
    public function setName(string $name): BaseFilter
    {
        $this->name = $name;

        return $this;
    }
}
