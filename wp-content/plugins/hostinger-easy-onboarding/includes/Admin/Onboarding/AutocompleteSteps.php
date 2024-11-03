<?php

namespace Hostinger\EasyOnboarding\Admin\Onboarding;

use Hostinger\EasyOnboarding\AmplitudeEvents\Amplitude;
use Hostinger\EasyOnboarding\AmplitudeEvents\Actions as AmplitudeActions;
use Hostinger\EasyOnboarding\Helper;
use Hostinger\EasyOnboarding\Settings;
use Hostinger\EasyOnboarding\Admin\Actions as Admin_Actions;
use WP_Post;

defined( 'ABSPATH' ) || exit;

class AutocompleteSteps {
    /**
     * @var Helper
     */
	private Helper $helper;

    /**
     * @var Onboarding
     */
    private Onboarding $onboarding;

	public function __construct() {
		$this->onboarding          = new Onboarding();
        $this->onboarding->init();
		$this->helper          = new Helper();

		add_action( 'save_post_product', array( $this, 'new_product_creation' ), 10, 3 );
        add_action( 'woocommerce_shipping_zone_method_added', array( $this, 'shipping_zone_added'), 10, 3 );
        add_action( 'googlesitekit_authorize_user', array( $this, 'googlesite_connected' ) );

        add_action( 'admin_init', array( $this, 'woocommerce_steps_completed' ) );

		if ( $this->helper->is_hostinger_admin_page() ) {
			add_action( 'admin_init', array( $this, 'domain_is_connected' ) );
		}
	}

    public function woocommerce_steps_completed(): void {
        if ( ! is_plugin_active('woocommerce/woocommerce.php')) {
            return;
        }

        if ( !$this->helper->is_woocommerce_onboarding_completed() ) {
            return;
        }

        $action = Admin_Actions::STORE_TASKS;

        $category_id = $this->find_category_from_actions($action);

        if( empty( $category_id ) ) {
            return;
        }

        if ( $this->onboarding->is_completed( $category_id, $action ) ) {
            return;
        }

        $this->onboarding->complete_step( $category_id, $action );
    }

    /**
     * @return void
     */
	public function domain_is_connected(): void {
		$action = Admin_Actions::DOMAIN_IS_CONNECTED;

        $category_id = $this->find_category_from_actions($action);

        if(empty($category_id)) {
            return;
        }

		if ( $this->onboarding->is_completed( $category_id, $action ) ) {
			return;
		}

		if ( ! $this->helper->is_free_subdomain() && ! $this->helper->is_preview_domain() ) {
			if ( ! did_action( 'hostinger_domain_connected' ) ) {
                $this->onboarding->complete_step( $category_id, $action );
				do_action( 'hostinger_domain_connected' );
			}
		}
	}

    /**
     * @param int    $post_id
     * @param bool   $update
     * @param string $action
     *
     * @return void
     */
	public function new_post_item_creation( int $post_id, bool $update, string $action ): void {
		$cookie_value = isset( $_COOKIE[ $action ] ) ? sanitize_text_field( wp_unslash( $_COOKIE[ $action ] ) ) : '';

        $category_id = $this->find_category_from_actions($action);

        if(empty($category_id)) {
            return;
        }

		if ( $this->onboarding->is_completed( $category_id, $action ) || wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
			return;
		}

		if ( $update && $cookie_value === $action ) {
            $this->onboarding->complete_step( $category_id, $action );
		}
	}

    /**
     * @param int     $post_id
     * @param WP_Post $post
     * @param bool    $update
     *
     * @return void
     */
	public function new_product_creation( int $post_id, WP_Post $post, bool $update ): void {
        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }

        if( $post->post_status != 'publish' ) {
            return;
        }

        if( empty( $post->post_author ) ) {
            return;
        }

        if ( $this->onboarding->is_completed( Onboarding::HOSTINGER_EASY_ONBOARDING_STORE_STEP_CATEGORY_ID, Admin_Actions::ADD_PRODUCT ) ) {
            return;
        }

        $this->onboarding->complete_step( Onboarding::HOSTINGER_EASY_ONBOARDING_STORE_STEP_CATEGORY_ID, Admin_Actions::ADD_PRODUCT );

        $add_product_event_sent = get_option( 'hostinger_add_product_event_sent', false );

        if ( !empty( $add_product_event_sent ) ) {
            return;
        }

        $amplitude = new Amplitude();

        $params = array(
            'action' => AmplitudeActions::WOO_ITEM_COMPLETED,
            'step_type' => Admin_Actions::ADD_PRODUCT,
        );

        $amplitude->send_event($params);

        update_option( 'hostinger_add_product_event_sent', true );
	}

    /**
     * @param $instance_id
     * @param $type
     * @param $zone_id
     *
     * @return void
     */
    public function shipping_zone_added($instance_id, $type, $zone_id) {
        if ( $this->onboarding->is_completed( Onboarding::HOSTINGER_EASY_ONBOARDING_STORE_STEP_CATEGORY_ID, Admin_Actions::ADD_SHIPPING ) ) {
            return;
        }

        $this->onboarding->complete_step( Onboarding::HOSTINGER_EASY_ONBOARDING_STORE_STEP_CATEGORY_ID, Admin_Actions::ADD_SHIPPING );

        $amplitude = new Amplitude();

        $params = array(
            'action' => AmplitudeActions::WOO_ITEM_COMPLETED,
            'step_type' => Admin_Actions::ADD_SHIPPING,
        );

        $amplitude->send_event($params);
    }

    public function googlesite_connected() {
        $category = Onboarding::HOSTINGER_EASY_ONBOARDING_WEBSITE_STEP_CATEGORY_ID;

        if ( $this->onboarding->is_completed( $category, Admin_Actions::GOOGLE_KIT ) ) {
            return;
        }

        $this->onboarding->complete_step( $category, Admin_Actions::GOOGLE_KIT );

        $amplitude = new Amplitude();

        $action = is_plugin_active( 'woocommerce/woocommerce.php' ) ? AmplitudeActions::WOO_ITEM_COMPLETED : AmplitudeActions::ONBOARDING_ITEM_COMPLETED;

        $params = array(
            'action' => $action,
            'step_type' => Admin_Actions::GOOGLE_KIT,
        );

        $amplitude->send_event($params);
    }

    /**
     * @param $action
     *
     * @return string
     */
    private function find_category_from_actions($action): string {
        foreach (Admin_Actions::get_category_action_lists() as $category => $actions) {
            if (in_array($action, $actions)) {
                return $category;
            }
        }
        return '';
    }
}