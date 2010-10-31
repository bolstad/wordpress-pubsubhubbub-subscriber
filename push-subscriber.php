<?php
/**
 * @package Pubsubhubbub Subscriber
 * @author Christian Bolstad
 * @version 1
 */
/*
Plugin Name: Pubsubhubbub Subscriber
Plugin URI: http://kracked.com/wordpress-pubsubhubbub-subscriber/
Description: Pubsubhubbub Subscriber for Wordpress
Author: Christian Bolstad
Version: 1
Author URI: http://christianbolstad.com/
*/





// setup query parameters 

add_filter('query_vars', 'push_parameter_queryvars' );

function push_parameter_queryvars( $qvars )
{
    $qvars[] = 'push_action';
    $qvars[] = 'push_param';
    $qvars[] = 'hub.challenge';
    $qvars[] = 'hub.topic';
    $qvars[] = 'hub.mode';
    $qvars[] = 'hub.lease_seconds'; 
    return $qvars;
}

// http://www.kracked.org/?push_action=subscribe&push_param=XXX_http%3A%2F%2Fwww.google.com%2Freader%2Fshared%2Fkersss&hub.challenge=K-N2vk7deSJKPJAE4CfmLiOPhVbzfeZyDT2oPlyqLtl8wxhZ8YxvT1xpg9I5uyKeATPx0_PTlTPDB8SP1cst10nMnV2_kvxNn_WHSum3IX6pc8XPvve21spTCddPVcR9&hub.topic=http%3A%2F%2Fwww.google.com%2Freader%2Fshared%2Fkersss&hub.mode=subscribe&hub.lease_seconds=2592000


// hook query parameters 

add_action('get_header','push_hook_header');

function push_hook_header()
{
    global $wp_query;
    if (isset($wp_query->query_vars['push_action']))
    {
        // Since $wp_query doesn't support keys with a dot in them (like 'hub.challange'), we have to fall back to $_GET
        print_r($wp_query->query_vars);      
        print $wp_query->query_vars['hub.challenge'];
        print_r ($_GET);
        

        die;
    }
}



?>