<?php
/**
 * Post Footer Template
 *
 * @package Kirumo
 */
?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : ?>
			<?php kirumo_posted_on(); ?>
		<?php endif; ?>
		<?php edit_post_link( __( 'Edit', 'kirumo' ), '| <span class="edit-link">', '</span>' ); ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<div>
			<span class="comments-link"><?php comments_popup_link( __( '&nbsp;', 'kirumo' ), __( '1', 'kirumo' ), __( '%', 'kirumo' ) ); ?></span>
		</div>
		<?php endif; ?>
	</footer><!-- .entry-meta -->