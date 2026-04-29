<?php get_header(); ?>

<main id="main" role="main">
  <section class="section">
    <div class="container">
      <div class="section-header section-header--center">
        <h1 class="section-title">Conteúdo</h1>
      </div>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article>
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <?php the_excerpt(); ?>
        </article>
      <?php endwhile; else : ?>
        <p style="color:var(--clr-text-muted);text-align:center">Nenhum conteúdo encontrado.</p>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
