/**
 * Shared motion — nav, burger, reveals, marquees, service previews.
 */
(function () {
  "use strict";

  var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  var nav = document.getElementById("nav");
  function updateNav() {
    if (!nav) return;
    if (window.scrollY > 40) {
      nav.classList.add("scrolled");
    } else {
      nav.classList.remove("scrolled");
    }
  }

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
      if (links.length) links[0].focus();
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

  function initReveals() {
    var els = document.querySelectorAll(".rv, .rv-left, .rv-right, .img-reveal");
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
      { threshold: 0.14, rootMargin: "0px 0px -8% 0px" }
    );

    els.forEach(function (el) {
      io.observe(el);
    });
  }

  function initHeroVisual() {
    var visual = document.querySelector(".hero-visual");
    if (!visual) return;
    if (reduceMotion) {
      visual.classList.add("is-in");
      return;
    }
    requestAnimationFrame(function () {
      visual.classList.add("is-in");
    });
  }

  function initMarquees() {
    if (reduceMotion) return;
    document.querySelectorAll("[data-marquee]").forEach(function (el) {
      el.classList.add("is-running", "marquee");
    });
  }

  function initServicePreviews() {
    var section = document.querySelector("[data-service-preview]");
    if (!section) return;

    var preview = section.querySelector(".services__preview");
    var images = preview ? preview.querySelectorAll("img") : [];
    var rows = section.querySelectorAll(".services__row[data-preview-id]");
    if (!preview || !images.length || !rows.length) return;

    function show(id) {
      preview.classList.add("is-on");
      images.forEach(function (img) {
        img.classList.toggle("is-active", img.getAttribute("data-preview") === String(id));
      });
    }

    function hide() {
      preview.classList.remove("is-on");
      images.forEach(function (img) {
        img.classList.remove("is-active");
      });
    }

    rows.forEach(function (row) {
      row.addEventListener("mouseenter", function () {
        show(row.getAttribute("data-preview-id"));
      });
      row.addEventListener("focus", function () {
        show(row.getAttribute("data-preview-id"));
      });
    });

    section.addEventListener("mouseleave", hide);
    section.addEventListener("focusout", function (e) {
      if (!section.contains(e.relatedTarget)) hide();
    });
  }

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

  document.addEventListener("DOMContentLoaded", function () {
    updateNav();
    initReveals();
    initHeroVisual();
    initMarquees();
    initServicePreviews();
    initFaq();
    window.addEventListener("scroll", updateNav, { passive: true });
  });
})();
