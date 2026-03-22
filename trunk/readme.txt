=== NeuralFlow AI Act Badge ===
Contributors: omergili
Tags: ai-act, transparency, compliance, ai-disclosure, badge
Requires at least: 5.0
Tested up to: 6.7
Stable tag: 2.0.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

AI transparency badge for EU AI Act Article 50 compliance. One click. Zero cookies. Zero tracking.

== Description ==

**The cookie banner for AI. One click install. EU AI Act ready.**

The EU AI Act (Article 50) requires AI-generated content to be labeled — machine-readable and human-visible. Enforcement starts **August 2, 2026**. Penalties: up to **EUR 15 million** or 3% of annual global turnover.

This plugin adds a compliant AI transparency badge to your WordPress site:

* **Visible badge** — "AI Transparent" / "KI-Transparent" in configurable position
* **Disclosure popup** — click for full Article 50 compliant text
* **JSON-LD metadata** — schema.org structured data in head (server-side, SEO-friendly)
* **HTML meta tags** — ai-generated, ai-system, ai-operator
* **Zero cookies** — no tracking, no personal data, GDPR friendly
* **5 KB** — tiny footprint, served locally (no external requests)
* **Cache-plugin compatible** — works with LiteSpeed, WP Rocket, Autoptimize, Cloudflare

= How it works =

1. Install and activate the plugin
2. Go to Settings → AI Act Badge
3. Enter your company name and AI system (e.g. ChatGPT, Claude)
4. Save. Done.

The badge appears on all pages. Metadata is injected server-side (visible to search engines without JavaScript).

= Privacy =

This plugin makes **no external HTTP requests**. All JavaScript is served locally from within the plugin directory. No cookies are set. No personal data is collected or transmitted. No account required.

= Open Source =

This plugin is GPL-2.0-or-later licensed. Source code: [GitHub](https://github.com/omergili/neuralflow-wp).

The badge widget is part of the [@neuralflow/ai-act](https://github.com/omergili/neuralflow) open source project (MIT license).

== Installation ==

1. Upload the plugin files to `/wp-content/plugins/neuralflow-ai-act/` or install through the WordPress plugins screen
2. Activate the plugin
3. Go to Settings → AI Act Badge
4. Enter your company name and the AI system you use
5. Save settings

== Frequently Asked Questions ==

= Is this plugin free? =

Yes, completely free and open source (GPL-2.0-or-later). No premium tier, no upsells.

= Does it set cookies? =

No. Zero cookies. The badge runs entirely client-side with no data collection.

= Does it make external requests? =

No. All JavaScript is bundled locally in the plugin. No CDN, no analytics, no tracking.

= Does it slow down my site? =

No. The badge script is 5 KB (minified) and loaded from your own server. It has zero dependencies.

= Does it work with caching plugins? =

Yes. Tested with LiteSpeed Cache, WP Rocket, Autoptimize, and Cloudflare. The script is automatically excluded from JS optimization to ensure compatibility.

= What AI systems should I list? =

Any AI system you use to create or assist content on your website. Examples: ChatGPT, Claude, Midjourney, DALL-E, Gemini, Copilot. Multiple systems: separate with commas.

= Is this legally sufficient for AI Act compliance? =

This plugin helps with the technical implementation of transparency disclosure. It does not constitute legal advice. Consult a lawyer for your specific compliance needs.

= When does the AI Act enforcement start? =

Article 50 transparency obligations apply from August 2, 2026.

== Screenshots ==

1. Settings page — configure your company name, AI system, language, and badge position
2. Frontend badge — small, non-intrusive badge in the corner of your website
3. Disclosure popup — full Article 50 compliant text, accessible on click

== Changelog ==

= 2.0.0 =
* JavaScript served locally (no external CDN requests)
* License changed to GPL-2.0-or-later for WordPress.org compatibility
* Cache-plugin compatibility (LiteSpeed, WP Rocket, Autoptimize, Cloudflare)
* Proper wp_enqueue_script with script_loader_tag filter
* Uninstall hook for clean removal
* WordPress coding standards

= 1.0.0 =
* Initial release
* Visible AI transparency badge (DE/EN)
* JSON-LD metadata injection (server-side)
* HTML meta tags (ai-generated, ai-system, ai-operator)
* Settings page with position and language selector

== Upgrade Notice ==

= 2.0.0 =
Major update: JS now served locally, cache-plugin compatible, GPL licensed. Install before August 2, 2026.
