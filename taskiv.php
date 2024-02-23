<?php
// Create a new DOM Document to hold our webpage structure
$dom = new DOMDocument();

// Load the website's source code into the DOMDocument (suppress warnings)
@$dom->loadHTMLFile('https://sea.mashable.com/');

// Create an XPath object to query the DOM
$xpath = new DOMXPath($dom);

// Query the DOM for all li elements with the class 'blogroll ARTICLE'
$nodes = $xpath->query("//li[@class='blogroll ARTICLE']");

// Iterate over all found nodes
foreach($nodes as $i => $node) {
    // Get the title, URL, and date of the article
    $a = $xpath->query(".//a", $node)->item(0);
    $title = $xpath->query(".//div[@class='caption']", $a)->item(0)->nodeValue;
    $url = $a->getAttribute('href');
    $date = $xpath->query(".//time[@class='datepublished']", $a)->item(0)->nodeValue;

    // Parse the date
    $date = DateTime::createFromFormat('M. d, Y', $date);

    // Only display the article if it was published in 2022 or later
    if ($date && $date->format('Y') >= 2022) {
        echo "<a href='$url'>$title</a>$date<br>";
    }
}
?>
