Quicksite Template
==================

A simple PHP based tool for creating websites that have:

- Short lifespan
- Simple content requirements
- No CMS
- Multi-language content

This tool is _not_ intended for complex websites, but rather non-database driven sites that need to be produced rapidly and with minimal effort. To that end the tool offers:

- Intelligble template folder structure linked directly to URL paths (e.g. /page/test sits in /templates/page/test.php)
- Simple internationalisation with YAML based translation file(s) and URL path prefixes (e.g. /fr/page/test)
- Pre-configured SASS .scss file with variables defined for common layout customisation
- jQuery 1.9.1 and an application.js file containing common javascript functions and legacy browser HTML5 DOM element support
- [CSS3 PIE](http://css3pie.com) for legacy browser support

Requirements
------------

- PHP 4+
- YAML - PHP [PECL Extension](http://pecl.php.net/package/yaml)
- [SASS](http://sass-lang.com/) (optional)

Usage
-----

1. Checkout a copy of the code in a directory of your choice
2. Configure apache (or your chosen web server) with the 'web' folder as the DocumentRoot directive and ensure that directory allows .htaccess overrides
3. Add some translations to the config/translations.yml file - you'll see there's already an en.yml and fr.yml file
4. Add some templates to the templates folder - there is already an error/404.php template used for 404 errors
5. Tweak the layout which is at web/index.php
6. Watch the stylesheet with SASS using the command `sass --watch styles.scss:styles.css`
7. Edit away!


Author
------

Written and maintained by [Charlie Hawker](http://twitter.com/CharlieHawker). Occasional blogger at [Too Many Redirects](http://www.toomanyredirects.com).