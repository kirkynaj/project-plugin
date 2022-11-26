<?php 
/**
 * @package ProjectPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController {

	public function adminWriteAI() {
		return require_once( "$this->plugin_path/templates/WriteAI.php" );
	}

	public function adminAddnew() {
		return require_once( "$this->plugin_path/templates/AddNew.php" );
	}

	public function adminTaxonomy() {
		return require_once( "$this->plugin_path/templates/Taxonomy.php" );
	}

	public function adminSettings() {
		return require_once( "$this->plugin_path/templates/AllSettings.php" );
	}

	public function projectOptionsGroup( $input ) {
		return $input;
	}

	public function projectAdminSection() {
		echo 'Check this section!';
	}

	public function projectTextExample() {
		$value = esc_attr( get_option( 'text_example' ) );
		echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Write Something Here!">';
	}

	public function projectFirstName() {
		$value = esc_attr( get_option( 'first_name' ) );
		echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '" placeholder="Write your First Name">';
	}

	public function projectCheckbox() {
		$value = esc_attr( get_option('checkbox') );
		echo '<input type="checkbox" class=""regular-text" name="checkbox" value="' . $value . '">I Agree to the Terms & Conditions
		<br/>
		<input type="checkbox" class=""regular-text" name="checkbox">Receive our latest news and updates via Email';
	}

	public function projectDropdown() {
		$value = esc_attr( get_option('dropdown') );
		echo '
		<form>
			<select name="dropdown">
				<option value = "option 0"></option>
				<option value = "option 1">Option1</option>
				<option value = "option 2">Option2</option>
				<option value = "option 3">Option3</option>
				<option value = "option 4">Option4</option>
				<option value = "option 5">Option5</option>
			</select>
		</form>';
	}
}