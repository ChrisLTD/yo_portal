# Yo Portal
### Version 0.1 | By [Chris Johnson](http://chrisltd.com) | https://github.com/ChrisLTD/yo_portal

Yo Portal is a start page for your web browser that displays RSS feeds for the NY Times, Woot, Weather, and Stock Quotes. It also displays a set of static links you can customize in the config file. The design is fluid and responsive, so it will scale down for phones and tablets.

Here's what it looks like:

![Preview](https://github.com/chrisltd/yo_portal/raw/master/img/preview.png)

The page is personalizable for invididual users and browsers through a settings panel in the footer:

![Settings Panel](https://github.com/chrisltd/yo_portal/raw/master/img/settings.png)

## Requirements
* PHP 5.2 or higher
* PHP's XML extension (enabled by default)
* PHP's PCRE extension (enabled by default)

## Installation
1. Upload the files to a folder on your server
2. Setup a cache folder on your server. [Read these instructions for making your cache folder writable](http://simplepie.org/wiki/faq/file_permissions).
3. Put the absolute server path to the cache folder in the `$portal_cache_location` variable in the `_config.php` file.
4. Create a (Forecast.io API account](https://developer.forecast.io) and set your `$portal_forecastio_api_key` with your API key in the `_config.php` file.
4. Create a (GeoNames account)[http://www.geonames.org/login], enable it for web services, and put your username in the `$portal_geonames_username` variable in `_config.php` file.
5. Enjoy and be sure to check the _config.php file for other settings you can change.

## Included Libraries
* [SimplePie library](http://simplepie.org) - For RSS feed parsing
* [Zepto](http://zeptojs.com) - Lightweight JQuery alternative for modern browsers
* [JQuery](http://jquery.com) - Fallback for older browsers
* [Forecast.io PHP wrapper](https://github.com/tobias-redmann/forecast.io-php-api) - For weather data
* [Skycons](http://darkskyapp.github.io/skycons/) - Animated icons for weather
