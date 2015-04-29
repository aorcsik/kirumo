<?php
/**
 * Post Footer Template
 *
 * @package Kirumo
 */
?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php kirumo_posted_on(); ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'kirumo' ) );
				if ( $categories_list && kirumo_categorized_blog() ) :
			?>
				<?php printf( __( ' in %1$s', 'kirumo' ), $categories_list ); ?>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'kirumo' ) );
				if ( $tags_list ) :
			?>
				| <?php printf( __( 'Tagged %1$s', 'kirumo' ), $tags_list ); ?>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php edit_post_link( __( 'Edit', 'kirumo' ), '| <span class="edit-link">', '</span>' ); ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<div>
				<span class="comments-link">
					<?php comments_popup_link( __( '&nbsp;', 'kirumo' ), __( '1', 'kirumo' ), __( '%', 'kirumo' ) ); ?>
				</span>
			</div>
		<?php endif; ?>

	</footer><!-- .entry-meta -->