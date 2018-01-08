<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Users extends Migrator
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
        $table = $this->table('users', array('engine'=>'InnoDB', 'id'=>false, 'primary_key'=>'id'))->setComment('user table');
        
        $table
            ->addColumn(Column::integer('id')->setUnsigned()->setLimit(11)->setComment('user id.'))
            ->addColumn(Column::string('name', 100)->setNullable()->setDefault(null)->setUnique()->setComment('user name.'))
            ->addColumn(Column::string('email', 150)->setNullable()->setDefault(null)->setUnique()->setComment('user eamil.'))
            ->addColumn(Column::string('phone', 50)->setNullable()->setDefault(null)->setUnique()->setComment('user phone.'))
            ->addColumn(Column::string('password', 191)->setNullable()->setDefault(null)->setComment('password.'))
            ->addColumn(Column::string('bio', 191)->setNullable()->setDefault(null)->setComment('user bio.'))
            ->addColumn(Column::tinyInteger('sex')->setNullable()->setDefault(0)->setComment('user sex.'))
            ->addColumn(Column::string('location')->setNullable()->setDefault(null)->setComment('user location.'))
            ->addColumn(Column::string('remember_token', 100)->setNullable()->setDefault(null)->setComment('user auth token.'))
            ->addColumn(Column::timestamp('created_at')->setNullable()->setDefault(null)->setComment('created time.'))
            ->addColumn(Column::timestamp('updated_at')->setNullable()->setDefault(null)->setComment('updated time.'))
            ->addColumn(Column::timestamp('deleted_at')->setNullable()->setDefault(null)->setComment('deleted time.'))
            ->create();
    }
    
    /**
     * Down Method.
     * @date: 2018年1月5日 下午5:24:16
     * @author: onep2p <324834500@qq.com>
     * @param: variable
     * @return:
     */
    public function down()
    {
        $this->dropTable('users');
    }    
}
