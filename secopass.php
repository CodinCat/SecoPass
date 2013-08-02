<?php
/*
Plugin Name: SecoPass
Description: Setting up a secondary password to protect your WordPress from Brute-force attack and keylogger
Version: 1.0.0
Author: Mr.OPR
Author URI: https://github.com/MrOPR/
Plugin URI: https://github.com/MrOPR/SecoPass
*/

define('SECOPASS_VERSION', '1.0.0');
if ( ! defined( 'ABSPATH' ) ) { die(); }

if ( ! class_exists('SecoPass') ) 
{
	class SecoPass {

		private function verificationFailed($msg = 'default') {
			if ($msg == 'config')
				wp_die('Login failed: SecoPass can\'t find your secondary password, please edit config.php and upload it.');
			
			if ($msg == 'default')
				wp_die('Login failed: Incorrect SecoPass.');
		}

		public static function verifySecoPass() {
			if ( ! isset($_POST['seco_pass']) )
				self::verificationFailed();
			
			$secopass = $_POST['seco_pass'];

			define('SECOPASS', true);
			@require 'config.php';

			if ( ! isset($secopass_password) )
				self::verificationFailed('config');

			if ($secopass !== $secopass_password)
				self::verificationFailed();
		}

		public static function loginFormTemplate() {
			$fontSize = rand(12, 16);
			$padding = rand(0, 6);
			$margin = rand(0, 20);

			echo '<p>'.
					'<label for="seco_pass">'.
						'SecoPass<br>'.
						'<input type="password" name="seco_pass" id="seco_pass" class="input" size="20">'.
					'</label>'.
					'<span style="color: #777;font-size: 14px;">'.
						'You can select the character below, then drag & drop (or copy & paste) to Password or SecoPass fields to prevent keylogger.'.
					'</span>'.
					'<div class="charsboard" style="color: #0D6EA5;font-family: source code pro, monaco, consolas, monospace;'.
												'font-size:' . $fontSize .'px;'.
												'margin-top:' . $margin .'px;'.
												'padding:' . $padding .'px;'. '">'.
						'abcdefghijklmnopqrstuvwxyz<br>'.
						'ABCDEFGHIJKLMNOPQRSTUVWXYZ<br>'.
						'0123456789<br>'.
						'!@#$%^&*()_+{}[]-.?'.
					'</div>'.
				 '</p>';
		}
	}
	add_action('login_form', array('SecoPass', 'loginFormTemplate'));
	add_action('wp_login', array('SecoPass', 'verifySecoPass'));
}