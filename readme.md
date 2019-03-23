# Demo Changes

## Controllers
- HomeController: index view.
- ImportController: import xlsx to lang files.
- ExportController: upload lang files, export xlsx file.
- LangController: lang files clear and zip download.
- TranslationController: Translation Editor

## Public Assets
- js/dropzone.min.js
- css/dropzone.min.css

## Middleware
- remove VerifyCsrfToken middleware for demo.

## Config
### filesystem
add lang section:
```php
'lang' => [
    'driver' => 'local',
    'root'   => resource_path('lang'),
],
```

### excel
change transactions.handler = null