# DiviMenus5

A powerful circular, horizontal, and vertical menu builder for Divi with flyouts, popups, and full Visual Builder support. No license required.

## Requirements

- Divi Theme (by Elegant Themes)
- WordPress 6.0+
- PHP 7.4+

## Installation

1. Upload the `DiviMenus5` folder to `/wp-content/plugins/`
2. Activate via **Plugins → Installed Plugins** in WordPress admin
3. Open the Divi Visual Builder and find **DiviMenus5** modules in the module picker

## Module Structure

```
includes/
├── loader.php                          ← Loads all module loaders
├── dm5-helper.php                      ← Shared helper class (DiviMenusHelper)
├── core.php                            ← Layout category registration
└── dm5-extension.php                  ← Extension bootstrap
    └── modules/
        ├── DiviMenus5/                 ← Circular/Horizontal/Vertical menus
        │   ├── DiviMenus5_Module.php   ← Parent module class
        │   ├── DiviMenus5.php          ← Module definition file
        │   ├── loader.php              ← Loads parent + child
        │   └── DiviMenus5Item/
        │       └── DiviMenus5_Item_Module.php  ← Child item module
        └── DiviMenus5Flex/            ← Flex menu module
            ├── DiviMenus5Flex_Module.php       ← Parent flex module class
            ├── DiviMenus5Flex.php             ← Module definition file
            ├── loader.php                      ← Loads parent + child
            └── DiviMenus5FlexItem/
                └── DiviMenus5Flex_Item_Module.php  ← Child flex item module
```

## Modules

### DiviMenus5 (Parent Module)
A complete circular, horizontal, or vertical menu with:
- 8 built-in trigger positions
- Full flyout/popup support
- WooCommerce + EDD cart integration
- WordPress menu import
- Divi Library layout embedding
- Icon, text, and image item types
- Full VB support via `vb_support = 'partial'`

### DiviMenus5 Item (Child Module)
- Child module used inside DiviMenus5 parent
- Adds individual menu items to the parent menu
- Supports icons, text, images, and links
- Full link/popup/show field controls

### DiviMenus5Flex (Parent Module)
- Flexbox-based menu with precise alignment controls
- 4 layout types: row, column, grid, wrap
- 7 alignment options per axis
- Hover effects and transitions

### DiviMenus5Flex Item (Child Module)
- Child module for Flex menu items
- Per-item icon/text/image layout

## Visual Builder Support

All modules use `vb_support = 'partial'` for compatibility with both Divi 4 and Divi 5.

## Changelog

### 1.0.0
- Initial release for Divi 5
- Circular, horizontal, vertical menu (DiviMenus5)
- Flex menu (DiviMenus5Flex)
- WooCommerce + EDD support
- Visual Builder partial support
