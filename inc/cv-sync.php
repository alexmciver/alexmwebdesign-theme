<?php
/**
 * Sync Professional Experience from a public Google Doc CV.
 *
 * Doc must be shared as "Anyone with the link can view".
 * Updates are cached; cache refreshes hourly (or on demand for admins).
 */

/**
 * Google Doc ID for the CV.
 *
 * @return string
 */
function alex_cv_doc_id() {
	return (string) apply_filters( 'alex_cv_google_doc_id', '1C5ULOiW2biePa-_eaUhqr_AVzlTxIphG3Dp1YJdDQ_g' );
}

/**
 * Plain-text export URL for the CV doc.
 *
 * @return string
 */
function alex_cv_export_url() {
	return 'https://docs.google.com/document/d/' . rawurlencode( alex_cv_doc_id() ) . '/export?format=txt';
}

/**
 * Cache lifetime in seconds.
 *
 * @return int
 */
function alex_cv_cache_ttl() {
	return (int) apply_filters( 'alex_cv_cache_ttl', HOUR_IN_SECONDS );
}

/**
 * Freelance role kept on the site even when absent from the CV.
 *
 * @return array{title:string,org:string,date:string,role:string,meta:string,body:string}
 */
function alex_cv_freelance_job() {
	return array(
		'title' => 'Freelance Web Developer',
		'org'   => 'Alex M Web Design, London',
		'date'  => '2020 – Present',
		'role'  => 'Freelance · Alex M Web Design',
		'meta'  => '2020 – Present',
		'body'  => 'Independent projects for small businesses — WordPress redesigns, Shopify stores, SEO audits and ongoing care.',
	);
}

/**
 * Fetch raw CV text from Google Docs.
 *
 * @return string|WP_Error
 */
function alex_cv_fetch_raw() {
	$response = wp_remote_get(
		alex_cv_export_url(),
		array(
			'timeout'    => 15,
			'redirection' => 3,
			'headers'    => array(
				'Accept' => 'text/plain',
			),
		)
	);

	if ( is_wp_error( $response ) ) {
		return $response;
	}

	$code = (int) wp_remote_retrieve_response_code( $response );
	$body = (string) wp_remote_retrieve_body( $response );

	if ( 200 !== $code || '' === trim( $body ) ) {
		return new WP_Error(
			'alex_cv_fetch_failed',
			sprintf( 'CV fetch failed (HTTP %d).', $code )
		);
	}

	// Strip BOM and normalise line endings.
	$body = preg_replace( '/^\xEF\xBB\xBF/', '', $body );
	$body = str_replace( array( "\r\n", "\r" ), "\n", $body );

	return $body;
}

/**
 * Parse job entries from CV plain text.
 *
 * Expects a "Professional Experience" section with lines like:
 * Title | Company (Location) Month Year – Month Year|Present
 * followed by ● bullet points.
 *
 * @param string $text CV plain text.
 * @return array<int, array{title:string,org:string,date:string,role:string,meta:string,body:string}>
 */
function alex_cv_parse_jobs( $text ) {
	$text = (string) $text;
	if ( '' === trim( $text ) ) {
		return array();
	}

	// Keep only the Professional Experience section.
	if ( preg_match( '/Professional Experience\s*(.*?)(?:Education\s*&\s*Qualifications|$)/is', $text, $section ) ) {
		$text = $section[1];
	}

	$months = 'January|February|March|April|May|June|July|August|September|October|November|December';
	$date   = '(?:' . $months . ')\s+\d{4}\s*[–—-]\s*(?:Present|(?:' . $months . ')\s+\d{4})';
	$header = '/^(.+?)\s*\|\s*(.+?)\s*\(([^)]+)\)\s+(' . $date . ')/u';

	$lines = preg_split( '/\n+/', $text ) ?: array();
	$jobs  = array();
	$current = null;

	foreach ( $lines as $line ) {
		$line = trim( preg_replace( '/\s+/u', ' ', $line ) );
		if ( '' === $line ) {
			continue;
		}

		// Drop trailing section glue, e.g. "...meetings. Education & Qualifications".
		$line = preg_replace( '/\s*Education\s*&\s*Qualifications.*$/iu', '', $line );
		$line = trim( (string) $line );
		if ( '' === $line ) {
			continue;
		}

		// Strip optional tech-stack suffix before matching the header.
		$header_line = preg_replace( '/\s+Tech Stack:.*$/iu', '', $line );
		$header_line = trim( (string) $header_line );

		if ( preg_match( $header, $header_line, $m ) ) {
			if ( null !== $current ) {
				$jobs[] = alex_cv_finalise_job( $current );
			}

			$title    = trim( $m[1] );
			$company  = trim( $m[2] );
			$location = trim( $m[3] );
			$dates    = preg_replace( '/\s*[—-]\s*/u', ' – ', trim( $m[4] ) );
			$org      = $company . ( $location ? ', ' . $location : '' );

			$current = array(
				'title'   => $title,
				'org'     => $org,
				'date'    => $dates,
				'role'    => $title . ' · ' . $company,
				'meta'    => $dates,
				'bullets' => array(),
			);
			continue;
		}

		if ( null === $current ) {
			continue;
		}

		if ( preg_match( '/^[●•\-\*]\s*(.+)$/u', $line, $bullet ) ) {
			$current['bullets'][] = trim( $bullet[1] );
		}
	}

	if ( null !== $current ) {
		$jobs[] = alex_cv_finalise_job( $current );
	}

	return $jobs;
}

/**
 * Turn a parsed job draft into a display row.
 *
 * @param array $job Job draft with bullets.
 * @return array{title:string,org:string,date:string,role:string,meta:string,body:string}
 */
function alex_cv_finalise_job( $job ) {
	$bullets = isset( $job['bullets'] ) && is_array( $job['bullets'] ) ? $job['bullets'] : array();
	$body    = '';

	if ( ! empty( $bullets ) ) {
		// Prefer a concise timeline blurb from the first two bullets.
		$slice = array_slice( $bullets, 0, 2 );
		$parts = array();
		foreach ( $slice as $bullet ) {
			$bullet = rtrim( (string) $bullet, " \t." );
			if ( '' !== $bullet ) {
				$parts[] = $bullet . '.';
			}
		}
		$body = implode( ' ', $parts );
	}

	return array(
		'title' => (string) $job['title'],
		'org'   => (string) $job['org'],
		'date'  => (string) $job['date'],
		'role'  => (string) $job['role'],
		'meta'  => (string) $job['meta'],
		'body'  => $body,
	);
}

/**
 * Insert Freelance after the newest role (or at the top if empty).
 *
 * @param array $jobs Parsed jobs.
 * @return array
 */
function alex_cv_with_freelance( $jobs ) {
	$freelance = alex_cv_freelance_job();
	$jobs      = is_array( $jobs ) ? array_values( $jobs ) : array();

	foreach ( $jobs as $job ) {
		if ( ! empty( $job['role'] ) && false !== stripos( (string) $job['role'], 'Freelance' ) ) {
			return $jobs;
		}
		if ( ! empty( $job['title'] ) && false !== stripos( (string) $job['title'], 'Freelance' ) ) {
			return $jobs;
		}
	}

	if ( empty( $jobs ) ) {
		return array( $freelance );
	}

	array_splice( $jobs, 1, 0, array( $freelance ) );
	return $jobs;
}

/**
 * Load jobs from cache or Google Docs.
 *
 * @param bool $force Force a fresh fetch.
 * @return array<int, array{title:string,org:string,date:string,role:string,meta:string,body:string}>
 */
function alex_cv_jobs( $force = false ) {
	$cache_key = 'alex_cv_jobs_v1';

	if ( ! $force ) {
		$cached = get_transient( $cache_key );
		if ( is_array( $cached ) ) {
			return $cached;
		}
	}

	$raw = alex_cv_fetch_raw();
	if ( is_wp_error( $raw ) ) {
		$stale = get_option( 'alex_cv_jobs_last_good', array() );
		return is_array( $stale ) ? $stale : array();
	}

	$jobs = alex_cv_with_freelance( alex_cv_parse_jobs( $raw ) );
	if ( empty( $jobs ) ) {
		$stale = get_option( 'alex_cv_jobs_last_good', array() );
		return is_array( $stale ) ? $stale : array();
	}

	set_transient( $cache_key, $jobs, alex_cv_cache_ttl() );
	update_option( 'alex_cv_jobs_last_good', $jobs, false );

	return $jobs;
}

/**
 * Experience sidebar rows (role + meta).
 *
 * @return array<int, array{role:string,meta:string}>
 */
function alex_cv_experience_rows() {
	$rows = array();
	foreach ( alex_cv_jobs() as $job ) {
		$rows[] = array(
			'role' => $job['role'],
			'meta' => $job['meta'],
		);
	}

	$rows[] = array(
		'role' => 'Based in Clapham, London',
		'meta' => 'Remote-friendly',
	);

	return $rows;
}

/**
 * Timeline rows (date, title, org, body).
 *
 * @return array<int, array{date:string,title:string,org:string,body:string}>
 */
function alex_cv_timeline_rows() {
	$rows = array();
	foreach ( alex_cv_jobs() as $job ) {
		$rows[] = array(
			'date'  => $job['date'],
			'title' => $job['title'],
			'org'   => $job['org'],
			'body'  => $job['body'],
		);
	}
	return $rows;
}

/**
 * Clear CV caches.
 */
function alex_cv_flush_cache() {
	delete_transient( 'alex_cv_jobs_v1' );
}

/**
 * Allow admins to force-refresh via ?alex_refresh_cv=1.
 */
function alex_cv_maybe_force_refresh() {
	if ( empty( $_GET['alex_refresh_cv'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		return;
	}
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	alex_cv_flush_cache();
	alex_cv_jobs( true );
}
add_action( 'init', 'alex_cv_maybe_force_refresh' );

/**
 * Warm the CV cache daily.
 */
function alex_cv_schedule_refresh() {
	if ( ! wp_next_scheduled( 'alex_cv_daily_refresh' ) ) {
		wp_schedule_event( time() + HOUR_IN_SECONDS, 'daily', 'alex_cv_daily_refresh' );
	}
}
add_action( 'after_switch_theme', 'alex_cv_schedule_refresh' );
add_action( 'init', 'alex_cv_schedule_refresh' );

add_action(
	'alex_cv_daily_refresh',
	function () {
		alex_cv_flush_cache();
		alex_cv_jobs( true );
	}
);
