<?php
/**
 * Hero block — two-column home hero with live code window.
 */
$contact_page = get_page_by_path( 'contact' );
$contact_url  = $contact_page ? get_permalink( $contact_page ) : home_url( '/contact/' );
$calendly = 'https://calendly.com/alexmwebdesign/1-hour-website-chat';
?>
<section class="hero hero-parallax" aria-label="<?php esc_attr_e( 'Freelance WordPress and Shopify Developer London', 'alex-theme' ); ?>">
	<div class="hero-bg-parallax" data-parallax="0.12" aria-hidden="true"></div>
	<div class="hero-grid-lines" aria-hidden="true"></div>

	<div class="hero-left">
		<div class="hero-pill">Available · London &amp; remote</div>
		<h1>Websites that<br><em>actually</em> bring<br>in <span class="ol">customers.</span></h1>
		<p class="hero-sub">Freelance WordPress &amp; Shopify developer based in London — 5+ years building fast, conversion-ready sites for small businesses. No jargon. No stress. Just results.</p>
		<div class="hero-btns">
			<a href="<?php echo esc_url( $calendly ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
				Book a free call
				<svg width="13" height="13" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</a>
			<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn-outline-white">Send a message</a>
		</div>
		<div class="hero-stats">
			<div class="stat">
				<div class="stat-n" data-count="5" data-suffix="+">0</div>
				<div class="stat-l">Years experience</div>
			</div>
			<div class="stat">
				<div class="stat-n" data-count="30" data-suffix="+">0</div>
				<div class="stat-l">Sites delivered</div>
			</div>
			<div class="stat">
				<div class="stat-n" data-count="100" data-suffix="%">0</div>
				<div class="stat-l">Client satisfaction</div>
			</div>
			<div class="stat">
				<div class="stat-n">2</div>
				<div class="stat-l">Platforms mastered</div>
			</div>
		</div>
	</div>

	<div class="hero-right">
		<div class="code-win" id="code-win">
			<div class="cw-bar">
				<div class="cw-dot r"></div>
				<div class="cw-dot y"></div>
				<div class="cw-dot g"></div>
				<span class="cw-title">custom-checkout.php</span>
			</div>
			<div class="cw-body">
				<span class="cw-line"><span class="cm">// WooCommerce — inject trust signals</span></span>
				<span class="cw-line"><span class="fn">add_action</span>(<span class="str">'woocommerce_checkout_order_review'</span>,</span>
				<span class="cw-line">  <span class="kw">function</span>() {</span>
				<span class="cw-line">    <span class="var">$total</span> = <span class="fn">WC</span>()-&gt;cart-&gt;<span class="fn">get_total</span>();</span>
				<span class="cw-line">    <span class="fn">echo</span> <span class="str">'&lt;div class="trust-wrap"&gt;'</span>;</span>
				<span class="cw-line">    <span class="fn">render_trust_badge</span>(<span class="var">$total</span>);</span>
				<span class="cw-line">    <span class="fn">echo</span> <span class="str">'&lt;/div&gt;'</span>;</span>
				<span class="cw-line">  }, <span class="num">20</span>);</span>
				<span class="cw-line">&nbsp;</span>
				<span class="cw-line"><span class="cm">// Shopify Liquid — featured products</span></span>
				<span class="cw-line"><span class="tag">{% for</span> <span class="var">p</span> <span class="tag">in</span> <span class="var">collection.products limit: 4</span> <span class="tag">%}</span></span>
				<span class="cw-line">  {{ <span class="var">p.title</span> | <span class="fn">escape</span> }}<span class="cw-cur"></span></span>
			</div>
			<div class="term-win">
				<div class="term-bar">
					<div class="cw-dot r"></div>
					<div class="cw-dot y"></div>
					<div class="cw-dot g"></div>
					<span class="cw-title">site-audit</span>
				</div>
				<div class="term-body">
					<div class="term-row"><span class="t-prompt">$</span><span class="t-dim">run-audit alexmwebdesign.co.uk</span></div>
					<div class="term-row"><span class="t-ok">✓</span><span class="t-dim">Page speed: 98 / 100</span></div>
					<div class="term-row"><span class="t-ok">✓</span><span class="t-dim">Core Web Vitals: Passed</span></div>
					<div class="term-row"><span class="t-ok">✓</span><span class="t-dim">SEO score: 95 / 100</span></div>
					<div class="term-row"><span class="t-ok">✓</span><span class="t-dim">SSL: Secure</span></div>
				</div>
			</div>
		</div>
	</div>
</section>
