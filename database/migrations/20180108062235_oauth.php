<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Oauth extends Migrator
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
        $exists = $this->hasTable('oauth');
        
        if(!$exists){
            $table = $this->table('oauth', array('engine'=>'InnoDB'))->setComment('oauth table');
            
            $table
                ->addColumn(Column::string('app_key', 191)->setComment('app key.'))
                ->addColumn(Column::string('app_secret', 191)->setNullable()->setDefault(null)->setComment('app secret.'))
                ->addColumn(Column::integer('expires_in')->setLimit(11)->setComment('app oauth expires time.'))
                ->addColumn(Column::string('remark', 191)->setComment('remark.'))
                ->addColumn(Column::timestamp('created_at')->setNullable()->setDefault(null)->setComment('created time.'))
                ->addColumn(Column::timestamp('updated_at')->setNullable()->setDefault(null)->setComment('updated time.'))
                
                ->addIndex('app_key')
                
                ->create();            
        }
    }
    
    /**
    * Down Method.
    * @date: 2018年1月9日 下午8:51:23
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('oauth');
    }
}
