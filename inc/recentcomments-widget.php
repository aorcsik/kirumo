<? class WP_Widget_Recent_Comments_Kirumo extends WP_Widget {

    function WP_Widget_Recent_Comments_Kirumo() {
        $widget_ops = array('classname' => 'widget_recent_comments', 'description' => __( 'The most recent comments' ) );
        $this->WP_Widget('recent-comments', __('Recent Comments'), $widget_ops);
        $this->alt_option_name = 'widget_recent_comments';

        if ( is_active_widget(false, false, $this->id_base) )
            add_action( 'wp_head', array(&$this, 'recent_comments_style') );

        add_action( 'comment_post', array(&$this, 'flush_widget_cache') );
        add_action( 'transition_comment_status', array(&$this, 'flush_widget_cache') );
    }

    function recent_comments_style() { 
    }

    function flush_widget_cache() {
        wp_cache_delete('recent_comments', 'widget');
    }

    function widget( $args, $instance ) {
        extract($args, EXTR_SKIP);
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Comments') : $instance['title']);
        if ( !$number = (int) $instance['number'] )
            $number = 5;
        else if ( $number < 1 )
            $number = 1;
        else if ( $number > 150 )
            $number = 150;

        echo $before_widget; ?>
            <?php if ( $title ) echo $before_title . $title . $after_title; ?>
            <ul id="recentcomments" class="comment-list"><?php

                wp_list_comments(
                    array('callback' => 'kirumo_comment' ),
                    get_comments( array( 'number' => $number ) )
                );

            ?></ul>
        <?php echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_comments']) )
            delete_option('widget_recent_comments');

        return $instance;
    }

    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of comments to show:'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
        <small><?php _e('(at most 150)'); ?></small></p>
<?php
    }
}

function WP_Widget_Recent_Comments_Kirumo_Init() {
    register_widget('WP_Widget_Recent_Comments_Kirumo');
}
add_action('widgets_init', 'WP_Widget_Recent_Comments_Kirumo_Init');
