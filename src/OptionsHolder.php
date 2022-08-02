<?php


namespace KUMaxim\PullCommentsOtherPages;


class OptionsHolder {
	private static $instance = null;

	private $plugin_file;

	private $options;

	private function __construct( $plugin_file ) {
		$this->options = array(
			'assets_uri'          => plugin_dir_url( $plugin_file ) . 'assets/',
			'lang_directory_path' => dirname( plugin_basename( __FILE__ ) ) . '/assets/languages',
			'post_meta_key'       => 'pcop1_objects_id',
		);
	}

	public static function init( $plugin_file ) {
		if ( null === self::$instance ) {
			self::$instance = new self( $plugin_file );
		}
	}

	/**
	 * Get singleton instance
	 *
	 * @return self
	 * @throws \Exception
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			throw new \Exception( self::class . ' was not initialized. Call init() method first' );
		}

		return self::$instance;
	}

	/**
	 * Get pre-defined option's value
	 *
	 * @param $option   string Option name
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function get( $option ) {
		if ( ! empty( $option ) && is_scalar( $option ) && array_key_exists( $option, $this->options ) ) {
			return $this->options[ $option ];
		}

		throw new \Exception(
			sprintf(
				'Option "%s" does not exist. Available values are "%s"',
				$option,
				implode(
					', ',
					array_keys( $this->options )
				)
			)
		);
	}
}
