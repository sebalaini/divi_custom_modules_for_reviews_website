# Divi custom modules for a reviews website

These modules have been created for a Hotel review website.
This repo allows you to run a WordPress instance locally and further develop the modules based on your requirements.

<details open>
<summary>Table of content</summary>

- [Stack Prerequisite](#stack-prerequisite)
- [Setup Instructions](#setup-instructions)
  - [WordPress theme & plugin](#wordpress-theme--plugin)
- [Divi modules](#divi-modules)
  - [Shared CSS classes](#shared-css-classes)
  - [Debug](#debug)
  - [known issues](#known-issues)
- [Usage](#usage)

</details>

<br>

## Stack Prerequisite

Before to be able to run the WordPress instance locally you will need:

- [gulp](https://gulpjs.com/)
- [NVM](https://github.com/nvm-sh/nvm) + configuration to change node version using the `.nvmrc` file, this project uses:
  - node 18 (at root level)
  - node 14 (In the Divi modules because the [Create Divi Extension](https://github.com/elegantthemes/create-divi-extension) package)
- [yarn](https://classic.yarnpkg.com/)
- PHP 8
- [PHP composer](https://getcomposer.org/)
- [WP-CLI](https://wp-cli.org/)
- [Docker](https://www.docker.com/)
- Python <= `v3.10`

<br>

## Setup Instructions

Once you met the prerequisites you can follow the next steps:

- Install NPM dependencies by running `yarn`
- Install Composer dependencies by running `composer install`
- Install WordPress by running `wp core download --path=wordpress --locale=es_ES` or you can use `en_US` (the website was intentded for the Spanish market)
- Start the project using Docker composer by running `docker-compose up -d`
- Finish to setup the website by accessing http://localhost:8080/wp-admin/install.php in your browser.

### WordPress theme & plugin

During the 1st startup you would need to install the below Theme and Plugin.

- Divi `^4.20`
  - Divi child theme
    > available in this repo, you just need to activate it after you instal the Divi theme
- Advanced Custom Fields `^6.2`
  - Import the ACF [Attributes Group](./docs/acf-export.json) saved in this repo
  > The Advanced Custom Fields **Attributes** Group is set to show only in the Post type = Post

While the Divi child is not needed to use the Divi custom modules is most likely that you are building your own custom theme to add more functionalities and is better to use a child theme if you are adding a lot of customization to the default Divi theme.
In the case of the original scope of this project I was removing and unloaded a lot of worpdress functionalities that were not needed for example:

- Disable Divi's Project post type.
- Remove Dashicons from Admin Bar for non logged in users.
- Remove WP global stlye.
- Disable the emojis, Filter out the TinyMCE emoji plugin, Remove emoji CDN hostname from DNS prefetching hints.
- Disable comments globally and remove Comments and Discussion settings pages.
- Remove jQuery migrate.
- Disable Gutember.

Besides, I prefer to use my own code to remove things instead of bloating WordPress with thousands plugins that slow down the website.

<br>

## Divi modules

Before to be able to activate the 2 Divi modules you need to run `yarn && yarn build` in both modules.

At this point you are up and runnig, you can activate and use them.

More info about each module:

- [post-custom-attributes](./docs/post-custom-attributes.md)
- [post-custom-review](./docs/post-custom-review.md)


### Shared CSS classes

The `post-custom-review` module is using the following classes that comes from the `post-custom-attributes` module

```
.poca-fonts
.poca-bold
.poca-product-button
.poca-product-button-purple
.poca-product-button-blue
```

### known issues

- `node-gyp` is a dependencies of [Create Divi Extension](https://github.com/elegantthemes/create-divi-extension) and is supporting Python v3.7, v3.8, v3.9, or v3.10, so if you have an higher version you would need to install multiple versions in your machine and use one of the supported versions for this project. Failing in doing so you can't install dependencies while running `yarn`
- `Incorrect integrity when fetching from the cache for "spdy-transport"` delete the `yarn.lock` file and run `yarn` to install the dependencies.

<br>

## usage

This project integrate a few commands that needs to be used manually or they are automated, below you can read more about them.

- The root `package.json` install `husky` & `lint-staged` and is setup to run some commands on git pre-commit, you can change them in the [husky pre-commit file](./.husky/pre-commit)
  - `npx lint-staged` run prettier for `js,jsx,json,md` files in the Divi modules and in every json and md file in the project.
    - you can run a global prettier fix command via the `prettier:fix` command in the `package.json`
  - `./vendor/bin/php-cs-fixer fix --verbose` run PHP CS Fixer in the Divi modules and the Divi child theme, this can be changed in the [.php-cs-fixer.php file](./.php-cs-fixer.php)

<br>

- The [gulpfile.js](./gulpfile.js) contains few commands that run in the Divi theme:
  - `default`
    - minify and uglify the `js/main.js` and compile it into the `theme.js`.
    - concat, minify & uglify the SCSS files in `scss` and compile it in the `style.css`.
  - `sass`
    - concat, minify & uglify the SCSS files in `scss` and compile it in the `style.css`.
  - `watch`
    - same as the `default` command but in watch mode.
