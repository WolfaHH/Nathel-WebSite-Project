<form action="">
    <div class="form-floating mb-3">
        <label>Name</label>
        <input type="text" value="<?php echo $collection->description ?>" >
    </div>
    <div class="form-floating">
        <label>Description</label>
        <input type="text" value="<?php echo $collection->name;?>">
    </div>
    <div>
        <br>
        <label>Tags de la collection</label>
        <?php foreach($tags as $tag): ?>
        <?php echo $tag['name'];?>
        <?php endforeach;?>
        <br>
        <label> Ajouter un tag</label>
        <?php foreach($Tags as $tag): ?>
            <button type="submit">
                <p>
                    <?php echo $tag['name']; ?>
                </p>
            </button>
        <?php endforeach;?>
        <br>
        <label> Supprimer un tag</label>
        <?php foreach($Tags as $tag): ?>
            <button name="<?php echo $tag['name'] ?>">
                <p>
                    <?php echo $tag['name']; ?>
                </p>
            </button>
        <?php endforeach;?>

    </div>

    <div>
        <label>Current contributors</label>
        <?php foreach($contributors as $contributor): ?>
            <?php echo $contributor->name; ?>
        <?php endforeach;?>
        <br>
        <label>Add a contributor</label>
        <input name="contributor" type="text">
        <br>
        <label>Remove a contributor</label>
        <?php foreach($contributors as $contributor): ?>
            <button name="contributor_remove""<?php echo $contributor->name ?>">
                <p>
                    <?php echo $contributor->name; ?>
                </p>
            </button>
        <?php endforeach;?>


    </div>

    <br>
    <button type="submit">update</button>

</form>
