<?php include '../quicksite.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo $GLOBALS['lang'] ?>">
  <head>
    <title><?php echo __('Site Title') ?></title>
    <meta charset="utf-8"> 
    <meta name="description" content="<?php echo __('Meta Description') ?>">
    <link rel="stylesheet" type="text/css" media="all" href="/css/styles.css">
    <script type="text/javascript" charset="utf-8" src="/js/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/js/application.js"></script>
  </head>
  <body>
    <div id="container">
      <?php include $template_file ?>
    </div>
  </body>
</html>