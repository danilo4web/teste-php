#cria a base de dados
create database vector;

#mudar as conf do banco (db, user, pass)
vim module/Produto/config/module.config.php

#cria as tabelas (no caso somente produto)
data/data_base.sql

#ou pode criar por migrate
./vendor/bin/doctrine-module migrations:migrate

PS: (sugiro criar a tabela com o sql: data/data_base.sql ao invés de criar pelos migrates, pq tem um detalhe com os campos: data_inserido e data_modificado, que não está criando como default timestamp em on create para data_inserido e on update para data_modificado, pq não consegui a tempo corrigir isso na rotina do migrate).

#rodar a aplicação
composer serve
