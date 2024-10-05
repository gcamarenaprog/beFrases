<?php
  /**
   * About plugin option
   *
   * @package            beFrases
   * @version            2.0.0
   * @author             Guillermo Camarena <gcamarenaprog@outlook.com>
   * @copyright          Copyright (c) 2004 - 2023, Guillermo Camarena
   * @link               https://gcamarenaprog.com.com/beFrases/
   * @license            http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
   *
   */
  
  # Prevent PHP code from being executed by inserting the path in the browser bar
  defined ('ABSPATH') or die("Bye bye and remember: Silence is golden!");
?>


<div class="container" style="max-width: 100%">
  <div class="row g-2" style="margin-right: 10px;">

    <!-- Title and description /-->
    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
      <div class="card">
        <h5 class="card-header"><?php echo get_admin_page_title (); ?></h5>
        <div class="card-body">
          <p class="card-text"> beFrases, a simple and easy-to-use plugin that will allow you to manage phrases with
            their authors and categories. With the option to display them in a random widget! </p>
        </div>
      </div>
    </div>

    <!-- Author information /-->
    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
      <div class="card">
        <div class="card-body">

          <div class="mb-4" style="display: block;">

            <!-- Author /-->
            <h6 class="card-title">Author</h6>
            <p class="card-text">
              <a href="https://gacamarenaprog.com/" target="_blank">Guillermo Camarena</a>
            </p>

            <hr>

            <!-- Email /-->
            <h6 class="card-title">Email</h6>
            <p class="card-text">
              <a href="mailto:gcamarenaprog@outlook.com">gcamarenaprog@outlook.com</a></p>

            <hr>

            <!-- Website /-->
            <h6 class="card-title">Website</h6>
            <p class="card-text">
              <a href="https://gacamarenaprog.com/" target="_blank">gacamarenaprog.com</a>
            </p>

            <hr>

            <!-- Facebook /-->
            <h6 class="card-title">Facebook</h6>
            <p class="card-text">
              <a href="https://www.facebook.com/guillermocamarenaprog/" target="_blank">facebook.com/guillermocamarenaprog</a>
            </p>

            <hr>

            <!-- Twitter /-->
            <h6 class="card-title">Twitter</h6>
            <p class="card-text">
              <a href="https://twitter.com/GCamarenaProg" target="_blank"> @GCamarenaProg</a>
            </p>

            <hr>

            <!-- LinkedIn /-->
            <h6 class="card-title">LinkedIn</h6>
            <p class="card-text">
              <a href="https://www.linkedin.com/in/guillermo-camarena-57a25b134/" target="_blank">
                linkedin.com/in/guillermo-camarena</a>
            </p>

            <hr>

            <!-- GitHub /-->
            <h6 class="card-title">GitHub</h6>
            <p class="card-text">
              <a href="https://github.com/gcamarenaprog" target="_blank"> github.com/gcamarenaprog</a>
            </p>

          </div>

          <hr>

          <!-- Author's quote -->
          <figure class="text-center">
            <blockquote class="blockquote">
              <p class="be-quote"><em>"We live a great novel, in a great theater, put together by intelligent people who
                  like to play puppets.".</em></p>
            </blockquote>
            <figcaption class="blockquote-footer">
              <em>
                <b>
                  Guillermo Camarena<cite title="Source Title"> / Full-Stack Developer, Researcher, Podcaster and
                    Blogger on Fortean Phenomena</cite>
                </b>
              </em>
            </figcaption>
          </figure>

        </div>
      </div>
    </div>
  </div>

</div>