<?php

use think\migration\Migrator;
use think\migration\db\Column;

class RolePermission extends Migrator
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
        $table = $this->table('role_permission', array('engine'=>'InnoDB', 'id'=>false, 'primary_key'=>'id'))->setComment('role permission table');
        
        $table
            ->addColumn(Column::integer('id')->setUnsigned()->setLimit(11)->setComment('role permission id.'))
            ->addColumn(Column::integer('role_id')->setLimit(11)->setNullable()->setDefault(0)->setComment('role id.'))
            ->addColumn(Column::integer('permission_id')->setLimit(11)->setNullable()->setDefault(0)->setComment('permission id.'))
            ->create();
    }
}
