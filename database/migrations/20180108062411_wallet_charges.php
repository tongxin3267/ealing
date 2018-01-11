<?php

use think\migration\Migrator;
use think\migration\db\Column;

class WalletCharges extends Migrator
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
        $exists = $this->hasTable('wallet_charges');
        
        if(!$exists){
            $table = $this->table('wallet_charges', array('engine'=>'InnoDB'))->setComment('charges table');
            
            $table
                ->addColumn(Column::integer('user_id')->setNullable()->setDefault(null)->setComment('关联用户，可不存在，例如直接支付方式等。存在便于按照用户检索。.'))
                ->addColumn(Column::string('channel', 100)->setComment('支付频道，参考 Ping++，增加 user 选项，表示站内用户凭据'))
                ->addColumn(Column::string('account', 100)->setNullable()->setDefault(null)->setComment('交易账户，减项为目标账户，增项为来源账户，当 type 为 user 时，此处是用户ID'))
                ->addColumn(Column::string('charge_id', 150)->setNullable()->setDefault(null)->setComment('credential id(for ping++).'))
                ->addColumn(Column::tinyInteger('action')->setUnsigned()->setComment('action 1-inc,0-dec'))
                ->addColumn(Column::bigInteger('amount')->setUnsigned()->setComment('total money.'))
                ->addColumn(Column::string('currency', 30)->setNullable()->setDefault('cny')->setComment('money type.'))
                ->addColumn(Column::string('subject')->setComment('order title.'))
                ->addColumn(Column::text('body')->setComment('order info.'))
                ->addColumn(Column::string('transaction_no')->setNullable()->setDefault(null)->setComment('logs id.'))
                ->addColumn(Column::tinyInteger('status')->setUnsigned()->setNullable()->setDefault(0)->setComment('status 0-wait,1-success,2-fail.'))
                ->addColumn(Column::timestamp('created_at')->setNullable()->setDefault(null)->setComment('created time.'))
                ->addColumn(Column::timestamp('updated_at')->setNullable()->setDefault(null)->setComment('updated time.'))
                ->addColumn(Column::timestamp('deleted_at')->setNullable()->setDefault(null)->setComment('deleted time.'))
                
                ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'cascade', 'update'=> 'cascade'])
                
                ->addIndex(['user_id',])
                ->addIndex('charge_id')
                ->addIndex('channel')
                ->addIndex('account')
                ->addIndex('status')
                ->addIndex('action')
                ->addIndex('transaction_no')
                
                ->create();
        }
    }
    
    /**
    * Down Method.
    * @date: 2018年1月10日 上午11:08:54
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('wallet_charges');
    }
}
