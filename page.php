<?php
/**
 * Default page template.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

get_header();
?>
<main id="main" class="site-main">
	<div class="container page-header">
		<?php \Fiaztheme\breadcrumb(); ?>
		<h1 class="page-header__title"><?php the_title(); ?></h1>
	</div>
	<div class="container section">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="fade-up intro__content">
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
	</div>
</main>
<?php
get_footer();
