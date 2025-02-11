<?php

$router->get(
  '/',
  'HomeController@index',
  ['auth']
);

// ********************************************************************** //

// Accounts

$router->get(
  '/accounts',
  'AccountsController@index',
  ['auth']
);

$router->get(
  '/accounts/edit/{acctNbr}',
  'AccountsController@editView',
  ['auth']
);

$router->get(
  '/accounts/create',
  'AccountsController@createView',
  ['auth']
);

$router->post(
  '/accounts/search',
  'AccountsController@searchAccounts',
  ['auth']
);

$router->post(
  '/accounts/edit',
  'AccountsController@update',
  ['auth']
);

$router->post(
  '/accounts/create',
  'AccountsController@create',
  ['auth']
);

$router->delete(
  '/accounts/delete',
  'AccountsController@delete',
  ['auth']
);

// ********************************************************************** //

// Investments

$router->get(
  '/savings/{acctNbr}',
  'SavingsController@index',
  ['auth']
);

$router->get(
  '/savings/edit/{investmentId}',
  'SavingsController@editView',
  ['auth']
);

$router->get(
  '/savings/new/create',
  'SavingsController@createView',
  ['auth']
);

$router->post(
  '/savings/edit',
  'SavingsController@update',
  ['auth']
);

$router->post(
  '/savings/new/create',
  'SavingsController@create',
  ['auth']
);

$router->delete(
  '/savings/edit',
  'SavingsController@delete',
  ['auth']
);

// ********************************************************************** //

// Customer Login and Registration

$router->get(
  '/auth/login',
  'UserController@loginView',
  ['guest']
);

$router->get(
  '/auth/register',
  'UserController@registerView',
  ['guest']
);

$router->get(
  '/users',
  'UserController@index',
  ['auth']
);

$router->get(
  '/users/edit',
  'UserController@edit',
  ['auth']
);

$router->get(
  '/users/passwordReset',
  'UserController@passwordReset',
  ['auth']
);

$router->get(
  '/users/forgotPassword',
  'UserController@forgotPassword',
  ['guest']
);


$router->post(
  '/users/edit',
  'UserController@store',
  ['auth']
);

$router->post(
  '/auth/login',
  'UserController@login',
  ['guest']
);

$router->post(
  '/auth/register',
  'UserController@register',
  ['guest']
);

$router->post(
  '/users/passwordReset',
  'UserController@updatePassword',
  ['auth']
);

$router->post(
  '/users/forgotPassword',
  'UserController@sendPassword',
  ['guest']
);


$router->post(
  '/auth/logout',
  'UserController@logout',
  ['auth']
);



// ********************************************************************** //

// Reports

$router->get(
  '/reports/debitSumm',
  'ReportsController@mnthlyDebitStmt',
  ['auth']
);

$router->get(
  '/reports/activeInvestmentsReport',
  'ReportsController@activeInvestmentsReport',
  ['auth']
);



// ********************************************************************** //

// Banks

$router->get(
  '/banks',
  'BanksController@index',
  ['auth']
);

$router->get(
  '/banks/edit/{bankId}',
  'BanksController@edit',
  ['auth']
);

$router->get(
  '/banks/create',
  'BanksController@create',
  ['auth']
);

$router->post(
  '/banks/edit',
  'BanksController@update',
  ['auth']
);

$router->post(
  '/banks/create',
  'BanksController@store',
  ['auth']
);

// ********************************************************************** //

$router->get(
  '/instrumentTypes',
  'InstrumentTypesController@index',
  ['auth']
);

$router->get(
  '/instrumentTypes/edit/{instrumentTypeId}',
  'InstrumentTypesController@edit',
  ['auth']
);

$router->get(
  '/instrumentTypes/create',
  'InstrumentTypesController@create',
  ['auth']
);

$router->post(
  '/instrumentTypes/edit',
  'InstrumentTypesController@update',
  ['auth']
);

$router->post(
  '/instrumentTypes/create',
  'InstrumentTypesController@store',
  ['auth']
);
