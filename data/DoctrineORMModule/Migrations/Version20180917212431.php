<?php declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180917212431 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $table = $schema->createTable('produto');
        $table->addColumn('id', 'integer', ['autoincrement'=>true]);
        $table->addColumn('nome', 'text', ['notnull'=>true]);
        $table->addColumn('descricao', 'text', ['notnull'=>true]);
        $table->addColumn('quantidade', 'integer', ['notnull'=>true]);
        $table->addColumn('preco', 'integer', ['notnull'=>true]);

        $table->addColumn('data_inserido', 'datetime', ['notnull'=>true, ['columnDefinition' => 'timestamp default current_timestamp']]);
        $table->addColumn('data_modificado', 'datetime', ['notnull'=>true, ['columnDefinition' => 'timestamp default current_timestamp on update current_timestamp']]);

        $table->setPrimaryKey(['id']);
        $table->addOption('engine' , 'InnoDB');    
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('produto');
    }
}
