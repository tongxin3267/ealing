<?php

use think\migration\Migrator;
use think\migration\db\Column;

class VerificationCode extends Migrator
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
        $exists = $this->hasTable('verification_code');
        
        if(!$exists){
            $table = $this->table('verification_code', array('engine'=>'InnoDB'))->setComment('verification code table');
            
            $table
                ->addColumn(Column::integer('user_id')->setUnsigned()->setLimit(11)->setComment('user id.'))
                ->addColumn(Column::string('channel', 50)->setComment('send channer eg:mail、sms.'))
                ->addColumn(Column::string('account')->setComment('send account.'))
                ->addColumn(Column::string('code', 20)->setComment('send code.'))
                ->addColumn(Column::timestamp('created_at')->setNullable()->setDefault(null)->setComment('created time.'))
                ->addColumn(Column::timestamp('updated_at')->setNullable()->setDefault(null)->setComment('updated time.'))
                ->addColumn(Column::timestamp('deleted_at')->setNullable()->setDefault(null)->setComment('deleted time.'))
                
                ->addIndex(['user_id','account'])
                
                ->create();
        }
    }
    
    /**
    * Down Method.
    * @date: 2018年1月10日 上午10:32:47
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('verification_code');
    }
}
