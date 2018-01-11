<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Advertising extends Migrator
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
        $exists = $this->hasTable('advertising');
        
        if(!$exists){
            $table = $this->table('advertising', array('engine'=>'InnoDB'))->setComment('advertising table');
            
            $table
                ->addColumn(Column::integer('space_id')->setLimit(11)->setUnsigned()->setComment('advertising space id.'))
                ->addColumn(Column::string('title', 191)->setComment('advertising title.'))
                ->addColumn(Column::string('type', 191)->setComment('advertising type.'))
                ->addColumn(Column::text('data')->setNullable()->setComment('for parmas.'))
                ->addColumn(Column::integer('sort')->setLimit(11)->setDefault(0)->setComment('advertising space sort.'))
                ->addColumn(Column::timestamp('created_at')->setNullable()->setDefault(null)->setComment('created time.'))
                ->addColumn(Column::timestamp('updated_at')->setNullable()->setDefault(null)->setComment('updated time.'))
                
                ->addIndex('space_id')
                
                ->create();            
        }
    }
    
    /**
    * Down Method.
    * @date: 2018年1月8日 下午2:42:59
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('advertising');
    }    
}
