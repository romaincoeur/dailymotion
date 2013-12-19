<?php
echo "<div class=\"dailymotion_video noviusos_enhancer\">\n";
if (count($video_list) > 0) {
    echo "<ul>\n";
    foreach ($video_list as $video) {
        echo '<li><img src="'.$video['vide_url_dailymotion'].'" alt="'.$video['vide_name'].'"/>' . $video->htmlAnchor() . "</li>\n";
    }
    echo "</ul>\n";
}
echo "</div>\n";
