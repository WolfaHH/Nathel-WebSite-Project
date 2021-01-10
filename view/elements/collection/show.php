<article class="card-mappool" style="background-image: url('<?= $collection->thumbnail ?>')">
    <h3 class="card-title"><?= $collection->name ?></h3>


    <span class="nb-maps">mappools <?= $Nb_mappools;?> <br> </span>
    <span class="nb-maps">maps <?= $Nb_maps;?> </span>
    <div class="mappool-tags">
        <?php foreach ($tags as $tag) : ?>

            <span class="tag tag-<?= $tag['type'] ?>"><?= str_replace('_', ' ', $tag['name']) ?></span>

        <?php endforeach; ?>
    </div>

    <div>
        <span>Manage with : </span>
        <?php echo $contributors;  ?>
    </div>


    <div>

    </div>

</article>

