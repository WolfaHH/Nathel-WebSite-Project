<form action="../edit/<?php echo $collection_id[0][0];?>?pool_id=<?php echo $pool['id'];?>&position=<?php echo $position;?>" method="post">
    <label>Add a map</label>
    <input type="text" name="url" placeholder="enter url here">
    <select id="map" name="mode">
        <?php foreach($mods as $mod => $value): ?>
                <option value="<?php echo $mod ?>"><?php echo $value; ?></option>
        <?php endforeach; ?>
    </select>

    <input type="Submit" value="Submit">
</form>
