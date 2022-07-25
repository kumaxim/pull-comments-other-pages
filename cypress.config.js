'use strict'; // eslint-disable-line

const {defineConfig} = require("cypress");
require('dotenv').config();

module.exports = defineConfig({
	projectId: process.env.CYPRESS_PROJECT_ID,
	downloadsFolder: 'tests/cypress/downloads',
	fixturesFolder: 'tests/cypress/fixtures',
	screenshotsFolder: 'tests/cypress/screenshots',
	videosFolder: 'tests/cypress/videos',
	env: {
		wp_user: 'wpadmin', // See wp-cli.yml
		wp_pass: process.env.WP_ADMIN_PASSWORD, // See .env
		wp_comments_number_on_dest_before_assigment: 2, // Number of comments on 'Review page v2' in tests/dummy.xml
		wp_comments_number_on_dest_after_assigment: 5, // Number of comments on ('Review page v2' + 'Old Review page' + 'Sample Page') in tests/dummy.xml
		wp_comments_number_on_1st_source_page: 1, // Number of comments on 'Old Review page' in tests/dummy.xml
		wp_comments_number_on_2nd_source_page: 2, // Number of comments on 'Sample Page' in tests/dummy.xml
	},
	e2e: {
		baseUrl: 'http://localhost',
		supportFile: 'tests/cypress/support/e2e.js',
		specPattern: 'tests/cypress/e2e/**/*.js',
	},
});
