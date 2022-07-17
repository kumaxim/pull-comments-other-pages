describe('Merge Comments From Other Pages', () => {
	it('Assign Source Comment Pages to Destination Page in Admin Panel', function () {
		cy.adminLogin(Cypress.env('wp_user'), Cypress.env('wp_pass'));

		cy.contains('#menu-pages > .wp-has-submenu > .wp-menu-name', 'Pages').should('be.visible').click();
		cy.url().should('include', '/wp-admin/edit.php?post_type=page');

		cy.contains('a.row-title', 'Review page v2').click();
		cy.url().should('include', '/wp-admin/post.php?post=');

		// Close Gutenberg Welcome Guide
		cy.focused().get('button[aria-label="Close dialog"]').then((dialog) => {
			if ( dialog.length > 0 ) {
				cy.wrap(dialog).click('center');
			}
		});

		cy.get('select#b2p-source-comments-page-dropdown + span.select2').should('be.visible').click()
			.type('Sample Page{enter}Old Review page{enter}', { delay: 100 });

		cy.get('.editor-post-publish-button').should('be.visible').click().then((button) => {
			cy.wrap(button).click({force: true});
			cy.wrap(button).should('have.attr', 'aria-disabled').and('equal', 'true');
		});

		// 'View post' link on black popup at bottom left
		cy.get('.components-snackbar__content > .components-button').should('be.visible').click();
	});

	it('Number of Comment Increased on Destination Page', () => {
		// Pretty permalink are disabled in WordPress
		cy.url().should('include', '?page_id=');

		cy.verifyCommentsNumber(Cypress.env('wp_comments_number_on_dest_page'));
	});

	it('Number of Comments Unchanged on Source Pages', () => {
		cy.contains('ul.wp-block-page-list > li > a', 'Old Review page').should('be.visible').click();
		cy.verifyCommentsNumber(Cypress.env('wp_comments_number_on_1st_source_page'));

		cy.contains('ul.wp-block-page-list > li > a', 'Sample Page').should('be.visible').click();
		cy.verifyCommentsNumber(Cypress.env('wp_comments_number_on_2nd_source_page'));
	});
});