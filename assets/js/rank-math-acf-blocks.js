/**
 * Pass rendered ACF block previews into Rank Math's content analysis.
 *
 * Watches the block canvas only, so sidebar updates do not retrigger a refresh.
 * Blocks must stay in preview mode for .acf-block-preview to exist.
 */
( function () {
	function canvas() {
		var frame = document.querySelector( 'iframe[name="editor-canvas"]' );
		return frame && frame.contentDocument ? frame.contentDocument : document;
	}

	function acfBlockHtml() {
		var nodes = canvas().querySelectorAll( '.acf-block-preview' );
		return Array.prototype.map.call( nodes, function ( node ) {
			return node.innerHTML;
		} ).join( '\n' );
	}

	wp.hooks.addFilter( 'rank_math_content', 'alex-theme', function ( content ) {
		return ( content || '' ) + '\n' + acfBlockHtml();
	} );

	var timer;
	function refresh() {
		clearTimeout( timer );
		timer = setTimeout( function () {
			if ( window.rankMathEditor ) {
				window.rankMathEditor.refresh( 'content' );
			}
		}, 1500 );
	}

	function watch() {
		var root = canvas().querySelector( '.is-root-container' );
		if ( ! root || root.__alexRankMathObserved ) {
			return !! root;
		}
		root.__alexRankMathObserved = true;
		new MutationObserver( refresh ).observe( root, { childList: true, subtree: true } );
		refresh();
		return true;
	}

	window.addEventListener( 'load', function () {
		var attempts = 0;
		var poll = setInterval( function () {
			attempts += 1;
			if ( watch() || attempts >= 12 ) {
				clearInterval( poll );
			}
		}, 500 );
	} );
} )();
