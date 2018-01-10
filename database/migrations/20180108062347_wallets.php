<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Wallets extends Migrator
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
        $table = $this->table('wallets', array('engine'=>'InnoDB', 'id'=>false, 'primary_key'=>'id'))->setComment('wallets table');
        
        $table
            ->addColumn(Column::integer('id')->setUnsigned()->setLimit(11)->setComment('wallets id.'))
            ->addColumn(Column::integer('user_id')->setUnsigned()->setUnique()->setComment('wallets owner user id.'))
            ->addColumn(Column::bigInteger('balance')->setUnsigned()->setComment('wallets balance'))
            ->addColumn(Column::timestamp('created_at')->setNullable()->setDefault(null)->setComment('created time.'))
            ->addColumn(Column::timestamp('updated_at')->setNullable()->setDefault(null)->setComment('updated time.'))
            
            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            
            ->addIndex('balance')
            
            ->create();
    }
    
    /**
    * Down Method.
    * @date: 2018年1月10日 上午10:40:43
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('wallets');
    }
}
