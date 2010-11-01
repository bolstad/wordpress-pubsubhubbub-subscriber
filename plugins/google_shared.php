<?php
	require 'plugins/simplepie.inc.php';

	$url = 'http://kracked.org/wp-content/plugins/wordpress-pubsubhubbub-subscriber/testFile.txt.xml';
	$feed = new SimplePie();
	$feed->set_feed_url($url);
	$feed->init();


?>				<?php
		        	// loop through items
            	foreach ($feed->get_items() as $item)
					       {
					
				
     echo $item->get_permalink() . "\n";
     
            
        $note = '';
             $annotation = $item->get_item_tags("http://www.google.com/schemas/reader/atom/", "annotation");
                        if (isset($annotation)) {
                            $note = "%CONTENT%  %AUTHOR%";
                            $note = str_replace('%CONTENT%', $annotation[0]["child"]["http://www.w3.org/2005/Atom"]["content"][0]["data"], $note);
                            $note = str_replace('%AUTHOR%', $annotation[0]["child"]["http://www.w3.org/2005/Atom"]["author"][0]["child"]["http://www.w3.org/2005/Atom"]["name"][0]["data"], $note);
                            
                            echo $note;
                        }
        
//	                print_r ($item);    
					
					
					       }               