<div class="publicpage">
    <div class="login_form">
        <form method="post" action="">
            <input type="text" name="LoginName" placeholder="Login name" />
            <input type="password" name="Password" placeholder="Password" />
            <button type="submit">Login</button>
        </form>
    </div>
    <div class="result">
        <?php if ($this->session->flashdata('wrong_login') == true) : ?>
            <p>Something is wrong.</p>
        <?php endif; ?>
    </div>
    <div class="registration">
        <p>You can register from <a href="<?= base_url(); ?>startpage/register/">here</a>.</p>
    </div>
</div>
