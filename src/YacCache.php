<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Zf\Cache;


use Zf\Cache\Abstracts\ACache;

/**
 * @author      qingbing<780042175@qq.com>
 * @describe    Yac缓存管理组件
 *
 * Class YacCache
 * @package Zf\Cache
 */
class YacCache extends ACache
{
    /**
     * @describe    describe
     *
     * @var \Yac
     */
    protected $yac;

    /**
     * @describe    属性赋值后执行函数
     */
    public function init()
    {
        $this->yac = new \Yac($this->namespace);
    }

    /**
     * @describe    获取缓存id
     *
     * @param mixed $key
     *
     * @return string
     */
    protected function buildId($key): string
    {
        return '_' . md5((is_string($key) ? $key : json_encode($key)));
    }

    /**
     * @describe    通过缓存id获取信息
     *
     * @param string $id
     *
     * @return mixed
     */
    protected function getValue($id)
    {
        return $this->yac->get($id);
    }

    /**
     * @describe    设置缓存id的信息
     *
     * @param string $id
     * @param string $value
     * @param int $ttl
     *
     * @return bool
     */
    protected function setValue(string $id, string $value, $ttl): bool
    {
        return $this->yac->set($id, $value, $ttl);
    }

    /**
     * @describe    删除缓存信息
     *
     * @param string $id
     *
     * @return bool
     */
    protected function deleteValue(string $id): bool
    {
        return $this->yac->delete($id);
    }

    /**
     * @describe    值得注意的是，该函数在Yac 下是清理所有的yac缓存，包含其他前缀空间的信息
     *
     * @return bool
     */
    protected function clearValues(): bool
    {
        return $this->yac->flush();
    }

    /**
     * @describe    通过缓存ids获取信息
     *
     * @param array $ids
     *
     * @return array
     */
    protected function getMultiValue($ids)
    {
        return $this->yac->get($ids);
    }

    /**
     * @describe    设置多个缓存
     *
     * @param mixed $kvs
     * @param null|int $ttl
     *
     * @return bool
     */
    protected function setMultiValue($kvs, $ttl = null): bool
    {
        return $this->yac->set($kvs, $ttl);
    }

    /**
     * @describe    删除多个缓存
     *
     * @param array $ids
     *
     * @return bool
     */
    protected function deleteMultiValue($ids)
    {
        return $this->yac->delete($ids);
    }

    /**
     * @describe    判断缓存是否存在
     *
     * @param string $id
     *
     * @return bool
     */
    protected function exist(string $id): bool
    {
        return false !== $this->yac->get($id);
    }
}