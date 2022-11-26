<?php
/**
 * @package ProjectPlugin
 */
namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController {
    public $settings;
    public $callbacks;
    public $pages = array();
    public $subpages = array();

    public function register() {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();
        $this->setPages();
        $this->setSubpages();
        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addPages($this->pages)->withSubPage('All Posts')->addSubPages($this->subpages)->register();
    }

    public function setPages() {

        $this->pages = array(
            array(
                'page_title' => 'Write AI Plugins', 
                'menu_title' => 'Write AI',
                'capability' => 'manage_options', 
                'menu_slug' => 'write_ai',
                'callback' => array($this->callbacks, 'adminWriteAI'), 
                'icon_url' => 'dashicons-welcome-write-blog',
                'position' => 9
			)	
        );
    }

    public function setSubpages() {

        $this->subpages = array(
			array(
				'parent_slug' => 'write_ai', 
				'page_title' => 'Add Write AI', 
				'menu_title' => 'Add New', 
				'capability' => 'manage_options', 
				'menu_slug' => 'add_new', 
				'callback' => array( $this->callbacks, 'adminAddnew' )
			),
			array(
				'parent_slug' => 'write_ai', 
				'page_title' => 'Custom Taxonomies', 
				'menu_title' => 'Taxonomies', 
				'capability' => 'manage_options', 
				'menu_slug' => 'project_taxonomies', 
				'callback' => array( $this->callbacks, 'adminTaxonomy' )
			),
			array(
				'parent_slug' => 'write_ai', 
				'page_title' => 'All Settings', 
				'menu_title' => 'Settings', 
				'capability' => 'manage_options', 
				'menu_slug' => 'all_settings', 
				'callback' => array( $this->callbacks, 'adminSettings' )
			)
		);
    }

    public function setSettings() {

        $args = array(
			array(
				'option_group' => 'project_options_group',
				'option_name' => 'text_example',
				'callback' => array($this->callbacks, 'projectOptionsGroup')
			),
			array(
				'option_group' => 'project_options_group',
				'option_name' => 'first_name'
			)
		);

		$this->settings->setSettings( $args );
    }

    public function setSections() {

        $args = array(
			array(
				'id' => 'project_admin_index',
				'title' => 'Settings',
				'callback' => array( $this->callbacks, 'projectAdminSection' ),
				'page' => 'project_plugin'
			)
		);

		$this->settings->setSections( $args );
    }

    public function setFields() {

        $args = array(
			array(
				'id' => 'text_example',
				'title' => 'Text Example',
				'callback' => array( $this->callbacks, 'projectTextExample' ),
				'page' => 'project_plugin',
				'section' => 'project_admin_index',
				'args' => array(
					'label_for' => 'text_example',
					'class' => 'example-class'
				)
			),
			array(
				'id' => 'first_name',
				'title' => 'First Name',
				'callback' => array( $this->callbacks, 'projectFirstName' ),
				'page' => 'project_plugin',
				'section' => 'project_admin_index',
				'args' => array(
					'label_for' => 'first_name',
					'class' => 'example-class'
				)
			),
			array(
				'id' => 'checkbox',
				'title' => 'Checkbox',
				'callback' => array( $this->callbacks, 'projectCheckbox' ),
				'page' => 'project_plugin',
				'section' => 'project_admin_index',
				'args' => array(
					'label_for' => 'checkbox',
					'class' => 'example-class'
				)
			),
			array(
				'id' => 'dropdown',
				'title' => 'Dropdown Option',
				'callback' => array( $this->callbacks, 'projectDropdown' ),
				'page' => 'project_plugin',
				'section' => 'project_admin_index',
				'args' => array(
					'label_for' => 'dropdown',
					'class' => 'example-class'
				)
			)

		);

		$this->settings->setFields( $args );
	}
}