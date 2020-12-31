<?php




?>

<section class="profile-jumbotron" style="background: url('<?= $user->banner ?>')">
    <div>
        <figure class="thumbnail">
            <img src="<?= $user->thumbnail ?>" alt="<?= $user->name ?>'s profile">
            <figcaption><?= $user->name ?></figcaption>
        </figure>
        <a href="<?php $user->country ?>" class="country"></a>
        <div class="profile-stats">
            <span class="stat stat-completed">Completed mappools<br><?= count($completed) ?></span>
            <span class="stat stat-submitted">Submitted mappools<br><?= count($submitted) ?></span>
            <span class="stat stat-followed">Followed mappool<br><?= count($follow) ?></span>
            <span class="stat stat-rank">Classement générale<br>#<?= $user->rank ?></span>
        </div>
        <ul class="profile-note">

            <li class="silver_ss">
                svg
                <span><?= $user->silver_ss ?></span>
            </li>

            <li class="ss">
                svg
                <span><?= $user->ss ?></span>
            </li>

            <li class="silver_s">
                svg
                <span><?= $user->silver_s ?></span>
            </li>

            <li class="s">
                svg
                <span><?= $user->s ?></span>
            </li>

            <li class="a">
                svg
                <span><?= $user->a ?></span>
            </li>

        </ul>
    </div>
</section>
