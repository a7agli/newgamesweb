<div class="col-12">
    <div class="pagination">
        <?php
        $paging = $paging_content['paging'];
        foreach ($paging as $page) {
            if ($page['selected']) {
                echo '<span class="active">' . $page['label'] . '</span>';
            } else {
                echo '<span class="btn" onclick=paging(' . $page["value"] . ')>' . $page['label'] . '</span>';
            }
        }
        ?>
    </div>
</div>