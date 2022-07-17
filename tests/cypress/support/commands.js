// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************
//
//
// -- This is a parent command --
Cypress.Commands.add('adminLogin', (login, password) => {
	cy.visit('/wp-login.php');

	cy.get('input#user_login').then((user_input) => {
		cy.wrap(user_input).should('be.visible');
		cy.wrap(user_input).clear().click().type(login, {delay: 100});
		cy.wrap(user_input).should('have.value', login);
	});

	cy.get('input#user_pass').then((pass_input) => {
		cy.wrap(pass_input).should('be.visible');
		cy.wrap(pass_input).clear().click().type(password, {delay: 100});
		cy.wrap(pass_input).should('have.value', password);
	});

	cy.get('input#wp-submit').click();

	cy.url().should('include', '/wp-admin/');
});

Cypress.Commands.add('verifyCommentsNumber', (amount) => {
	// Default markup of 'Twenty Twenty-Two' theme replace number 1 to word One
	const prettyHeading = (1 === amount) ? 'One response' : amount + ' responses';

	// Based on markup of 'Twenty Twenty-Two' theme
	cy.get('h3#comments').should('be.visible').and('contain.text', prettyHeading);
	cy.get('ol.commentlist').should('be.visible').then((ol) => {
		cy.wrap(ol.find('li.comment')).should('have.length', amount)
	});
});
