<?php
include_once 'includes/general/showerrors.inc.php';
@date_default_timezone_set("GMT");
header('Content-type: text/xml');
require_once 'classes/database.class.php';
$db = new database;
$writer = new XMLWriter();
$writer->openURI('php://output');
$writer->startDocument('1.0','UTF-8');
$writer->setIndent(4);
$writer->startElement('rss');
$writer->writeAttribute('version', '2.0');
$writer->writeAttribute('xmlns:atom', 'http://www.w3.org/2005/Atom');
$writer->startElement("channel");
$feedTitle = 'News and events from '.$db->getVal('name');
$writer->writeElement('title', $feedTitle);
$feedDescription = 'These are the latest '.$feedTitle;
$writer->writeElement('description', $feedDescription);
$writer->writeElement('link', $db->getVal('url'));
$writer->writeElement('pubDate', date("D, d M Y H:i:s e"));
$writer->endElement();

$news = $db->listorderby('news','created','DESC', 'content');
$events = $db->listorderby('events','created','DESC', 'content');
$blogs = $db->listorderby('blog','created','DESC', 'content');
$allData = array();
$tempArray = array();
foreach ($news as $newsitem)
{
    $tempArray['title'] = htmlspecialchars($newsitem['name']);
    $tempArray['link'] = htmlspecialchars($db->getVal('url').'news');
    $tempArray['description'] = htmlspecialchars($newsitem['content']);
    $tempArray['guid'] = htmlspecialchars($db->getVal('url').'news&id='.$newsitem['id']);
    $objDate = new DateTime($newsitem['created']);
    $tempArray['pubDate'] = $objDate->format(DateTime::RSS);
    array_push($allData, $tempArray);
}

foreach ($events as $eventitem)
{
    $tempArray['title'] = htmlspecialchars($eventitem['name']);
    $tempArray['link'] = htmlspecialchars($db->getVal('url').'news');
    if($eventitem['datestart'] == $eventitem['dateend'])
    {
        $tempArray['description'] = htmlspecialchars('<h4>Date : '.$eventitem['datestart'].'</h4>');
    }
    else
    {
        $tempArray['description'] = htmlspecialchars('<h4>Start date : '.$eventitem['datestart']);
        $tempArray['description'] .= htmlspecialchars(' End date : '.$eventitem['dateend'].'</h4>');
    }
    $tempArray['description'] .= htmlspecialchars($eventitem['content']);
    $tempArray['guid'] = htmlspecialchars($db->getVal('url').'events&id='.$eventitem['id']);
    $objDate = new DateTime($eventitem['created']);
    $tempArray['pubDate'] = $objDate->format(DateTime::RSS);
    array_push($allData, $tempArray);
}

foreach ($blogs as $blogitem)
{
    if($blogitem['responseid'] == 0)
    {
        $tempArray['title'] = htmlspecialchars($blogitem['name']);
        $tempArray['link'] = htmlspecialchars($db->getVal('url').'blog');
        $tempArray['description'] = htmlspecialchars($blogitem['content']);
        $tempArray['guid'] = htmlspecialchars($db->getVal('url').'blog&id='.$blogitem['id']);
        $objDate = new DateTime($blogitem['created']);
        $tempArray['pubDate'] = $objDate->format(DateTime::RSS);
        array_push($allData, $tempArray);
    }
}

usort($allData, function($a, $b)
{
    return $a['pubDate'] <=> $b['pubDate'];
});

foreach ($allData as $item)
{
    $writer->startElement("item");
    $writer->writeElement('title', $item['title']);
    $writer->writeElement('link', $item['link']);
    $writer->writeElement('description', $item['description']);
    $writer->writeElement('guid', $item['guid']);
    $writer->writeElement('pubDate', $item['pubDate']);
    $writer->endElement();
}

/* End channel */
$writer->endElement();
/* End RSS */
$writer->endElement();
$writer->endDocument();
$writer->flush();
?>