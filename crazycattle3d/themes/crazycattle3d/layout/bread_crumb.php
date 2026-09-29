<div class="breadcrumbs">
    <span class="breadcrumbs__item">
        <a href="/"><span title="Home">Home</span></a>
    </span>
    <?php foreach ($arr_bread as $breadnew) : ?>
        <?php if ($breadnew['source']) : ?>
            <span class="breadcrumbs__item breadcrumbs__delimiter">/</span>
            <span class="breadcrumbs__item">
                <a href="/<?php echo $breadnew['source']; ?>" title="<?php echo $breadnew['name'] ?>">
                    <span><?php echo $breadnew['name'] ?></span>
                </a>
            </span>
        <?php else : ?>
            <span class="breadcrumbs__item breadcrumbs__delimiter">/</span>
            <span class="breadcrumbs__item breadcrumbs__current"><?php echo $breadnew['name']; ?></span>
        <?php endif; ?>
    <?php endforeach; ?>
</div>