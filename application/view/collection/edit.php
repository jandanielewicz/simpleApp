<div class="container">
    <h1>CollectionController/edit/:collection_id</h1>

    <div class="box">
        <h2>Edit a collection</h2>

        <?php $this->renderMessages(); ?>

        <?php if ($this->collection) { ?>
            <form method="post" action="<?php echo Config::get('URL'); ?>collection/editSave">
                <label>Change text of collection:</label>

                <!-- we use htmlentities() here to prevent user input with " etc. break the HTML -->
                <input type="hidden" name="collection_id" value="<?php echo htmlentities($this->collection->collection_id); ?>"/>
                <input type="text" name="collection_text" value="<?php echo htmlentities($this->collection->collection_text); ?>"/>
                <input type="submit" value='Change'/>
            </form>
        <?php } else { ?>
            <p>This collection does not exist.</p>
        <?php } ?>
    </div>
</div>
