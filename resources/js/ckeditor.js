/**
 * CKEditor 5 (modular)
 * Fix for `ckeditor-duplicated-modules`: avoid importing from the `ckeditor5` umbrella package.
 */
import { ClassicEditor } from '@ckeditor/ckeditor5-editor-classic';
import { Essentials } from '@ckeditor/ckeditor5-essentials';
import { Autoformat } from '@ckeditor/ckeditor5-autoformat';
import { Bold, Italic, Underline, Strikethrough } from '@ckeditor/ckeditor5-basic-styles';
import { FontColor, FontSize } from '@ckeditor/ckeditor5-font';
import { Heading } from '@ckeditor/ckeditor5-heading';
import { Link } from '@ckeditor/ckeditor5-link';
import { List } from '@ckeditor/ckeditor5-list';
import { Paragraph } from '@ckeditor/ckeditor5-paragraph';
import { Table, TableToolbar } from '@ckeditor/ckeditor5-table';

import 'ckeditor5/ckeditor5.css';

function debounce(fn, wait) {
    let t = null;
    return (...args) => {
        if (t) clearTimeout(t);
        t = setTimeout(() => fn(...args), wait);
    };
}

function initCKEditorForTextarea(textarea) {
    if (!textarea) return;
    if (textarea.dataset.ckeditorInitialized === '1') return;
    textarea.dataset.ckeditorInitialized = '1';

    // Create an editor host (CKEditor will render UI inside it).
    // We keep the original textarea for form submission.
    const wrapper = document.createElement('div');
    wrapper.className = 'ck-editor-wrapper';

    const editorHost = document.createElement('div');
    editorHost.className = 'rounded-xl border border-slate-300 bg-white';

    textarea.style.display = 'none';
    textarea.insertAdjacentElement('afterend', wrapper);
    wrapper.appendChild(editorHost);

    let editorInstance = null;

    const form = textarea.closest('form');
    const syncTextarea = debounce(() => {
        // editor.getData() is HTML string.
        if (!editorInstance) return;
        textarea.value = editorInstance.getData();
    }, 150);

    return ClassicEditor.create(editorHost, {
        // Required by CKEditor 5 for self-hosted npm usage.
        // Allows GPL usage and removes `license-key-missing` runtime error.
        licenseKey: 'GPL',
        // Add Table support.
        extraPlugins: [Table, TableToolbar],
        plugins: [
            Essentials,
            Autoformat,
            Paragraph,
            Heading,
            Bold,
            Italic,
            Underline,
            Strikethrough,
            FontColor,
            FontSize,
            Link,
            List,
            Table,
            TableToolbar,
        ],
        toolbar: {
            items: [
                'heading',
                '|',
                'bold',
                'italic',
                'underline',
                'strikethrough',
                'link',
                'fontSize',
                'fontColor',
                'bulletedList',
                'numberedList',
                'insertTable',
                '|',
                'undo',
                'redo',
            ],
        },
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4' },
            ],
        },
    }).then((editor) => {
        editorInstance = editor;
        editorInstance.setData(textarea.value || '');

        // Keep textarea synced so backend receives latest HTML.
        editorInstance.model.document.on('change:data', () => {
            syncTextarea();
        });

        if (form) {
            form.addEventListener('submit', () => {
                textarea.value = editorInstance.getData();
            });
        }

        return editorInstance;
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const textarea = document.querySelector('textarea#content');
    if (!textarea) return;
    initCKEditorForTextarea(textarea).catch((e) =>
        console.error('CKEditor init error:', e)
    );
});
