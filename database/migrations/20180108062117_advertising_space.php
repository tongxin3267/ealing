<?php

use think\migration\Migrator;
use think\migration\db\Column;

class AdvertisingSpace extends Migrator
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
        $table = $this->table('advertising_space', array('engine'=>'InnoDB', 'id'=>false, 'primary_key'=>'id'))->setComment('advertising space table');
        
        $table
            ->addColumn(Column::integer('id')->setUnsigned()->setLimit(11)->setComment('advertising space id.'))
            ->addColumn(Column::string('channel', 50)->setComment('advertising channel.'))
            ->addColumn(Column::string('space', 191)->setUnique()->setComment('advertising space id.'))
            ->addColumn(Column::string('alias', 191)->setComment('advertising space alias.'))
            ->addColumn(Column::string('allow_type', 191)->setComment('advertising space allow type.'))
            ->addColumn(Column::text('format')->setComment('advertising space data format.'))
            ->addColumn(Column::text('rule')->setComment('advertising space data rule.'))
            ->addColumn(Column::text('message')->setComment('advertising space form validation hints.'))
            ->addColumn(Column::timestamp('created_at')->setNullable()->setDefault(null)->setComment('created time.'))
            ->addColumn(Column::timestamp('updated_at')->setNullable()->setDefault(null)->setComment('updated time.'))
            ->create();
        
        $table->addIndex('channel')->addIndex('space');
    }
    
    /**
    * Down Method.
    * @date: 2018年1月8日 下午3:29:39
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function down()
    {
        $this->dropTable('advertising_space');
    }    
}
