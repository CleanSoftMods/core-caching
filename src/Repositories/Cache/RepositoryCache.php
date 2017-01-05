<?php namespace WebEd\Base\Caching\Repositories\Cache;

trait RepositoryCache
{
    /**
     * @return bool
     */
    public function isUseCache()
    {
        return call_user_func_array([$this->repository, __FUNCTION__], func_get_args());
    }

    /**
     * @param bool $bool
     * @return $this
     */
    public function withCache($bool = true)
    {
        call_user_func_array([$this->repository, __FUNCTION__], func_get_args());
        return $this->repository;
    }
}
