<?php
	require 'simplepie.inc.php';
	$url = 'http://kracked.org/wp-content/plugins/wordpress-pubsubhubbub-subscriber/testFile.txt.xml';
	$feed = new SimplePie();
	$feed->set_feed_url($url);
	$feed->init();
	// loop through items
    foreach ($feed->get_items() as $item)
	{
		echo $item->get_permalink() . "\n";
        $annotation = $item->get_item_tags("http://www.google.com/schemas/reader/atom/", "annotation");
        if (isset($annotation)) 
        {
			$comment = $annotation[0]["child"]["http://www.w3.org/2005/Atom"]["content"][0]["data"];
            $author = $annotation[0]["child"]["http://www.w3.org/2005/Atom"]["author"][0]["child"]["http://www.w3.org/2005/Atom"]["name"][0]["data"];
			print " Comment: $comment Author: $author\n";    
         }
     }               
?>
