<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Addons extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $exists = $this->hasTable('addon');
        
        if(!$exists){
            $table = $this->table('addon', array('engine'=>'InnoDB'))->setComment('插件表');
            
            $table
                ->addColumn(Column::string('name', 32)->setNullable()->setDefault(null)->setComment('插件名称'))
                ->addColumn(Column::string('title', 32)->setNullable()->setDefault(null)->setComment('插件标题'))
                ->addColumn(Column::string('icon', 64)->setNullable()->setDefault(null)->setComment('图标'))
                ->addColumn(Column::text('description')->setNullable()->setDefault(null)->setComment('描述'))
                ->addColumn(Column::string('author', 32)->setNullable()->setDefault(null)->setComment('作者'))
                ->addColumn(Column::string('author_url')->setNullable()->setDefault(null)->setComment('作者主页'))
                ->addColumn(Column::text('config')->setNullable()->setComment('配置信息'))
                ->addColumn(Column::text('admin_actions')->setComment('管理操作'))
                ->addColumn(Column::string('version', 16)->setNullable()->setDefault(null)->setComment('版本号'))
                ->addColumn(Column::string('identifier', 64)->setNullable()->setDefault(null)->setComment('插件唯一标识符'))
                ->addColumn(Column::tinyInteger('admin')->setLimit(4)->setNullable()->setDefault(0)->setComment('是否有后台管理'))
                ->addColumn(Column::integer('sort')->setNullable()->setDefault(99)->setComment('排序'))
                ->addColumn(Column::tinyInteger('status')->setLimit(2)->setNullable()->setDefault(1)->setComment('状态'))
                ->addColumn(Column::timestamp('created_at')->setNullable()->setDefault(null)->setComment('created time.'))
                ->addColumn(Column::timestamp('updated_at')->setNullable()->setDefault(null)->setComment('updated time.'))
                ->create();
        }
    }
    
    /**
    * Down Method.
    * @date: 2018年1月15日 上午8:21:23
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('addon');
    }
}
