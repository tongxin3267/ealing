<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Area extends Migrator
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
        $exists = $this->hasTable('area');
        
        if(!$exists){
            $table = $this->table('area', array('engine'=>'InnoDB'))->setComment('areas table');
            
            $table
                ->addColumn(Column::string('name', 100)->setComment('areas name.'))
                ->addColumn(Column::integer('pid')->setLimit(11)->setComment('areas parent id.'))
                ->addColumn(Column::string('extends', 191)->setNullable()->setDefault(null)->setComment('extension content.'))
                ->addColumn(Column::timestamp('created_at')->setNullable()->setDefault(null)->setComment('created time.'))
                ->addColumn(Column::timestamp('updated_at')->setNullable()->setDefault(null)->setComment('updated time.'))
                
                ->addIndex('name')->addIndex('pid')
                
                ->create();            
        }
    }
    
    /**
    * Down Method.
    * @date: 2018年1月8日 下午3:45:20
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('area');
    }
}
