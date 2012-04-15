<header>
  <?php if ($loader->is_home_page()) : ?>
    <h1>Welcome</h1>
  <?php else : ?>
    <div>Welcome</div>
  <?php endif ?>
  <nav>
    <ol><?php $loader->page_links() ?></ol>
  </nav>
</header>
