<?php

class Icon_Title {
    
    public static function init(){
    // Include the required
        self::includes();

    }

    public static function includes(){

        include_once( ICON_TITLE_DIR. 'includes/class-icon-title-display.php');
        include_once( ICON_TITLE_DIR .'admin/icon-title-admin.php' );
    }
}
