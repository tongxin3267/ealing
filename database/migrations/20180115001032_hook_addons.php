<?php

use think\migration\Migrator;
use think\migration\db\Column;

class HookAddons extends Migrator
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
        $exists = $this->hasTable('hook_addon');
        
        if(!$exists){
            $table = $this->table('hook_addon', array('engine'=>'InnoDB'))->setComment('钩子-插件对应表');
            
            $table
                ->addColumn(Column::integer('hook')->setNullable()->setDefault(null)->setComment('钩子id'))
                ->addColumn(Column::string('addon', 32)->setNullable()->setDefault(null)->setComment('插件标识'))
                ->addColumn(Column::integer('sort')->setNullable()->setDefault(99)->setComment('排序'))
                ->addColumn(Column::tinyInteger('status')->setLimit(2)->setNullable()->setDefault(1)->setComment('状态'))
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
        $this->dropTable('hook_addon');
    }
}
