[![WP: Pull Comments Other Pages](https://img.shields.io/endpoint?url=https://dashboard.cypress.io/badge/simple/wiybc5/master&style=flat&logo=cypress)](https://dashboard.cypress.io/projects/wiybc5/runs)
[![Build Plugin Release](https://github.com/kumaxim/pull-comments-other-pages/actions/workflows/build-plugin-release.yml/badge.svg)](https://github.com/kumaxim/pull-comments-other-pages/actions/workflows/build-plugin-release.yml)

# Pull Comments From Other Page(s)

Pull Comments From Other Page(s) is [WordPress](https://wordpress.org/) plugin that allow you to pull comments from one or several pages and merge them among comments of target one.
Resulting list will be sort in chronological order. Support both buildin (page, post) and any custom post type as source(s) and target page.

_**Note:** Custom post type must support 'comments' feature_  


## Requirements

### Minimal
- PHP 7.3
- WordPress 5.4

### Recommend

I tested 'Pull Comments From Other Page(s)' on different set of PHP and WordPress version. I guarantee that plugin will work well if your PHP and WordPress version match 
with one of the :heavy_check_mark: mark.   

| WordPress | 5.4 | 5.5 | 5.6 | 5.7 | 5.8 | 5.9 | 6.0 |
| --------- | :---: | :---: | :---: | :---: | :---: | :---: | :---: |
| __PHP 7.3__ | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: |  :grey_question: | 
| __PHP 7.4__ | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: |  :heavy_check_mark: |
| __PHP 8.0__ | :grey_question: | :grey_question: | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: | :heavy_check_mark: |  :heavy_check_mark: |
| __PHP 8.1__ | :grey_question: | :grey_question: | :grey_question: | :grey_question: | :heavy_check_mark: | :heavy_check_mark: |  :heavy_check_mark: |

- :heavy_check_mark: - Tested. Working well.
- :grey_question: - Not tested. Unknown status.

You may install the plugin on your WordPress until the configuration meet the minimal requirements. :grey_question: only denote that I haven't tested the code against such versions. 
 


## Installation

## Manual
1. [Download](https://github.com/kumaxim/pull-comments-other-pages/releases) latest release
2. Upload plugin in "WordPress => Admin Panel => Plugins => Add New => Upload Plugin"
3. Press "Activate Plugin" button on successful screen

## From [Plugin's Directory](https://wordpress.org/plugins/pull-comments-other-pages/)
1. Open "WordPress => Admin Panel => Plugins => Add New"
2. Search by plugin's slug surround by double quotes: "pull-comments-other-pages"

![wp-admin-plugin-search](https://raw.githubusercontent.com/kumaxim/pull-comments-other-pages/master/.github/wordpress-plugin-search.png?raw=true)

3. Press 'Install Now' button and then 'Activate'

## Using Composer on [Bedrock](https://roots.io/bedrock/)
Run in terminal `composer require wpackagist-plugin/pull-comments-other-pages`


## Usages:

1. Open "WordPress => Admin Panel => Pages" and select any page for editing
2. Scroll down to 'Comments source' metabox
3. Put the cursor into input 'Post(page, cpt)' and start typing the title of any previously existed page
4. Select desired page from dropdown list
5. Press 'Update' button at the top right
6. Go to front-end and check the list of comments 

Note: Steps #3 and #4 may be repeated any numbers of time that you desire.

## FAQ

### Q: Comments was not displayed
A1: Switch to page edit screen in admin panel. Verify that checkbox 'Allow comments' in panel 'Discussion' are selected.

A2: Deactivate plugin [Disable Comments](https://wordpress.org/plugins/disable-comments/) or allow in their options at least at one post type

A3: Verify that your theme support comments output. See function [wp_list_comments()](https://developer.wordpress.org/reference/functions/wp_list_comments/) 

### Q: Comments not merged in "WordPress => Admin Panel => Comments"

A: They should not. The plugin do not perform any database changes. All comments from source pages still associated with original pages. The plugin just retrieve them and merge 
with comments of target page. Even more, your users may still post comments on source(s) page and their will be appeared on target one automatically. On other side, your users
may still post comments on target page and their will be merged with comments of source(s) one for displaying on target. 

## Support

### Free
You may ask a question or post an issue on GitHub [Issues](https://github.com/kumaxim/pull-comments-other-pages/issues). I check them daily and give response when I will be free. 

### Paid
Any actions on your hosting or custom development under your requirements. Create new project on [UpWork](https://upwork.com/) and [send me][profile] an invitation. Cost and terms 
are discussable.

## Contributions

The primary OS on my workstation is Linux Ubuntu 20.04.4 LTS. Perhaps, you should to do a little changes in `docker-compose.yml` or `docker-sync.yml` if you are using different
platform. While development I used all 3rd-party tools listed below. You should consider specified versions as minimum recommend. Such was installed on my machine before I
started the code of the plugin.

### Requirements:
- [Git](https://git-scm.com/) v2.25.1
- [Docker](https://www.docker.com/) v20.10.17
- [Docker Compose](https://docs.docker.com/compose/) v2.6.0
- [Docker Sync](https://docker-sync.readthedocs.io/en/latest/) v0.7.2
- [Unison](https://www.cis.upenn.edu/~bcpierce/unison/) v2.52.1 ([ocaml](https://ocaml.org/) 4.12.1)
- [NodeJS](https://nodejs.org/en/) v16.14.2
- [Yarn](https://yarnpkg.com/) 1.22.18
- [Composer](https://getcomposer.org/) 2.2.9
- [WP-CLI](https://wp-cli.org/) v2.5

_**Note:** Pay attention that Unison and Ocaml versions must be the same with versions within image [eugenmayer/unison](https://hub.docker.com/r/eugenmayer/unison).
It will be pulled automatically during 1st start of Docker Sync._

### Install 

Open a terminal and copy/past following commands 'as is':
- `git clone git@github.com:kumaxim/pull-comments-other-pages.git` - no comments
- `cd pull-comments-other-pages` - subsequent commands consider that plugin's dir is your current folder 
- `composer install update` - Download WordPress Core and plugins, install [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer) and [WPCS](https://github.com/WordPress/WordPress-Coding-Standards) for linting, generate PSR4 class autoloader
- `composer env:generate` - generate `.env` with variables that required in Docker Compose and subsequent commands
- `compoer wp:create-config` - generate `wp-config.php`
- `composer wp:seed` - install and populate WordPress with demo content(see `tests/dummy.xml`)
- `yarn --frozen-lockfile` - Download and Install [Webpack](https://webpack.js.org/), [Cypress](https://www.cypress.io/) and other dependencies  
- `yarn watch` - Compile assets in background using Webpack (see `webpack.config.js`)
- `docker-sync-stack start` - sync working files and start Docker containers

After all steps, open the plugin folder in your favorite IDE (I like [PHPStorm](https://www.jetbrains.com/phpstorm/)) and start implementing any changes you want. 

### Tests

Before propose your code to the review, run the following checks:
- `composer lint:php` - linting PHP code over WordPress Core standard with a little indulgence (see `phpcs.xml`)
- `yarn lint:scripts` - linting JS code (see `.eslintrc.js`)
- `yarn lint:styles` - linting SCSS code (see `.stylelintrc.js`)
- `yarn cypress:open` - run End2End tests using Cypress

_**Note:** If you implemented new feature, write a Cypress test that cover it, please_

### Build

If you want create and use your own release:
- `yarn build:production` - Compile assets
- `composer build:production` - Remove dev-dependencies, optimize PSR4 autoloader and create archive

After all, you will find the file `pull-comments-other-pages.zip` in the current folder. Upload this archive in "WordPress => Admin Panel => Plugins => Add New => Upload Plugin"
to install your own build on any number WordPress sites you want.

_**Note:** You do not to do this if you want to send the pull request. The release will be build automatically on GitHub Actions when I will merge your changes with `master` branch_

### Details

1. Plugin's behaviour cover only End2End tests
2. Database container `dbtests` used for testing purposes only
3. Before Cypress run I generate new `wp-config.php` that connect WordPress to `dbtests`

## Roadmap

I have plan to implement following features in the next release: 
- Create shortcode `[pull-comments-other-pages post_ids="1,2,3..."]`
    * Shortcode must display comments of posts [1,2,3] in any place where it will be placed
- Create widget
    * The same as shortcode, but implemented in widget for better UI
- Create Gutenberg block
    * The same as shortcode, but implemented as block for better UI
- Optimize GitHub Actions Workflow:
    * Publish release to WordPress Plugin Directory automatically
    
I can't declare any deadline of the next release. Do them when I will be free. If you're want to contribute you may start from here. 

## Credits

[Виктор](https://t.me/leviktor) from Telegram chat [Митапы WordPress в Москве](https://t.me/wpmeetup) for the [idea](https://t.me/wpmeetup/12079) of this plugin

[Kevin Brown](https://kevin-brown.com/) for [select2](https://github.com/select2/select2) library that I use for displaying dropdown in plugin's metabox

[Matt Mullenweg](https://ma.tt/about/) and WordPress Core's Contributors for [WordPress](https://wordpress.org/) that my plugin extend 


## Copyright

[Maxim Kudryavtsev](https://k-maxim.ru/). 2022. All rights reserved.

The code in this repository distribute under General Public License version 2 or any later.


[profile]: https://www.upwork.com/freelancers/~01d38e15c52f399ca5
[wpcs-core]: https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/


 
