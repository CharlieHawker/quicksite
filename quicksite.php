<?php
chdir(dirname(__FILE__));
session_start();
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
  $uri = str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
  $GLOBALS['url_parts'] = array_values(array_filter(explode('/', $uri)));
  load_translations(); 
  set_language();
}


/**
 * Loads the translation yml files
 */
function load_translations()
{
  // Init as empty array if not set
  if (!isset($_SESSION['translations']))
  {
    $_SESSION['translations'] = array();
    $_SESSION['translations_last_loaded'] = 0;
  }
  
  $dirhandle = opendir('translations');
  while (($filename = readdir($dirhandle)) !== FALSE)
  {
    if (substr($filename, -4) == '.yml')
    {
      $lang = substr($filename, 0, -4);
      $translation_file_path = 'translations/' . $filename;
      // If we haven't loaded the file or it has been modified more recently than it was loaded then load and store into session
      if (!array_key_exists($lang, $_SESSION['translations']) || $_SESSION['translations_last_loaded'] < filemtime($translation_file_path))
      {
        $yaml = file_get_contents($translation_file_path);
        $_SESSION['translations'][$lang] = yaml_parse($yaml);
        $_SESSION['translations_last_loaded'] = time();
      }
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
    if (array_key_exists($GLOBALS['url_parts'][0], $_SESSION['translations']))
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
  if (array_key_exists($GLOBALS['lang'], $_SESSION['translations']) && array_key_exists($string, $_SESSION['translations'][$GLOBALS['lang']]))
    return $_SESSION['translations'][$GLOBALS['lang']][$string];
  else
    return $string;
}

?>