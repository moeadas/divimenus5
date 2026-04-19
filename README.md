# DiviMenus5

A powerful circular/horizontal/vertical menu builder for Divi 5 with flyouts, popups, and Visual Builder support. No license required.

## Features

- **Circular Menu** — Place items around a central point in a circular arrangement
- **Horizontal Menu** — Linear left-to-right (or right-to-left) menu layout
- **Vertical Menu** — Top-to-bottom menu layout
- **Flyout Menus** — Sub-menus that appear on hover/click
- **Popup Menus** — Items that open content in a popup overlay
- **Flex Menu** — Flexible box-based menu layout with logo and item alignment
- **Full Visual Builder Support** — Configure everything in Divi's builder
- **WooCommerce Cart Support** — Display cart count in menus

## Installation

1. Download `DiviMenus5-V4.zip`
2. Go to **WordPress Admin → Plugins → Add New → Upload Plugin**
3. Upload the zip and click **Activate**

## Usage

### DiviMenu Module

Add a **DiviMenu** module to your page, then click **Add Menu Item** to create items. Configure:

- **Menu Shape** — Circular / Horizontal / Vertical
- **Menu Button** — The trigger button that opens/closes the menu
- **Menu Items** — Individual items with icon, image, text, or combination
- **Positions & Layout** — Fine-tune item placement, spacing, and alignment

### DiviMenu Flex Module

A flexible menu layout ideal for headers and navigation bars. Supports:

- Logo placement (left/center/right)
- Flex direction (row/column)
- Item alignment
- Responsive behavior

## Requirements

- Divi Theme (or Divi Builder plugin) **Divi 4 or Divi 5**
- WordPress 6.0+
- PHP 7.4+

## File Structure

```
DiviMenus5/
├── divimenus5.php              # Main plugin bootstrap
├── includes/
│   ├── core.php               # Layout category registration
│   ├── dm5-extension.php      # DiviExtension subclass
│   ├── dm5-helper.php         # Utility functions
│   ├── loader.php             # Autoloader
│   └── modules/
│       ├── DiviMenus5/        # Circular/horiz/vertical menus
│       │   ├── DiviMenus5.php
│       │   ├── DiviMenus5_Module.php
│       │   ├── DiviMenus5_Item_Module.php
│       │   └── loader.php
│       └── DiviMenus5Flex/    # Flex menu
│           ├── DiviMenus5Flex.php
│           ├── DiviMenus5Flex_Module.php
│           ├── DiviMenus5Flex_Item_Module.php
│           └── loader.php
├── scripts/
│   └── frontend.js            # Client-side menu interactions
└── styles/
    └── frontend.css           # Menu styling
```

## Development

```bash
# Install dependencies (if adding JSX/React support)
yarn install

# Start build in watch mode
yarn start

# Production build
yarn build
```

## Notes

- This is a **standalone rebuild** of the original DiviMenus plugin, built from scratch for Divi 5 compatibility
- No license or authentication system is included
- All original DiviMenus features are replicated
- JSX/React components for the Visual Builder are planned for a future release

## License

GPL2
