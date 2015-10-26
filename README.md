Doghouse Carousel
=================

This is the illest Magento carousel in the universe. Continuing the trend of things that make no design-decisions for you, this module doesn't actually show a carousel. In fact, all it shows is an unordered list with things you put in it through the Magento admin interface. It doesn't come with any javascript or CSS. It's adviced you use [OWLCarousel](http://owlgraphic.com/owlcarousel/) or [Slick Carousel](http://kenwheeler.github.io/slick/) because they're nice and work well.

## About

Created by [Doghouse](http://doghouse.agency/) because we needed a developer-friendly, bloat-free carousel we could use in any project. Because which website doesn't need a carousel?

You can use this module even if you just want to show some blocks of content on a site. Most of the time, we would rather use this module for showing random blocks of content than using CMS blocks: CMS blocks can't be grouped ("give me all blocks that are part of this group") and can't be scheduled ("I want this piece of content to be activated at midnight"). They also don't have fields other than the main HTML field.

## Features

- Nice adminhtml grid with sorting, image preview and everything.
- It outputs stuff on the front-end
- You can put stuff in it through the admin panel

### Even more features

- You can enable/disable slides
- You can group slides and have multiple carousels
- You can schedule slides to turn on/off by date. Ideal if you're running a promotion on certain dates.
- Does some caching stuff

## Installation

Install using Composer (preferred) or Modman.

Just require `"doghouse/carousel":"0.*",` in your composer.json.

## Usage

You can use this carousel as an inline widget, instance widget or normal block by including it in your layout xml. Keep in mind that you can only add css/js assets through the block's `_prepareLayout` method when using it as an instance widget - also see my [Stackoverflow answer](http://stackoverflow.com/a/21109065/896657).

### As a block

Put this in your layout xml file:

    <block type="dhcarousel/carousel" name="my_cool_carousel" />

Above will add the `default` carousel group. You can choose the group like so:

    <block type="dhcarousel/carousel" name="my_cool_carousel">
        <action method="setGroupIdentifier">
            <identifier>surfboards</identifier>
        </action>
    </block>

### As an inline widget

Inside a CMS Page or Static Block:

    <div>{{widget type="dhcarousel/carousel"}}</div>

You don't need the div's but I put them there because Magento will otherwise wrap `<p>` tags around it (if you switch between wysiwyg/html).

### As an instance widget

Select `Doghouse Carousel` when creating a new instance widget and your current theme.

Note: currently you can't choose the group you want to display, only the `default` group can be used as a widget or instance widget. (PR anyone?)

### Extending it

There are a couple events you can listen to, to add additional form fields to the carousel item. You can even save additional images and files by listening to the controller action event:
 - `dhcarousel_item_edit_form_prepare_form`
 - `dhcarousel_controller_action_form_save`

# License

[MIT License](https://opensource.org/licenses/MIT)

