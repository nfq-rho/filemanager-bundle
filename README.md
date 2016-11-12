NfqFileManagerBundle
=============================

## Installation

### Step 1: Download NfqFileManagerBundle using composer

Add NfqFileManagerBundle in to your composer.json:

	{
		"repositories": [
            {
              "type": "vcs",
              "url": "git@github.com:nfq-rho/filemanager-bundle.git"
            },
		],
    	"require": {
        	"nfq-rho/filemanager-bundle": "~0.1"
    	}
	}

### Step 2: Add bundle configuration

This bundle works as a part of tinyMCE plugin. `stfalcon/tinymce-bundle` bundle provides convenient integration of
this plugin to Symfony.  To enable file manager all you have to do is add it to `external_plugins`

    stfalcon_tinymce:
        external_plugins:
            nfq_filemanager:
                url: "asset[bundles/nfqfilemanager/js/tinymce-plugin/nfq_filemanager/mce_editor_plugin.js]"

and then put `nfq_filemanager` in theme `plugins:` and/or `toolbars:` configuration, wherever you want the buttons to appear

### Step 3: Enable the bundle

Enable the bundle in the kernel.:

	<?php
	// app/AppKernel.php

	public function registerBundles()
	{
	    $bundles = array(
        	// ...
        	new Nfq\FileManagerBundle\NfqFileManagerBundle(),
    	);
	}
