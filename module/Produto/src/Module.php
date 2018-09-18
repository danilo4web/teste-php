<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Produto;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Produto\Controller\ProdutoController;

class Module implements ConfigProviderInterface {
    const VERSION = '3.0.3-dev';

    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig() {
        return [
            'factories' => [
                Model\ProdutoTable::class => function($container) {
                    $tableGateway = $container->get( Model\ProdutoTableGateway::class );
                    return new Model\ProdutoTable($tableGateway);
                },
                Model\ProdutoTableGateway::class => function($container) {
                    $dbAdapter = $container->get( AdapterInterface::class );

                    
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype( new Model\Produto() );
                    return new TableGateway('produto', $dbAdapter, null, $resultSetPrototype);
                }
            ]
        ];
    }

    public function getControllerConfig() {
        return [
            'factories' => [
                ProdutoController::class => function($container) {
                    $tableGateway = $container->get( Model\ProdutoTable::class );
                    return new ProdutoController( $tableGateway );
                }
            ]
        ];
    }
}
