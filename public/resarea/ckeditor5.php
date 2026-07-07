<?php 
if(!isset($id_textarea)) $id_textarea="editor";
?>
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/super-build/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/super-build/translations/it.js"></script>

<script>
CKEDITOR.ClassicEditor.create(document.getElementById("<?php echo $id_textarea;?>"), {
    toolbar: {
        items: [
            'bold', 'italic', 'strikethrough', 'underline', 'removeFormat', '|',
            'fontColor', '|',
			'bulletedList', 'numberedList', '|',
            'outdent', 'indent', '|',
            'undo', 'redo', '|',
            'alignment', '|',
            'link', '|',
            'sourceEditing'
        ],
        shouldNotGroupWhenFull: true
    },

    fontColor: {
        colors: [
            {
                color: '#E30613',
                label: 'Rosso aziendale'
            },
            {
                color: '#000000',
                label: 'Nero'
            }
        ],
        columns: 4,
        documentColors: 0
    },

	lineHeight: {
		options: [
			0.5,
			1,
			1.15,
			1.5,
			2,
			2.5,
			3
		]
	},

    placeholder: '',

    htmlSupport: {
        allow: [
            {
                name: /^(p|br|strong|b|i|em|u|ul|ol|li|blockquote)$/,
				attributes: ['style'],
				classes: [],
				styles: ['line-height']
            }
        ],
        disallow: [
            { name: /^(font|span)$/ },
            { name: /^h[1-6]$/ }  // Blocca h1-h6
        ]
    },

    htmlEmbed: {
        showPreviews: true
    },

    removePlugins: [
        'CKBox',
        'CKFinder',
        'EasyImage',
        'RealTimeCollaborativeComments',
        'RealTimeCollaborativeTrackChanges',
        'RealTimeCollaborativeRevisionHistory',
        'PresenceList',
        'Comments',
        'TrackChanges',
        'TrackChangesData',
        'RevisionHistory',
        'Pagination',
        'WProofreader',
        'MathType'
    ]
})
.then(editor => {
    const viewDocument = editor.editing.view.document;
    viewDocument.on('clipboardInput', (evt, data) => {
        const html = data.dataTransfer.getData('text/html');
        if (!html) return;

        // Blocca inserimento automatico di CKEditor
        evt.stop();

        // Pulisci e converti H1-H6 in <strong>
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = html;

        tempDiv.querySelectorAll('h1, h2, h3, h4, h5, h6').forEach(el => {
            const strong = document.createElement('strong');
            strong.innerHTML = el.innerHTML;
            el.parentNode.replaceChild(strong, el);
        });
		
		 // Rimuovi <span>, <font>, <div> mantenendo il contenuto
		tempDiv.querySelectorAll('span, font, div').forEach(el => {
			const parent = el.parentNode;
			while (el.firstChild) parent.insertBefore(el.firstChild, el);
			parent.removeChild(el);
		});

        // Recupera il contenuto filtrato
        const cleanedHtml = tempDiv.innerHTML;

        // Inserisce il contenuto filtrato nel CKEditor
        editor.model.change(writer => {
            const viewFragment = editor.data.processor.toView(cleanedHtml);
            const modelFragment = editor.data.toModel(viewFragment);
            editor.model.insertContent(modelFragment);
        });
    });
})
.catch(error => {
    console.error(error);
});
</script>
