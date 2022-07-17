// Source: roots/sage@9.0.10
// See: https://raw.githubusercontent.com/roots/sage/9.0.10/.stylelintrc.js
module.exports = {
	'extends': 'stylelint-config-standard',
	'overrides': [
		{
			'files': ['*.scss', '**/*.scss'],
			'customSyntax': 'postcss-scss',
		}
	],
	'rules': {
		'no-empty-source': null,
		'string-quotes': 'double',
		'at-rule-no-unknown': [
			true,
			{
				'ignoreAtRules': [
					'extend',
					'at-root',
					'debug',
					'warn',
					'error',
					'if',
					'else',
					'for',
					'each',
					'while',
					'mixin',
					'include',
					'content',
					'return',
					'function',
					'tailwind',
					'apply',
					'responsive',
					'variants',
					'screen',
				],
			},
		],
	},
};