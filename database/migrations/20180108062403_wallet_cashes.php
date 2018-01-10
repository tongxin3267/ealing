<?php

use think\migration\Migrator;
use think\migration\db\Column;

class WalletCashes extends Migrator
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
        $table = $this->table('wallet_cashes', array('engine'=>'InnoDB', 'id'=>false, 'primary_key'=>'id'))->setComment('cashes table');
        
        $table
            ->addColumn(Column::integer('id')->setUnsigned()->setLimit(11)->setComment('cashes id.'))
            ->addColumn(Column::integer('user_id')->setUnsigned()->setComment('cashes user id.'))
            ->addColumn(Column::bigInteger('value')->setUnsigned()->setComment('cashes money.'))
            ->addColumn(Column::string('type', 100)->setComment('cashes type.'))
            ->addColumn(Column::string('account')->setComment('cashes account.'))
            ->addColumn(Column::tinyInteger('status')->setUnsigned()->setNullable()->setDefault(0)->setComment('status 0-wait,1-adopt,2-refuse.'))
            ->addColumn(Column::text('remark')->setNullable()->setDefault(null)->setComment('remark.'))
            ->addColumn(Column::timestamp('created_at')->setNullable()->setDefault(null)->setComment('created time.'))
            ->addColumn(Column::timestamp('updated_at')->setNullable()->setDefault(null)->setComment('updated time.'))
            ->addColumn(Column::timestamp('deleted_at')->setNullable()->setDefault(null)->setComment('deleted time.'))
            
            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'cascade', 'update'=> 'cascade'])
            
            ->addIndex('user_id')
            
            ->create();
    }
    
    /**
    * Down Method.
    * @date: 2018年1月10日 上午10:54:00
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('wallet_cashes');
    }
}
