<?php 
    /*
    Plugin Name: My Recent Event 
    Description: Plugin for displaying recent events on home page
    Author: Deepak
    Version: 1.0
    */
    function home_calendar_events( $atts ) {
        global $post;
	    // Retrieve the next 5 upcoming events
        $events = tribe_get_events( array(
            'posts_per_page' => 3,
            'orderby'        => 'date',
            'order'          => 'DESC'
        ) );
        
        $onlyTitlee = '<div>';
        $eventCount = 0;
        foreach ( $events as $post ) {
            setup_postdata( $post );
            
            $postArr = explode('@', tribe_get_start_date( $post ));
            $postArrEnd = explode('@', tribe_get_end_date( $post ));
            $onlyTitlee .= "<div class='home-event-left ".(($eventCount > 0) ? 'eventmar' : '' )."'><div><h2>".date('D', strtotime($postArr[0]))."</h2><p>".$postArr[0]."</p><hr></div></div><div class='home-event-right ".(($eventCount > 0) ? 'eventmar' : '' )."'><p class='home-ev-ttl'>".$post->post_title."</p><p class='home-ev-time'>".(($postArr[1] != '') ? $postArr[1] : '12:00am' )." - ".(($postArrEnd[1] != '') ? $postArrEnd[1] : '11:59pm' )."</p><p>".$post->post_content."</p></div><div style='clear:both'></div>";
            $eventCount++;
        }
        $onlyTitlee .= '</div>';
        return $onlyTitlee;
    }
    add_shortcode( 'home-events', 'home_calendar_events' );
?>