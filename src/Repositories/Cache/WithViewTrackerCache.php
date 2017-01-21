<?php namespace WebEd\Base\Caching\Repositories\Cache;

trait WithViewTrackerCache
{
    /**
     * @return $this
     */
    public function withViewTracker()
    {
        call_user_func_array([$this->repository, __FUNCTION__], func_get_args());
        return $this;
    }
}
