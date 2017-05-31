/**
 * Add Button button
 **/
(function() {  
    tinymce.create('tinymce.plugins.button', {  
        init : function(ed, url) {  
            ed.addButton('button', {  
                title : 'Add a button',  
                image : url+'/button-button.png',  
                onclick : function() {  
                     ed.selection.setContent('[button align="center" color="" size="small" link=""]Small Button[/button]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('button', tinymce.plugins.button);  
})();

/**
 * Add Dropcap button
 **/
(function() {  
    tinymce.create('tinymce.plugins.dropcap', {  
        init : function(ed, url) {  
            ed.addButton('dropcap', {  
                title : 'Add a dropcap',  
                image : url+'/button-dropcap.png',  
                onclick : function() {  
                     ed.selection.setContent('[dropcap]...[/dropcap]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('dropcap', tinymce.plugins.dropcap);  
})();

/**
 * Add an arrow list button
 **/
(function() {  
    tinymce.create('tinymce.plugins.arrowlist', {  
        init : function(ed, url) {  
            ed.addButton('arrowlist', {  
                title : 'Add an arrow list',  
                image : url+'/button-arrow.png',  
                onclick : function() {  
                     ed.selection.setContent('[arrowlist]<ul>\r<li>Item #1</li>\r<li>Item #2</li>\r<li>Item #3</li>\r</ul>[/arrowlist]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('arrowlist', tinymce.plugins.arrowlist);  
})();

/**
 * Add 1-2 button
 **/
(function() {  
    tinymce.create('tinymce.plugins.one_half', {  
        init : function(ed, url) {  
            ed.addButton('one_half', {  
                title : 'Add a one_half column',  
                image : url+'/button-12.png',  
                onclick : function() {  
                     ed.selection.setContent('[one_half]...[/one_half] [one_half_last]...[/one_half_last]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('one_half', tinymce.plugins.one_half);  
})();

/**
 * Add 1-3 button
 **/
(function() {  
    tinymce.create('tinymce.plugins.two_third', {  
        init : function(ed, url) {  
            ed.addButton('one_third', {  
                title : 'Add a two_third column',  
                image : url+'/button-23.png',  
                onclick : function() {  
                     ed.selection.setContent('[one_third]...[/one_third] [one_third]...[/one_third] [one_third_last]...[/one_third_last]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('one_third', tinymce.plugins.two_third);  
})();

/**
 * Add Tabs button
 **/
(function() {  
    tinymce.create('tinymce.plugins.tabs', {  
        init : function(ed, url) {  
            ed.addButton('tabs', {  
                title : 'Add tabs',  
                image : url+'/button-tabs.png',  
                onclick : function() {  
                     ed.selection.setContent('[tabs tab1=\"Tab 1\" tab2=\"Tab 2\" tab3=\"Tab 3\"]<br /><br />[tab id=1]Tab content 1[/tab]<br />[tab id=2]Tab content 2[/tab]<br />[tab id=3]Tab content 3[/tab]<br /><br />[/tabs]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);  
})();

/**
 * Add Toggle button
 **/
(function() {  
    tinymce.create('tinymce.plugins.toggle', {  
        init : function(ed, url) {  
            ed.addButton('toggle', {  
                title : 'Add a toggle',  
                image : url+'/button-toggle.png',  
                onclick : function() {  
                     ed.selection.setContent('[toggle title=""]...[/toggle]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('toggle', tinymce.plugins.toggle);  
})();

/**
 * Add Youtube button
 **/
(function() {  
    tinymce.create('tinymce.plugins.youtube', {  
        init : function(ed, url) {  
            ed.addButton('youtube', {  
                title : 'Add a Youtube video',  
                image : url+'/button-youtube.png',  
                onclick : function() {  
                     ed.selection.setContent('[youtube id="Enter video ID (eg. Wq4Y7ztznKc)" width="590" height="442"]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('youtube', tinymce.plugins.youtube);  
})();

/**
 * Add Vimeo button
 **/
(function() {  
    tinymce.create('tinymce.plugins.vimeo', {  
        init : function(ed, url) {  
            ed.addButton('vimeo', {  
                title : 'Add a Vimeo video',  
                image : url+'/button-vimeo.png',  
                onclick : function() {  
                     ed.selection.setContent('[vimeo id="Enter video ID (eg. 10145153)" width="590 height="442"]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('vimeo', tinymce.plugins.vimeo);  
})();