<?php


namespace KUMaxim\PullCommentsOtherPages;


class LanguageLoader {
	public function load_text_domain() {
		load_plugin_textdomain( 'pull-comments-other-pages', false, OptionsHolder::get_instance()->get( 'lang_directory_path' ) );
	}
}
