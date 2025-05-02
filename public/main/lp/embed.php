<?php
/* For licensing terms, see /license.txt */

use ChamiloSession as Session;

require_once __DIR__.'/../inc/global.inc.php';

api_protect_course_script(true);

<<<<<<< HEAD
$type = $_REQUEST['type'];
$src = Security::remove_XSS($_REQUEST['source']);
=======
$type = $_REQUEST['type'] ?? '';
$src = $_REQUEST['source'] ?? '';
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
if (empty($type) || empty($src)) {
    api_not_allowed();
}

$iframe = '';
switch ($type) {
    case 'download':
        /** @var learnpath $learnPath */
        $learnPath = Session::read('oLP');
        $itemId = isset($_GET['lp_item_id']) ? $_GET['lp_item_id'] : '';
        if (!$learnPath || empty($itemId)) {
            api_not_allowed();
        }

        $file = learnpath::rl_get_resource_link_for_learnpath(
            api_get_course_int_id(),
            $learnPath->get_id(),
            $itemId,
            $learnPath->get_view_id()
        );

        $iframe = Display::return_message(
            Display::url(get_lang('Download'), $file, ['class' => 'btn btn--primary']),
            'info',
            false
        );
        break;
    case 'youtube':
<<<<<<< HEAD
        $src = '//www.youtube.com/embed/'.$src;
        $iframe .= '<div id="content" style="width: 700px ;margin-left:auto; margin-right:auto;"><br />';
        $iframe .= '<iframe class="youtube-player" type="text/html" width="640" height="385" src="'.$src.'" frameborder="0"></iframe>';
        $iframe .= '</div>';
        break;
    case 'vimeo':
        $src = '//player.vimeo.com/video/'.$src;
        $iframe .= '<div id="content" style="width: 700px ;margin-left:auto; margin-right:auto;"><br />';
        $iframe .= '<iframe src="'.$src.'" width="640" height="385" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
=======
        $src = "src ='//www.youtube.com/embed/$src'";
        $src = Security::remove_XSS($src);
        $iframe .= '<div id="content" style="width: 700px ;margin-left:auto; margin-right:auto;"><br />';
        $iframe .= '<iframe class="youtube-player" type="text/html" width="640" height="385" '.$src.' frameborder="0"></iframe>';
        $iframe .= '</div>';
        break;
    case 'vimeo':
        $src = "src ='//player.vimeo.com/video/$src'";
        $src = Security::remove_XSS($src);
        $iframe .= '<div id="content" style="width: 700px ;margin-left:auto; margin-right:auto;"><br />';
        $iframe .= '<iframe '.$src.' width="640" height="385" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
        $iframe .= '</div>';
        break;
    case 'nonhttps':
        $icon = '&nbsp;<em class="icon-external-link icon-2x"></em>';
<<<<<<< HEAD
        $iframe = Display::return_message(
            Display::url($src.$icon, $src, ['class' => 'btn', 'target' => '_blank']),
            'normal',
            false
        );
=======
        $iframe = Security::remove_XSS(Display::return_message(
            Display::url($src.$icon, $src, ['class' => 'btn', 'target' => '_blank']),
            'normal',
            false
        ));
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
        break;
}

$htmlHeadXtra[] = "
<style>
body { background: none;}
</style>
";

Display::display_reduced_header();
echo $iframe;
Display::display_footer();
