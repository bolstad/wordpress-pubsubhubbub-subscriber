<?php
	require_once 'simplepie.inc.php';


	function push_parse_greader_atom($atomdata)
	{
		$feed = new SimplePie();
		$feed->set_raw_data($atomdata);
		$feed->init();
		$feed->handle_content_type();
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
	}

	$atom = file_get_contents('testFile.txt.xml');
	push_parse_greader_atom($atom);

?>
