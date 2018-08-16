<div class="container">
    <h1>AuthorController/view</h1>

    <div class="box">


        <?php $this->renderMessages(); ?>

        <?php if ($this->authors) { ?>
            <table class="author-table">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Name</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->authors as $key => $value) { ?>
                    <tr>
                        <td><?= $value->author_id; ?></td>
                        <td><?= $value->author_name; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div>No authors.</div>
        <?php } ?>
    </div>
</div>
