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

    icon arrow

    <div>

        <span class="nb-maps"><?= count($mappool_maps) ?> Maps</span>

    </div>

</article>