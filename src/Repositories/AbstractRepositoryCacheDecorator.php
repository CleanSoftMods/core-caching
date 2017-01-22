<?php namespace WebEd\Base\Caching\Repositories;

use WebEd\Base\Caching\Repositories\Cache\ModelNeedValidateCache;
use WebEd\Base\Caching\Repositories\Cache\RepositoryCache;
use WebEd\Base\Caching\Repositories\Cache\WithViewTrackerCache;
use WebEd\Base\Core\Models\Contracts\BaseModelContract;
use WebEd\Base\Core\Repositories\AbstractBaseRepository;
use WebEd\Base\Core\Repositories\Contracts\BaseMethodsContract;

use WebEd\Base\Caching\Repositories\Cache\BaseMethodsCache;
use WebEd\Base\Caching\Services\Contracts\CacheableContract;
use WebEd\Base\Caching\Services\Traits\Cacheable;
use WebEd\Base\Core\Repositories\Contracts\ModelNeedValidateContract;
use WebEd\Base\Core\Repositories\Contracts\QueryBuilderContract;
use WebEd\Base\Core\Repositories\Contracts\WithViewTrackerContract;

abstract class AbstractRepositoryCacheDecorator implements BaseMethodsContract, ModelNeedValidateContract, QueryBuilderContract, CacheableContract, WithViewTrackerContract
{
    use RepositoryCache;

    use BaseMethodsCache;

    use ModelNeedValidateCache;

    use WithViewTrackerCache;

    /**
     * @var AbstractBaseRepository|Cacheable
     */
    protected $repository;

    /**
     * @var \WebEd\Base\Caching\Services\CacheService
     */
    protected $cache;

    /**
     * @param CacheableContract $repository
     */
    public function __construct(CacheableContract $repository)
    {
        $this->repository = $repository;

        $this->cache = app(\WebEd\Base\Caching\Services\Contracts\CacheServiceContract::class);

        $this->cache
            ->setCacheObject($this->repository)
            ->setCacheLifetime(config('webed-caching.repository.lifetime'))
            ->setCacheFile(config('webed-caching.repository.store_keys'));
    }

    /**
     * @return AbstractBaseRepository|Cacheable
     */
    public function getRepository()
    {
        return $this->repository;
    }

    public function getModel()
    {
        return $this->repository->getModel();
    }

    /**
     * @return \WebEd\Base\Caching\Services\CacheService
     */
    public function getCacheInstance()
    {
        return $this->cache;
    }

    /**
     * @param $lifetime
     * @return $this
     */
    public function setCacheLifetime($lifetime)
    {
        $this->cache->setCacheLifetime($lifetime);

        return $this;
    }

    /**
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function beforeGet($method, $parameters)
    {
        if ($this->needIgnoreCache()) {
            return call_user_func_array([$this->repository, $method], $parameters);
        }

        $this->cache->setCacheKey($method, $parameters);

        $repository = clone $this->repository;

        /**
         * Clear params
         */
        $this->repository->resetQuery();

        return $this->cache->retrieveFromCache(function () use ($repository, $method, $parameters) {
            return call_user_func_array([$repository, $method], $parameters);
        });
    }

    /**
     * @param $method
     * @param $parameters
     * @param bool $flushCache
     * @return mixed
     */
    public function afterUpdate($method, $parameters, $flushCache = true, $forceFlush = false)
    {
        $result = call_user_func_array([$this->repository, $method], $parameters);

        if ($flushCache === true && ($forceFlush === true || (is_array($result) && isset($result['error']) && !$result['error']))) {
            $this->cache->flushCache();
        }

        return $result;
    }

    public function needIgnoreCache()
    {
        $queryBuilderData = $this->getQueryBuilderData();

        if (!empty($queryBuilderData['with'])) {
            return true;
        }

        return false;
    }

    /**
     * @param BaseModelContract $model
     * @return $this
     */
    public function pushModel(BaseModelContract $model)
    {
        call_user_func_array([$this->repository, __FUNCTION__], func_get_args());
        return $this;
    }

    /**
     * @param $class
     * @param $method
     * @return $this
     */
    public function pushCriteria($class, $method)
    {
        call_user_func_array([$this->repository, __FUNCTION__], func_get_args());
        return $this;
    }

    /**
     * @param $class
     * @param $method
     * @param array $args
     * @return mixed
     */
    public final function getByCriteria($class, $method, array $args)
    {
        return call_user_func_array([$this->repository, __FUNCTION__], func_get_args());
    }
}
