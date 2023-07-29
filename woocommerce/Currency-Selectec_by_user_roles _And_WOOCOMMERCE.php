function changer_devises_par_role( $helper ) {
	// Récupérer l'ID du rôle de l'utilisateur actuel
	if ( is_user_logged_in() ) {
		$user  = wp_get_current_user();
		$roles = ( array ) $user->roles;
		$role  = $roles[0]; // Le premier rôle est le plus prioritaire

		// Définir les devises disponibles en fonction du rôle de l'utilisateur
		switch ( $role ) {
			case 'clients_eu_fr':
			case 'distributeurs_fr':
				$currency = 'EUR';
				break;
			case 'clients_usa':
			case 'distributeurs_usa':
				$currency = 'USD';
				break;
			case 'clients_asia':
			case 'distributeurs_asie':
				$currency = 'CNY'; // Utiliser le code de devise ISO 4217 pour le RMB (Yuan chinois)
				break;
			default:
				$currency = 'EUR'; // Définir la devise Euro par défaut pour les autres rôles
				break;
		}

		if ( $currency ) {
			$helper->set_current_currency( $currency );
		}

		// Ajouter un filtre pour la partie commande
		add_filter( 'woocommerce_get_price_html', function( $price, $product ) use ( $currency ) {
			$currency_symbol = get_woocommerce_currency_symbol( $currency );
			//$price = $currency_symbol . $price;
			return $price;
		}, 10, 2 );

		// Ajouter un filtre pour la confirmation par email
		add_filter( 'woocommerce_email_order_meta_fields', function( $fields, $sent_to_admin, $order ) use ( $currency ) {
			$currency_symbol = get_woocommerce_currency_symbol( $currency );
			$fields['devise'] = array(
				'label' => __( 'Devise', 'woocommerce' ),
				'value' => $currency_symbol,
			);
			return $fields;
		}, 10, 3 );
	}
}

add_action( 'wmc_after_init_currency', 'changer_devises_par_role' );
