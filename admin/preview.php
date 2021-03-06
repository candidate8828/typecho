<?php

include 'common.php';

/** 获取内容 Widget */
Typecho_Widget::widget('Widget_Archive', 'type=single&checkPermalink=0&preview=1')->to($content);

/** 检测是否存在 */
if (!$content->have()) {
    $response->redirect($options->adminUrl);
}

/** 检测权限 */
if (!$user->pass('editor', true) && $content->authorId != $user->uid) {
    $response->redirect($options->adminUrl);
}

/** 输出内容 */
$content->render();
?>
<script>
    window.onbeforeunload = function () {
        if (!!parent) {
            parent.cancelPreview();
        }
    }
</script>