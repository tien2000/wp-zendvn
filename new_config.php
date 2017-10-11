<?php
define('SAVEQUERIES', true);

// Tắt cảnh báo trên hệ thống WP.
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);      // Sử dụng khi dòng trên ko hoạt động

// Debug cho CSS ,JS
define('SCRIPT_DEBUG', true);       // Khi có lỗi sẽ ghi vào tập tin logs
define('WP_DEBUG_LOG', true);

define('WP_POST_REVISIONS', 3);     // Giới hạn lưu Previuos Post trong DB.
define('AUTOSAVE_INTERVAL', 150);

define('WP_MEMORY_LIMIT', '128M');
define('WPLANG', 'en-US');
define('LANGDIR', 'wp-content/my/languages');