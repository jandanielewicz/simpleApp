<div class="container">
    <h1>CollectionController/index</h1>

    <div class="box">

        <?php $this->renderMessages(); ?>

        <?php if ($this->collections) { ?>
            <table class="collection-table">
                <thead>
                <tr>
                    <td>Article</td>
                    <td>View</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->collections as $key => $value) { ?>
                    <tr>
                        <td><?= htmlentities($value->article_id); ?></td>
                        <td>
                            <a href="<?= Config::get('URL') . 'article/view/' . $value->article_id; ?>">View</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div>No collections.</div>
        <?php } ?>
    </div>
</div>
