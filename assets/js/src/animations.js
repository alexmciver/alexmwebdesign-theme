/**
 * Shared motion — scroll reveals, nav state, cursor, scroll progress, burger.
 */
(function () {
  "use strict";

  var bp = 1000;
  var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  var isMobile = function () {
    return window.innerWidth <= bp;
  };

  // Scroll progress
  var progress = document.getElementById("scroll-progress");
  function updateProgress() {
    if (!progress) return;
    var doc = document.documentElement;
    var max = doc.scrollHeight - doc.clientHeight;
    var pct = max > 0 ? (doc.scrollTop / max) * 100 : 0;
    progress.style.width = pct + "%";
  }

  // Nav scroll state
  var nav = document.getElementById("nav");
  function updateNav() {
    if (!nav) return;
    if (window.scrollY > 40) {
      nav.classList.add("scrolled");
    } else {
      nav.classList.remove("scrolled");
    }
  }

  // Burger / mobile overlay
  var burger = document.getElementById("burger");
  var mobileNav = document.getElementById("mobile-nav");
  var menuOpenLabel = "Open menu";
  var menuCloseLabel = "Close menu";

  function getFocusable(container) {
    return Array.prototype.slice.call(
      container.querySelectorAll('a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])')
    );
  }

  function setMobileMenu(open) {
    if (!burger || !mobileNav) return;
    mobileNav.classList.toggle("open", open);
    burger.classList.toggle("open", open);
    burger.setAttribute("aria-expanded", open ? "true" : "false");
    burger.setAttribute("aria-label", open ? menuCloseLabel : menuOpenLabel);
    document.body.style.overflow = open ? "hidden" : "";

    if (open) {
      mobileNav.removeAttribute("hidden");
      var links = getFocusable(mobileNav);
      if (links.length) {
        links[0].focus();
      }
    } else {
      mobileNav.setAttribute("hidden", "");
      burger.focus();
    }
  }

  if (burger && mobileNav) {
    menuOpenLabel = burger.getAttribute("data-label-open") || burger.getAttribute("aria-label") || menuOpenLabel;
    menuCloseLabel = burger.getAttribute("data-label-close") || menuCloseLabel;

    burger.addEventListener("click", function () {
      setMobileMenu(!mobileNav.classList.contains("open"));
    });

    mobileNav.querySelectorAll("a").forEach(function (link) {
      link.addEventListener("click", function () {
        setMobileMenu(false);
      });
    });

    document.addEventListener("keydown", function (e) {
      if (!mobileNav.classList.contains("open")) return;

      if (e.key === "Escape") {
        e.preventDefault();
        setMobileMenu(false);
        return;
      }

      if (e.key !== "Tab") return;

      var focusable = getFocusable(mobileNav);
      if (!focusable.length) return;

      // Keep the burger in the tab cycle while the overlay is open.
      var cycle = [burger].concat(focusable);
      var first = cycle[0];
      var last = cycle[cycle.length - 1];

      if (e.shiftKey && document.activeElement === first) {
        e.preventDefault();
        last.focus();
      } else if (!e.shiftKey && document.activeElement === last) {
        e.preventDefault();
        first.focus();
      }
    });
  }

  // Scroll reveals
  function initReveals() {
    var els = document.querySelectorAll(".rv, .rv-left, .rv-right");
    if (!els.length) return;

    if (reduceMotion) {
      els.forEach(function (el) {
        el.classList.add("in");
      });
      return;
    }

    var io = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add("in");
            io.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12, rootMargin: "0px 0px -40px 0px" }
    );

    els.forEach(function (el) {
      io.observe(el);
    });
  }

  // Count-ups
  function initCountUps() {
    var counters = document.querySelectorAll("[data-count]");
    if (!counters.length) return;

    function setFinal(el) {
      var target = parseFloat(el.getAttribute("data-count"));
      var suffix = el.getAttribute("data-suffix") || "";
      if (isNaN(target)) return;
      el.textContent = Math.round(target) + suffix;
    }

    if (reduceMotion) {
      counters.forEach(setFinal);
      return;
    }

    var io = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          var el = entry.target;
          var target = parseFloat(el.getAttribute("data-count"));
          var suffix = el.getAttribute("data-suffix") || "";
          var duration = 1200;
          var start = performance.now();

          function tick(now) {
            var t = Math.min(1, (now - start) / duration);
            var eased = 1 - Math.pow(1 - t, 3);
            el.textContent = Math.round(target * eased) + suffix;
            if (t < 1) requestAnimationFrame(tick);
          }

          requestAnimationFrame(tick);
          io.unobserve(el);
        });
      },
      { threshold: 0.4 }
    );

    counters.forEach(function (el) {
      io.observe(el);
    });
  }

  // Custom cursor
  var cur = document.getElementById("cur");
  var curR = document.getElementById("cur-r");
  var mouseX = 0;
  var mouseY = 0;
  var ringX = 0;
  var ringY = 0;

  function initCursor() {
    if (!cur || !curR || reduceMotion) return;

    function syncVisibility() {
      var hide = isMobile();
      cur.style.display = hide ? "none" : "";
      curR.style.display = hide ? "none" : "";
      if (hide) {
        document.documentElement.classList.remove("cur-big", "cur-text");
      }
    }

    syncVisibility();
    window.addEventListener("resize", syncVisibility);

    document.addEventListener("mousemove", function (e) {
      mouseX = e.clientX;
      mouseY = e.clientY;
      cur.style.left = mouseX + "px";
      cur.style.top = mouseY + "px";
    });

    function animateRing() {
      if (!isMobile()) {
        ringX += (mouseX - ringX) * 0.18;
        ringY += (mouseY - ringY) * 0.18;
        curR.style.left = ringX + "px";
        curR.style.top = ringY + "px";
      }
      requestAnimationFrame(animateRing);
    }
    requestAnimationFrame(animateRing);

    var interactive = "a, button, .btn, [role='button'], .nav-burger, label";
    document.addEventListener("mouseover", function (e) {
      if (isMobile()) return;
      if (e.target.closest(interactive)) {
        document.documentElement.classList.add("cur-big");
      }
      if (e.target.closest("input, textarea, select")) {
        document.documentElement.classList.add("cur-text");
      }
    });
    document.addEventListener("mouseout", function (e) {
      if (e.target.closest(interactive)) {
        document.documentElement.classList.remove("cur-big");
      }
      if (e.target.closest("input, textarea, select")) {
        document.documentElement.classList.remove("cur-text");
      }
    });
  }

  // Magnetic buttons (subtle)
  function initMagnetic() {
    if (reduceMotion || isMobile()) return;
    document.querySelectorAll(".btn-primary, .btn-white").forEach(function (btn) {
      btn.addEventListener("mousemove", function (e) {
        var rect = btn.getBoundingClientRect();
        var x = e.clientX - rect.left - rect.width / 2;
        var y = e.clientY - rect.top - rect.height / 2;
        btn.style.transform = "translate(" + x * 0.12 + "px, " + (y * 0.12 - 2) + "px)";
      });
      btn.addEventListener("mouseleave", function () {
        btn.style.transform = "";
      });
    });
  }

  // Parallax (elements with data-parallax)
  function initParallax() {
    var nodes = document.querySelectorAll("[data-parallax]");
    if (!nodes.length || reduceMotion) return;

    function tick() {
      var vh = window.innerHeight;
      nodes.forEach(function (el) {
        var speed = parseFloat(el.getAttribute("data-parallax")) || 0.15;
        var rect = el.getBoundingClientRect();
        var mid = rect.top + rect.height / 2;
        var offset = (mid - vh / 2) * speed;
        el.style.transform = "translate3d(0, " + offset + "px, 0)";
      });
    }

    window.addEventListener("scroll", tick, { passive: true });
    tick();
  }

  // Hero code window stagger
  function initCodeWindow() {
    var codeWin = document.getElementById("code-win");
    if (!codeWin) return;

    var lines = codeWin.querySelectorAll(".cw-line");
    var termRows = codeWin.querySelectorAll(".term-row");

    function play() {
      lines.forEach(function (line, i) {
        setTimeout(function () {
          line.classList.add("show");
        }, i * 80);
      });
      termRows.forEach(function (row, i) {
        setTimeout(function () {
          row.classList.add("show");
        }, lines.length * 80 + i * 150);
      });
    }

    if (reduceMotion) {
      lines.forEach(function (line) {
        line.classList.add("show");
      });
      termRows.forEach(function (row) {
        row.classList.add("show");
      });
      return;
    }

    if (codeWin.getBoundingClientRect().top < window.innerHeight) {
      play();
      return;
    }

    var obs = new IntersectionObserver(
      function (entries) {
        if (entries[0].isIntersecting) {
          play();
          obs.disconnect();
        }
      },
      { threshold: 0.35 }
    );
    obs.observe(codeWin);
  }

  // FAQ accordion
  function initFaq() {
    var lists = document.querySelectorAll("[data-faq]");
    if (!lists.length) return;

    lists.forEach(function (list) {
      list.querySelectorAll(".faq-q").forEach(function (btn) {
        btn.addEventListener("click", function () {
          var item = btn.closest(".faq-item");
          var panel = item ? item.querySelector(".faq-a") : null;
          if (!panel) return;

          var open = btn.getAttribute("aria-expanded") === "true";

          list.querySelectorAll(".faq-item").forEach(function (other) {
            var otherBtn = other.querySelector(".faq-q");
            var otherPanel = other.querySelector(".faq-a");
            if (!otherBtn || !otherPanel) return;
            otherBtn.setAttribute("aria-expanded", "false");
            otherPanel.hidden = true;
          });

          if (!open) {
            btn.setAttribute("aria-expanded", "true");
            panel.hidden = false;
          }
        });
      });
    });
  }

  function onScroll() {
    updateProgress();
    updateNav();
  }

  document.addEventListener("DOMContentLoaded", function () {
    updateProgress();
    updateNav();
    initReveals();
    initCountUps();
    initCursor();
    initMagnetic();
    initParallax();
    initCodeWindow();
    initFaq();
    window.addEventListener("scroll", onScroll, { passive: true });
  });
})();
