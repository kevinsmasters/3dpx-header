<?php

class TPDX_Header {

    public function __construct() {
    	// Hook into the admin menu
    	add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );

        // Add Settings and Fields
    	add_action( 'admin_init', array( $this, 'setup_sections' ) );
    	add_action( 'admin_init', array( $this, 'setup_fields' ) );

        //add_filter('the_content', array( $this, 'tdpx_timeline_banner')); 
        add_action( 'init', array($this, 'tdpx_timeline_banner') );
    }

    public function do_nothing_really() {
        return NULL;
    }

    public function create_plugin_settings_page() {
    	// Add the menu item and page
    	$page_title = '3DPX Timeline';
    	$menu_title = '3DPX Timeline Editor';
    	$capability = 'manage_options';
    	$slug = 'tdpx_fields';
    	$callback = array( $this, 'plugin_settings_page_content' );
    	$icon = 'dashicons-admin-plugins';
    	$position = 100;

    	add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
    }

    public function plugin_settings_page_content() { ?>
    	<div class="wrap">
    		<h2>3DPX Timeline Header Settings</h2><?php
            if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ){
                  $this->admin_notice();
            } ?>
    		<form method="POST" action="options.php">
                <?php
                    settings_fields( 'tdpx_fields' );
                    do_settings_sections( 'tdpx_fields' );
                    submit_button();
                ?>
    		</form>
    	</div> 
        <?php
    }

    public function admin_notice() { ?>
        <div class="notice notice-success is-dismissible">
            <p>Your settings have been updated!</p>
        </div><?php
    }

    public function setup_sections() {
        add_settings_section( 'main_section', 'My First Section Title', array( $this, 'section_callback' ), 'tdpx_fields' );
        //add_settings_section( 'our_second_section', 'My Second Section Title', array( $this, 'section_callback' ), 'tdpx_fields' );
        //add_settings_section( 'our_third_section', 'My Third Section Title', array( $this, 'section_callback' ), 'tdpx_fields' );
    }

    public function section_callback( $arguments ) {
    	switch( $arguments['id'] ){
    		case 'main_section':
    			echo 'Enter Timeline Values';
    			break;
    		// case 'our_second_section':
    		// 	echo 'This one is number two';
    		// 	break;
    		// case 'our_third_section':
    		// 	echo 'Third time is the charm!';
    		// 	break;
    	}
    }

    public function setup_fields() {
        $fields = array(
            array(
                'uid' => 'headline_one_field',
                'label' => 'Header 1',
                'section' => 'main_section',
                'type' => 'text',
                'placeholder' => 'Headline',
                'default' => 'Headline 1'
            ),
        	array(
        		'uid' => 'text_one_field',
        		'label' => 'Text 1',
                'section' => 'main_section',
        		'type' => 'textarea',
                'default' => 'Text...'
        	),
            array(
                'uid' => 'headline_two_field',
                'label' => 'Header 2',
                'section' => 'main_section',
                'type' => 'text',
                'placeholder' => 'Headline',
            ),
        	array(
        		'uid' => 'text_two_field',
        		'label' => 'Text 2',
                'section' => 'main_section',
        		'type' => 'textarea',
        	),
            array(
                'uid' => 'headline_three_field',
                'label' => 'Header 3',
                'section' => 'main_section',
                'type' => 'text',
                'placeholder' => 'Headline',
            ),
        	array(
        		'uid' => 'text_three_field',
        		'label' => 'Text 3',
                'section' => 'main_section',
        		'type' => 'textarea',
        	),
            array(
                'uid' => 'headline_four_field',
                'label' => 'Header 4',
                'section' => 'main_section',
                'type' => 'text',
                'placeholder' => 'Headline',
            ),
        	array(
        		'uid' => 'text_four_field',
        		'label' => 'Text 4',
                'section' => 'main_section',
        		'type' => 'textarea',
        	),
            array(
                'uid' => 'headline_five_field',
                'label' => 'Header 5',
                'section' => 'main_section',
                'type' => 'text',
                'placeholder' => 'Headline',
            ),
        	array(
        		'uid' => 'text_five_field',
        		'label' => 'Text 5',
                'section' => 'main_section',
        		'type' => 'textarea',
        	),
            array(
                'uid' => 'headline_six_field',
                'label' => 'Header 6',
                'section' => 'main_section',
                'type' => 'text',
                'placeholder' => 'Headline',
            ),
        	array(
        		'uid' => 'text_six_field',
        		'label' => 'Text 6',
                'section' => 'main_section',
        		'type' => 'textarea',
        	),
            array(
                'uid' => 'headline_seven_field',
                'label' => 'Header 7',
                'section' => 'main_section',
                'type' => 'text',
                'placeholder' => 'Headline',
            ),
        	array(
        		'uid' => 'text_seven_field',
        		'label' => 'Text 7',
                'section' => 'main_section',
        		'type' => 'textarea',
        	),
            array(
                'uid' => 'headline_eight_field',
                'label' => 'Header 8',
                'section' => 'main_section',
                'type' => 'text',
                'placeholder' => 'Headline',
            ),
        	array(
        		'uid' => 'text_eight_field',
        		'label' => 'Text 8',
                'section' => 'main_section',
        		'type' => 'textarea',
        	),
        );
    	foreach( $fields as $field ){

        	add_settings_field( $field['uid'], $field['label'], array( $this, 'field_callback' ), 'tdpx_fields', $field['section'], $field );
            register_setting( 'tdpx_fields', $field['uid'] );
    	}
    }

    public function field_callback( $arguments ) {

        $value = get_option( $arguments['uid'] );

        if( ! $value ) {
            $value = $arguments['default'];
        }

        switch( $arguments['type'] ){
            case 'text':
            case 'password':
            case 'number':
                printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
                break;
            case 'textarea':
                printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value );
                break;
            case 'select':
            case 'multiselect':
                if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
                    $attributes = '';
                    $options_markup = '';
                    foreach( $arguments['options'] as $key => $label ){
                        $options_markup .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $value[ array_search( $key, $value, true ) ], $key, false ), $label );
                    }
                    if( $arguments['type'] === 'multiselect' ){
                        $attributes = ' multiple="multiple" ';
                    }
                    printf( '<select name="%1$s[]" id="%1$s" %2$s>%3$s</select>', $arguments['uid'], $attributes, $options_markup );
                }
                break;
            case 'radio':
            case 'checkbox':
                if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
                    $options_markup = '';
                    $iterator = 0;
                    foreach( $arguments['options'] as $key => $label ){
                        $iterator++;
                        $options_markup .= sprintf( '<label for="%1$s_%6$s"><input id="%1$s_%6$s" name="%1$s[]" type="%2$s" value="%3$s" %4$s /> %5$s</label><br/>', $arguments['uid'], $arguments['type'], $key, checked( $value[ array_search( $key, $value, true ) ], $key, false ), $label, $iterator );
                    }
                    printf( '<fieldset>%s</fieldset>', $options_markup );
                }
                break;
        }

        if( $helper = $arguments['helper'] ){
            printf( '<span class="helper"> %s</span>', $helper );
        }

        if( $supplimental = $arguments['supplimental'] ){
            printf( '<p class="description">%s</p>', $supplimental );
        }

    }

    public function getdata_func() {
              
        return $output; 
    }

    public function tdpx_timeline_banner($content) {
        
        //$myoptions = get_option('headline_one_field');
        //$content .= $timeline;
        // printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );

        //$content .= var_export( $myoptions ) . ' <<< is?';
        //return $content;

        add_shortcode( 'sample-shortcode','shortcode_function'  );
        function shortcode_function($timeline) {
            $timeline = <<<EOD
            <div id="heroWrapper">
            <div class="slide shown" data-slide="0">
                <h1>Navigating drug development</h1>
                <p>We provide all core expertise needed to take a drug<br> development program from A to B or from A to Z, if required.</p>
            </div>
            <div class="slide" data-slide="1">
                <h1>Pre-clinical title</h1>
                <p>Subtitle.</p>
            </div>
            <div class="slide" data-slide="2">
                <h1>IND title</h1>
                <p>Subtitle.</p>
            </div>
            <div class="slide" data-slide="3">
                <h1>Phase 1 title</h1>
                <p>Subtitle.</p>
            </div>
            <div class="slide" data-slide="4">
                <h1>Phase 2 title</h1>
                <p>Subtitle.</p>
            </div>
            <div class="slide" data-slide="5">
                <h1>Phase 3 title</h1>
                <p>Subtitle.</p>
            </div>
            <div class="slide" data-slide="6">
                <h1>MAA/NDA title</h1>
                <p>Subtitle.</p>
            </div>
            <div class="slide" data-slide="7">
                <h1>Post Marketing title</h1>
                <p>Subtitle.</p>
            </div>
            <div id="timeLine">
                <ul>
                <li class="active">
                    <span>&nbsp;</span>
                    <span class="dot"></span>
                    <span>&nbsp;</span>
                </li>
                <li>
                    <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="body_1" width="72" height="54">

                        <g transform="matrix(0.702302 0 0 0.702302 6.141633 -0)">
                        <path d="M15.73 42.05L18.189999 42.05L18.189999 44.5L15.73 44.5z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                        <path d="M8.95 40.6C 5.8099995 42.69 4.97 46.92 7.06 50.039997C 8.33 51.929996 10.46 53.069996 12.74 53.069996L12.74 53.069996L64.25 53.069996C 66.13 53.069996 68 52.699997 69.75 51.999996C 67.86 55.659996 64.07 57.969997 59.94 57.969997L59.94 57.969997L23.1 57.969997C 20.39 57.969997 18.19 60.159996 18.19 62.87C 18.19 65.58 20.390001 67.77 23.1 67.77L23.1 67.77L63.62 67.77L63.62 65.32L23.1 65.32C 21.74 65.32 20.64 64.22 20.64 62.87C 20.64 61.519997 21.74 60.42 23.099998 60.42L23.099998 60.42L59.94 60.42C 66.15 60.41 71.54 56.19 73.04 50.18C 79.65 45.38 81.11 36.15 76.3 29.56C 76.200005 29.42 76.090004 29.279999 75.98 29.14C 70.87 22.58 63.15 18.56 54.83 18.13C 47.56 17.759998 40.370003 19.73 34.300003 23.75L34.300003 23.75L29.360003 27.03C 25.120003 24.92 19.970001 26.650002 17.860003 30.880001C 17.270002 32.07 16.960003 33.38 16.960003 34.71C 16.960003 34.899998 16.970003 35.09 16.990004 35.26L16.990004 35.26L8.950004 40.6L8.95 40.6zM35.66 25.779999C 41.28 22.06 47.95 20.23 54.690002 20.57C 62.300003 20.97 69.36 24.64 74.04 30.64C 77.79 35.36 77.54 42.1 73.44 46.51L73.44 46.51L73.44 39.589996L70.98 39.589996L70.98 46.939995C 70.98 47.529995 70.93 48.109993 70.83 48.689995C 68.86 49.929996 66.58 50.599995 64.25 50.609993L64.25 50.609993L12.73 50.609993C 10.32 50.609993 8.36 48.659992 8.36 46.249992C 8.36 44.789993 9.09 43.429993 10.309999 42.61999L10.309999 42.61999L17.55 37.79999C 17.609999 37.96999 17.679998 38.11999 17.75 38.269993C 17.79 38.36999 17.84 38.45999 17.88 38.54999C 17.949999 38.68999 18.029999 38.819992 18.109999 38.95999C 18.169998 39.05999 18.23 39.16999 18.289999 39.25999C 18.349998 39.35999 18.439999 39.48999 18.529999 39.60999C 18.609999 39.72999 18.689999 39.83999 18.779999 39.94999C 18.859999 40.05999 18.939999 40.14999 19.029999 40.23999C 19.07 40.28999 19.109999 40.34999 19.15 40.38999C 19.26 40.50999 19.359999 40.629993 19.47 40.73999L19.47 40.73999L21.21 39.00999C 21.019999 38.80999 20.839998 38.59999 20.689999 38.36999C 20.589998 38.229992 20.47 38.09999 20.39 37.95999C 20.279999 37.77999 20.18 37.59999 20.09 37.409992C 20.01 37.249992 19.92 37.09999 19.86 36.929993C 19.78 36.719994 19.720001 36.509995 19.67 36.29999C 19.63 36.14999 19.57 35.999992 19.54 35.82999C 19.470001 35.44999 19.43 35.069992 19.43 34.68999C 19.43 31.299992 22.18 28.55999 25.57 28.55999C 28.96 28.55999 31.71 31.29999 31.71 34.67999C 31.71 35.029987 31.669998 35.389988 31.609999 35.72999C 31.589998 35.829987 31.569998 35.919987 31.55 36.01999C 31.48 36.34999 31.38 36.65999 31.259998 36.96999L31.259998 36.96999L31.219997 37.06999C 30.909998 37.799988 30.469997 38.44999 29.909998 39.009987L29.909998 39.009987L31.649998 40.739986C 32.179996 40.209988 32.64 39.609985 33.01 38.969986C 33.019997 38.949986 33.03 38.919987 33.05 38.889984C 33.39 38.289986 33.66 37.639984 33.84 36.969986C 33.86 36.899986 33.87 36.839985 33.89 36.769985C 33.96 36.499985 34.01 36.229984 34.05 35.949986C 34.059998 35.869984 34.079998 35.789986 34.09 35.699986C 34.13 35.359985 34.16 35.019985 34.16 34.669987C 34.16 32.33999 33.21 30.109987 31.52 28.509987L31.52 28.509987L35.66 25.759987z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                        <path d="M25.55 31.03C 23.519999 31.03 21.859999 32.670002 21.859999 34.7C 21.859999 35.68 22.249998 36.61 22.939999 37.3L22.939999 37.3L24.679998 35.57C 24.199999 35.09 24.199999 34.32 24.679998 33.84C 25.159998 33.36 25.939999 33.36 26.419998 33.84C 26.899998 34.32 26.899998 35.09 26.419998 35.57L26.419998 35.57L28.159998 37.3C 29.599998 35.86 29.599998 33.54 28.159998 32.1C 27.469997 31.409998 26.529999 31.019999 25.549997 31.019999" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                        <path d="M66.07 65.32L68.53 65.32L68.53 67.77L66.07 67.77z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                        </g>
                    </svg>
                    </span>
                    <span class="dot"></span>
                    <span>Pre-clinical</span>
                </li>
                <li>
                    <span>IND</span>
                    <span class="dot"></span>
                    <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="body_1" width="61" height="46">

                        <g transform="matrix(0.59825724 0 0 0.59825724 5.065095 -0)">
                        <path d="M49.2 27.88C 48.52 27.88 47.96 28.429998 47.96 29.119999C 47.96 29.81 48.51 30.359999 49.2 30.359999C 49.890003 30.359999 50.440002 29.81 50.440002 29.119999C 50.440002 28.429998 49.890003 27.88 49.2 27.88z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                        <path d="M72.73 59.26L56.22 42.75C 58.91 38.7 60.33 34.010002 60.33 29.11C 60.33 15.47 49.230003 4.370001 35.590004 4.370001C 21.950005 4.370001 10.85 15.47 10.85 29.11C 10.85 42.75 21.95 53.85 35.59 53.85C 40.48 53.85 45.17 52.43 49.23 49.739998L49.23 49.739998L53.79 54.3L65.73 66.25C 66.66 67.18 67.91 67.7 69.23 67.7C 70.55 67.7 71.79 67.189995 72.73 66.25C 73.66 65.32 74.18 64.07 74.18 62.75C 74.18 61.43 73.67 60.19 72.73 59.25L72.73 59.25L72.73 59.26zM48.640003 47.14C 44.820004 49.91 40.310005 51.379997 35.590004 51.379997C 23.310005 51.379997 13.330004 41.39 13.330004 29.119997C 13.330004 16.849995 23.31 6.85 35.59 6.85C 47.870003 6.85 57.85 16.84 57.85 29.11C 57.85 33.83 56.379997 38.35 53.61 42.16C 52.22 44.07 50.55 45.739998 48.64 47.13zM51.24 48.26C 52.52 47.21 53.690002 46.039997 54.74 44.76L54.74 44.76L58.25 48.269997C 57.18 49.529995 56.01 50.699997 54.75 51.769997L54.75 51.769997L51.24 48.26zM70.98 64.509995C 70.51 64.979996 69.89001 65.229996 69.23 65.229996C 68.57 65.229996 67.950005 64.96999 67.48 64.509995L67.48 64.509995L56.500004 53.529995C 57.750004 52.449993 58.920006 51.279995 60.000004 50.029995L60.000004 50.029995L70.98 61.009995C 71.450005 61.479996 71.700005 62.099995 71.700005 62.759995C 71.700005 63.419994 71.44 64.03999 70.98 64.509995z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                        <path d="M35.59 9.32C 24.68 9.32 15.799999 18.2 15.799999 29.11C 15.799999 40.02 24.68 48.9 35.59 48.9C 46.5 48.9 55.38 40.02 55.38 29.11C 55.38 18.2 46.5 9.32 35.59 9.32zM35.59 46.43C 26.04 46.43 18.27 38.66 18.27 29.11C 18.27 19.560001 26.04 11.790001 35.59 11.790001C 45.14 11.790001 52.91 19.560001 52.91 29.11C 52.91 38.66 45.14 46.43 35.59 46.43z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                        <path d="M49.45 23.8C 48.38 21.029999 46.53 18.66 44.09 16.949999C 41.59 15.199999 38.65 14.269999 35.59 14.269999C 34.91 14.269999 34.35 14.819999 34.35 15.509998C 34.35 16.199997 34.899998 16.749998 35.59 16.749998C 40.67 16.749998 45.32 19.939999 47.14 24.699997C 47.329998 25.189997 47.8 25.489998 48.29 25.489998C 48.440002 25.489998 48.59 25.459997 48.73 25.409998C 49.37 25.159998 49.69 24.449999 49.44 23.809998L49.44 23.809998L49.45 23.8z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                        </g>
                    </svg>
                    </span>
                </li>
                <li>
                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="body_1" width="82" height="61">

                        <g transform="matrix(0.79334116 0 0 0.79334116 7.2711024 -0)">
                        <path d="M44.88 39.39L44.88 57.59L40.670002 57.59L40.670002 42.77L37.030003 42.77L37.030003 39.39L44.88 39.39z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                        <path d="M62.02 48.2C 62.020004 53.584778 60.116196 58.180973 56.308582 61.988583C 52.500973 65.79619 47.904778 67.7 42.52 67.7C 37.135223 67.7 32.539032 65.79619 28.731419 61.988583C 24.923807 58.180973 23.02 53.584778 23.02 48.2C 23.02 42.815224 24.923807 38.219032 28.731419 34.41142C 32.539032 30.60381 37.135223 28.700003 42.52 28.7C 47.904778 28.700003 52.500973 30.60381 56.308582 34.41142C 60.116196 38.219032 62.020004 42.815224 62.02 48.2C 62.020004 48.426918 62.016045 48.653767 62.00812 48.880543" stroke="#FFFFFF" stroke-width="2" fill="none" />
                        </g>
                    </svg>

                    </span>
                    <span class="dot"></span>
                    <span>Phase 1</span>
                </li>
                <li>
                    <span>Phase 2a/b</span>
                    <span class="dot"></span>
                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="body_1" width="82" height="61">

                        <g transform="matrix(0.79334116 0 0 0.79334116 7.2711024 -0)">
                        <path d="M49.81 54.24L49.81 57.670002L36.06 57.670002L36.06 54.940002L43.08 48.31C 44.690002 46.780003 44.980003 45.84 44.980003 44.960003C 44.980003 43.530003 43.99 42.700005 42.070004 42.700005C 40.510002 42.700005 39.180004 43.300003 38.300003 44.520004L38.300003 44.520004L35.230003 42.540005C 36.630005 40.490005 39.180004 39.160004 42.460003 39.160004C 46.520004 39.160004 49.22 41.240005 49.22 44.540005C 49.22 46.310005 48.73 47.920006 46.18 50.290005L46.18 50.290005L41.99 54.240005L49.82 54.240005L49.81 54.24z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                        <path d="M62.02 48.2C 62.020004 53.584778 60.116196 58.180973 56.308582 61.988583C 52.500973 65.79619 47.904778 67.7 42.52 67.7C 37.135223 67.7 32.539032 65.79619 28.731419 61.988583C 24.923807 58.180973 23.02 53.584778 23.02 48.2C 23.02 42.815224 24.923807 38.219032 28.731419 34.41142C 32.539032 30.60381 37.135223 28.700003 42.52 28.7C 47.904778 28.700003 52.500973 30.60381 56.308582 34.41142C 60.116196 38.219032 62.020004 42.815224 62.02 48.2C 62.020004 48.426918 62.016045 48.653767 62.00812 48.880543" stroke="#FFFFFF" stroke-width="2" fill="none" />
                        </g>
                    </svg></span>
                </li>
                <li>
                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="body_1" width="82" height="61">

                        <g transform="matrix(0.79334116 0 0 0.79334116 7.2711024 -0)">
                        <path d="M49.76 51.92C 49.76 54.989998 47.39 57.8 42.219997 57.8C 39.67 57.8 37.049995 57.1 35.28 55.85L35.28 55.85L36.92 52.629997C 38.3 53.67 40.219997 54.269997 42.12 54.269997C 44.23 54.269997 45.53 53.409996 45.53 51.929996C 45.53 50.549995 44.52 49.689995 42.12 49.689995L42.12 49.689995L40.2 49.689995L40.2 46.909996L43.940002 42.67L36.190002 42.67L36.190002 39.289997L48.93 39.289997L48.93 42.019997L44.82 46.699997C 48.1 47.219997 49.76 49.249996 49.76 51.929996L49.76 51.929996L49.76 51.92z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                        <path d="M62.02 48.17C 62.020004 53.554775 60.116196 58.15097 56.308582 61.95858C 52.500973 65.7662 47.904778 67.67 42.52 67.67C 37.135223 67.67 32.539032 65.7662 28.731419 61.95858C 24.923807 58.15097 23.02 53.554775 23.02 48.17C 23.02 42.785225 24.923807 38.18903 28.731419 34.381416C 32.539032 30.573805 37.135223 28.669998 42.52 28.669998C 47.904778 28.669998 52.500973 30.573805 56.308582 34.381416C 60.116196 38.18903 62.020004 42.785225 62.02 48.17C 62.020004 48.396915 62.016045 48.623764 62.00812 48.85054" stroke="#FFFFFF" stroke-width="2" fill="none" />
                        </g>
                    </svg></span>
                    <span class="dot"></span>
                    <span>Phase 3</span>
                </li>
                <li>
                    <span>MAA/NDA</span>
                    <span class="dot"></span>
                    <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="body_1" width="72" height="54">

            <g transform="matrix(0.702302 0 0 0.702302 6.141633 -0)">
                <g>
                    <path d="M30.44 33.38C 29.33 33.38 28.42 32.49 28.41 31.37C 28.41 30.26 29.3 29.35 30.42 29.34L30.42 29.34L30.44 29.34C 31.550001 29.34 32.46 30.24 32.46 31.36C 32.46 32.480003 31.56 33.38 30.439999 33.38L30.439999 33.38L30.44 33.38zM34.440002 31.36C 34.440002 32.47 35.340004 33.38 36.460003 33.38L36.460003 33.38L54.630005 33.38C 55.740005 33.38 56.650005 32.48 56.650005 31.36C 56.650005 30.240002 55.750004 29.34 54.630005 29.34L54.630005 29.34L36.460007 29.34C 35.350006 29.34 34.440006 30.24 34.440006 31.36zM51.270004 41.96L38.990005 52.86L33.800007 48.04C 32.970005 47.3 31.690006 47.370003 30.950006 48.2C 30.220007 49.010002 30.270006 50.25 31.060007 51L31.060007 51L37.590008 57.06C 38.350006 57.77 39.520008 57.780003 40.300007 57.09L40.300007 57.09L53.960007 44.98C 54.800007 44.239998 54.870007 42.96 54.130005 42.13C 53.390003 41.300003 52.110004 41.22 51.280006 41.960003zM64.72 19.25L64.72 63.67C 64.72 65.9 62.91 67.71 60.68 67.71L60.68 67.71L24.35 67.71C 22.12 67.71 20.310001 65.9 20.310001 63.67L20.310001 63.67L20.310001 19.25C 20.310001 17.02 22.12 15.21 24.350002 15.21L24.350002 15.21L31.420002 15.21C 31.420002 12.98 33.230003 11.17 35.460003 11.17L35.460003 11.17L49.590004 11.17C 51.820004 11.17 53.630005 12.98 53.630005 15.21L53.630005 15.21L60.700005 15.21C 62.930004 15.21 64.740005 17.02 64.740005 19.25zM35.45 19.25L49.58 19.25L49.58 15.21L35.45 15.21L35.45 19.25zM60.690002 19.25L53.620003 19.25C 53.620003 21.48 51.81 23.29 49.58 23.29L49.58 23.29L35.45 23.29C 33.22 23.29 31.41 21.480001 31.41 19.25L31.41 19.25L24.34 19.25L24.34 63.67L60.69 63.67L60.69 19.25z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                </g>
            </g>
            </svg>
                    </span>
                </li>
                <li>
                    <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="body_1" width="72" height="54">

            <g transform="matrix(0.702302 0 0 0.702302 6.141633 -0)">
                <path d="M23.74 54.5C 22.93 54.5 22.15 54.7 21.46 55.08C 17.82 50.410004 15.82 44.61 15.82 38.660004C 15.82 23.940002 27.8 11.960003 42.52 11.960003C 44.31 11.960003 46.1 12.140003 47.84 12.490003C 48.45 12.6100025 49.05 12.220002 49.170002 11.6100025C 49.290005 11.000003 48.9 10.4000025 48.29 10.280003C 46.4 9.9000025 44.46 9.710003 42.52 9.710003C 34.78 9.710003 27.51 12.720003 22.04 18.190002C 16.570002 23.660002 13.560001 30.940002 13.560001 38.670002C 13.560001 45.18 15.770001 51.530003 19.79 56.620003C 19.27 57.390003 18.990002 58.300003 18.990002 59.260002C 18.990002 60.530003 19.480001 61.72 20.380001 62.620003C 21.28 63.520004 22.470001 64.01 23.740002 64.01C 25.010002 64.01 26.2 63.52 27.100002 62.620003C 28.000002 61.72 28.490002 60.530003 28.490002 59.260002C 28.490002 57.99 28.000002 56.800003 27.100002 55.9C 26.200003 55 25.010002 54.510002 23.740002 54.510002L23.740002 54.510002L23.74 54.5zM25.5 61.010002C 25.03 61.480003 24.4 61.74 23.74 61.74C 23.08 61.74 22.45 61.480003 21.98 61.010002C 21.509998 60.54 21.25 59.910004 21.25 59.250004C 21.25 58.590004 21.51 57.960003 21.98 57.490005C 22.449999 57.020004 23.08 56.760006 23.74 56.760006C 24.4 56.760006 25.029999 57.020004 25.5 57.490005C 25.97 57.960007 26.23 58.590004 26.23 59.250004C 26.23 59.910004 25.97 60.540005 25.5 61.010002z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                <path d="M65.25 20.72C 66.48 18.869999 66.28 16.349998 64.66 14.719999C 63.760002 13.82 62.570004 13.329999 61.300003 13.329999C 60.030003 13.329999 58.840004 13.819999 57.940002 14.719999C 57.04 15.619999 56.550003 16.81 56.550003 18.08C 56.550003 19.35 57.040005 20.54 57.940002 21.44C 58.840004 22.34 60.030003 22.83 61.300003 22.83C 62.110004 22.83 62.890003 22.63 63.58 22.25C 67.22 26.92 69.22 32.72 69.22 38.67C 69.22 53.39 57.24 65.369995 42.52 65.369995C 40.75 65.369995 38.98 65.2 37.25 64.85C 36.64 64.729996 36.04 65.119995 35.92 65.74C 35.8 66.35 36.19 66.95 36.809998 67.07C 38.679996 67.44 40.6 67.63 42.519997 67.63C 50.259995 67.63 57.53 64.619995 62.999996 59.149998C 68.46999 53.679996 71.479996 46.399998 71.479996 38.67C 71.479996 32.159996 69.27 25.809998 65.24999 20.719997L65.24999 20.719997L65.25 20.72zM59.54 19.849998C 59.07 19.38 58.81 18.749998 58.81 18.089998C 58.81 17.429998 59.07 16.8 59.54 16.329998C 60.010002 15.859998 60.64 15.599998 61.3 15.599998C 61.96 15.599998 62.59 15.859999 63.059998 16.329998C 64.03 17.299997 64.03 18.879997 63.059998 19.849998C 62.589996 20.319998 61.96 20.579998 61.3 20.579998C 60.64 20.579998 60.01 20.319998 59.54 19.849998z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                <path d="M37.85 58.13C 37.85 58.75 38.359997 59.260002 38.98 59.260002L38.98 59.260002L46.05 59.260002C 46.67 59.260002 47.18 58.750004 47.18 58.13L47.18 58.13L47.18 55.940002C 48.670002 55.54 50.09 54.95 51.43 54.180004L51.43 54.180004L52.98 55.730003C 53.19 55.940002 53.48 56.060005 53.78 56.060005C 54.079998 56.060005 54.37 55.940006 54.579998 55.730003L54.579998 55.730003L59.579998 50.730003C 60.019997 50.290005 60.019997 49.570004 59.579998 49.130005L59.579998 49.130005L58.03 47.580006C 58.8 46.240005 59.39 44.820007 59.789997 43.330006L59.789997 43.330006L61.979996 43.330006C 62.599995 43.330006 63.109997 42.820007 63.109997 42.200005L63.109997 42.200005L63.109997 35.130005C 63.109997 34.510006 62.6 34.000004 61.979996 34.000004L61.979996 34.000004L59.789997 34.000004C 59.389996 32.510002 58.799995 31.090004 58.03 29.750004L58.03 29.750004L59.57 28.210003C 59.78 28.000004 59.9 27.710003 59.9 27.410004C 59.9 27.110004 59.780003 26.820004 59.57 26.610004L59.57 26.610004L54.57 21.610004C 54.13 21.170004 53.41 21.170004 52.97 21.610004L52.97 21.610004L51.43 23.150005C 50.09 22.380005 48.670002 21.790005 47.18 21.390005L47.18 21.390005L47.18 19.220005C 47.18 18.600004 46.670002 18.090006 46.05 18.090006L46.05 18.090006L38.98 18.090006C 38.36 18.090006 37.85 18.600006 37.85 19.220005L37.85 19.220005L37.85 21.390005C 36.359997 21.790005 34.94 22.380005 33.6 23.150005L33.6 23.150005L32.059998 21.610004C 31.619997 21.170004 30.899998 21.170004 30.459997 21.610004L30.459997 21.610004L25.459997 26.610004C 25.249998 26.820004 25.129997 27.110004 25.129997 27.410004C 25.129997 27.710003 25.249998 28.000004 25.459997 28.210003L25.459997 28.210003L26.999996 29.750004C 26.229996 31.090004 25.639996 32.510002 25.239996 34.000004L25.239996 34.000004L23.059996 34.000004C 22.439995 34.000004 21.929996 34.510002 21.929996 35.130005L21.929996 35.130005L21.929996 42.200005C 21.929996 42.500004 22.039997 42.790005 22.259996 43.000004C 22.479996 43.210003 22.759996 43.330006 23.059996 43.330006L23.059996 43.330006L25.249996 43.330006C 25.649996 44.820007 26.239996 46.240005 27.009996 47.580006L27.009996 47.580006L25.459997 49.130005C 25.019997 49.570004 25.019997 50.290005 25.459997 50.730003L25.459997 50.730003L30.459997 55.730003C 30.669996 55.940002 30.959997 56.060005 31.259996 56.060005C 31.559996 56.060005 31.849997 55.940006 32.059998 55.730003L32.059998 55.730003L33.609997 54.180004C 34.949997 54.950005 36.369995 55.540005 37.859997 55.940002L37.859997 55.940002L37.859997 58.13L37.85 58.13zM34.05 51.800003C 33.6 51.510002 33.01 51.570004 32.64 51.950005L32.64 51.950005L31.26 53.330006L27.86 49.930004L29.24 48.550003C 29.619999 48.170002 29.68 47.58 29.39 47.140003C 28.359999 45.550003 27.64 43.810005 27.25 41.97C 27.14 41.45 26.68 41.08 26.14 41.08L26.14 41.08L24.199999 41.08L24.199999 36.27L26.14 36.27C 26.67 36.27 27.13 35.9 27.25 35.38C 27.65 33.54 28.37 31.800001 29.39 30.210001C 29.68 29.76 29.619999 29.170002 29.24 28.800001L29.24 28.800001L27.869999 27.43L31.269999 24.03L32.64 25.400002C 33.02 25.78 33.61 25.840002 34.05 25.550001C 35.64 24.52 37.379997 23.800001 39.22 23.410002C 39.74 23.300001 40.11 22.840002 40.11 22.300001L40.11 22.300001L40.11 20.37L44.920002 20.37L44.920002 22.300001C 44.920002 22.830002 45.29 23.29 45.81 23.410002C 47.65 23.810001 49.39 24.530003 50.980003 25.550001C 51.430004 25.840002 52.020004 25.78 52.390003 25.400002L52.390003 25.400002L53.760002 24.03L57.160004 27.43L55.790005 28.800001C 55.410004 29.18 55.350006 29.77 55.640003 30.210001C 56.670002 31.800001 57.390003 33.54 57.780003 35.38C 57.890003 35.9 58.350002 36.27 58.890003 36.27L58.890003 36.27L60.83 36.27L60.83 41.08L58.890003 41.08C 58.360004 41.08 57.9 41.45 57.780003 41.97C 57.38 43.81 56.660004 45.550003 55.640003 47.14C 55.350002 47.59 55.410004 48.18 55.790005 48.55L55.790005 48.55L57.170006 49.93L53.770004 53.33L52.390003 51.95C 52.010002 51.57 51.420002 51.510002 50.980003 51.8C 49.390003 52.829998 47.65 53.55 45.810005 53.94C 45.290005 54.05 44.920006 54.51 44.920006 55.05L44.920006 55.05L44.920006 57L40.110004 57L40.110004 55.05C 40.110004 54.52 39.740005 54.059998 39.220005 53.94C 37.380005 53.539997 35.640007 52.82 34.050003 51.8z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                <path d="M51.87 38.67C 51.87 33.51 47.68 29.319998 42.519997 29.319998C 37.359993 29.319998 33.17 33.51 33.17 38.67C 33.17 43.829998 37.359997 48.019997 42.519997 48.019997C 47.679996 48.019997 51.869995 43.829998 51.869995 38.67L51.869995 38.67L51.87 38.67zM35.43 38.67C 35.43 34.76 38.61 31.579998 42.52 31.579998C 46.43 31.579998 49.61 34.76 49.61 38.67C 49.61 42.579998 46.43 45.76 42.52 45.76C 38.61 45.76 35.43 42.579998 35.43 38.67z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                <path d="M52.94 13.98C 53.239998 13.98 53.53 13.86 53.739998 13.65C 53.949997 13.44 54.07 13.15 54.07 12.849999C 54.07 12.549999 53.95 12.259999 53.739998 12.049999C 53.53 11.839999 53.239998 11.719999 52.94 11.719999C 52.64 11.719999 52.35 11.839999 52.14 12.049999C 51.93 12.259999 51.809998 12.549999 51.809998 12.849999C 51.809998 13.15 51.929996 13.44 52.14 13.65C 52.35 13.86 52.64 13.98 52.94 13.98z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                <path d="M32.15 63.38C 31.850002 63.38 31.560001 63.5 31.350002 63.710003C 31.140003 63.920006 31.020002 64.21001 31.020002 64.51C 31.020002 64.81 31.140003 65.1 31.350002 65.310005C 31.560001 65.52001 31.850002 65.64001 32.15 65.64001C 32.45 65.64001 32.74 65.520004 32.95 65.310005C 33.16 65.100006 33.280003 64.810005 33.280003 64.51C 33.280003 64.21 33.160004 63.920002 32.95 63.710003C 32.739998 63.500004 32.45 63.38 32.15 63.38z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
            </g>
            </svg>
                    </span>
                    <span class="dot"></span>
                    <span>Post<br>Marketing</span>
                </li>
                <li>
                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="body_1" width="82" height="61">

                        <g transform="matrix(0.79334116 0 0 0.79334116 7.2711024 -0)">
                        <path d="M56.18 20.82C 53.6 20.82 51.510002 22.92 51.510002 25.49C 51.510002 25.98 51.590004 26.46 51.730003 26.91C 48.690002 27.82 44.030003 28.55 40.100002 26.34C 33.850002 22.84 27.350002 24.81 25.510002 25.5C 24.720001 25.79 24.190002 26.56 24.190002 27.4L24.190002 27.4L24.190002 44.93C 24.190002 46.31 25.540003 47.29 26.850002 46.86C 28.850002 46.2 34.020004 44.97 38.950005 47.73C 42.980003 49.989998 47.830006 49.829998 52.260006 48.54L52.260006 48.54L52.260006 51.59L52.260006 66.51C 52.260006 67.16 52.780006 67.68 53.430004 67.68C 54.08 67.68 54.600002 67.16 54.600002 66.51L54.600002 66.51L54.600002 65.98L54.600002 29.9C 55.61 30.26 56.74 30.26 57.750004 29.9L57.750004 29.9L57.750004 45.79C 57.750004 46.440002 58.270004 46.96 58.920002 46.96C 59.57 46.96 60.09 46.44 60.09 45.79L60.09 45.79L60.09 28.04C 60.57 27.310001 60.84 26.44 60.84 25.5C 60.84 22.92 58.74 20.83 56.17 20.83L56.17 20.83L56.18 20.82zM40.09 45.699997C 35.94 43.369995 31 43.17 26.529999 44.519997L26.529999 44.519997L26.529999 27.63C 28.369999 26.98 33.79 25.5 38.949997 28.39C 43.549995 30.97 48.809998 30.199999 52.26 29.199999L52.26 29.199999L52.26 46.1C 49.239998 47.079998 44.26 48.039997 40.089996 45.699997zM56.18 27.819998C 54.88 27.819998 53.85 26.749998 53.85 25.489998C 53.85 24.229998 54.89 23.159998 56.18 23.159998C 57.47 23.159998 58.510002 24.209997 58.510002 25.489998C 58.510002 26.769999 57.460003 27.819998 56.18 27.819998z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                        <path d="M58.92 50.08C 58.269997 50.08 57.75 50.600002 57.75 51.25L57.75 51.25L57.75 66.53C 57.75 67.18 58.27 67.7 58.92 67.7C 59.569996 67.7 60.089996 67.18 60.089996 66.53L60.089996 66.53L60.089996 51.25C 60.089996 50.6 59.569996 50.08 58.92 50.08z" stroke="none" fill="#FFFFFF" fill-rule="nonzero" />
                        </g>
                    </svg></span>
                    <span class="flag dot"></span>
                    <span>&nbsp;</span>
                </li>
                </ul>
            </div>
            </div>
            <div class="wrapper">
            <h1>Meowdy!</h1>
            </div>
        EOD;
            //$myoptions = get_option('headline_one_field');
            return $timeline;
        }
    }
    

}

new TPDX_Header();