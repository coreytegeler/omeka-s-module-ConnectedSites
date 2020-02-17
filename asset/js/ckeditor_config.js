/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
CKEDITOR.editorConfig = function(config) {
    // Define changes to default configuration here.
    // For complete reference see:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config

    config.toolbar = [{
            "name": "advanced",
            "items": ['Sourcedialog', '-',
                'Link', 'Unlink', 'Anchor', '-',
                'Format'
            ]
        },
        "/",
        {
            "items": ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', '-',
                'NumberedList', 'BulletedList', 'Indent', 'Outdent', 'Blockquote'
            ]
        }
    ];

    // config.format_tags = 'h2;';
    config.format_tags = 'h3';
    config.format_h3 = { element: 'h3', attributes: { 'class': 'contentTitle3' }, name: 'Subheading' };

    // Disable content filtering
    config.allowedContent = true;
    config.extraPlugins = 'sourcedialog';
};