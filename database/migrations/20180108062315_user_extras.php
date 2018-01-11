<?php

use think\migration\Migrator;
use think\migration\db\Column;

class UserExtras extends Migrator
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
        $exists = $this->hasTable('user_extras');
        
        if(!$exists){
            $table = $this->table('user_extras', array('engine'=>'InnoDB', 'id'=>false))->setComment('user extras table');
            
            $table
                ->addColumn(Column::integer('user_id')->setUnique()->setLimit(11)->setComment('user id.'))
                ->addColumn(Column::integer('likes_count')->setUnsigned()->setLimit(11)->setNullable()->setDefault(0)->setComment('user likes count.'))
                ->addColumn(Column::integer('comments_count')->setUnsigned()->setLimit(11)->setNullable()->setDefault(0)->setComment('user comments count.'))
                ->addColumn(Column::integer('followers_count')->setUnsigned()->setLimit(11)->setNullable()->setDefault(0)->setComment('user followers count.'))
                ->addColumn(Column::integer('followings_count')->setUnsigned()->setLimit(11)->setNullable()->setDefault(0)->setComment('user followings count.'))
                ->addColumn(Column::timestamp('created_at')->setNullable()->setDefault(null)->setComment('created time.'))
                ->addColumn(Column::timestamp('updated_at')->setNullable()->setDefault(null)->setComment('updated time.'))
                ->addColumn(Column::timestamp('deleted_at')->setNullable()->setDefault(null)->setComment('deleted time.'))
                
                ->addIndex('user_id')
                
                ->create();
        }
    }
    
    /**
    * Down Method.
    * @date: 2018年1月10日 上午10:06:54
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('user_extras');
    }
}
