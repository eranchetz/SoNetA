<?php
// Connect to localhost on the default port.
$con = new Mongo();
 
// Get a handle on the myCollection collection,
// which is in the 'test' database.
$myCollection = $con->test->test;
 
// Find everything in our collection:
$results = $myCollection->find();
 
// Loop through all results
foreach ($results as $document) {
 
  // Attributes of a document come back in an array.
  $test = $document['test'];
 
  // Technically, _id is a MongoId object. It can 
  // be automatically converted to a string, though.
  $id = $document['_id'];
 
  // Print out the values.
  printf("Test Value: %d, ID Value: %s\n", $test, $id);
 
  // You can also extract the timestamp that this 
  // object was created, since timestamp is encoded in 
  // the id:
  $createdOn = $id->getTimestamp();
  $prettyDate = date('r', $createdOn);
 
  printf("Created on %s.\n", $prettyDate);
}
?>