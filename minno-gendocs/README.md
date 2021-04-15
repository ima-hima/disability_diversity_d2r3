# minno-gendocs
A static site generator for minno

[![npm version](https://badge.fury.io/js/minno-gendocs.svg)](https://badge.fury.io/js/minno-gendocs)


## Install

``` bash
npm install minno-gendocs --save
```

## Usage

```bash
node minno-gendocs src dest
```

Where `src` is a source directory, and `dest` is the directory we want to create the docs in.
Gendocs will walk through the source directory and render folder according to the following rules:

## Description

* If `menu.md` exists, it is used as the menu for all files within this directory.
* Markdown files (other than menu.md) will be rendered into the layout.
* JS files will be rendered into a playground (the lines of comments before `define` will be rendered as markdown).
