<?php
chdir(dirname(__FILE__));
set_globals();
$template_file = load_page();


/**
 * Loads the page
 */
function load_page()
{
  $path = 'templates/';
  if (!empty($GLOBALS['url_parts']))
  {
    foreach ($GLOBALS['url_parts'] as $key => $part)
    {
      if ($key+1 == count($url_parts))
      {
        $file = $path . $part . '.php';
        if (file_exists($file))
          return $file;
      }
      else 
        $path .= $part . '/';
    }
  }
  else
    return $path . '/home.php';
  
  // 404 if we get this far
  header('HTTP/1.0 404 Not Found');
  return 'templates/error/404.php';
}


/**
 * Sets some global variables
 */
function set_globals()
{
  $GLOBALS['url_parts'] = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI'])));
  $GLOBALS['translations'] = array();
  load_translations(); 
  set_language();
}


/**
 * Loads the translation yml files
 */
function load_translations()
{
  $dirhandle = opendir('translations');
  while (($filename = readdir($dirhandle)) !== FALSE)
  {
    if (substr($filename, -4) == '.yml')
    {
      $yaml = file_get_contents('translations/' . $filename);
      $GLOBALS['translations'][substr($filename, 0, -4)] = yaml_parse($yaml);
    }
  }
}


/**
 * Sets the language based on URL path
 */
function set_language()
{
  if (count($GLOBALS['url_parts']))
  {
    if (array_key_exists($GLOBALS['url_parts'][0], $GLOBALS['translations']))
    {
      $GLOBALS['lang'] = array_shift($GLOBALS['url_parts']);
      return;
    }
  }
  $GLOBALS['lang'] = 'en';
}


/**
 * Translate a string
 * @param string $string The string to translate  
 * @return string The translated string
 */
function __($string)
{
  if (array_key_exists($GLOBALS['lang'], $GLOBALS['translations']) && array_key_exists($string, $GLOBALS['translations'][$GLOBALS['lang']]))
    return $GLOBALS['translations'][$GLOBALS['lang']][$string];
  else
    return $string;
}

?>