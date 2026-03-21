=== NeuralFlow AI Act Badge ===
Contributors: omergili
Tags: ai-act, eu-ai-act, transparency, compliance, ai-disclosure, gdpr, badge, article-50
Requires at least: 5.0
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 1.0.0
License: MIT
License URI: https://opensource.org/licenses/MIT

AI transparency badge for EU AI Act Article 50 compliance. One click. Zero cookies.

== Description ==

**The cookie banner for AI. One click install. EU AI Act ready.**

The EU AI Act (Article 50) requires AI-generated content to be labeled — machine-readable and human-visible. Enforcement starts **August 2, 2026**. Penalties: up to **EUR 15 million** or 3% of annual global turnover.

This plugin adds a compliant AI transparency badge to your WordPress site:

* **Visible badge** — "AI Transparent" / "KI-Transparent" in configurable position
* **Disclosure popup** — click for full Article 50 compliant text
* **JSON-LD metadata** — schema.org structured data in `<head>` (server-side, SEO-friendly)
* **HTML meta tags** — `ai-generated`, `ai-system`, `ai-operator`
* **Zero cookies** — no tracking, no personal data, GDPR friendly
* **4.8 KB** — tiny footprint, served from jsDelivr CDN

= How it works =

1. Install and activate the plugin
2. Go to Settings → AI Act Badge
3. Enter your company name and AI system (e.g. ChatGPT, Claude)
4. Save. Done.

The badge appears on all pages. Metadata is injected server-side (visible to search engines without JavaScript).

= What it does NOT do =

* No cookies
* No tracking
* No external requests except loading the badge script from jsDelivr CDN
* No personal data collection
* No account required

= Open Source =

This plugin is MIT licensed. The badge widget is open source: [GitHub](https://github.com/omergili/neuralflow).

Built and operated by AI (Claude Opus 4.6). Owner: Olaf Mergili.

== Installation ==

1. Upload the plugin files to `/wp-content/plugins/neuralflow-ai-act/` or install through the WordPress plugins screen
2. Activate the plugin
3. Go to Settings → AI Act Badge
4. Enter your company name and the AI system you use
5. Save settings

== Frequently Asked Questions ==

= Is this plugin free? =

Yes, completely free and open source (MIT license). No premium tier, no upsells.

= Does it set cookies? =

No. Zero cookies. The badge runs entirely client-side with no data collection.

= Does it slow down my site? =

No. The badge script is 4.8 KB (minified), loaded asynchronously from jsDelivr CDN. It has zero dependencies.

= What AI systems should I list? =

Any AI system you use to create or assist content on your website. Examples: ChatGPT, Claude, Midjourney, DALL-E, Gemini, Copilot. If you use multiple, separate them with commas.

= Is this legally sufficient for AI Act compliance? =

This plugin helps with the technical implementation of transparency disclosure. It does not constitute legal advice. Consult a lawyer for your specific compliance needs.

= When does the AI Act enforcement start? =

Article 50 transparency obligations apply from August 2, 2026.

= What is the penalty for non-compliance? =

Up to EUR 15 million or 3% of annual worldwide turnover (whichever is higher).

== Screenshots ==

1. Settings page — configure your company name, AI system, language, and badge position
2. Frontend badge — small, non-intrusive badge in the corner of your website
3. Disclosure popup — full Article 50 compliant text, accessible on click

== Changelog ==

= 1.0.0 =
* Initial release
* Visible AI transparency badge (DE/EN)
* JSON-LD metadata injection (server-side)
* HTML meta tags (ai-generated, ai-system, ai-operator)
* Settings page with live preview info
* Position selector (4 corners)
* Language selector (German/English)

== Upgrade Notice ==

= 1.0.0 =
Initial release. Install before August 2, 2026 to be ready for EU AI Act enforcement.
