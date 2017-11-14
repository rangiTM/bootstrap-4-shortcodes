Bootstrap 4.0.0-beta Shortcodes for WordPress
===

![WordPress Rating](https://img.shields.io/wordpress/plugin/r/bootstrap-4-shortcodes.svg) ![WordPress Downloads](https://img.shields.io/wordpress/plugin/dt/bootstrap-4-shortcodes.svg)

WordPress plugin that provides shortcodes for easier use of the Bootstrap styles and components in your content.

**Bootstrap 4 Shortcodes for WordPress** creates a simple, out of the way button just above the WordPress TinyMCE editor (next to the "Add Media" button) which pops up the plugin's documentation and shortcode examples for reference and handy "Insert Example" links to send the example shortcodes straight to the editor. There are no additional TinyMCE buttons to clutter up your screen, just great, easy to use shortcodes!

## Requirements
![Tested in WordPress](https://img.shields.io/wordpress/v/bootstrap-4-shortcodes.svg) ![PHP 5.3+](https://img.shields.io/badge/PHP-5.3%2B-blue.svg) ![Bootstrap](https://img.shields.io/badge/Bootstrap-4.x-6f5499.svg)

This plugin won't do anything if you don't have WordPress theme built with the [Bootstrap](http://getbootstrap.com/) framework. **This plugin does not include the Bootstrap framework**.

The plugin is tested to work with ```Bootstrap 4``` and ```WordPress 4.6.1``` and **requires PHP 5.3 or later**.

## Shortcode Reference

### CSS
* [Grid](#grid)
* [Media Objects](#media-objects)
* [Responsive utilities](#responsive-utilities)

### Content
* [Lead](#lead)
* [Emphasis classes](#emphasis-classes)
* [Code](#code)
* [Images](#images)
* [Tables](#tables)
* [Figures](#figures)

### Components
* [Alerts](#alerts)
* [Breadcrumbs](#breadcrumbs)
* [Buttons](#buttons)
* [Button Groups](#button-groups)
* [Cards](#cards)
* [Carousel](#carousel)
* [Collapse](#collapse)
* [Dropdowns](#dropdowns)
* [Jumbotron](#jumbotron)
* [List Groups](#list-groups)
* [Modal](#modal)
* [Navs](#navs)
* [Popover](#popover)
* [Progress](#progress)
* [Tag](#tag)
* [Tooltip](#tooltip)

### Utilities
* [Close Icon](#close-icon)
* [Responsive Embeds](#responsive-embeds)


# Usage

### Layout

### Grid
	[row]
		[column md="6"]
			...
		[/column]
		[column md="6"]
			...
		[/column]
	[/row]

The container component is also supported in case your theme doesn't include a container.

	[container]
		[row]
			[column md="6"]
				...
			[/column]
			[column md="6"]
				...
			[/column]
		[/row]
	[/container]

The container-fluid component is supported as a discrete shortcode for cases where you want to wrap a container.

	[container-fluid]
		[container]
			[row]
				[column md="6"]
					...
				[/column]
				[column md="6"]
					...
				[/column]
			[/row]
		[/container]
	[/container-fluid]
	
If your Bootstrap has flexbox support enabled, you can get some more alignment options on rows and columns - [Bootstrap flexbox documentation](http://v4-alpha.getbootstrap.com/layout/flexbox-grid/).

#### [container] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
fluid | Is the container fluid? (see Bootstrap documentation for details) | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [container-fluid] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [row] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
flex-valign-xs | (only if flexbox is enabled) Vertical aligment for columns on extra small screens (less than 576px) | optional | top,middle,bottom | none
flex-valign-sm | (only if flexbox is enabled) Vertical aligment for columns on small screens (greater than 576px) | optional | top,middle,bottom | none
flex-valign-md | (only if flexbox is enabled) Vertical aligment for columns on medium screens (greater than 768px) | optional | top,middle,bottom | none
flex-valign-lg | (only if flexbox is enabled) Vertical aligment for columns on large screens (greater than 992px) | optional | top,middle,bottom | none
flex-valign-xs | (only if flexbox is enabled) Vertical aligment for columns on extra large screens (greater than 1200px) | optional | top,middle,bottom | none
flex-halign-xs | (only if flexbox is enabled) Horizontal aligment for columns on extra small screens (less than 576px) | optional | left,center,right,around,between | none
flex-halign-sm | (only if flexbox is enabled) Horizontal aligment for columns on small screens (greater than 576px) | optional | left,center,right,around,between | none
flex-halign-md | (only if flexbox is enabled) Horizontal aligment for columns on medium screens (greater than 768px) | optional | left,center,right,around,between | none
flex-halign-lg | (only if flexbox is enabled) Horizontal aligment for columns on large screens (greater than 992px) | optional | left,center,right,around,between | none
flex-halign-xs | (only if flexbox is enabled) Horizontal aligment for columns on extra large screens (greater than 1200px) | optional | left,center,right,around,between | none
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [column] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xs | Size of column on extra small screens (less than 576px) | optional | 1-12 | false
sm | Size of column on small screens (greater than 576px) | optional | 1-12 | false
md | Size of column on medium screens (greater than 768px) | optional | 1-12 | false
lg | Size of column on large screens (greater than 992px) | optional | 1-12 | false
xl | Size of column on extra large screens (greater than 1200px) | optional | 1-12 | false
offset_xs | Offset on extra small screens | optional | 1-12 | false
offset_sm | Offset on small screens | optional | 1-12 | false
offset_md | Offset on column on medium screens | optional | 1-12 | false
offset_lg | Offset on column on large screens | optional | 1-12 | false
offset_xl | Offset on column on extra large screens | optional | 1-12 | false
pull_xs | Pull on extra small screens | optional | 1-12 | false
pull_sm | Pull on small screens | optional | 1-12 | false
pull_md | Pull on column on medium screens | optional | 1-12 | false
pull_lg | Pull on column on large screens | optional | 1-12 | false
pull_xl | Pull on column on extra large screens | optional | 1-12 | false
push_xs | Push on extra small screens | optional | 1-12 | false
push_sm | Push on small screens | optional | 1-12 | false
push_md | Push on column on medium screens | optional | 1-12 | false
push_lg | Push on column on large screens | optional | 1-12 | false
push_xl | Push on column on extra large screens | optional | 1-12 | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap grid documentation](http://v4-alpha.getbootstrap.com/layout/grid/).

* * *

### Media Objects
    [media-list]
        [media]
            [media-object media="left"]
                ...
            [/media-object]
            [media-body title="Testing"]
                ...
            [/media-body]
        [/media]
    [/media-list]

media-list is entirely optional and should contain only media elements.

#### [media-list] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [media] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [media-object] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
halign | Whether the image pulls to the left or right | optional | left, right | left
valign | Whether the body is vertically aligned to top, middle or bottom | optional | top, middle, bottom | top
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [media-body] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
title | The object title | required | Any text | none
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

__NOTE: media-object should contain an image, or linked image, inserted using the WordPress TinyMCE editor__

[Bootstrap media objects documentation](http://v4-alpha.getbootstrap.com/layout/media-object/)

* * *

### Responsive Utilities
	[responsive block="lg md" hidden="sm xs"] ... [/responsive]

#### [reponsive] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
visible | Sizes at which this element is visible (separated by spaces) **NOTE: as of Bootstrap 3.2 "visible" is deprecated in favor of "block", "inline", and "inline-block" (see below)** | optional | xs, sm, md, lg  | false
hidden | Sizes at which this element is hidden (separated by spaces) | optional | xs, sm, md, lg  | false
block | Sizes at which this element is visible and displayed as a "block" element (separated by spaces) | optional | xs, sm, md, lg  | false
inline | Sizes at which this element is visible and displayed as an "inline" element (separated by spaces) | optional | xs, sm, md, lg  | false
inline_block | Sizes at which this element is visible and displayed as an "inline-block" element (separated by spaces) | optional | xs, sm, md, lg  | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap responsive utilities documentation](http://v4-alpha.getbootstrap.com/layout/responsive-utilities/)

* * *

### Components

### Lead
	[lead] ... [/lead]

#### [lead] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap lead documentation](http://v4-alpha.getbootstrap.com/content/typography/#lead)

* * *

### Emphasis classes
	[emphasis type="success"] ... [/emphasis]

#### [emphasis] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
type | The type of label to display | required | muted, primary, success, info, warning, danger | muted
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap emphasis classes documentation](http://v4-alpha.getbootstrap.com/content/typography/)

* * *

### Code
	[code] ... [/code]

#### [code] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
inline | Display inline code | optional | true, false | false
scrollable | Set a max height of 350px and provide a scroll bar. Not usable with inline="true".  | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap code documentation](http://v4-alpha.getbootstrap.com/content/code/)

* * *

### Images
	[img type="circle" fluid="true"] ... [/img]

Wrap any number of HTML image tags or images inserted via the WordPress media manager.
#### [img] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
type | The effect to apply to wrapped images | optional | rounded, circle, thumbnail | false
fluid | Make the wrapped images responsive | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap images documentation](http://v4-alpha.getbootstrap.com/css/#images)

* * *

### Tables
	[table-wrap bordered="true" striped="true"]

				Standard HTML table code goes here.

	[/table-wrap]

#### [table-wrap] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
bordered | Set "bordered" table style (see Bootstrap documentation) | optional | true, false | false
striped | Set "striped" table style (see Bootstrap documentation) | optional | true, false | false
hover | Set "hover" table style (see Bootstrap documentation) | optional | true, false | false
condensed | Set "condensed" table style (see Bootstrap documentation) | optional | true, false | false
responsive | Wrap the table in a div with the class "table-respsonve" (see Bootstrap documentation) | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap table documentation](http://v4-alpha.getbootstrap.com/css/#tables)

* * *

### Buttons
	[button type="success" size="lg" link="#"] ... [/button]

#### [button] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
type | The type of the button | optional | default, primary, success, info, warning, danger, link | default
size | The size of the button | optional | xs, sm, lg | none
block | Whether the button should be a block-level button | optional | true, false | false
dropdown | Whether the button triggers a dropdown menu (see [Button Dropdowns](#button-dropdowns)) | optional | true, false | false
active | Apply the "active" style | optional | true, false | false
disabled | Whether the button be disabled | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
link | The url you want the button to link to | optional | any valid link | none
target | Target for the link | optional | any valid target | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap button documentation](http://v4-alpha.getbootstrap.com/css/#buttons)

* * *


### Responsive Embeds
	[embed-responsive ratio="16by9"] ... [/embed-responsive]

Wrap ```<iframe>```, ```<embed>```, ```<video>```, and ```<object>``` elements to make them responsive.
#### [responsive-embed] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
ratio | Maintain the aspect ratio of the embed | optional | 16by9, 4by3 | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap responsive embed documentation](http://v4-alpha.getbootstrap.com/components/#responsive-embed)

* * *

### Components

### Icons
	[icon type="arrow-right"]

#### [icon] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
type | The type of icon you want to display | required | See Bootstrap docs | none
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap Glyphicons documentation](http://v4-alpha.getbootstrap.com/components/#glyphicons)

* * *

### Button Groups
#### Basic example
	[button-group size="lg" justified="" vertical=""]
		[button link="#"] ... [/button]
		[button link="#"] ... [/button]
		[button link="#"] ... [/button]
	[/button-group]

#### Button toolbar
	[button-toolbar]
		[button-group]
			[button link="#"] ... [/button]
			[button link="#"] ... [/button]
			[button link="#"] ... [/button]
		[/button-group]
		[button-group]
			[button link="#"] ... [/button]
			[button link="#"] ... [/button]
			[button link="#"] ... [/button]
		[/button-group]
		[button-group]
			[button link="#"] ... [/button]
		[/button-group]
	[/button-toolbar]

#### [button-group] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
size | The size of the button group | optional | xs, sm, lg | none
justified | Whether button group is justified | optional | true, false | false
vertical | Whether button group is vertical | optional | true, false | false
dropup | **Must correspond with the use of [dropdown]** | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [button-toolbar] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap button groups documentation](http://v4-alpha.getbootstrap.com/css/#btn-groups)

* * *

### Button Dropdowns
Button Dropdowns can be accomplished by combining the [button-group] shortcode, the "data" parameters of the [button] shortcode, and [dropdown] shortcode as follows.

#### Single button dropdowns
	[button-group]
		[button link="#" dropdown="true" data="toggle,dropdown"] ... [caret][/button]
			[dropdown]
				[dropdown-header] ... [/dropdown-header]
				[dropdown-item link="#"] ... [/dropdown-item]
				[dropdown-item link="#"] ... [/dropdown-item]
				[dropdown-item link="#"] ... [/dropdown-item]
				[divider]
				[dropdown-item link="#"] ... [/dropdown-item]
			[/dropdown]
	[/button-group]

#### Split button dropdowns
	[button-group]
		[button link="#"] ... [/button]
		[button dropdown="true" data="toggle,dropdown"][caret][/button]
		[dropdown]
			[dropdown-item link="#"] ... [/dropdown-item]
			[divider]
			[dropdown-item link="#"] ... [/dropdown-item]
		[/dropdown]
	[/button-group]

#### Dropup variation
	[button-group dropup="true"]
		[button link="#"] ... [/button]
		[button dropdown="true" data="toggle,dropdown"][caret][/button]
		[dropdown]
			[dropdown-item link="#"] ... [/dropdown-item]
			[divider]
			[dropdown-item link="#"] ... [/dropdown-item]
		[/dropdown]
	[/button-group]  

#### [dropdown] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [dropdown-item] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
link | The url you want the dropdown-item to link to | optional | any valid link | none
disabled | Whether this menu-item is disabled | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [dropdown-header] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [caret] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [divider] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap button dropdowns documentation](http://v4-alpha.getbootstrap.com/components/#btn-dropdowns)

* * *

### Navs
	[nav type="pills"]
		[nav-item link="#"] ... [/nav-item]
		[nav-item link="#"] ... [/nav-item]
		[nav-item link="#"] ... [/nav-item]
	[/nav]

#### Nav with dropdowns
	[nav type="pills"]
		[nav-item link="#" active="true"] ... [/nav-item]
		[nav-item dropdown="true" link="#"] ... [caret]
			[dropdown]
				[dropdown-item link="#"] ... [/dropdown-item]
				[dropdown-item link="#"] ... [/dropdown-item]
			[/dropdown]
		[/nav-item]
	[/nav]

#### [nav] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
type | The type of nav | required | tabs, pills | tabs
stacked | Whether the nav is stacked (should be used with "pills" type | optional | true, false | false
justified | Whether the nav is justified | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [nav-item] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
link | The url you want the dropdown-item to link to | optional | any valid link | none
active | Whether the item has the "active" style applied | optional | true, false | false
disabled | Whether the item is disabled | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap button navs documentation](http://v4-alpha.getbootstrap.com/components/#nav)

* * *

### Breadcrumbs
	[breadcrumb]
		[breadcrumb-item link="#"] ... [/breadcrumb-item]
		[breadcrumb-item link="#"] ... [/breadcrumb-item]
		[breadcrumb-item link="#"] ... [/breadcrumb-item]
	[/breadcrumb]

#### [breadcrumb] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [breadcrumb-item] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
link | The url you want the breadcrumb-item to link to | optional | any valid link | none
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap breadcrumbs documentation](http://v4-alpha.getbootstrap.com/components/#breadcrumbs)

* * *

### Labels
	[label type="success"] ... [/label]

#### [label] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
type | The type of label to display | optional | default, primary, success, info, warning, danger | default
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap label documentation](http://v4-alpha.getbootstrap.com/components/#labels)

* * *

### Badges
	[badge right="true"] ... [/badge]

#### [badge] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
right | Whether the badge should align to the right of its container | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap badges documentation](http://v4-alpha.getbootstrap.com/components/#badges)

* * *

### Jumbotron
	[jumbotron title="My Jumbotron"] ... [/jumbotron]

#### [jumbotron] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
title | The jumbotron title | optional | Any text | none
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap jumbotron documentation](http://v4-alpha.getbootstrap.com/components/#jumbotron)

* * *

### Page Header
	[page-header] ... [/page-header]

Automatically inserts H1 tag if not present
#### [page-header] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap page-header documentation](http://v4-alpha.getbootstrap.com/components/#page-header)

* * *

### Alerts
	[alert type="success"] ... [/alert]

#### [alert] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
type | The type of the alert | required | success, info, warning, danger | success
dismissable | If the alert should be dismissable | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap alert documentation](http://v4-alpha.getbootstrap.com/components/#alerts)

* * *

### Progress Bars
	[progress striped="true"]
		[progress-bar percent="50"]
		[progress-bar percent="25" type="success"]
	[/progress]

#### [progress] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
striped | Whether enclosed progress bars will be striped | optional | true, false | false
animated | Whether enclosed progress bars will be animated | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [progress-bar] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
percent | The percentage amount to show in the progress bar | required | any number between 0 and 100 | false
label | Whether to show the percentage as a text label inside the bar | optional | true, false | false
type | The type of the progress bar | optional | default, primary, success, info, warning, danger  | default
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap progress bars documentation](http://v4-alpha.getbootstrap.com/components/#progress)

* * *

### List Groups

#### Basic Example
	[list-group]
		[list-group-item]
			...
		[/list-group-item]
		[list-group-item]
			...
		[/list-group-item]
		[list-group-item]
			...
		[/list-group-item]
	[/list-group]

#### Linked Items
	[list-group linked="true"]
		[list-group-item link="#" active="true"]
			...
		[/list-group-item]
		[list-group-item link="#"]
			...
		[/list-group-item]
		[list-group-item link="#"]
			...
		[/list-group-item]
	[/list-group]

#### Custom Content
	[list-group linked="true"]
		[list-group-item link="#" active="true"]
			[list-group-item-heading]...[/list-group-item-heading]
			[list-group-item-text]...[/list-group-item-text]
		[/list-group-item]
		[list-group-item link="#"]
			[list-group-item-heading]...[/list-group-item-heading]
			[list-group-item-text]...[/list-group-item-text]
		[/list-group-item]
		[list-group-item link="#"]
			[list-group-item-heading]...[/list-group-item-heading]
			[list-group-item-text]...[/list-group-item-text]
		[/list-group-item]
	[/list-group]

#### [list-group] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
linked | Whether this is a linked list group, or a standard one | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [list-group-item] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
link | The url you want the list item to link to **Must correspond with the "linked" parameter in [list-group]** | optional | any text | false
type | The type of the list-group-item | optional | primary, success, info, warning, danger, link | none
active | Whether the item has the "active" style applied | optional | true, false | false
target | Target for the link | optional | any valid target | none
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [list-group-item-heading] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [list-group-item-text] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap list groups documentation](http://v4-alpha.getbootstrap.com/components/#list-group)

* * *

### Cards
	[card type="info" heading="Card Title" footer="Footer text"] ... [/card]

#### [card] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
type | The type of the card | optional | default, primary, success, info, warning, danger, link | default
heading | The card heading | optional | any text | none
title | Whether the card heading should have a title tag around it | optional | true, false | false
footer | The card footer text if desired | optional | any text | none
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap card documentation](http://v4-alpha.getbootstrap.com/components/#card)

* * *

### Javascript

### Tabs
	[tabs type="tabs"]
		[tab title="Home" active="true"]
			...
		[/tab]
		[tab title="Profile"]
			...
		[/tab]
		[tab title="Messages"]
			...
		[/tab]
	[/tabs]

#### [tabs] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
type | The type of nav | required | tabs, pills | tabs
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [tab] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
title | The title of the tab | required | any text | false
active | Whether this tab should be "active" or selected | optional | true, false | false
fade | Whether to use the "fade" effect when showing this tab | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap tabs documentation](http://v4-alpha.getbootstrap.com/javascript/#tabs)

* * *

### Tooltip
	[tooltip title="I'm the title" placement="right"] ... [/tooltip]

#### [tooltip] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
title | The text of the tooltip | required | any text | none
placement | The placement of the tooltip | optional | left, top, bottom, right | top
animation | apply a CSS fade transition to the tooltip | optional | any text | none
html | Insert HTML into the tooltip | optional | true, false | false

[Bootstrap tooltip documentation](http://v4-alpha.getbootstrap.com/javascript/#tooltips)

* * *

### Popover
	[popover title="I'm the title" text="And here's some amazing content. It's very engaging. right?" placement="right"] ... [/popover]

#### [popover] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
title | The title of the popover | optional | any text | none
text | The text of the popover | required | any text | none
placement | The placement of the popover | optional | left, top, bottom, right | top
animation | apply a CSS fade transition to the tooltip | optional | any text | none
html | Insert HTML into the tooltip | optional | true, false | false

[Bootstrap popover documentation](http://v4-alpha.getbootstrap.com/javascript/#popovers)

* * *

### Collapse

#### Single Collapse
	[collapse title="Collapse 1" active="true"]
		...
	[/collapse]

#### Accordion
	[accordion]
		[collapse title="Collapse 1" active="true"]
			...
		[/collapse]
		[collapse title="Collapse 2"]
			...
		[/collapse]
		[collapse title="Collapse 3"]
			...
		[/collapse]
	[/accordion]

#### [accordion] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [collapse] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
title | The title of the collapsible item, visible when collapsed | required | any text | false
type | The type of the panel | optional | default, primary, success, info, warning, danger, link | default
active | Whether the tab is expanded at load time | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap collapse documentation](http://v4-alpha.getbootstrap.com/javascript/#collapse)

* * *

### Carousel
	[carousel]
		[carousel-item active="true"]
		 ...
		    [carousel-caption]...[/carousel-caption]
		[/carousel-item]
		[carousel-item] ... [/carousel-item]
		[carousel-item] ... [/carousel-item]
	[/carousel]

[carousel-item] wraps an HTML image tag or image inserted via the WordPress editor.
#### [carousel] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
interval | The amount of time to delay between automatically cycling an item. If false, carousel will not automatically cycle. | optional | any number (in ms) or "false" | 5000
wrap | Whether the carousel should cycle continuously or have hard stops. | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [carousel-item] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
active | Whether the item has the "active" style applied. One item MUST be set as active. | optional | true, false | false
caption | This carousel slide's caption | optional | Any text | none
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap carousel documentation](http://v4-alpha.getbootstrap.com/javascript/#carousel)

#### [carousel-caption] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap carousel documentation](http://v4-alpha.getbootstrap.com/javascript/#carousel)

* * *

### Modal
	[modal text="This is my modal" title="Modal Title Goes Here" xclass="btn btn-primary btn-lg"]
		...
		[modal-footer]
			[button type="primary" link="#" data="dismiss,modal"]Dismiss[/button]
		[/modal-footer]
	[/modal]

#### [modal] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
text | Text of the modal trigger link | required | any text  | none
title | Title of the modal popup | required | any text | none
size | Optional modal size | optional | lg, sm | none
xclass | Any extra classes you want to add to the trigger link | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [modal-footer] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

[Bootstrap modal documentation](http://v4-alpha.getbootstrap.com/javascript/#modals)

* * *
