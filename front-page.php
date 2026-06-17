<?php
/**
 * Front page template.
 *
 * @package Fiaztheme
 */

declare(strict_types=1);

get_header();
?>
<main id="main" class="site-main">
	<?php
	get_template_part( 'template-parts/sections/hero' );
	get_template_part( 'template-parts/sections/company-overview' );
	get_template_part( 'template-parts/sections/services' );
	get_template_part( 'template-parts/sections/featured-projects' );
	get_template_part( 'template-parts/sections/clients' );
	get_template_part( 'template-parts/sections/legality' );
	get_template_part( 'template-parts/sections/directors' );
	get_template_part( 'template-parts/sections/contact-cta' );
	?>
</main>
<?php
get_footer();
