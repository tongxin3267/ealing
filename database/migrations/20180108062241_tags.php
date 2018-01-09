<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Tags extends Migrator
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
        $table = $this->table('tags', array('engine'=>'InnoDB', 'id'=>false, 'primary_key'=>'id'))->setComment('tags table');
        
        $table
            ->addColumn(Column::integer('id')->setUnsigned()->setLimit(11)->setComment('tags id.'))
            ->addColumn(Column::string('name', 150)->setComment('tags name.'))
            ->addColumn(Column::integer('tag_category_id')->setLimit(11)->setComment('tags type.'))
            ->addColumn(Column::integer('weight')->setLimit(11)->setNullable()->setDefault(0)->setComment('tags weight for sort.'))
            ->addColumn(Column::timestamp('created_at')->setNullable()->setDefault(null)->setComment('created time.'))
            ->addColumn(Column::timestamp('updated_at')->setNullable()->setDefault(null)->setComment('updated time.'))
            
            ->addIndex('app_key')
            
            ->create();
    }
    
    /**
    * Down Method.
    * @date: 2018年1月9日 下午8:59:17
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('tags');
    }
}
