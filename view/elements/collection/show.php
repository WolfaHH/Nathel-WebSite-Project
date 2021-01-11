<section class="banner-collection">

    <div class="banner"
         style="background-image: url('<?= $collection->thumbnail ?>');">
        <div class="info-collection">
            <h1 class="name"><?= $collection->name ?></h1>
            <span class="nb-mappool"><?= $Nb_mappools;?> LEVELS</span>
            <span class="maps"><?= $Nb_maps;?> Maps</span>

            <form class="form form-following" action="#" method="post">
                <button class="btn btn-following">Following</button>
            </form>

            <div class="contributors">
                <span>Contributors: </span>
                <ul class="list-contributor">
                    <?php // echo $contributors;  ?>

                    <li class="thumbnail thumbnail-contributor"
                        style="background-image: url('https://a.ppy.sh/8418652?1593876351.png');"></li>
                    <li class="thumbnail thumbnail-contributor"
                        style="background-image: url('https://a.ppy.sh/8418652?1593876351.png');"></li>
                    <li class="thumbnail thumbnail-contributor"
                        style="background-image: url('https://a.ppy.sh/8418652?1593876351.png');"></li>
                    <li class="thumbnail thumbnail-contributor"
                        style="background-image: url('https://a.ppy.sh/8418652?1593876351.png');"></li>
                    <li class="thumbnail thumbnail-more">+3</li>

                </ul>
            </div>
            <span class="title-tag">tags :</span>
            <div class="tags">
                <?php foreach ($tags as $tag) : ?>

                <div class="tag tag-<?= $tag['type'] ?>">
                    <?= str_replace('_', ' ', $tag['name']) ?>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

