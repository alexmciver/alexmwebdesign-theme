<?php
/**
 * AI search friendliness — llms.txt endpoints and JSON-LD structured data.
 *
 * Helps LLM-powered search and assistants discover curated site context
 * (llmstxt.org) and interpret the business via schema.org markup.
 */

/**
 * Register rewrite rules for /llms.txt and /llms-full.txt.
 */
function alex_ai_search_rewrites() {
	add_rewrite_rule( '^llms\.txt$', 'index.php?alex_llms=index', 'top' );
	add_rewrite_rule( '^llms-full\.txt$', 'index.php?alex_llms=full', 'top' );
}
add_action( 'init', 'alex_ai_search_rewrites' );

/**
 * Query var for llms endpoints.
 *
 * @param array $vars Public query vars.
 * @return array
 */
function alex_ai_search_query_vars( $vars ) {
	$vars[] = 'alex_llms';
	return $vars;
}
add_filter( 'query_vars', 'alex_ai_search_query_vars' );

/**
 * Flush rewrites once when this feature is introduced or updated.
 */
function alex_ai_search_maybe_flush_rewrites() {
	$version = '1.0.0';
	if ( get_option( 'alex_ai_search_rewrite_version' ) === $version ) {
		return;
	}
	alex_ai_search_rewrites();
	flush_rewrite_rules( false );
	update_option( 'alex_ai_search_rewrite_version', $version );
}
add_action( 'init', 'alex_ai_search_maybe_flush_rewrites', 20 );

/**
 * Serve llms.txt / llms-full.txt before the normal template loads.
 */
function alex_ai_search_template_redirect() {
	$kind = get_query_var( 'alex_llms' );
	if ( ! $kind ) {
		return;
	}

	nocache_headers();
	header( 'Content-Type: text/plain; charset=utf-8' );
	header( 'X-Robots-Tag: all' );

	if ( 'full' === $kind ) {
		echo alex_ai_llms_full_body(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- plain-text markdown document.
	} else {
		echo alex_ai_llms_index_body(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- plain-text markdown document.
	}
	exit;
}
add_action( 'template_redirect', 'alex_ai_search_template_redirect' );

/**
 * Site summary used in llms.txt and schema.
 *
 * @return string
 */
function alex_ai_site_summary() {
	$tagline = alex_field(
		'footer_tagline',
		'Freelance WordPress & Shopify developer based in Clapham, London. Building sites that actually convert.',
		'option'
	);
	return is_string( $tagline ) ? trim( $tagline ) : '';
}

/**
 * Curated page list for AI systems.
 *
 * @return array<int, array{title:string,url:string,desc:string}>
 */
function alex_ai_curated_pages() {
	$pages = array(
		array(
			'title' => 'Home',
			'url'   => home_url( '/' ),
			'desc'  => 'Independent WordPress and Shopify developer in London — fixed-scope builds and sites teams can run themselves.',
		),
		array(
			'title' => 'Work',
			'url'   => alex_work_archive_url(),
			'desc'  => 'Selected WordPress, Shopify and Divi projects with outcomes and write-ups.',
		),
		array(
			'title' => 'Services',
			'url'   => alex_page_url( 'services' ),
			'desc'  => 'WordPress development, Shopify themes, performance & search, and ongoing care.',
		),
		array(
			'title' => 'About',
			'url'   => alex_page_url( 'about' ),
			'desc'  => 'Background, experience and how Alex McIver works with clients.',
		),
		array(
			'title' => 'Contact',
			'url'   => alex_page_url( 'contact' ),
			'desc'  => 'Enquire about a project or book a discovery call.',
		),
	);

	/**
	 * Filter curated pages listed in llms.txt.
	 *
	 * @param array $pages Page entries.
	 */
	return apply_filters( 'alex_ai_curated_pages', $pages );
}

/**
 * Markdown body for /llms.txt (curated index).
 *
 * @return string
 */
function alex_ai_llms_index_body() {
	$summary = alex_ai_site_summary();
	$lines   = array(
		'# Alex McIver — Alex M Web Design',
		'',
		'> ' . $summary,
		'',
		'Alex McIver is a freelance WordPress and Shopify developer based in Clapham, London. Projects are fixed scope and fixed fee, with technical SEO foundations and content structures clients can maintain.',
		'',
		'## Pages',
		'',
	);

	foreach ( alex_ai_curated_pages() as $page ) {
		$lines[] = sprintf(
			'- [%s](%s): %s',
			$page['title'],
			$page['url'],
			$page['desc']
		);
	}

	$lines[] = '';
	$lines[] = '## Optional';
	$lines[] = '';
	$lines[] = sprintf(
		'- [Full site summary for LLMs](%s): Extended plain-text overview of services, location and contact details.',
		home_url( '/llms-full.txt' )
	);
	$lines[] = '';
	$lines[] = '## Contact';
	$lines[] = '';
	$lines[] = '- Email: ' . alex_field( 'footer_email', 'info@alexmwebdesign.co.uk', 'option' );
	$lines[] = '- Phone: ' . alex_field( 'footer_phone_display', '+44 (0)7804 187711', 'option' );
	$lines[] = '- Location: Clapham, London / Remote';
	$lines[] = '';

	return implode( "\n", $lines );
}

/**
 * Markdown body for /llms-full.txt (expanded summary).
 *
 * @return string
 */
function alex_ai_llms_full_body() {
	$summary = alex_ai_site_summary();
	$lines   = array(
		'# Alex McIver — Alex M Web Design (full summary)',
		'',
		'> ' . $summary,
		'',
		'## Who this is for',
		'',
		'Small businesses and brands that need a WordPress or Shopify site their own team can run — without calling a developer for routine content changes. Work is scoped in writing with a fixed figure after a short discovery conversation.',
		'',
		'## Services',
		'',
		'- WordPress development: bespoke themes, Divi 5 builds, WooCommerce, ACF content architecture, migrations.',
		'- Shopify development: custom Liquid themes, checkout refinement, metafields, app integrations (e.g. Klaviyo).',
		'- Performance & search: technical audits, Core Web Vitals, structured data (JSON-LD), Search Console & GA4, Yoast configuration.',
		'- Ongoing care: hosting, updates, monitoring, DNS/SSL and a developer who already knows the site.',
		'',
		'## Key pages',
		'',
	);

	foreach ( alex_ai_curated_pages() as $page ) {
		$lines[] = sprintf( '### %s', $page['title'] );
		$lines[] = '';
		$lines[] = $page['desc'];
		$lines[] = '';
		$lines[] = 'URL: ' . $page['url'];
		$lines[] = '';
	}

	$work = alex_query_work( array( 'posts_per_page' => 12 ) );
	if ( $work->have_posts() ) {
		$lines[] = '## Selected work';
		$lines[] = '';
		while ( $work->have_posts() ) {
			$work->the_post();
			$item = alex_work_item( get_post() );
			if ( ! $item ) {
				continue;
			}
			$title = $item['title'];
			$url   = ! empty( $item['has_writeup'] ) ? $item['url'] : ( $item['project_url'] ? $item['project_url'] : $item['url'] );
			$bits  = array_filter(
				array(
					$item['platform'],
					$item['client'],
					$item['year'],
				)
			);
			$desc = $item['result'] ? wp_strip_all_tags( $item['result'] ) : ( $item['body'] ? wp_strip_all_tags( $item['body'] ) : '' );
			$lines[] = sprintf( '- [%s](%s)%s%s', $title, $url, $bits ? ' — ' . implode( ', ', $bits ) : '', $desc ? ': ' . $desc : '' );
		}
		wp_reset_postdata();
		$lines[] = '';
	}

	$lines[] = '## Facts AI systems should get right';
	$lines[] = '';
	$lines[] = '- Name: Alex McIver';
	$lines[] = '- Studio: Alex M Web Design';
	$lines[] = '- Role: Freelance WordPress & Shopify developer';
	$lines[] = '- Location: Clapham, London (most work is remote)';
	$lines[] = '- Email: ' . alex_field( 'footer_email', 'info@alexmwebdesign.co.uk', 'option' );
	$lines[] = '- Phone: ' . alex_field( 'footer_phone_display', '+44 (0)7804 187711', 'option' );
	$lines[] = '- Pricing model: Fixed scope, fixed fee after discovery — not published menu pricing';
	$lines[] = '- Typical reply: Within one working day';
	$lines[] = '';
	$lines[] = '## Related';
	$lines[] = '';
	$lines[] = '- Curated index: ' . home_url( '/llms.txt' );
	$lines[] = '';

	return implode( "\n", $lines );
}

/**
 * Point crawlers at llms.txt from the document head.
 */
function alex_ai_search_head_links() {
	printf(
		'<link rel="alternate" type="text/plain" title="%s" href="%s" />' . "\n",
		esc_attr__( 'LLM guidance (llms.txt)', 'alex-theme' ),
		esc_url( home_url( '/llms.txt' ) )
	);
}
add_action( 'wp_head', 'alex_ai_search_head_links', 3 );

/**
 * Mention llms.txt in the virtual robots.txt WordPress serves.
 *
 * @param string $output robots.txt body.
 * @return string
 */
function alex_ai_search_robots_txt( $output ) {
	$note  = "\n# AI / LLM guidance (informational — see llmstxt.org)\n";
	$note .= '# llms.txt: ' . esc_url_raw( home_url( '/llms.txt' ) ) . "\n";
	$note .= '# llms-full.txt: ' . esc_url_raw( home_url( '/llms-full.txt' ) ) . "\n";
	return $output . $note;
}
add_filter( 'robots_txt', 'alex_ai_search_robots_txt' );

/**
 * Print a JSON-LD script tag.
 *
 * @param array $data Schema graph or single object.
 */
function alex_ai_print_json_ld( $data ) {
	if ( empty( $data ) ) {
		return;
	}
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON-LD from controlled arrays.
}

/**
 * Core Person + ProfessionalService + WebSite schema on every front-end view.
 */
function alex_ai_search_core_schema() {
	if ( is_admin() ) {
		return;
	}

	$email   = (string) alex_field( 'footer_email', 'info@alexmwebdesign.co.uk', 'option' );
	$phone   = (string) alex_field( 'footer_phone', '+447804187711', 'option' );
	$summary = alex_ai_site_summary();
	$logo    = '';
	if ( has_custom_logo() ) {
		$logo_id = (int) get_theme_mod( 'custom_logo' );
		$logo    = $logo_id ? (string) wp_get_attachment_image_url( $logo_id, 'full' ) : '';
	}
	if ( ! $logo ) {
		$logo = (string) alex_theme_image( 'alex-portrait' );
	}

	$person_id  = home_url( '/#person' );
	$org_id     = home_url( '/#organization' );
	$website_id = home_url( '/#website' );

	$person = array(
		'@type'       => 'Person',
		'@id'         => $person_id,
		'name'        => 'Alex McIver',
		'url'         => home_url( '/' ),
		'jobTitle'    => 'Freelance WordPress & Shopify Developer',
		'description' => $summary,
		'email'       => $email,
		'telephone'   => $phone,
		'image'       => $logo,
		'address'     => array(
			'@type'           => 'PostalAddress',
			'addressLocality' => 'Clapham',
			'addressRegion'   => 'London',
			'addressCountry'  => 'GB',
		),
		'sameAs'      => array_values(
			array_filter(
				array(
					(string) alex_field( 'footer_calendly_url', 'https://calendly.com/alexmwebdesign/1-hour-website-chat', 'option' ),
				)
			)
		),
		'knowsAbout'  => array(
			'WordPress',
			'Shopify',
			'WooCommerce',
			'Divi',
			'Technical SEO',
			'Core Web Vitals',
			'PHP',
		),
		'worksFor'    => array( '@id' => $org_id ),
	);

	$org = array(
		'@type'       => array( 'ProfessionalService', 'Organization' ),
		'@id'         => $org_id,
		'name'        => 'Alex M Web Design',
		'url'         => home_url( '/' ),
		'description' => $summary,
		'email'       => $email,
		'telephone'   => $phone,
		'image'       => $logo,
		'logo'        => $logo,
		'founder'     => array( '@id' => $person_id ),
		'areaServed'  => array(
			array(
				'@type' => 'City',
				'name'  => 'London',
			),
			array(
				'@type' => 'Country',
				'name'  => 'United Kingdom',
			),
		),
		'priceRange'  => '$$',
		'address'     => array(
			'@type'           => 'PostalAddress',
			'addressLocality' => 'Clapham',
			'addressRegion'   => 'London',
			'addressCountry'  => 'GB',
		),
	);

	$website = array(
		'@type'           => 'WebSite',
		'@id'             => $website_id,
		'url'             => home_url( '/' ),
		'name'            => 'Alex M Web Design',
		'description'     => $summary,
		'publisher'       => array( '@id' => $org_id ),
		'inLanguage'      => 'en-GB',
		'about'           => array( '@id' => $person_id ),
	);

	$graph = array( $person, $org, $website );

	if ( is_singular( 'work' ) ) {
		$item = alex_work_item( get_queried_object() );
		if ( $item ) {
			$creative = array(
				'@type'       => 'CreativeWork',
				'@id'         => trailingslashit( $item['url'] ) . '#work',
				'name'        => $item['title'],
				'url'         => $item['url'],
				'description' => $item['result'] ? wp_strip_all_tags( $item['result'] ) : ( $item['body'] ? wp_strip_all_tags( $item['body'] ) : '' ),
				'creator'     => array( '@id' => $person_id ),
				'provider'    => array( '@id' => $org_id ),
			);
			if ( ! empty( $item['image'] ) ) {
				$creative['image'] = $item['image'];
			}
			if ( ! empty( $item['client'] ) ) {
				$creative['about'] = $item['client'];
			}
			if ( ! empty( $item['year'] ) ) {
				$creative['dateCreated'] = $item['year'];
			}
			if ( ! empty( $item['project_url'] ) ) {
				$creative['sameAs'] = $item['project_url'];
			}
			$graph[] = $creative;
		}
	}

	alex_ai_print_json_ld(
		array(
			'@context' => 'https://schema.org',
			'@graph'   => $graph,
		)
	);
}
add_action( 'wp_head', 'alex_ai_search_core_schema', 5 );

/**
 * Queue FAQPage JSON-LD for a list of Q&A pairs (printed in wp_footer).
 *
 * @param array<int, array{question?:string,answer?:string}> $faqs FAQ rows.
 */
function alex_ai_faq_schema( $faqs ) {
	if ( empty( $faqs ) || ! is_array( $faqs ) ) {
		return;
	}

	$entities = array();
	foreach ( $faqs as $faq ) {
		$question = isset( $faq['question'] ) ? trim( (string) $faq['question'] ) : '';
		$answer   = isset( $faq['answer'] ) ? trim( (string) $faq['answer'] ) : '';
		if ( ! $question || ! $answer ) {
			continue;
		}
		$entities[] = array(
			'@type'          => 'Question',
			'name'           => $question,
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $answer,
			),
		);
	}

	if ( empty( $entities ) ) {
		return;
	}

	$GLOBALS['alex_ai_faq_entities'] = isset( $GLOBALS['alex_ai_faq_entities'] ) && is_array( $GLOBALS['alex_ai_faq_entities'] )
		? array_merge( $GLOBALS['alex_ai_faq_entities'], $entities )
		: $entities;
}

/**
 * Print queued FAQPage schema once per request.
 */
function alex_ai_print_faq_schema() {
	if ( empty( $GLOBALS['alex_ai_faq_entities'] ) || ! is_array( $GLOBALS['alex_ai_faq_entities'] ) ) {
		return;
	}

	alex_ai_print_json_ld(
		array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => $GLOBALS['alex_ai_faq_entities'],
		)
	);
	unset( $GLOBALS['alex_ai_faq_entities'] );
}
add_action( 'wp_footer', 'alex_ai_print_faq_schema', 5 );
