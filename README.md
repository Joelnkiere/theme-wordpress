# AmCham DRC WordPress theme

A responsive WordPress theme built from the supplied AmCham DRC website reference. It is a classic PHP theme and does not require a page builder.

## Install

1. Zip this folder, or use the included `amcham-drc-theme.zip` archive.
2. In WordPress, go to **Appearance → Themes → Add New → Upload Theme**.
3. Upload the archive, activate **AmCham DRC**, then create the pages used in the menu (About, Events, Partners, Membership, Resources, Contact, and News).
4. Assign a menu to **Primary navigation** under **Appearance → Menus**. The theme uses a built-in navigation fallback until a menu is assigned.

## Editing the homepage

Use **Appearance → Customize → Homepage content** to change the hero copy and contact email. Homepage calls-to-action use normal WordPress URLs, so create the corresponding pages or adjust the links in `front-page.php`.

## Theme structure

- `front-page.php` — the complete AmCham landing page.
- `header.php` / `footer.php` — reusable navigation and footer.
- `page.php` / `index.php` — default content and news templates.
- `assets/images` — local copies of the visual assets from the supplied reference, so the theme does not depend on Wix at runtime.
- `assets/css/theme.css` — responsive visual system.
