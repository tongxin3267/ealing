<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Hook extends Migrator
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
        $exists = $this->hasTable('hook');
        
        if(!$exists){
            $table = $this->table('hook', array('engine'=>'InnoDB'))->setComment('钩子表');
            
            $table
                ->addColumn(Column::string('name', 32)->setNullable()->setDefault(null)->setComment('钩子名称'))
                ->addColumn(Column::string('addon', 32)->setNullable()->setDefault(null)->setComment('钩子来自哪个插件'))
                ->addColumn(Column::string('description')->setNullable()->setDefault(null)->setComment('钩子描述'))
                ->addColumn(Column::tinyInteger('system')->setLimit(4)->setUnsigned()->setNullable()->setDefault(0)->setComment('是否为系统钩子'))
                ->addColumn(Column::tinyInteger('status')->setUnsigned()->setLimit(2)->setNullable()->setDefault(1)->setComment('状态'))
                ->addColumn(Column::timestamp('created_at')->setNullable()->setDefault(null)->setComment('created time.'))
                ->addColumn(Column::timestamp('updated_at')->setNullable()->setDefault(null)->setComment('updated time.'))
                ->create();
        }
    }
    
    /**
    * Down Method.
    * @date: 2018年1月15日 上午8:20:06
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('hook');
    }
}
