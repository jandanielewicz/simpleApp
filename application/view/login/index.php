<div class="container">


    <?php $this->renderMessages(); ?>

    <div class="login-page-box">
        <div class="table-wrapper">

            <!-- login box on left side -->
            <div class="login-box">
                <h2>Login here</h2>

                <form action="<?php echo Config::get('URL'); ?>login/login" method="post">
                    <input type="text" name="user_name" placeholder="Username or email" required/>
                    <input type="password" name="user_password" placeholder="Password" required/>
                    <?php if (!empty($this->redirect)) { ?>
                        <input type="hidden" name="redirect" value="<?= $this->encodeHTML($this->redirect); ?>"/>
                    <?php } ?>

                    <input type="submit" class="login-submit-button" value="Log in"/>
                </form>
            </div>


        </div>
    </div>
</div>
