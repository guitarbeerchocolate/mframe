<?php
@date_default_timezone_set("GMT");
header('Content-type: text/xml');
require_once 'classes/database.class.php';
$db = new database;
$writer = new XMLWriter();
$writer->openURI('php://output');
$writer->startDocument('1.0','UTF-8');
$writer->setIndent(4);
$writer->startElement('urlset');
$nitems = $db->listall('navigation');
$writer->startElement('url');
$writer->writeElement('loc', $db->getVal('url'));
$writer->endElement();
foreach ($nitems as $nitem)
{
    $writer->startElement('url');
    $writer->writeElement('loc', $db->getVal('url').htmlspecialchars($nitem['location']));
    $writer->endElement();
}
$writer->endDocument();
$writer->flush();
?>