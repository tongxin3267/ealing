<?php

use think\migration\Migrator;
use think\migration\db\Column;

class GoldType extends Migrator
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
        $table = $this->table('gold_type', array('engine'=>'InnoDB', 'id'=>false, 'primary_key'=>'id'))->setComment('gold type table');
        
        $table
            ->addColumn(Column::integer('id')->setUnsigned()->setLimit(11)->setComment('gold type id.'))
            ->addColumn(Column::string('name', 191)->setComment('gold type name.'))
            ->addColumn(Column::string('unit', 191)->setNullable()->setDefault(null)->setComment('gold type unit.'))
            ->addColumn(Column::tinyInteger('status')->setNullable()->setDefault(1)->setComment('status 1-open 0-close'))
            ->addColumn(Column::timestamp('created_at')->setNullable()->setDefault(null)->setComment('created time.'))
            ->addColumn(Column::timestamp('updated_at')->setNullable()->setDefault(null)->setComment('updated time.'))
            ->create();
    }
    
    /**
    * Down Method.
    * @date: 2018年1月9日 下午8:44:59
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('gold_type');
    }
}
