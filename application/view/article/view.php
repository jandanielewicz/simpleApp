<div class="container">
    <h1>ArticleController/index</h1>

    <div class="box">

        <?php $this->renderMessages(); ?>

        <?php

        if ($this->article) {
            $category = CategoryModel::getCategory($this->article->category_id)->category_name;
            $author = AuthorModel::getAuthor($this->article->author_id)->author_name;

            ?>
            <table class="article-table">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Content</td>
                    <td>shortDescription</td>
                    <td>price</td>
                    <td>category</td>
                    <td>author</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?= $this->article->article_id; ?></td>
                    <td><?php

                        if (!empty($this->article->content)) {
                            echo $this->article->content;
                        } else {
                            if (!Session::userIsLogged()) {
                                echo 'Login to buy';
                            } else {
                                ?>
                                <form method="post" action="<?php echo Config::get('URL') . 'article/buy/' . $value->article_id; ?>">
                                    <input type="hidden" name="article_id" value='<?php echo $value->article_id; ?>' autocomplete="off"/>
                                    <input type="submit" value='Buy' autocomplete="off"/>
                                </form>
                            <?php
                            }
                        };
                        ?>
                    </td>
                    <td><?= $this->article->shortDescription; ?></td>
                    <td><?= $this->article->price; ?></td>
                    <td><?= $category; ?></td>
                    <td>
                        <a href="<?= Config::get('URL') . 'author/articles/' . $this->article->author_id; ?>">
                            <?= $author ?>
                        </a>
                    </td>


                </tr>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>
