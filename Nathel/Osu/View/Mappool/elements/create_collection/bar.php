<form action="create" method="POST" enctype="multipart/form-data">
    <label for="name">Name of the collection:</label>
    <input type="text" id="name" name="name" required
           minlength="4" maxlength="24" size="10">
    <br>
    <br>
    <label for="name">Description (max 144c):</label>

    <input type="text" id="desc" name="desc"
           minlength="0" maxlength="144" size="10">
    <?php include '../view/elements/filters/filterscriterias.php';?>
    <?php include '../view/elements/create_collection/addbackground.php'; ?>
    <br>
    <input type="submit" value="Submit">
</form>
