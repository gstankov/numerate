<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation Starter Template</title>
    <link rel="stylesheet" href="app/assets/css/zurb/foundation.min.css" />
</head>
<body>
    
    <!-- Start Top Bar -->
    <div class="top-bar">
      <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
          <li class="menu-text"><?php echo $args['session'] ?></li>
          <li class="has-submenu">
            <a href="#">One</a>
            <ul class="submenu menu vertical" data-submenu>
              <li><a href="#">One</a></li>
              <li><a href="#">Two</a></li>
              <li><a href="#">Three</a></li>
            </ul>
          </li>
          <li><a href="#">Two</a></li>
          <li><a href="#">Three</a></li>
        </ul>
      </div>
      <div class="top-bar-right">
        <ul class="menu">
          <li><input type="search" placeholder="Search"></li>
          <li><button type="button" class="button">Search</button></li>
        </ul>
      </div>
    </div>
    <!-- End Top Bar -->
    <br>
    <article class="grid-container">
    <div class="grid-x cell">
      <nav aria-label="You are here:" role="navigation">
        <ul class="breadcrumbs">
          <li><a href="#">Home</a></li>
          <li><a href="#">Features</a></li>
          <li class="disabled">Gene Splicing</li>
          <li>
            <span class="show-for-sr">Current: </span> Cloning
          </li>
        </ul>
      </nav>
    </div>
    <div class="grid-x grid-margin-x">
      <div class="medium-6 cell">
        <img class="thumbnail" src="https://placehold.it/650x350">
        <div class="grid-x grid-padding-x small-up-4">
          <div class="cell">
            <img src="https://placehold.it/250x200">
          </div>
          <div class="cell">
            <img src="https://placehold.it/250x200">
          </div>
          <div class="cell">
            <img src="https://placehold.it/250x200">
          </div>
          <div class="cell">
            <img src="https://placehold.it/250x200">
          </div>
        </div>
      </div>
      <div class="medium-6 large-5 cell large-offset-1">
        <h3>My Awesome Product</h3>
        <p>Nunc eu ullamcorper orci. Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque faucibus vestibulum. Nulla at nulla justo, eget luctus tortor. Nulla facilisi. Duis aliquet egestas purus in.</p>
    
        <label>Size
        <select>
          <option value="husker">Small</option>
          <option value="starbuck">Medium</option>
          <option value="hotdog">Large</option>
          <option value="apollo">Yeti</option>
        </select>
        </label>
    
        <div class="grid-x">
          <div class="small-3 cell">
            <label for="middle-label" class="middle">Quantity</label>
          </div>
          <div class="small-9 cell">
            <input type="text" id="middle-label" placeholder="One fish two fish">
          </div>
        </div>
    
        <a href="#" class="button large expanded">Buy Now</a>
    
        <div class="small secondary expanded button-group">
            <a class="button">Facebook</a>
            <a class="button">Twitter</a>
            <a class="button">Yo</a>
          </div>
        </div>
    </div>
    
    <div class="">
      <hr>
      <ul class="tabs" data-tabs id="example-tabs">
        <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Reviews</a></li>
        <li class="tabs-title"><a href="#panel2">Similar Products</a></li>
      </ul>
      <div class="tabs-content" data-tabs-content="example-tabs">
        <div class="tabs-panel is-active" id="panel1">
          <h4>Reviews</h4>
          <div class="media-object stack-for-small">
            <div class="media-object-section">
              <img class="thumbnail" src="https://placehold.it/200x200">
            </div>
            <div class="media-object-section">
              <h5>Mike Stevenson</h5>
              <p>I'm going to improvise. Listen, there's something you should know about me... about inception. An idea is like a virus, resilient, highly contagious. The smallest seed of an idea can grow. It can grow to define or destroy you.</p>
            </div>
          </div>
          <div class="media-object stack-for-small">
            <div class="media-object-section">
              <img class="thumbnail" src="https://placehold.it/200x200">
            </div>
            <div class="media-object-section">
              <h5>Mike Stevenson</h5>
              <p>I'm going to improvise. Listen, there's something you should know about me... about inception. An idea is like a virus, resilient, highly contagious. The smallest seed of an idea can grow. It can grow to define or destroy you</p>
            </div>
          </div>
          <div class="media-object stack-for-small">
            <div class="media-object-section">
              <img class="thumbnail" src="https://placehold.it/200x200">
            </div>
            <div class="media-object-section">
              <h5>Mike Stevenson</h5>
              <p>I'm going to improvise. Listen, there's something you should know about me... about inception. An idea is like a virus, resilient, highly contagious. The smallest seed of an idea can grow. It can grow to define or destroy you</p>
            </div>
          </div>
          <label>
            My Review
            <textarea placeholder="None"></textarea>
          </label>
          <button class="button">Submit Review</button>
        </div>
        <div class="tabs-panel" id="panel2">
          <div class="grid-x grid-margin-x medium-up-3 large-up-5">
            <div class="cell">
              <img class="thumbnail" src="https://placehold.it/350x200">
              <h5>Other Product <small>$22</small></h5>
              <p>In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna diam.</p>
              <a href="#" class="button hollow tiny expanded">Buy Now</a>
            </div>
            <div class="cell">
              <img class="thumbnail" src="https://placehold.it/350x200">
              <h5>Other Product <small>$22</small></h5>
              <p>In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna diam.</p>
              <a href="#" class="button hollow tiny expanded">Buy Now</a>
            </div>
            <div class="cell">
              <img class="thumbnail" src="https://placehold.it/350x200">
              <h5>Other Product <small>$22</small></h5>
              <p>In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna diam.</p>
              <a href="#" class="button hollow tiny expanded">Buy Now</a>
            </div>
            <div class="cell">
              <img class="thumbnail" src="https://placehold.it/350x200">
              <h5>Other Product <small>$22</small></h5>
              <p>In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna diam.</p>
              <a href="#" class="button hollow tiny expanded">Buy Now</a>
            </div>
            <div class="cell">
              <img class="thumbnail" src="https://placehold.it/350x200">
              <h5>Other Product <small>$22</small></h5>
              <p>In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna diam.</p>
              <a href="#" class="button hollow tiny expanded">Buy Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <hr>
    
    <div class="grid-x align-justify align-middle">
      <div class="small-12 medium-shrink cell">
        <ul class="menu">
          <li class="align-self-middle">Yeti Store</li>
          <li><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
    
      <div class="small-12 medium-shrink cell">
        <span>Copyright 2018</span>
      </div>
    </div>
    </article>
    </body>

    <script src="app/assets/js/jquery/jquery.min.js"></script>
    <script src="app/assets/js/zurb/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>

  </body>
</html>