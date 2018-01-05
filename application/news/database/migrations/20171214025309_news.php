<?php

use think\migration\Migrator;
use think\migration\db\Column;

class User extends Migrator
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
        $table = $this->table('news', array('engine'=>'InnoDB', 'id'=>false, 'primary_key'=>'id'))->setComment('news table');
        
        $table
            ->addColumn(Column::integer("id")->setUnsigned()->setLimit(11)->setComment("news id."))
            ->addColumn(Column::timestamp('created_at')->setNullable()->setDefault(null)->setComment('created time.'))
            ->addColumn(Column::timestamp('updated_at')->setNullable()->setDefault(null)->setComment('updated time.'))
            ->addColumn(Column::timestamp('deleted_at	')->setNullable()->setDefault(null)->setComment('deleted time.'))
            ->create();
    }
    
    public function up()
    {
        
    }
    
    /**
    * Down Method.
    * @date: 2018年1月5日 下午5:24:16
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('news');
    }
}
