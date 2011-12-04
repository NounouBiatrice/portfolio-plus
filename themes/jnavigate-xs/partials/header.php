<header id="page-header">

  <div id="inner-header">
    
    <div class="page-content-area">
    
      <?php if ($loader->is_home_page()) : ?>
        
        <h1 id="logo"><span>j</span>Navigate - a powerful jQuery Ajax plugin</h1>
        
      <?php else : ?>
        
        <div id="logo"><span>j</span>Navigate - a powerful jQuery Ajax plugin</div>
        
      <?php endif; ?>
  
      <nav id="main-navigation">
        <ol>
        <?php $loader->page_links('main-nav', 'main-nav-link jnav-external'); ?>
        </ol>
      </nav>
  
    </div>
  
  </div>
  
  <div id="highlight-divider"><!-- highlight under header --></div>
  
</header>
