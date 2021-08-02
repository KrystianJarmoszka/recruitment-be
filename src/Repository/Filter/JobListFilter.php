<?php

namespace App\Repository\Filter;

/**
 * Class JobListFilter
 * @package App\Repository\Filter
 */
class JobListFilter extends BaseFilter
{
    /**
     * @var string
     */
    protected $summary;

    /**
     * @return string
     */
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     *
     * @return self
     */
    public function setSummary(string $summary): JobListFilter
    {
        $this->summary = $summary;

        return $this;
    }
}
