<?php namespace WebEd\Base\Caching\Services\Traits;

trait Cacheable
{
    /**
     * Determine when enabled cache for query
     * @var bool
     */
    protected $cacheEnabled;

    /**
     * @return bool
     */
    public function isUseCache()
    {
        if ($this->cacheEnabled === null) {
            $this->cacheEnabled = config('webed-caching.repository.enabled');
        }

        return !!$this->cacheEnabled;
    }

    /**
     * @param bool $bool
     * @return $this
     */
    public function withCache($bool = true)
    {
        $this->cacheEnabled = !!$bool;

        return $this;
    }
}
