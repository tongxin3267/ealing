<?php

use think\migration\Migrator;
use think\migration\db\Column;

class JwtToken extends Migrator
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
        $exists = $this->hasTable('jwt_caches');
        
        if(!$exists){
            $table = $this->table('jwt_caches', array('engine'=>'InnoDB'))->setComment('json web token table');
            
            $table
                ->addColumn(Column::integer('user_id')->setLimit(11)->setComment('user id.'))
                ->addColumn(Column::string('key')->setComment('json web token key.'))
                ->addColumn(Column::integer('expires')->setLimit(11)->setNullable()->setDefault(0)->setComment('json web token expires time.'))
                ->addColumn(Column::tinyInteger('status')->setNullable()->setDefault(0)->setComment('json web token status.'))
                ->addColumn(Column::timestamp('created_at')->setNullable()->setDefault(null)->setComment('created time.'))
                ->addColumn(Column::timestamp('updated_at')->setNullable()->setDefault(null)->setComment('updated time.'))
                
                ->addIndex('key')->addIndex('user_id')
                
                ->create();            
        }      
    }
    
    /**
    * Down Method.
    * @date: 2018年1月9日 下午8:35:12
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('jwt_caches');
    }
}