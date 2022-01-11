<?php

include_once 'common.inc.php';;
$rss_xml = '';

$news            = new news();
$news->pageReNum = 99999;
$news->setKw(array('is_show' => 1));
$news_list = $news->getList();
foreach ($news_list as $val) {
    $link = $rooturl . '/index.php?action=news_page&id=' . $val['id'];
    $time = date('D , d M Y H:i:s', strtotime($val['newsdt']));
    $rss_xml .= '
    <item>
    <title>' . $val['title'] . '</title>
    <link>' . $link . '</link>
    <comments>' . $link . '</comments>
    <pubDate>' . $date . '+0800</pubDate>
    <dc:creator>admin</dc:creator>
    
    <category><![CDATA[最新消息]]></category>
    
    <guid isPermaLink="false">' . $link . '</guid>
    <description><![CDATA[' . $val['title'] . ']]></description>
    <wfw:commentRss>' . $link . '</wfw:commentRss>
    </item>';
}

$monthbook            = new monthbook();
$monthbook->pageReNum = 99999;
$monthbook->setKw(array('is_show' => 1));
$monthbook_list = $monthbook->getList();
foreach ($monthbook_list as $val) {
    $link = $rooturl . '/index.php?action=bimonthly_m_catalog&monthbook_id=' . $val['id'];
    $time = date('D , d M Y H:i:s', strtotime($val['newsdt']));
    $rss_xml .= '
    <item>
    <title>' . $val['title'] . '</title>
    <link>' . $link . '</link>
    <comments>' . $link . '</comments>
    <pubDate>' . $data . '+0800</pubDate>
    <dc:creator>admin</dc:creator>
    
    <category><![CDATA[雙月刊]]></category>
    
    <guid isPermaLink="false">' . $link . '</guid>
    <description><![CDATA[' . $val['title'] . ']]></description>
    <wfw:commentRss>' . $link . '</wfw:commentRss>
    </item>';
}

$schoolbook            = new schoolbook();
$schoolbook->pageReNum = 99999;
$schoolbook->setKw(array('is_show' => 1));
$schoolbook_list = $schoolbook->getList();
foreach ($monthbook_list as $val) {
    $link = $rooturl . '/index.php?action=quarterly_m_catalog&schoolbook_id=' . $val['id'];
    $time = date('D , d M Y H:i:s', strtotime($val['newsdt']));
    $rss_xml .= '
    <item>
    <title>' . $val['title'] . '</title>
    <link>' . $link . '</link>
    <comments>' . $link . '</comments>
    <pubDate>' . $date . '+0800</pubDate>
    <dc:creator>admin</dc:creator>
    
    <category><![CDATA[校友季刊]]></category>
    
    <guid isPermaLink="false">' . $link . '</guid>
    <description><![CDATA[' . $val['title'] . ']]></description>
    <wfw:commentRss>' . $link . '</wfw:commentRss>
    </item>';
}

$xml = '
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	>

    <channel>
        <title>臺大校友雙月刊</title>
        <atom:link href="http://www.alum.ntu.edu.tw/wordpress/?feed=rss2" rel="self" type="application/rss+xml" />
        <link>http://www.alum.ntu.edu.tw/wordpress</link>
        <description></description>
        <pubDate>Mon, 30 Nov 2020 06:06:07 +0000</pubDate>
        <generator>http://wordpress.org/?v=2.6.3</generator>
        <language>en</language>
		' . $rss_xml . '
	</channel>
</rss>
';
