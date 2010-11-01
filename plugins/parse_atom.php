<?php

class BlogPost
{
    var $title;
    var $published;
    var $updated;
    var $link;
    var $author;
    var $summary;
    var $content;

}

#    var $posts = array();

    function BlogFeed($file_or_url)
    {

        print "> " . $file_or_url . "\n";
        $xml_source = file_get_contents($file_or_url);
        
#        print $xml_source; 
        
        
        $x = simplexml_load_string($xml_source);

        if(count($x) == 0)
            return;


        print_r($x);

        print "split har --- \n";

//        foreach($x->channel->item as $item)
            foreach($x->entry as $item)

        {
        #        print_r($item);

                $post = new BlogPost();
                
                $post->published = (string) $item->published;
                $post->updated = (string) $item->updated;
                $post->title = (string) $item->title;
                $post->link = (string) $item->link[0][href];
                $post->author = (string) $item->author->name;
                $post->summary = (string) $item->summary;
                $post->content = (string) $item->content;

                print_r($post);
                
                
                print "## --------- next item goes here ---> \n";
                        
       
     
         }
    }


$moo = BlogFeed("http://kracked.org/wp-content/plugins/wordpress-pubsubhubbub-subscriber/testFile.txt.xml");


?>