<?php

use think\migration\Migrator;
use think\migration\db\Column;

class UserRole extends Migrator
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
        $exists = $this->hasTable('user_role');
        
        if(!$exists){
            $table = $this->table('user_role', array('engine'=>'InnoDB'))->setComment('user role table');
            
            $table
                ->addColumn(Column::integer('user_id')->setLimit(11)->setNullable()->setDefault(0)->setComment('user id.'))
                ->addColumn(Column::integer('role_id')->setLimit(11)->setNullable()->setDefault(0)->setComment('role id.'))
                ->create();
        }
    }
    
    /**
    * Down Method.
    * @date: 2018年1月8日 上午10:49:07
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('user_role');
    }
}
