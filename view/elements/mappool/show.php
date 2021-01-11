<article class="article mappool" style="background-image: url('<?= $mappool->thumbnail ?>')">

    <div class="card"
         style="background-image: url('<?= $mappool->thumbnail ?>')">
        <div class="card-mappool">
            <h3 class="card-title"><?= $mappool->name ?></h3>
            <span class="mappool-collection">created by <span class="name"><?= $mappool->collection ?></span></span>
            <span class="nb-maps">26 maps</span>

            <form class="form form-follow" action="?" method="post">

                <button type="submit" class="btn btn-<?= isset($is_follow) ? 'follow' : 'following' ?>">

                    <?php if (isset($is_follow)): ?>

                        Followed

                    <?php else: ?>

                        <svg viewBox="0 0 12 11" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M11.1978 5.50002L5.50018 10.4854V7.59727C3.70738 7.40611 2.22523 7.91601 1.0082 9.13304L0.0835161 10.0577V8.75002C0.0835161 5.35619 1.95299 3.51287 5.50018 3.34583V0.514648L11.1978 5.50002ZM9.55258 5.49994L6.58348 2.90198V4.41661H6.04182C3.2248 4.41661 1.68115 5.41924 1.27583 7.51306C2.65338 6.59113 4.2813 6.28238 6.13086 6.59064L6.58348 6.66608V8.0979L9.55258 5.49994Z"/>
                        </svg>
                        follow

                    <?php endif; ?>

                </button>

            </form>

            <div class="tags">
                <?php foreach ($tags as $tag) : ?>

                    <span class="tag tag-<?= $tag['type'] ?>"><?= str_replace('_', ' ', $tag['name']) ?></span>

                <?php endforeach; ?>
            </div>
            <a class="arrow">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M12.0001 9.41436L19.293 16.7073L20.7072 15.293L12.0001 6.58594L3.29297 15.293L4.70718 16.7073L12.0001 9.41436Z"/>
                </svg>
            </a>
        </div>
    </div>

    <div class="maps">
        <div class="card card-map nm-map"
             style="background-image: url('https://assets.ppy.sh/beatmaps/967904/covers/cover.jpg?1566734927')">
            <div class="map">
                <span class="map-name">Matsushita - raspberry cube [Insane]</span>
                <span class="mapper">mappée par timemon</span>
                <img class="mod" src="assets/image/NM.png">
            </div>
        </div>
    </div>

</article>