<?php

class Icon_Title_Admin
{
    private static $errors = []; //array for errors messages

    private static $success = []; //array for success messages

    public static function init()
    {
        // Add menu
        add_action('admin_menu', array(__class__, 'add_menu'));

        // Enqueue the scripts and styles
        add_action('admin_enqueue_scripts', array(__class__, 'enqueue_scripts'));

        add_action('admin_init', array(__class__, 'saveSettings'));

    }

    public static function add_menu()
    {
        add_options_page('Icon Title', 'Icon Title', 'manage_options', 'icon_title', array(__class__, 'item_title_settings_page'));
        add_menu_page('Icon Title', 'Icon Title', 'administrator', __FILE__, array(__class__, 'item_title_settings_page'), ICON_TITLE_URL.'images/settings.jpg');
    }

    public static function enqueue_scripts()
    {
        wp_enqueue_style('sc-admin-css', ICON_TITLE_ADMIN_DIR . '/css/icon-title.css', array(), ICON_TITLE_VERSION);
        wp_enqueue_script('jquery');
        wp_enqueue_script('sc-admin-js', ICON_TITLE_ADMIN_DIR . '/js/icon-title.js', array('jquery'), ICON_TITLE_VERSION, 'footer');
    }

    public function item_title_settings_page()
    {

        //include dashicons images
        $arrayDashicons = include_once(ICON_TITLE_DIR . '/data-array/dashicons.php');

        //get Pages
        $arrayPages = self::getPostPages();

        //show admin settings, $arrayPages and $arrayDashicons are are used in admin_settings.php file
        include(ICON_TITLE_DIR . '/admin/views/admin_settings.php');
        ?>
        <?php

    }

    public function getPostPages()
    {

        //get products
        $args_product = array(
            'post_type' => 'product'
        );
        $pages['pages_product'] = get_posts($args_product);

        //get posts (По завданню зрозумів що потрібно posts)
        $args_posts = array(
            'post' => 'post'
        );

        $pages['pages_posts'] = get_posts($args_posts);

        return $pages;
    }

    public function saveSettings()
    {
        global $wpdb;

        $data = $_POST;

        //get page ID by title name
        $arrayPagesType = include_once (ICON_TITLE_DIR.'/data-array/type-pages-to-search.php');
        $page = get_page_by_title ($data['name-page-choose'], $wpdb,  $arrayPagesType);
    
        //check on filling out the form
        if (!empty($data)) {
            if (empty($data['icon_title_dashicons'])) {
                self::add_error('Please, select icon');
                return;
            } elseif (empty($data['pages'])) {
                self::add_error('Please, select page');
                return;
            } elseif (empty($data['page_side'])) {
                self::add_error('Please, Select the side on which you want to display the icon');
                return;
            }
            
            $icon_side_saved = false;
            if (!empty($data['page_side'] == "left")) {
                if (update_post_meta($page->ID, '_icon_title_side', 'left')) {
                    $icon_side_saved = true;
                }
            } elseif (!empty($data['page_side'] == "right")) {
                if (update_post_meta($page->ID, '_icon_title_side', 'right')) {
                    $icon_side_saved = true;
                }
            }

            if (update_post_meta($page->ID, '_icon_title_dashicon', $data['icon_title_dashicons']) && $icon_side_saved == true) {
                self::add_success('Icon was added to Title');
            }
        }
    }

    public static function add_error($text)
    {
        self::$errors[] = $text;
    }

    public static function add_success($text)
    {
        self::$success[] = $text;
    }

    public function showErrorMessages()
    {
        if (count(self::$errors) > 0) {
            foreach (self::$errors as $errors) {
                return '<p class="error-message">' . $errors . '</p>';
            }
        }
    }

    public function showSuccessMessages()
    {
        if (count(self::$success) > 0) {
            foreach (self::$success as $success) {
                return '<p class="p-text-success-message">' . $success . '</p>';
            }
        }
    }
}

Icon_Title_Admin::init();