<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */
namespace SwoftTest\Db\Cases\Mysql;

use Swoft\Db\Query;
use SwoftTest\Db\Cases\AbstractMysqlCase;
use SwoftTest\Db\Testing\Entity\Prefix;

/**
 * PrefixTest
 */
class PrefixTest extends AbstractMysqlCase
{
    public function prefixProvider()
    {
        $prefix         = new Prefix();
        $prefix['name'] = 'prefix name';

        $id = $prefix->save()->getResult();

        return [
            [$id],
        ];
    }

    /**
     * @dataProvider prefixProvider
     *
     * @param int $id
     */
    public function testSave(int $id)
    {
        $prefix = Prefix::findById($id)->getResult();
        $this->assertEquals($prefix['id'], $id);


        $one = Query::table(Prefix::class)->where('s_id', $id)->one()->getResult();
        $this->assertEquals($one['s_id'], $id);

        $list = Prefix::findAll()->getResult();
        $this->assertGreaterThanOrEqual(1, count($list));
    }
}
