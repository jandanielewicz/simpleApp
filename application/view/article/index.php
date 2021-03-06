<div class="container">
    <h1>ArticleController/index</h1>

    <div class="box">

        <?php $this->renderMessages(); ?>

        <?php if ($this->articles) { ?>
            <table class="article-table">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>shortDescription</td>
                    <td>Price</td>
                    <td>Buy</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->articles as $key => $value) { ?>
                    <tr>
                        <td><?= $value->article_id; ?></td>
                        <td>
                            <a href="<?= Config::get('URL') . 'article/view/' . $value->article_id; ?>">
                                <?= htmlentities($value->shortDescription); ?>
                            </a>
                        <td><?= $value->price; ?></td>
                        <td>
                            <?php
                            if ($value->price > 0 AND Session::userIsLogged()) {
                                ?>
                                <form method="post" action="<?php echo Config::get('URL') . 'article/buy/' . $value->article_id; ?>">
                                    <input type="hidden" name="article_id" value='<?php echo $value->article_id; ?>' autocomplete="off"/>
                                    <input type="submit" value='Buy' autocomplete="off"/>
                                </form>
                            <?php
                            } else if ($value->price > 0 AND !Session::userIsLogged()) {
                                echo 'Login to buy';
                            } else {
                                echo 'Free';
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div>No articles.</div>
        <?php } ?>
    </div>
</div>
