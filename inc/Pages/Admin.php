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

        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
    }

    public function setPages() {

        $this->pages = array(
            array(
                'page_title' => 'Project Plugin', 
                'menu_title' => 'Project',
                'capability' => 'manage_options', 
                'menu_slug' => 'project_plugin',
                'callback' => array($this->callbacks, 'adminDashboard'), 
                'icon_url' => 'dashicons-shortcode',
                'position' => 110
            )
        );
    }

    public function setSubpages() {

        $this->subpages = array(
			array(
				'parent_slug' => 'project_plugin', 
				'page_title' => 'Custom Post Types', 
				'menu_title' => 'CPT', 
				'capability' => 'manage_options', 
				'menu_slug' => 'project_cpt', 
				'callback' => array( $this->callbacks, 'adminCpt' )
			),
			array(
				'parent_slug' => 'project_plugin', 
				'page_title' => 'Custom Taxonomies', 
				'menu_title' => 'Taxonomies', 
				'capability' => 'manage_options', 
				'menu_slug' => 'project_taxonomies', 
				'callback' => array( $this->callbacks, 'adminTaxonomy' )
			),
			array(
				'parent_slug' => 'project_plugin', 
				'page_title' => 'Custom Widgets', 
				'menu_title' => 'Widgets', 
				'capability' => 'manage_options', 
				'menu_slug' => 'project_widgets', 
				'callback' => array( $this->callbacks, 'adminWidget' )
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
			)
		);

		$this->settings->setFields( $args );
	}
}