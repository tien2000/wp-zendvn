<?php
define('SAVEQUERIES', true);

define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);

define('SCRIPT_DEBUG', true);
define('WP_DEBUG_LOG', true);

define('WP_POST_REVISIONS', 3);     // Giới hạn lưu Previuos Post trong DB.
define('AUTOSAVE_INTERVAL', 150);

define('WP_MEMORY_LIMIT', '128M');
define('WPLANG', 'en-US');
define('LANGDIR', 'wp-content/my/languages');