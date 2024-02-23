<?php
// Create a new DOM Document to hold our webpage structure
$dom = new DOMDocument();

// Load the website's source code into the DOMDocument (suppress warnings)
@$dom->loadHTMLFile('https://mashable.com/');

// Create an XPath object to query the DOM
$xpath = new DOMXPath($dom);

// Query the DOM for all h2 elements with the class 'article-title'
$nodes = $xpath->query("//h2[@class='article-title']");

// Iterate over all found nodes
foreach($nodes as $i => $node) {
    // Get the title and URL of the article
    $a = $xpath->query(".//a", $node)->item(0);
    $title = $a->nodeValue;
    $url = $a->getAttribute('href');

    // Print the title and URL
    echo "<a href='$url'>$title</a><br>";
}
?>
