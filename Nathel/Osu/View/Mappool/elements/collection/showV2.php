<article class="card-mappool" style="background-image: url('<?= $collection->thumbnail ?>')">
    <h3 class="card-title"><?= $collection->name ?></h3>


    <span class="nb-maps"><?= $Nb_mappools ?> Nb_mappools</span>

    <div class="mappool-tags">
        <?php foreach ($tags as $tag) : ?>

            <span class="tag tag-<?= $tag['type'] ?>"><?= str_replace('_', ' ', $tag['name']) ?></span>

        <?php endforeach; ?>
    </div>

    <div>
        <span>Manage with : </span>
        <?php echo $contributors; ?>
    </div>

    <a href="http://mappool-website-project.nath/edit/<?php echo $collection->id;?>">Edit</a>
    <a href="http://mappool-website-project.nath/edit/<?php echo $collection->id;?>">Edit</a>
    Delete it

    <div>

    </div>

</article>