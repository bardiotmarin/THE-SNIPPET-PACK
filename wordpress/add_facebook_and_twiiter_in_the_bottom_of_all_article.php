<?php
function share_this($content){
if(!is_feed() &amp;&amp; !is_home()) {
$content .= '<div class="share-this">
<a href="http://twitter.com/share"
class="twitter-share-button"
data-count="horizontal">Tweet</a>
<script type="text/javascript"
src="https://platform.twitter.com/widgets.js"></script>
<div class="facebook-share-button">
<iframe
src="https://www.facebook.com/plugins/like.php?href='.
urlencode(get_permalink($post->ID))
.'&amp;layout=button_count&amp;show_faces=false&amp;width=200&amp;action=like&amp;colorscheme=light&amp;height=21"
?>
