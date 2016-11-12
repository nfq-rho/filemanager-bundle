/**
 * This file is part of the "NFQ Bundles" package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

tinymce.PluginManager.add('nfq_filemanager', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('nfq_filemanager', {
        text: 'File Manager',
        icon: false,
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'File Manager',
                file : '/admin/file-manager/dialog',
                width : 820,
                height : 400,
                inline : 1
            }, {
                plugin_url : url // Plugin absolute URL
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('nfq_filemanager', {
        text: 'File Manager',
        context: 'tools',
        onclick: function() {
            // Open window with a specific url
            editor.windowManager.open({
                title: 'File Manager',
                file : '/admin/file-manager/dialog?',
                width : 820,
                height : 400,
                inline : 1
            }, {
                plugin_url : url // Plugin absolute URL
            });
        }
    });
});
