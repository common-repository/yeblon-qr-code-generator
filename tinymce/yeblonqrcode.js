function yeblonqrcodeplugin() {
    return '[yeblonqrcode size="100" url="" class="" style=""]';
}

(function() {
    tinymce.create('tinymce.plugins.yeblonqrcodeplugin', {
 
        init : function(ed, url){
            ed.addButton('yeblonqrcodeplugin', {
            title : 'Insert QR Code',
                onclick : function() {
                    ed.execCommand(
                    'mceInsertContent',
                    false,
                    yeblonqrcodeplugin()
                    );
                },
                image: url + "/qrcode.png"
            });
        }
    });

    tinymce.PluginManager.add('yeblonqrcodeplugin', tinymce.plugins.yeblonqrcodeplugin);

})();