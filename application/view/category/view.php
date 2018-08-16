<div class="container">
    <h1>CategoryController/view</h1>

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
                        <td><?= htmlentities($value->shortDescription); ?></td>
                        <td><?= $value->price; ?></td>
                        <td>
                            <?php
                            if (!Session::userIsLogged()) {
                                echo 'Login to buy';
                            } else {
                                ?>
                                <form method="post" action="<?php echo Config::get('URL') . 'article/buy/' . $value->article_id; ?>">
                                    <input type="hidden" name="article_id" value='<?php echo $value->article_id; ?>'
                                           autocomplete="off"/>
                                    <input type="submit" value='Buy' autocomplete="off"/>
                                </form>
                            <?php
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
