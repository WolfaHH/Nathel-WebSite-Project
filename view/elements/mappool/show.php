<article class="card-mappool" style="background-image: url('<?= $mappool->thumbnail ?>')">
    <h3 class="card-title"><?= $mappool->name ?></h3>

    <form class="form-follow" action="?" method="post">

        <button type="submit" class="btn-<?= isset($is_follow) ? 'follow' : 'followed' ?>">

            <?php if (isset($is_follow)): ?>

            Followed

            <?php else: ?>

            icon flèche
            follow

            <?php endif; ?>

        </button>

    </form>

    <a href="user/<?= $submitter->id ?>" class="submitter">created by <?= $submitter->name ?></a>
    <span class="nb-maps"><?= count($mappool_maps) ?> Maps</span>

    <div class="mappool-tags">
        <?php foreach ($tags as $tag) : ?>

        <span class="tag tag-<?= $tag['type'] ?>"><?= str_replace('_', ' ', $tag['name']) ?></span>

        <?php endforeach; ?>
    </div>

    icon arrow

    <div>

    </div>

</article>