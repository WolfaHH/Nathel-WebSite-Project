<?php

$activities = $user->getUserRecentPlay();

?>



<section class="bg-medium">

    <h2 class="title">Recent Plays</h2>

    <ul class="mx-2">
        <?php foreach ($activities as $activity): ?>
        <?php $map = \Nathel\Map::getMapbyscore($activity['mappool_map_id']);  ?>
            <li>
                <span class="combo"><?= $activity['combo'] ?>451x</span>
                <span class="text-muted"><?= $activity['accuracy'] ?>12%</span>
                <span class="info-map"><?= $map['artist'] . ' - '. $map['title'] . ' [' . $map['diffifulty'] . ']' ?></span>
                <span class="ml-auto text-muted"><?= $activity['updated_at'] ?></span>
            </li>

        <?php endforeach; ?>
    </ul>

</section>