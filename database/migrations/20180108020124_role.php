<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Role extends Migrator
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
        $exists = $this->hasTable('role');
        
        if(!$exists){
            $table = $this->table('role', array('engine'=>'InnoDB'))->setComment('user role table');
            
            $table
                ->addColumn(Column::string('name', 50)->setNullable()->setComment('role name.'))
                ->addColumn(Column::integer('parent_id')->setLimit(11)->setNullable()->setDefault(0)->setComment('role pid.'))
                ->addColumn(Column::string('description', 200)->setNullable()->setDefault(null)->setComment('role description.'))
                ->addColumn(Column::tinyInteger('status')->setLimit(1)->setNullable()->setDefault(0)->setComment('role status.'))
                ->addColumn(Column::integer('sort_num')->setLimit(11)->setNullable()->setDefault(0)->setComment('role list sort.'))
                ->addColumn(Column::integer('left_key')->setLimit(11)->setNullable()->setDefault(0)->setComment('For an organization'))
                ->addColumn(Column::integer('right_key')->setLimit(11)->setNullable()->setDefault(0)->setComment('To organize the relationship between rvalue'))
                ->addColumn(Column::integer('level')->setLimit(11)->setNullable()->setDefault(0)->setComment('role for level'))
                ->create();            
        }      
    }
    
    /**
    * Down Method.
    * @date: 2018年1月8日 上午10:19:19
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('role');
    }    
}
