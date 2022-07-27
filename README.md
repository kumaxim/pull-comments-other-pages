[![WP: Pull Comnents Other Pages](https://img.shields.io/endpoint?url=https://dashboard.cypress.io/badge/simple/wiybc5/master&style=flat&logo=cypress)](https://dashboard.cypress.io/projects/wiybc5/runs)
[![Build Plugin Release](https://github.com/kumaxim/pull-comnents-other-pages/actions/workflows/build-plugin-release.yml/badge.svg)](https://github.com/kumaxim/pull-comnents-other-pages/actions/workflows/build-plugin-release.yml)

# Pull Comments From Other Page(s)

Pull Comments From Other Page(s) is WordPress plugin that allow you to display comments of one page(s) to another. Comments of both page(s) will be merged and appeared in chronological order.


## Requirements
- PHP 7.3 - 8.1
- WordPress 5.9 and above

_Note_: Pluign may work on WordPress below 5.9, but not have been tested.

## Installation

1. [Download](https://github.com/kumaxim/pull-comnents-other-pages/releases) latest release
2. Upload plugin in "WordPress => Admin panel => Plugins => Add plugin => Upload"
3. Click "Activate" link on successfull screen

_Note_: Pluing was not published in WordPress Plugin Directory yet. Only manuall installation is available.

## Usages:

1. Open for editing any post/page/cpt in admin panel
2. Choice any post/page/cpt that comments should be merged with comments of current page
3. Press 'Upadate' and check the result of front-end

_Warning_: Plugin was NOT copy comments between. If you users posts comments on both source and current pages, their will be shown in destination page in chronological order.
