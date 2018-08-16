<div class="container">
    <h1>CategoryController/index</h1>

    <div class="box">

        <?php $this->renderMessages(); ?>

        <?php if ($this->categories) { ?>
            <table class="article-table">
                <thead>
                <tr>
                    <td>Name</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->categories as $key => $value) { ?>
                    <tr>
                        <td>
                            <a href="<?= Config::get('URL') . 'category/view/' . $value->category_id; ?>"><?= $value->category_name;
                                ?></a>
                        </td>

                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div>No categories.</div>
        <?php } ?>
    </div>
</div>
