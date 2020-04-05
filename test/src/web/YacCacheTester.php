<?php
/**
 * @link        http://www.phpcorner.net
 * @author      qingbing<780042175@qq.com>
 * @copyright   Chengdu Qb Technology Co., Ltd.
 */

namespace Test\Web;


use DebugBootstrap\Abstracts\Tester;
use Zf\Cache\Abstracts\ACache;
use Zf\Cache\YacCache;
use Zf\Helper\Object;

/**
 * @author      qingbing<780042175@qq.com>
 * @describe    YacCacheTester
 *
 * Class YacCacheTester
 * @package Test\Web
 */
class YacCacheTester extends Tester
{

    /**
     * @describe    执行函数
     *
     * @throws \ReflectionException
     * @throws \Zf\Helper\Exceptions\ClassException
     * @throws \Zf\Helper\Exceptions\ParameterException
     */
    public function run()
    {
        $yac1 = new \Yac('zf');
        $yac2 = new \Yac('zf1');
        var_dump($yac1);
        var_dump($yac2);
        $yac1->flush();
        var_dump($yac1->info());
        var_dump($yac2->info());
        var_dump($yac1->dump());
        var_dump($yac2->dump());

        exit;
        // 实例化
        $cache = Object::create([
            'class' => YacCache::class,
        ]);

        /* @var $cache ACache */
        // ====== 普通用法 ======
        // 生成一个缓存
        $cache->set('name', 'qingbing', 20);
        $cache->set('sex', 'nan');
        $value = $cache->get('name');
        var_dump($value);

        $cache->delete('sex');
        var_dump($cache);


        $has = $cache->has('grade');
        var_dump($has);
        $has = $cache->has('name');
        var_dump($has);

        $cache->clear();
        var_dump($cache);

        // ====== 批量用法 ======
        $cache->setMultiple([
            'age' => 19,
            'class' => 1,
            'grade' => 2,
        ], 2000);

        $data = $cache->getMultiple([
            'class',
            'name',
            'grade',
            'age',
        ]);
        var_dump($data);
        $cache->deleteMultiple(['class', 'name']);

        // ====== 键、值随意化 ======
        $key = ["sex", "name"];
        // 设置缓存
        $status = $cache->set($key, ["女", ["xxx"]]);
        var_dump($status);
        // 获取缓存
        $data = $cache->get($key);
        var_dump($data);
        // 删除缓存
        $status = $cache->delete($key);
        var_dump($status);
    }
}