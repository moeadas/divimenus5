/* DiviMenus5 Frontend JS v1.0.0 */
(function($) {
	'use strict';

	window.dm5 = window.dm5 || {};

	/**
	 * Get selector from data attributes for popup/flyout targeting
	 */
	dm5.getShowSelector = function(id, cls) {
		var parts = [];
		if (id && id.length) parts.push('#' + id.trim().replace(/,\s*$/, '').replace(/,\s*/g, ',#'));
		if (cls && cls.length) parts.push('.' + cls.trim().replace(/,\s*$/, '').replace(/,\s*/g, ',.'));
		return parts.filter(Boolean).join(',');
	};

	/**
	 * Device visibility helper
	 */
	dm5.isDevice = function($el, cls, clsD, clsT, clsP) {
		return $el.hasClass(cls) ||
			$el.hasClass(clsD) && window.innerWidth > 980 ||
			$el.hasClass(clsT) && window.innerWidth > 767 && window.innerWidth < 981 ||
			$el.hasClass(clsP) && window.innerWidth < 768;
	};

	/**
	 * Close all open menus on a given device breakpoint
	 */
	dm5.closeAll = function(cls) {
		$('.dd-divimenu').each(function() {
			if ($(this).hasClass(cls)) {
				$(this).removeClass('dd-divimenu-open');
				dm5.toggle($(this).find('.dd-menu-button-content'), 'remove');
			} else {
				$(this).addClass('dd-divimenu-open');
			}
		});
	};

	/**
	 * Toggle item active state
	 */
	dm5.toggle = function($el, action, animate, $target, isFlyout) {
		var isActiveUrl = $el.hasClass('active-url');

		if (action === 'remove' && !isActiveUrl) {
			$el.removeClass('active dd-item-open');
		} else if (action === 'toggle') {
			$el.hasClass('active') ? $el.removeClass('active dd-item-open') : $el.addClass('active dd-item-open');
		} else if (action === 'active-url') {
			$el.addClass('active active-url');
		} else if (action === 'add') {
			$el.addClass('active dd-item-open');
		} else {
			$el.toggleClass('active dd-item-open');
		}

		if (animate && $target) {
			dm5.animatePopup($el, $target, $el.hasClass('dd-item-open'), isFlyout);
		} else if (animate) {
			$target.show();
			dm5.processAnimation($target, true);
		} else {
			$target.hide();
		}
	};

	/**
	 * Animate popup open/close
	 */
	dm5.animatePopup = function($trigger, $popup, open, isFlyout) {
		var fxIn = $trigger.attr('data-effect-in') || 'fade';
		var fxOut = $trigger.attr('data-effect-out') || 'fade';
		var ms = parseInt($trigger.attr('data-effect-ms')) || 300;

		if (open) {
			$popup.show();
			if (fxIn === 'fade') {
				$popup.fadeIn(ms);
			} else if (fxIn === 'slidedown') {
				$popup.slideDown(ms);
			} else {
				dm5.slideTranslate($popup, 100, ms, 'down');
			}
			$(document).trigger('divimenu-showing', [$trigger, $popup, $popup]);
			if (window.et_pb_init_modules) window.et_pb_init_modules();
		} else {
			if (fxOut === 'fade') {
				$popup.fadeOut(ms, function() { $popup.hide().parent('.dd-popup-c').hide(); dm5.onPopupClose($trigger); });
			} else if (fxOut === 'slideup') {
				$popup.slideUp(ms, function() { $popup.hide().parent('.dd-popup-c').hide(); dm5.onPopupClose($trigger); });
			} else {
				$popup.hide().parent('.dd-popup-c').hide();
				dm5.onPopupClose($trigger);
			}
		}
	};

	dm5.slideTranslate = function($el, range, ms, dir) {
		$('#page-container').css('overflow', 'hidden');
		var x = 0, y = 0;
		if (dir === 'left' || dir === 'right') x = dir === 'left' ? -range : range;
		if (dir === 'up' || dir === 'down') y = dir === 'up' ? -range : range;
		$el.animate({ range: dir === 'left' || dir === 'right' ? x : y }, {
			step: function(val) {
				var cx = x ? val : 0;
				var cy = y ? val : 0;
				$(this).css({ transform: 'translate3d(' + cx + '%,' + cy + '%, 0px)' });
			},
			duration: ms,
			done: function() {
				$(this).css('transform', '');
				$('#page-container').css('overflow', '');
			}
		});
	};

	dm5.processAnimation = function($el, show) {
		if (window.et_process_animation_data) {
			if (show) {
				if (window.et_has_animation_data($el)) window.et_remove_animation($el);
			} else {
				$el.add($el.find('div')).each(function() {
					if (window.et_has_animation_data($(this))) {
						$(this).removeClass('et_had_animation');
						window.et_process_animation_data($(this));
					}
				});
			}
		}
	};

	dm5.onPopupClose = function($trigger) {};

	/**
	 * Show/hide tooltip on hover
	 */
	dm5.handleHover = function($el, show) {
		if (show) {
			$el.addClass('hover');
			if (!$el.hasClass('active')) {
				$el.parent().parent('.dd-divimenu-open').length || dm5.showDesktopValue($el);
			}
		} else {
			$el.removeClass('hover');
			if (!$el.hasClass('active')) {
				$el.parent().parent('.dd-divimenu-open').length || dm5.showDesktopValue($el);
			}
		}
	};

	/**
	 * Switch multi-value element (img/text) between desktop/hover states
	 */
	dm5.showDesktopValue = function($el) {
		$el.parent().find('.dd-multi-value').each(function() {
			var $t = $(this);
			if ($t.is('img')) {
				$t.attr('src', $t.attr('data-desktop') || $t.attr('src'));
			} else {
				$t.html($t.attr('data-desktop') || $t.html());
			}
		});
	};

	dm5.showHoverValue = function($el) {
		$el.parent().find('.dd-multi-value').each(function() {
			var $t = $(this);
			if ($t.is('img')) {
				$t.attr('src', $t.attr('data-hover') || $t.attr('src'));
			} else {
				$t.html($t.attr('data-hover') || $t.html());
			}
		});
	};

	/**
	 * Handle responsive menu switching
	 */
	dm5.handleDiviMenu = function() {
		$('.dd-wrapper').css('display', '');

		if (window.innerWidth > 980) {
			dm5.closeAll('dd-closed-desktop');
		} else if (window.innerWidth > 767 && window.innerWidth < 981) {
			dm5.closeAll('dd-closed-tablet');
		} else {
			dm5.closeAll('dd-closed-phone');
		}

		// Handle full-width sub-menus
		$('.dd-sub-fw').each(function() {
			var rect = $(this).get(0).getBoundingClientRect();
			if (dm5.isDevice($(this), 'dd-h', 'dd-h-d', 'dd-h-t', 'dd-h-p') ||
				dm5.isDevice($(this), 'dd-h-c', 'dd-h-c-d', 'dd-h-c-t', 'dd-h-c-p')) {
				$(this).find('.dd-menu-flex-sub').css({ left: 0 - rect.left, right: 0 - (document.body.clientWidth - rect.right) });
			} else {
				$(this).find('.dd-menu-flex-sub').css({ left: '', right: '' });
			}
		});
	};

	dm5.isBuilder = function() {
		return window.et_builder_utils_params && window.et_builder_utils_params.builderType === 'fe';
	};

	dm5.isCoarse = function() {
		return window.matchMedia('(pointer: coarse)').matches;
	};

	dm5.initActive = function() {
		$('.dd-item').each(function() { dm5.toggle($(this), ''); });
	};

	dm5.initModule = function() {
		$('.dd-divimenu').each(function() {
			$(this).parents('.et_pb_column').first().addClass('dd-has-divimenu');
		});

		dm5.handleDiviMenu();

		if (dm5.isBuilder()) {
			// Mark active URLs in builder mode
			$('.dd-mi.dd-active-url>a').each(function() {
				var href = $(this).attr('href');
				try { var u = new URL(href); var t = u.hostname + u.pathname; } catch(e) { var t = href; }
				var isCurrent = window.location.hostname === t || window.location.hostname + '/' === t;
				if ((isCurrent && '/' === window.location.pathname) || (!isCurrent && (window.location.hostname + window.location.pathname).indexOf(t) > -1)) {
					dm5.toggle($(this).closest('.dd-mi-w').find('.dd-item, .dd-tooltip'), 'active-url');
				}
			});
		}

		// Re-init Divi modules inside popups
		$('.dd-popup-c:not(.dds-popup-c)').each(function() {
			var $parent = $('#main-content .et-l--body').length ? '#main-content .et-l--body' :
				$('#main-content .et-l--post').length ? '#main-content .et-l--post' :
				'#page-container';
			$($parent).prepend($(this).detach());
		});

		dm5.initActive();
	};

	// DOM ready
	$(function() {
		dm5.initModule();

		var stickyObserver = new MutationObserver(function(mutations) {
			mutations.forEach(function(m) {
				if ($(m.target).attr('data-sticky') && $(m.target).closest('.et_pb_sticky').length) {
					$(m.target).attr('src', $(m.target).attr('data-sticky')).removeAttr('srcset');
				}
			});
		});

		$('.dd-logo img').each(function() {
			stickyObserver.observe(this, { attributes: true, attributeFilter: ['srcset'] });
		});

		// Window resize
		$(window).on('resize', function() { dm5.handleDiviMenu(); });

		// Scroll handler
		$(window).on('scroll resize', function() {
			var scrollTop = $(this).scrollTop();
			$('.dd-mi.dd-active-url>a[href^="#"]').each(function() {
				var $a = $(this);
				var $target = $($a.attr('href'));
				var offset = 0;
				$('#wpadminbar, header .et_pb_section--fixed:visible, header .et_pb_sticky--top, .et-fixed-header').each(function() { offset += $(this).outerHeight(); });
				if ($target.length && Math.floor($target.offset().top) <= scrollTop + offset && Math.floor($target.offset().top + $target.outerHeight()) > scrollTop + offset) {
					dm5.toggle($a.closest('.dd-mi-w').find('.dd-item, .dd-tooltip'), 'active-url');
				} else {
					$a.closest('.dd-mi-w').find('.dd-item, .dd-tooltip').removeClass('active-url');
					dm5.toggle($a.closest('.dd-mi-w').find('.dd-item, .dd-tooltip'), 'remove');
				}
			});
		});

		// Document click/keydown
		$(document).on('click keydown', function(e) {
			if (e.type === 'keydown' && e.key !== 'Enter') return;
			var $t = $(e.target);

			// Close clicked popups
			$('.dd-popup-c.open').each(function() {
				var $popup = $(this);
				if ($t.closest('.dd-popup-c').length && !$t.closest('.dd-mi, .dd-menu-item-modal, .mfp-wrap').length) {
					$popup.removeClass('open').hide();
				}
			});

			// Collapse accordion
			if ($t.is('.dd-collapse')) {
				e.preventDefault();
				var $parent = $t.closest('li');
				$parent.find('ul').first().hide();
				dm5.toggle($t.closest('a'), 'remove');
			}
		});

		// Focus handling for accessibility
		$(document).on('focusin', function(e) {
			if ($(e.target).closest('.dd-sub-hover').length) e.preventDefault();
		});

		$(document).on('focusout', function(e) {
			if ($(e.target).is('.dd-item')) dm5.toggle($(e.target), '');
		});

		// Escape key closes popups
		$(document).on('keydown', function(e) {
			if (e.key === 'Escape' && $('.dd-popup-c.open').length) {
				$('.dd-popup-c.open').removeClass('open').hide();
			}
		});

		// WooCommerce password init
	$('body').on('divipasswords', function() { dm5.initModule(); });

		// Menu button click
		$('body').on('click keydown', '.dd-divimenu .dd-menu-button-content, .dd-menu-button .dd-title-clickable span', function(e, noAnim) {
			if (e.type === 'keydown' && e.key !== 'Enter' && e.key !== ' ') return;
			var $mb = $(this);
			if ($mb.is('.dd-title-clickable span')) $mb = $mb.closest('.dd-dm').find('.dd-menu-button-content');
			$mb.closest('.dd-divimenu').toggleClass('dd-divimenu-open');
			$mb.closest('.dd-divimenu-open').length ? $mb.attr('aria-pressed', 'true') : $mb.attr('aria-pressed', 'false');
			setTimeout(function() {
				if (typeof $mb.closest('.dd-dm:not(.dd-fixed)').divimenus_handle_overflow === 'function') {
					$mb.closest('.dd-dm:not(.dd-fixed)').divimenus_handle_overflow();
				}
			}, 300);
		});

		// Menu item link click
		$('body').on('click keydown', '.dd-mi>a, .dd-menu-items .dd-title-clickable span', function(e, noAnim) {
			if (e.type === 'keydown' && e.key !== 'Enter') return;
			var $mi = $(this).is('.dd-title-clickable span') ? $(this).closest('.dd-mi-w').find('.dd-mi>a') : $(this);
			var url = $mi.attr('href');

			if ($mi.hasClass('dd-modal')) {
				e.preventDefault();
				var popupId = $mi.attr('data-popup-id');
				if (popupId) {
					var $popup = $('#' + popupId);
					$popup.css('display', 'flex').toggleClass('open');
					dm5.toggle($mi.closest('.dd-mi-w').find('.dd-item, .dd-tooltip'), 'add', true, $popup.find('.dd-menu-item-modal'), false);
					$('.dd-divimenu').css('pointer-events', 'auto');
				}
			} else if ($mi.hasClass('dd-show')) {
				if (!$mi.hasClass('dd-open-url') || dm5.isCoarse()) e.preventDefault();
				dm5.toggle($mi.closest('.dd-mi-w').find('.dd-item, .dd-tooltip'), $mi.hasClass('dd-toggle') ? 'toggle' : 'add', true, $(dm5.getShowSelector($mi.attr('data-id'), $mi.attr('data-class'))), false);
			} else if ($mi.hasClass('dd-sub')) {
				if (!$mi.hasClass('dd-open-url') || dm5.isCoarse()) e.preventDefault();
				if (!dm5.isDevice($mi.parent(), 'dd-h', 'dd-h-d', 'dd-h-t', 'dd-h-p')) {
					e.preventDefault();
					$mi.attr('aria-expanded', $mi.attr('aria-expanded') === 'true' ? 'false' : 'true');
					dm5.toggle($mi.children(), 'toggle', true, $mi.siblings(), true);
				}
			} else if (url === '#') {
				e.preventDefault();
			}
		});

		// Tooltip hover
		$('body').on('mouseenter', '.dd-tooltip .dd-title', function() {
			$(this).closest('.dd-menu-button, .dd-mi-w').find('.dd-item').trigger('mouseenter');
		});
		$('body').on('mouseleave', '.dd-tooltip .dd-title', function() {
			$(this).closest('.dd-menu-button, .dd-mi-w').find('.dd-item').trigger('mouseleave');
		});

		// Item hover
		$('body').on('mouseenter', '.dd-menu-button-content, .dd-menu-item-content', function() {
			dm5.handleHover($(this).add($(this).closest('.dd-menu-button-content, .dd-menu-item').siblings('.dd-tooltip.dd-hover-enabled').find('.dd-title')), false);
		});
		$('body').on('mouseleave', '.dd-menu-button-content, .dd-menu-item-content', function() {
			$(this).removeClass('hover');
			if (!$(this).hasClass('active')) {
				$(this).parent().parent('.dd-divimenu-open').length || dm5.showDesktopValue($(this));
			}
		});
	});
})(jQuery);
