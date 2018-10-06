<div id="wrap">
    <!-- Top box with logo -->
    <div class="header-plugin">
        <div class="header-plugin-title">
            Icon Title Settings
        </div>
    </div>
    <div id="success-message">
        <?php echo self::showSuccessMessages() ?>
    </div>
    <!-- Body -->
    <div id="tab_menu">
        <a tab="#1" class="checked">About plugin</a>
        <a tab="#2">Settings</a>
    </div>
    <form name="icon_title_form_settings" method="post" action="">
        <div id="tabs">
            <div tab="#1" class="tab_box" style="display:block;">
                <p>Hello</p>
                <p>In this plugin you can add to your title posts WordPress dashicons(standard WordPress icons)</p>
                <p>To get started, go to the tab "Settings"</p>
            </div>
            <div tab="#2" class="tab_box">
                <p>Pleas,go to the list, and select icon. The picture will be displayed on the right side. </p>
                <select name="icon_title_dashicons" id="content_menu_dashicon_icon" required>
                    <option value="" disabled selected hidden> Please,select icon</option>
                    <?php foreach ($arrayDashicons as $dashicons) {
                        ?>
                        <option value="dashicons <?= $dashicons ?>"><?= $dashicons ?></option>
                        <?php
                    }
                    ?>
                </select>
                <span>The picture will be displayed here -></span><span id="content_icon"></span>
                <br>
                <p>Please,select page, where you want to add this picture.</p>
                <p>The picture will be added only in title this page.</p>
                <div id="selected">
                    <input type="text" name="name-page-choose" class="input-selected-item" placeholder="Please,choose your page">
                    <div id="drop-down" class="drop-down-page-menu">
                        <?php foreach ($arrayPages as $allPages) {
                            foreach ($allPages as $key => $pages) {
                                $icon = get_post_meta($pages->ID, '_icon_title_dashicon', true);
                                $side_title = get_post_meta($pages->ID, '_icon_title_side', true); ?>
                                <?php if (!empty($icon) && $side_title == "left") { ?>
                                    <div class="block-inputs-pages"><input type="radio" name="pages"
                                                                           value="<?= get_the_title($allPages[$key]) ?>"><i
                                            class="<?= $icon ?>"></i> <?php echo get_the_title($allPages[$key]) ?> </input>
                                    </div>
                                <?php } elseif (!empty($icon) && $side_title == "right") { ?>
                                    <div class="block-inputs-pages"><input type="radio" name="pages"
                                                                           value="<?= get_the_title($allPages[$key]) ?>"> <?php echo get_the_title($allPages[$key]) ?>
                                        <i class="<?= $icon ?>"> </i></input></div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="block-inputs-pages"><input type="radio" name="pages"
                                                                           value="<?= get_the_title($allPages[$key]) ?>"><?php echo get_the_title($allPages[$key]) ?> </input>
                                    </div>
                                <?php }
                            }
                        } ?>
                    </div>
                </div>
                <br>
                <p> You can choose to display the icon on both sides.</p>
                <div class="block-radio-side"><input type="radio" name="page_side" value="left">From the left
                    side</input></div>
                <div class="block-radio-side"><input type="radio" name="page_side" value="right">From the right
                    side</input></div>
                <?php echo self::showErrorMessages(); ?>
            </div>
        </div>
        <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>"
               style="margin-top: 15px;"/>
    </form>
</div>
