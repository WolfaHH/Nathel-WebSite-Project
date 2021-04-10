<form action="../edit/<?php echo $collection_id[0][0];?>?map_id=<?php echo $mamap['map_id'];?>&pool_id=<?php echo $pool['id'];?>" method="post">
    <label><?php echo $map->name?></label>
    <input type="text" name="url" value="<?php echo $map->url?>">
    <select id="map" name="mode">
        <?php foreach($mods as $mod => $value): ?>

            <?php if((int)$mamap['mode'] === (int)$mod){  ?>

                <option value="<?php echo  $mod ?>" selected="selected" ><?php echo $value;?></option>
            <?php }else{?>
                <option value="<?php echo $mod ?>"><?php echo $value; ?></option>
            <?php } ?>





        <?php endforeach; ?>
    </select>
    <input type="Submit" value="Submit">
</form>

