<?php

namespace App\Response;

use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * Class Collection
 */
class Collection
{
    /**
     * @var array
     *
     * @Expose
     * @Groups({"list", "default", "stream"})
     */
    protected $data;

    /**
     * @var integer
     *
     * @Expose
     * @Groups({"list", "default", "stream"})
     */
    protected $count;

    /**
     * @var integer
     *
     * @Expose
     * @Groups({"list", "default", "stream"})
     */
    protected $page;

    /**
     * @var integer
     *
     * @Expose
     * @Groups({"list", "default", "stream"})
     */
    protected $pages;

    /**
     * Collection constructor.
     * @param array $data
     * @param int $count
     * @param int $page
     * @param int $pages
     */
    public function __construct(array $data, int $count, int $page, int $pages)
    {
        $this->data = $data;
        $this->count = $count;
        $this->page = $page;
        $this->pages = $pages;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount(int $count)
    {
        $this->count = $count;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPages(): int
    {
        return $this->pages;
    }

    /**
     * @param int $pages
     */
    public function setPages(int $pages)
    {
        $this->pages = $pages;
    }
}
