<?php
/**
 * Fallback index template.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

get_header();
?>
<main id="main" class="site-main">
	<div class="container page-header">
		<?php \Fiaztheme\breadcrumb(); ?>
		<h1 class="page-header__title"><?php esc_html_e( 'Latest', 'fiaztheme' ); ?></h1>
	</div>
	<div class="container section">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article class="fade-up" style="margin-bottom:3rem">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<p><?php esc_html_e( 'No content found.', 'fiaztheme' ); ?></p>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
