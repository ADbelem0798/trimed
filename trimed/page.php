<?php get_header(); ?>

<main id="main" role="main">
  <section class="page-hero" aria-label="<?php the_title_attribute(); ?>">
    <div class="page-hero__bg" aria-hidden="true"></div>
    <div class="container">
      <div class="page-hero__inner">
        <h1 class="page-hero__title"><?php the_title(); ?></h1>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container" style="max-width:860px">
      <div style="color:var(--clr-text-muted);line-height:1.8;font-size:var(--text-base)">
        <?php
        while (have_posts()) : the_post();
          the_content();
        endwhile;
        ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
