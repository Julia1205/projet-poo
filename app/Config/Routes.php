<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
//$routes->get('Product::fetchCocktails');
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');
$routes->get('/fetch', 'Cocktails::fetchCocktails');
/*-- L'accès à la page d'accueil --*/
$routes->get('/', 'Home::index');

/*La partie de gestion des utilisateurs*/
/*-- L'accès à la page de connexion pour l'utilisateur --*/
$routes->get('/login', 'Users::connectUser');
/*-- L'accès à la page de déconnexion pour l'utilisateur --*/
$routes->get('/logout', 'Users::disconnectUser');
/*-- L'accès à la page de déconnexion pour l'utilisateur --*/
$routes->get('/register', 'Auth::index');
$routes->get('/registerUser', 'Auth::index');
$routes->post('/registerUser', 'Auth::registerUser');
/*-- L'accès à la page de déconnexion pour l'utilisateur --*/
$routes->get('/account', 'Users::updateUser');

/*A SUPPRIMER*/
$routes->get('/addCocktail', 'Cocktails::addCocktailView');

/*La partie des pages de règlementation*/
/*-- L'accès à la page de la RGPD --*/
$routes->get('/gdpr', 'Home::gdpr');
/*-- L'accès à la page des Conditions Générales d'Utilisation --*/
$routes->get('/gcu', 'Home::gcu');

/*La partie des cocktails (ajout, lecture, modification, suppression*/
/*-- L'accès à la page d'ajout de cocktail --*/
$routes->get('/cocktail/add', 'Cocktails::cocktailAdd');
/*-- L'accès à la page pour consulter un cocktail --*/
$routes->get('/cocktail/view/(:num)', 'Cocktails::cocktailView/$1');
/*-- L'accès à la page de modification de cocktail --*/
$routes->get('/cocktail/update/(:num)', 'Cocktails::cocktailUpdate/$1');
/*-- L'accès à la page de suppression de cocktail --*/
$routes->get('/cocktail/delete/(:num)', 'Cocktails::cocktailDelete/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
