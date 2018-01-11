<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Permission extends Migrator
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
        $exists = $this->hasTable('permission');
        
        if(!$exists){
            $table = $this->table('permission', array('engine'=>'InnoDB'))->setComment('permission table');
            
            $table
                ->addColumn(Column::string('name', 50)->setNullable()->setDefault(null)->setComment('permission name.'))
                ->addColumn(Column::string('path', 100)->setNullable()->setDefault(null)->setComment('permission path.'))
                ->addColumn(Column::string('description', 200)->setNullable()->setDefault(null)->setComment('permission description.'))
                ->addColumn(Column::tinyInteger('status')->setLimit(1)->setNullable()->setDefault(0)->setComment('permission status.'))
                ->addColumn(Column::integer('create_time')->setLimit(11)->setNullable()->setDefault(0)->setComment('permission create time.'))
                ->create();            
        }
    }
    
    /**
    * Down Method.
    * @date: 2018年1月8日 上午10:41:34
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('permission');
    }    
}
