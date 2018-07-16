<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'User', 'action' => 'accueil']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
    $routes->connect('/inscription', ['controller' => 'User', 'action' => 'inscription']);
    $routes->connect('/accueil', ['controller' => 'User', 'action' => 'accueil']);
    $routes->connect('/billet/new', ['controller' => 'Billet', 'action' => 'newBillet']);
    $routes->connect('/billet', ['controller' => 'Billet', 'action' => 'readBillet']);
    $routes->connect('/billet/:id/edit', ['controller' => 'Billet', 'action' => 'editBillet']);
    $routes->connect('/billet/:id/delete', ['controller' => 'Billet', 'action' => 'deleteBillet']);
    $routes->connect('/billet/:id', ['controller' => 'Billet', 'action' => 'readOneBillet']);
    $routes->connect('/admin', ['controller' => 'Admin', 'action' => 'index']);
    $routes->connect('/admin/users/:id', ['controller' => 'Admin', 'action' => 'users']);
    $routes->connect('/admin/billets/:id', ['controller' => 'Admin', 'action' => 'billets']);
    $routes->connect('/admin/comments/:id', ['controller' => 'Admin', 'action' => 'comments']);
    $routes->connect('/search/:keywords', ['controller' => 'Search', 'action' => 'search']);
    $routes->connect('/search/:keywords', ['controller' => 'Contact', 'action' => 'index']);
    $routes->connect('/billet/:id/search/:keywords',  ['controller' => 'Billet', 'action' => 'readOneBillet']);
});

/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
