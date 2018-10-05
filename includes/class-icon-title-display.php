<?php

class Icon_Title_Display{

    public static function init()
    {
        add_filter('the_title', array(__class__,'display_icon_title'));
        add_action('add_meta_boxes', array( __class__, 'icon_title_create_metabox' ));

    }

    public function icon_title_create_metabox(){
        
        //get array pages type to include
        $arrayPagesType = include(ICON_TITLE_DIR.'/data-array/type-pages-to-search.php');
       
        foreach ( $arrayPagesType as $pagesType ) {
            add_meta_box('icon-title', __( 'WP Page Icon Title', 'wp-page-icon-title' ), array( __class__, 'icon_title_example' ),	$pagesType);
        }
    }

    public function icon_title_example( $post ){
        
        $value = get_post_meta( $post->ID, '_icon_title_dashicon', true );
        $icon_side = get_post_meta( $post->ID, '_icon_title_side', true );

        if(!empty($value) && !empty($icon_side)){
            echo '<p>You title will be with this icon: <span class = "'.$value.'"></span> on '.$icon_side.' side</p>';
        }else{
            echo '<p>Your dont choose your icon title. Please, <a href="'. admin_url('admin.php?page=icon-title%2Fadmin%2Ficon-title-admin.php') .'">go to icon title plugin settings and select settings</a></p>';
        }
    }

    public function display_icon_title($title){
        global $post;

        $icon = get_post_meta( $post->ID, '_icon_title_dashicon', true );
        $side_title = get_post_meta($post->ID, '_icon_title_side', true);

        if(!empty($icon) && in_the_loop() && !empty($side_title)){

            if( is_page($post->ID) || is_single($post->ID) && $title == $post->post_title && $side_title == 'left'){
                return '<i class="'.$icon.'"></i> '.' '.$title;
            }
            elseif( is_page($post->ID) || is_single($post->ID) && $title == $post->post_title  && $side_title == 'right'){
                return $title.' '.'<i class="'.$icon.'"></i> ';
            }
            else{
                return $title;
            }
        }
        else{
            return $title;
        }
    }
}

Icon_Title_Display::init();