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
    $qvars[] = 'hub_challenge';
    $qvars[] = 'hub_topic';
    $qvars[] = 'hub_mode';
    $qvars[] = 'hub_lease_seconds'; 
    return $qvars;
}


// hook query parameters 

add_action('get_header','push_hook_header');

function push_hook_header()
{
    global $wp_query;
    if (isset($wp_query->query_vars['push_action']))
    {
        if ($wp_query->query_vars['hub_mode'] == 'subscribe')
                {                
                 if (!isset($wp_query->query_vars['hub_challenge']))
                          throw new Exception('Invalid subcribe confirmation - got no challange from hub');                                                                  
                 echo $wp_query->query_vars['hub_challenge'];
                 exit;
                }
                
           elseif ($_GET['hub_mode'] == 'unsubscribe')
                {
                 if (!isset($wp_query->query_vars['hub_challenge']))
                          throw new Exception('Invalid subcribe confirmation - got no challange from hub');                                                                  
                 echo $wp_query->query_vars['hub_challenge'];
                 exit;                
                }
            else
            {
              $postdata = file_get_contents("php://input"); 
              do_action("push_feed_submitted",$wp_query->query_vars['push_param'],$postdata);
              die;
            }
     }
}

function email_friends($p1,$p2)  {
   
    $myFile = "/tmp/testFile.txt";
    $fh = fopen($myFile, 'w') or die("can't open file");
    fwrite($fh, $p2);
    fclose($fh);
    $attachments = array($myFile);

   wp_mail( 'christian@bolstad.se', 'subject 1', "b1: " . print_r($p1,1) . " b2: " . print_r($p2,1),$headers, $attachments );
   return $p1;
}

add_action('push_feed_submitted', 'email_friends',10,2);





?>
