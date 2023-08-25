<?php return array (
  'app' => 
  array (
    'name' => 'Whistler Ghana Limited',
    'env' => 'local',
    'debug' => true,
    'url' => 'https://apis.ideationtec.com/whistler',
    'timezone' => 'UTC',
    'locale' => 'English-en',
    'fallback_locale' => 'English-en',
    'faker_locale' => 'en_US',
    'key' => 'base64:maxQFpmbI6x32vwUXFjpYdELc+wBpMb9y8PaXugSaf8=',
    'cipher' => 'AES-256-CBC',
    'log' => 'daily',
    'log_level' => 'error',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Laravel\\Tinker\\TinkerServiceProvider',
      23 => 'App\\Providers\\AppServiceProvider',
      24 => 'App\\Providers\\AuthServiceProvider',
      25 => 'App\\Providers\\EventServiceProvider',
      26 => 'App\\Providers\\RouteServiceProvider',
      27 => 'Collective\\Html\\HtmlServiceProvider',
      28 => 'Laravel\\Passport\\PassportServiceProvider',
      29 => 'Spatie\\Permission\\PermissionServiceProvider',
      30 => 'Kreait\\Laravel\\Firebase\\ServiceProvider',
      31 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      32 => 'Spatie\\Backup\\BackupServiceProvider',
      33 => 'NotificationChannels\\WebPush\\WebPushServiceProvider',
      34 => 'Edujugon\\PushNotification\\Providers\\PushNotificationServiceProvider',
      35 => 'Yajra\\DataTables\\DataTablesServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Form' => 'Collective\\Html\\FormFacade',
      'Html' => 'Collective\\Html\\HtmlFacade',
      'Input' => 'Illuminate\\Support\\Facades\\Input',
      'Hyvikk' => 'App\\Model\\Hyvikk',
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
      'DataTables' => 'Yajra\\DataTables\\Facades\\DataTables',
    ),
    'debug_blacklist' => 
    array (
      '_COOKIE' => 
      array (
      ),
      '_SERVER' => 
      array (
        0 => 'XDG_SESSION_ID',
        1 => 'HOSTNAME',
        2 => 'SHELL',
        3 => 'HISTSIZE',
        4 => 'SSH_CLIENT',
        5 => 'PERL5LIB',
        6 => 'QTDIR',
        7 => 'QTINC',
        8 => 'PERL_MB_OPT',
        9 => 'QT_GRAPHICSSYSTEM_CHECKED',
        10 => 'USER',
        11 => 'MAIL',
        12 => 'PATH',
        13 => 'PWD',
        14 => 'LANG',
        15 => 'KDEDIRS',
        16 => 'HISTCONTROL',
        17 => 'SHLVL',
        18 => 'HOME',
        19 => 'PERL_LOCAL_LIB_ROOT',
        20 => 'LOGNAME',
        21 => 'QTLIB',
        22 => 'XDG_DATA_DIRS',
        23 => 'SSH_CONNECTION',
        24 => 'LESSOPEN',
        25 => 'XDG_RUNTIME_DIR',
        26 => 'QT_PLUGIN_PATH',
        27 => 'PERL_MM_OPT',
        28 => '_',
        29 => 'OLDPWD',
        30 => 'PHP_SELF',
        31 => 'SCRIPT_NAME',
        32 => 'SCRIPT_FILENAME',
        33 => 'PATH_TRANSLATED',
        34 => 'DOCUMENT_ROOT',
        35 => 'REQUEST_TIME_FLOAT',
        36 => 'REQUEST_TIME',
        37 => 'argv',
        38 => 'argc',
        39 => 'SHELL_VERBOSITY',
        40 => 'APP_URL',
        41 => 'front_enable',
        42 => 'DB_HOST',
        43 => 'DB_DATABASE',
        44 => 'DB_USERNAME',
        45 => 'DB_PASSWORD',
        46 => 'APP_NAME',
      ),
      '_ENV' => 
      array (
        0 => 'SHELL_VERBOSITY',
        1 => 'APP_URL',
        2 => 'front_enable',
        3 => 'DB_HOST',
        4 => 'DB_DATABASE',
        5 => 'DB_USERNAME',
        6 => 'DB_PASSWORD',
        7 => 'APP_NAME',
      ),
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
      ),
      'backend' => 
      array (
        'driver' => 'passport',
        'provider' => 'users',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Model\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'backup' => 
  array (
    'backup' => 
    array (
      'name' => 'Whistler Ghana Limited',
      'source' => 
      array (
        'files' => 
        array (
          'include' => 
          array (
            0 => '/var/www/html/whistler/framework',
          ),
          'exclude' => 
          array (
            0 => '/var/www/html/whistler/framework/vendor',
            1 => '/var/www/html/whistler/framework/node_modules',
          ),
          'follow_links' => false,
        ),
        'databases' => 
        array (
          0 => 'mysql',
        ),
      ),
      'database_dump_compressor' => NULL,
      'destination' => 
      array (
        'filename_prefix' => '',
        'disks' => 
        array (
          0 => 'backup',
        ),
      ),
      'temporary_directory' => '/var/www/html/whistler/framework/storage/backup',
    ),
    'notifications' => 
    array (
      'notifications' => 
      array (
        'Spatie\\Backup\\Notifications\\Notifications\\BackupHasFailed' => 
        array (
          0 => '',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\UnhealthyBackupWasFound' => 
        array (
          0 => '',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\CleanupHasFailed' => 
        array (
          0 => '',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\BackupWasSuccessful' => 
        array (
          0 => '',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\HealthyBackupWasFound' => 
        array (
          0 => '',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\CleanupWasSuccessful' => 
        array (
          0 => '',
        ),
      ),
      'notifiable' => 'Spatie\\Backup\\Notifications\\Notifiable',
      'mail' => 
      array (
        'to' => 'info@hyvikk.com',
        'from' => 
        array (
          'address' => 'hello@example.com',
          'name' => 'Example',
        ),
      ),
      'slack' => 
      array (
        'webhook_url' => '',
        'channel' => NULL,
        'username' => NULL,
        'icon' => NULL,
      ),
    ),
    'monitor_backups' => 
    array (
      0 => 
      array (
        'name' => 'Whistler Ghana Limited',
        'disks' => 
        array (
          0 => 'backup',
        ),
        'health_checks' => 
        array (
          'Spatie\\Backup\\Tasks\\Monitor\\HealthChecks\\MaximumAgeInDays' => 1,
          'Spatie\\Backup\\Tasks\\Monitor\\HealthChecks\\MaximumStorageInMegabytes' => 5000,
        ),
      ),
    ),
    'cleanup' => 
    array (
      'strategy' => 'Spatie\\Backup\\Tasks\\Cleanup\\Strategies\\DefaultStrategy',
      'default_strategy' => 
      array (
        'keep_all_backups_for_days' => 7,
        'keep_daily_backups_for_days' => 16,
        'keep_weekly_backups_for_weeks' => 8,
        'keep_monthly_backups_for_months' => 4,
        'keep_yearly_backups_for_years' => 2,
        'delete_oldest_backups_when_using_more_megabytes_than' => 5000,
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'null',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'app_id' => NULL,
        'key' => NULL,
        'secret' => NULL,
        'options' => 
        array (
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/var/www/html/whistler/framework/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
    ),
    'prefix' => 'laravel',
  ),
  'currency' => 
  array (
    'INR' => 'INR',
    'USD' => 'USD',
    'AED' => 'AED',
    'ALL' => 'ALL',
    'AMD' => 'AMD',
    'ARS' => 'ARS',
    'AUD' => 'AUD',
    'AWG' => 'AWG',
    'BBD' => 'BBD',
    'BDT' => 'BDT',
    'BMD' => 'BMD',
    'BND' => 'BND',
    'BOB' => 'BOB',
    'BSD' => 'BSD',
    'BWP' => 'BWP',
    'BZD' => 'BZD',
    'CAD' => 'CAD',
    'CHF' => 'CHF',
    'CNY' => 'CNY',
    'COP' => 'COP',
    'CRC' => 'CRC',
    'CZK' => 'CZK',
    'DKK' => 'DKK',
    'DOP' => 'DOP',
    'DZD' => 'DZD',
    'EGP' => 'EGP',
    'ETB' => 'ETB',
    'EUR' => 'EUR',
    'FJD' => 'FJD',
    'GBP' => 'GBP',
    'GIP' => 'GIP',
    'GMD' => 'GMD',
    'GTQ' => 'GTQ',
    'GYD' => 'GYD',
    'HKD' => 'HKD',
    'HNL' => 'HNL',
    'HRK' => 'HRK',
    'HTG' => 'HTG',
    'HUF' => 'HUF',
    'IDR' => 'IDR',
    'ILS' => 'ILS',
    'JMD' => 'JMD',
    'KES' => 'KES',
    'KGS' => 'KGS',
    'KHR' => 'KHR',
    'KYD' => 'KYD',
    'KZT' => 'KZT',
    'LAK' => 'LAK',
    'LBP' => 'LBP',
    'LKR' => 'LKR',
    'LRD' => 'LRD',
    'LSL' => 'LSL',
    'MAD' => 'MAD',
    'MDL' => 'MDL',
    'MKD' => 'MKD',
    'MMK' => 'MMK',
    'MNT' => 'MNT',
    'MOP' => 'MOP',
    'MUR' => 'MUR',
    'MVR' => 'MVR',
    'MWK' => 'MWK',
    'MXN' => 'MXN',
    'MYR' => 'MYR',
    'NAD' => 'NAD',
    'NGN' => 'NGN',
    'NIO' => 'NIO',
    'NOK' => 'NOK',
    'NPR' => 'NPR',
    'NZD' => 'NZD',
    'PEN' => 'PEN',
    'PGK' => 'PGK',
    'PHP' => 'PHP',
    'PKR' => 'PKR',
    'QAR' => 'QAR',
    'RUB' => 'RUB',
    'SAR' => 'SAR',
    'SCR' => 'SCR',
    'SEK' => 'SEK',
    'SGD' => 'SGD',
    'SLL' => 'SLL',
    'SOS' => 'SOS',
    'SZL' => 'SZL',
    'TTD' => 'TTD',
    'TZS' => 'TZS',
    'UYU' => 'UYU',
    'UZS' => 'UZS',
    'YER' => 'YER',
    'ZAR' => 'ZAR',
    'AFN' => 'AFN',
    'ANG' => 'ANG',
    'AOA' => 'AOA',
    'AZN' => 'AZN',
    'BAM' => 'BAM',
    'BGN' => 'BGN',
    'BIF' => 'BIF',
    'BRL' => 'BRL',
    'CDF' => 'CDF',
    'CLP' => 'CLP',
    'CVE' => 'CVE',
    'DJF' => 'DJF',
    'FKP' => 'FKP',
    'GEL' => 'GEL',
    'GNF' => 'GNF',
    'ISK' => 'ISK',
    'JPY' => 'JPY',
    'KMF' => 'KMF',
    'KRW' => 'KRW',
    'MGA' => 'MGA',
    'MRO' => 'MRO',
    'MZN' => 'MZN',
    'PAB' => 'PAB',
    'PLN' => 'PLN',
    'PYG' => 'PYG',
    'RON' => 'RON',
    'RSD' => 'RSD',
    'RWF' => 'RWF',
    'SBD' => 'SBD',
    'SHP' => 'SHP',
    'SRD' => 'SRD',
    'STD' => 'STD',
    'THB' => 'THB',
    'TJS' => 'TJS',
    'TOP' => 'TOP',
    'TRY' => 'TRY',
    'TWD' => 'TWD',
    'UAH' => 'UAH',
    'UGX' => 'UGX',
    'VND' => 'VND',
    'VUV' => 'VUV',
    'WST' => 'WST',
    'XAF' => 'XAF',
    'XCD' => 'XCD',
    'XOF' => 'XOF',
    'XPF' => 'XPF',
    'ZMW' => 'ZMW',
    'CUP' => 'CUP',
    'GHS' => 'GHS',
    'SSP' => 'SSP',
    'SVC' => 'SVC',
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'whistler_goldmine',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'whistler_goldmine',
        'username' => 'whistler_user',
        'password' => 'Killer@1122',
        'unix_socket' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => NULL,
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => 'localhost',
        'port' => '5432',
        'database' => 'whistler_goldmine',
        'username' => 'whistler_user',
        'password' => 'Killer@1122',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => 6379,
        'database' => 0,
      ),
    ),
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'multi_term' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
      'starts_with' => false,
    ),
    'index_column' => 'DT_RowIndex',
    'engines' => 
    array (
      'eloquent' => 'Yajra\\DataTables\\EloquentDataTable',
      'query' => 'Yajra\\DataTables\\QueryDataTable',
      'collection' => 'Yajra\\DataTables\\CollectionDataTable',
      'resource' => 'Yajra\\DataTables\\ApiResourceDataTable',
    ),
    'builders' => 
    array (
    ),
    'nulls_last_sql' => ':column :direction NULLS LAST',
    'error' => NULL,
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
  ),
  'elfinder' => 
  array (
    'dir' => 
    array (
      0 => 'files',
    ),
    'disks' => 
    array (
    ),
    'route' => 
    array (
      'prefix' => 'elfinder',
      'middleware' => 
      array (
        0 => 'web',
        1 => 'auth',
      ),
    ),
    'access' => 'Barryvdh\\Elfinder\\Elfinder::checkAccess',
    'roots' => NULL,
    'options' => 
    array (
    ),
    'root_options' => 
    array (
    ),
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'strict_null_comparison' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'ignore_empty' => false,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
    ),
    'transactions' => 
    array (
      'handler' => 'db',
    ),
    'temporary_files' => 
    array (
      'local_path' => '/var/www/html/whistler/framework/storage/framework/laravel-excel',
      'remote_disk' => NULL,
      'remote_prefix' => NULL,
      'force_resync_remote' => NULL,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/whistler/framework/storage/app',
      ),
      'backup' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/whistler/framework/storage/backup',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/whistler/framework/storage/app/public',
        'url' => 'https://apis.ideationtec.com/whistler/storage',
        'visibility' => 'public',
      ),
      'views' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/whistler/framework/resources/lang',
      ),
      'public_uploads' => 
      array (
        'driver' => 'local',
        'root' => 'public/uploads',
      ),
      'public_img' => 
      array (
        'driver' => 'local',
        'root' => 'img',
      ),
      'public_files' => 
      array (
        'driver' => 'local',
        'root' => 'files',
      ),
      'public_files2' => 
      array (
        'driver' => 'local',
        'root' => '../files',
      ),
      'public_img2' => 
      array (
        'driver' => 'local',
        'root' => '../img',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
      ),
    ),
  ),
  'firebase' => 
  array (
    'default' => 'app',
    'projects' => 
    array (
      'app' => 
      array (
        'credentials' => 
        array (
          'file' => '/var/www/html/whistler/framework/storage/firebase/firebase_credentials.json',
          'auto_discovery' => true,
        ),
        'auth' => 
        array (
          'tenant_id' => NULL,
        ),
        'database' => 
        array (
          'url' => NULL,
        ),
        'dynamic_links' => 
        array (
          'default_domain' => NULL,
        ),
        'storage' => 
        array (
          'default_bucket' => NULL,
        ),
        'cache_store' => 'file',
        'logging' => 
        array (
          'http_log_channel' => NULL,
          'http_debug_log_channel' => NULL,
        ),
        'http_client_options' => 
        array (
          'proxy' => NULL,
          'timeout' => NULL,
        ),
        'debug' => false,
      ),
    ),
  ),
  'installer' => 
  array (
    'requirements' => 
    array (
      0 => 'openssl',
      1 => 'pdo',
      2 => 'mbstring',
      3 => 'tokenizer',
    ),
    'permissions' => 
    array (
      'storage/app/' => '775',
      'storage/framework/' => '775',
      'storage/logs/' => '775',
      'bootstrap/cache/' => '775',
    ),
  ),
  'logging' => 
  array (
    'default' => 'daily',
    'deprecations' => 'null',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/var/www/html/whistler/framework/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/var/www/html/whistler/framework/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => '/var/www/html/whistler/framework/storage/logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'YOUR_MAIL_DRIVER',
    'host' => 'YOUR_MAIL_HOST',
    'port' => 2525,
    'from' => 
    array (
      'address' => 'from@example.com',
      'name' => 'Example',
    ),
    'username' => 'YOUR_MAIL_USERNAME',
    'password' => 'YOUR_MAIL_PASSWORD',
    'encryption' => 'YOUR_MAIL_ENCRYPTION',
  ),
  'permission' => 
  array (
    'models' => 
    array (
      'permission' => 'Spatie\\Permission\\Models\\Permission',
      'role' => 'Spatie\\Permission\\Models\\Role',
    ),
    'table_names' => 
    array (
      'roles' => 'roles',
      'permissions' => 'permissions',
      'model_has_permissions' => 'model_has_permissions',
      'model_has_roles' => 'model_has_roles',
      'role_has_permissions' => 'role_has_permissions',
    ),
    'column_names' => 
    array (
      'model_morph_key' => 'model_id',
    ),
    'register_permission_check_method' => true,
    'teams' => false,
    'display_permission_in_exception' => false,
    'display_role_in_exception' => false,
    'enable_wildcard_permission' => false,
    'cache' => 
    array (
      'expiration_time' => 
      \DateInterval::__set_state(array(
         'from_string' => true,
         'date_string' => '24 hours',
      )),
      'key' => 'spatie.permission.cache',
      'model_key' => 'name',
      'store' => 'default',
    ),
  ),
  'push-notification' => 
  array (
    'appNameIOS' => 
    array (
      'environment' => 'development',
      'certificate' => '/path/to/certificate.pem',
      'passPhrase' => 'password',
      'service' => 'apns',
    ),
    'appNameAndroid' => 
    array (
      'environment' => 'development',
      'apiKey' => 'hgfdhjjdhfgjhgjdhg',
      'service' => 'gcm',
    ),
  ),
  'pushnotification' => 
  array (
    'gcm' => 
    array (
      'priority' => 'normal',
      'dry_run' => false,
      'apiKey' => NULL,
    ),
    'fcm' => 
    array (
      'priority' => 'normal',
      'dry_run' => false,
      'apiKey' => NULL,
    ),
    'apn' => 
    array (
      'certificate' => '/var/www/html/whistler/framework/config/iosCertificates/apns-dev-cert.pem',
      'passPhrase' => 'secret',
      'passFile' => '/var/www/html/whistler/framework/config/iosCertificates/yourKey.pem',
      'dry_run' => true,
    ),
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'stripe' => 
    array (
      'model' => 'App\\Model\\User',
      'key' => NULL,
      'secret' => NULL,
    ),
    'firebase' => 
    array (
      'database_url' => NULL,
      'secret' => NULL,
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/var/www/html/whistler/framework/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'whistler_ghana_limited_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/var/www/html/whistler/framework/resources/views',
    ),
    'compiled' => '/var/www/html/whistler/framework/storage/framework/views',
  ),
  'webpush' => 
  array (
    'vapid' => 
    array (
      'subject' => NULL,
      'public_key' => NULL,
      'private_key' => NULL,
      'pem_file' => NULL,
    ),
    'model' => 'NotificationChannels\\WebPush\\PushSubscription',
    'table_name' => 'push_subscriptions',
    'database_connection' => 'mysql',
    'client_options' => 
    array (
    ),
    'gcm' => 
    array (
      'key' => NULL,
      'sender_id' => NULL,
    ),
  ),
  'passport' => 
  array (
    'private_key' => NULL,
    'public_key' => NULL,
    'client_uuids' => false,
    'personal_access_client' => 
    array (
      'id' => NULL,
      'secret' => NULL,
    ),
    'storage' => 
    array (
      'database' => 
      array (
        'connection' => 'mysql',
      ),
    ),
  ),
  'flare' => 
  array (
    'key' => NULL,
    'flare_middleware' => 
    array (
      0 => 'Spatie\\FlareClient\\FlareMiddleware\\RemoveRequestIp',
      1 => 'Spatie\\FlareClient\\FlareMiddleware\\AddGitInformation',
      2 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddNotifierName',
      3 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddEnvironmentInformation',
      4 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddExceptionInformation',
      5 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddDumps',
      'Spatie\\LaravelIgnition\\FlareMiddleware\\AddLogs' => 
      array (
        'maximum_number_of_collected_logs' => 200,
      ),
      'Spatie\\LaravelIgnition\\FlareMiddleware\\AddQueries' => 
      array (
        'maximum_number_of_collected_queries' => 200,
        'report_query_bindings' => true,
      ),
      'Spatie\\LaravelIgnition\\FlareMiddleware\\AddJobs' => 
      array (
        'max_chained_job_reporting_depth' => 5,
      ),
      'Spatie\\FlareClient\\FlareMiddleware\\CensorRequestBodyFields' => 
      array (
        'censor_fields' => 
        array (
          0 => 'password',
          1 => 'password_confirmation',
        ),
      ),
      'Spatie\\FlareClient\\FlareMiddleware\\CensorRequestHeaders' => 
      array (
        'headers' => 
        array (
          0 => 'API-KEY',
        ),
      ),
    ),
    'send_logs_as_events' => true,
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'auto',
    'enable_share_button' => true,
    'register_commands' => false,
    'solution_providers' => 
    array (
      0 => 'Spatie\\Ignition\\Solutions\\SolutionProviders\\BadMethodCallSolutionProvider',
      1 => 'Spatie\\Ignition\\Solutions\\SolutionProviders\\MergeConflictSolutionProvider',
      2 => 'Spatie\\Ignition\\Solutions\\SolutionProviders\\UndefinedPropertySolutionProvider',
      3 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\IncorrectValetDbCredentialsSolutionProvider',
      4 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingAppKeySolutionProvider',
      5 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\DefaultDbNameSolutionProvider',
      6 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\TableNotFoundSolutionProvider',
      7 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingImportSolutionProvider',
      8 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\InvalidRouteActionSolutionProvider',
      9 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\ViewNotFoundSolutionProvider',
      10 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\RunningLaravelDuskInProductionProvider',
      11 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingColumnSolutionProvider',
      12 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\UnknownValidationSolutionProvider',
      13 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingMixManifestSolutionProvider',
      14 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingViteManifestSolutionProvider',
      15 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingLivewireComponentSolutionProvider',
      16 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\UndefinedViewVariableSolutionProvider',
      17 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\GenericLaravelExceptionSolutionProvider',
    ),
    'ignored_solution_providers' => 
    array (
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '/var/www/html/whistler/framework',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
    'settings_file_path' => '',
    'recorders' => 
    array (
      0 => 'Spatie\\LaravelIgnition\\Recorders\\DumpRecorder\\DumpRecorder',
      1 => 'Spatie\\LaravelIgnition\\Recorders\\JobRecorder\\JobRecorder',
      2 => 'Spatie\\LaravelIgnition\\Recorders\\LogRecorder\\LogRecorder',
      3 => 'Spatie\\LaravelIgnition\\Recorders\\QueryRecorder\\QueryRecorder',
    ),
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
