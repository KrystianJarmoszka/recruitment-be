<?php

namespace App\Repository\Filter;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Abstract Class BaseFilter
 * @package App\Repository\Filter
 */
abstract class BaseFilter
{
    const LIMIT = 20;
    const GLOBAL_SEARCH_LIMIT = 3;

    const DEFAULT_PAGE = 1;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $keyword;

    /**
     * @var int
     *
     * @Assert\Type(type="integer")
     */
    protected $page;

    /**
     * @var int
     *
     * @Assert\Type(type="integer")
     */
    protected $limit;

    /**
     * @var integer
     *
     * @Assert\Choice(
     *     callback = "getOrderDirections"
     * )
     */
    protected $order;

    /**
     * @return array
     */
    public static function getOrderDirections(): ?array
    {
        return [-1, 1, '1', '-1'];
    }

    /**
     * @return int
     */
    public function getPage(): ?int
    {
        return $this->page ? $this->page : self::DEFAULT_PAGE;
    }

    /**
     * @param int $page
     *
     * @return self
     */
    public function setPage(int $page): BaseFilter
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): BaseFilter
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    /**
     * @param string $keyword
     *
     * @return self
     */
    public function setKeyword(string $keyword): BaseFilter
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): ?int
    {
        return empty($this->limit) || $this->limit > self::LIMIT ? self::LIMIT : $this->limit;
    }

    /**
     * @param int $limit
     *
     * @return self
     */
    public function setLimit(int $limit): BaseFilter
    {
        $this->limit = $limit > self::LIMIT ? self::LIMIT : $limit;

        return $this;
    }


    /**
     * @return string
     */
    public function getOrder(): ?string
    {
        return empty($this->order) || (int)$this->order == 1 ? 'ASC' : 'DESC';
    }

    /**
     * @param int $order
     */
    public function setOrder(int $order)
    {
        $this->order = $order;
    }

}
