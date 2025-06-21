<?php
// קוד זה ירוץ בתוך תיקיית /api/ ולכן הוא מתאים ל-Vercel
header('Content-Type: text/html; charset=utf-8');

// כתובת ה-RSS Feed של הפודקאסט
$rss_url = 'https://feeds.captivate.fm/rabbi_osher_farkash_maamarim/';

// קריאת תוכן ה-RSS
$rss_content = @file_get_contents($rss_url);

// בדיקה אם הקריאה נכשלה
if ($rss_content === false) {
    echo 'read=t-אירעה שגיאה בקבלת נתונים מהאתר נסו שוב מאוחר יותר=hangup';
    exit;
}

$xml = new SimpleXMLElement($rss_content);

// מציאת הקישור לקובץ השמע (MP3) של הפרק החדש ביותר
$latest_episode_url = $xml->channel->item[0]->enclosure['url'];

// בדיקה שבאמת מצאנו קישור
if (empty($latest_episode_url)) {
    echo 'read=t-לא נמצא פרק להשמעה נסו שוב מאוחר יותר=hangup';
    exit;
}

// הדפסת הפקודה עבור ימות המשיח
echo "read=t-המאמר האחרון מועבר כעת להשמעה.m-{$latest_episode_url}=hangup";
?>