<form action="../edit/<?php echo $collection_id[0][0];?>" method="post">
    <label>Name</label>
    <input type="text" value="<?php echo $collection->name ?>" name="name" >
    <input type="submit" value="Submit">
</form>
<form action="../edit/<?php echo $collection_id[0][0];?>" method="post">
    <label>Description</label>
    <input type="text" value="<?php echo $collection->description;?>" name="description">
    <input type="submit" value="Submit">
</form>
    <br>
    <label>Tags de la collection</label>
    <?php foreach($tags as $tag): ?>
        <?php echo $tag['name'];?>
    <?php endforeach;?>
    <br>
<form action="../edit/<?php echo $collection_id[0][0];?>" method="post">
    <label> Ajouter un tag</label>
    <?php foreach($Tags as $tag): ?>
        <button type="submit" name="addtag" value="<?php echo $tag['id'] ?>">
                <?php echo $tag['name']; ?>

        </button>
    <?php endforeach;?>
    <input type="submit" value="Submit">
    <br>
</form>
<form action="../edit/<?php echo $collection_id[0][0];?>" method="post">
    <label> Supprimer un tag</label>
    <?php foreach($Tags as $tag): ?>
        <button value="<?php echo $tag['id'] ?>" name="removetag">
                <?php echo $tag['name']; ?>

        </button>
    <?php endforeach;?>
    <input type="submit" value="Submit">
</form>
<label>Current contributors</label>
<?php foreach($contributors as $contributor): ?>
    <?php echo $contributor->name; ?>
<?php endforeach;?>
<br>
<form action="../edit/<?php echo $collection_id[0][0];?>" method="post">
    <label>Add a contributor</label>
    <input name="addcontributor" type="text">
    <input type="submit" value="Submit">
    <br>
</form>
<form action="../edit/<?php echo $collection_id[0][0];?>" method="post">
    <label>Remove a contributor</label>
    <?php foreach($contributors as $contributor): ?>
        <button type="submit" name="removecontributor" value="<?php echo $contributor->osu_id;?>">
            <?php echo $contributor->name; ?>
        </button>
    <?php endforeach;?>
</form>

