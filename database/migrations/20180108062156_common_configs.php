<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CommonConfigs extends Migrator
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
        $table = $this->table('common_configs', array('engine'=>'InnoDB', 'id'=>false))->setComment('common config table');
        
        $table
            ->addColumn(Column::string('name', 100)->setComment('config name.'))
            ->addColumn(Column::string('namespace', 100)->setComment('config namespace.'))
            ->addColumn(Column::text('value')->setNullable()->setDefault(null)->setComment('config value.'))
            ->addColumn(Column::timestamp('created_at')->setNullable()->setDefault(null)->setComment('created time.'))
            ->addColumn(Column::timestamp('updated_at')->setNullable()->setDefault(null)->setComment('updated time.'))
            
            ->setPrimaryKey(['name', 'namespace'])
            
            ->create();        
    }
    
    /**
    * Down Method.
    * @date: 2018年1月9日 下午8:41:01
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('common_configs');
    }
}
