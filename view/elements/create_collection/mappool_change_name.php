<form action="../edit/<?php echo $collection_id[0][0];?>?pool_id=<?php echo $pool['id'];?>" method="post">
    <input type="text" value ="<?php echo $pool['name'];?>" name="changepoolname">
    <?php $_SESSION['pool_id'] = $pool['id'];?>
    <input type="submit" value="Submit">
</form>