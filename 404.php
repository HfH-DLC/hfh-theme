<?php
get_header();
?>
<main id="main" class="hfh-theme-404">
    <div class="hfh-theme-content hfh-content">
        <header>
            <h1>
                <?= __('Error 404 - Page not found', 'hfh-theme') ?>
            </h1>
        </header>
        <p><?= __("Sorry, we could not find the page your were looking for. The page you requested unfortunately is no longer available at this URL. In order to find the content you were looking for, please use the links above or try a search:", 'hfh-theme') ?></p>
        <?php
        get_search_form();
        ?>
        <p><?= _x("Thank you.", 'End of 404 page text', 'hfh-theme') ?></p>
    </div>
</main>
<?php
get_footer()
?>