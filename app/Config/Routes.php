<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

// $routes->match(['post', 'options'], 'register', 'UserController::register');
// $routes->get('users', 'UserController::index');
// $routes->match(['post', 'options'], 'login', 'UserController::login');
// $routes->match(['put', 'options'], 'update-user/(:any)', 'UserController::update/$1');
// $routes->match(['delete', 'options'], 'delete-user/(:any)', 'UserController::delete/$1');
$routes->get('/', 'Home::index');

// User Routes
$routes->match(['post', 'options'], 'register', 'UserController::register');
$routes->get('users', 'UserController::index');
$routes->match(['post', 'options'], 'login', 'UserController::login');
$routes->match(['put', 'options'], 'update-user/(:any)', 'UserController::update/$1');
$routes->match(['delete', 'options'], 'delete-user/(:any)', 'UserController::delete/$1');

// Income Routes
$routes->match(['post', 'options'], 'add-income', 'IncomeController::addIncome');
$routes->get('get-incomes', 'IncomeController::getIncomes');
$routes->match(['delete', 'options'], 'delete-income/(:num)', 'IncomeController::deleteIncome/$1');

// Expense Routes
$routes->match(['post', 'options'], 'add-expense', 'ExpenseController::addExpense');
$routes->get('get-expenses', 'ExpenseController::getExpense');
$routes->match(['delete', 'options'], 'delete-expense/(:num)', 'ExpenseController::deleteExpense/$1');

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->post('admin-login', 'AuthController::adminLogin');
});

