<?php

// simple example for the PHP pubsubhubbub Subscriber
// as defined at http://code.google.com/p/pubsubhubbub/
// written by Josh Fraser | joshfraser.com | josh@eventvue.com
// Released under Apache License 2.0

include("subscriber.php");

$hub_url = "http://pubsubhubbub.appspot.com";

$feed = "http://www.google.com/reader/public/atom/user%2F05408474857278637341%2Fstate%2Fcom.google%2Fbroadcast";

$callback_url = "http://www.kracked.org/?push_action=feeder&push_param=".urlencode($feed);

							
// create a new subscriber
$s = new Subscriber($hub_url, $callback_url);

// subscribe to a feed
 $s->subscribe($feed);

// unsubscribe from a feed
//  $s->unsubscribe($feed);

?>

http://www.kracked.org/?push_action=feeder&push_param=http%3A%2F%2Fwww.google.com%2Freader%2Fshared%2Fkersss&hub.challenge=-8vDEyQ4hePWAx9bcVoQP5uh9HviMrkHASsLZkKpM0j8HSyrp543RS75k_vQZPvzCsKeJA0T5Nck7EIcz5jLDwObrMrT1UDYkhnTQghRgFgPfWbkyxpbGSTXl8hHpfBG&hub.topic=http%3A%2F%2Fwww.google.com%2Freader%2Fshared%2Fkersss&hub.mode=unsubscribe&hub.lease_seconds=2592000