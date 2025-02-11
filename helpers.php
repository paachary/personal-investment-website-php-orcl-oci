<?php

/**
 * basePath function
 * Returns the basepath of a particular file.
 *
 * @param string $path
 * @return string
 */
function basePath($path = '')
{
  return __DIR__ . '/' . $path;
}


/**
 * Load a view
 *
 * @param [string] $name
 * @return void
 */
function loadView($name, $data = [])
{

  $viewPath = basePath("views/{$name}.view.php");

  if (file_exists($viewPath)) {
    extract($data);
    require $viewPath;
  } else {
    echo "View '{$name}' not found!";
  }
}

/**
 * loads the partials html components
 *
 * @param string $name
 * @param array $data
 * @return void
 */
function loadPartial($name, $data = [])
{
  $partialPath = basePath("views/partials/{$name}.php");

  if (file_exists($partialPath)) {
    extract($data);
    require $partialPath;
  } else {
    echo "Partial '{$name} not found!'";
  }
}

/**
 * Inspects a value(s)
 *
 * @param [mixed] $param
 * @return void
 */
function inspect($param)
{

  echo '<pre>';
  var_dump($param);
  echo '</pre>';
}


/**
 * Inspect a value(s) and Die
 *
 * @param [mixed] $param
 * @return void
 */
function inspectAndDie($param)
{

  inspect($param);
  die();
}

/**
 * Sanitize Data
 *
 * @param [type] $dirty
 * @return void
 */
function sanitize($dirty)
{
  return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 * Redirect to a given url
 * 
 * @param string $url
 * @return void
 */
function redirect($url)
{
  header("Location: {$url}");
  exit;
}

/**
 * Format amount
 * 
 * @param string $salary
 * @return string Formatted Salary
 */
function formatAmount($amount)
{
  return '₹ ' . number_format(floatval($amount));
}
