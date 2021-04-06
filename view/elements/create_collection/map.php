<div>
    <label><?php echo $map->name?></label>
    <input type="text" value="https://osu.ppy.sh/beatmapsets/<?php echo $map->beatmapset_id?>#osu/<?php echo $map->url?>">
    <select id="map" name="map">
        <option value="nm">NM</option>
        <option value="dog">DT</option>
        <option value="rabbit">HR</option>
        <option value="rabbit">HD</option>
        <option value="rabbit">EZ</option>
        <option value="rabbit">FL</option>
        <option value="rabbit">Autre</option>
    </select>
</div>