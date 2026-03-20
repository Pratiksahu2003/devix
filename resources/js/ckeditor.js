/**
 * CKEditor 5 — NPM build entry
 * Exposes ClassicEditor on window so inline blade scripts work unchanged.
 */
import {
    ClassicEditor,
    Autoformat,
    Bold,
    Essentials,
    FontColor,
    FontSize,
    Heading,
    Italic,
    Link,
    List,
    Paragraph,
    Strikethrough,
    Underline,
} from 'ckeditor5';

import { Table, TableToolbar } from '@ckeditor/ckeditor5-table';

import 'ckeditor5/ckeditor5.css';

// Make ClassicEditor available globally so inline blade <script> blocks work.
window.ClassicEditor = ClassicEditor;
window.CKEditorPlugins = {
    Autoformat,
    Bold,
    Essentials,
    FontColor,
    FontSize,
    Heading,
    Italic,
    Link,
    List,
    Paragraph,
    Strikethrough,
    Underline,
    Table,
    TableToolbar,
};

function debounce(fn, wait) {
    let t = null;
    return (...args) => {
        if (t) clearTimeout(t);
        t = setTimeout(() => fn(...args), wait);
    };
}

function initCKEditorForTextarea(textarea) {
    if (!textarea) return;

    // Create an editor host (CKEditor will render UI inside it).
    // We keep the original textarea for form submission.
    const wrapper = document.createElement('div');
    wrapper.className = 'ck-editor-wrapper';

    const editorHost = document.createElement('div');
    editorHost.className = 'rounded-xl border border-slate-300 bg-white';

    textarea.style.display = 'none';
    textarea.insertAdjacentElement('afterend', wrapper);
    wrapper.appendChild(editorHost);

    const form = textarea.closest('form');
    const syncTextarea = debounce(() => {
        // editor.getData() is HTML string.
        textarea.value = editorInstance.getData();
    }, 150);

    // If CKEditor is created again (shouldn't happen), avoid double-sync refs.
    // Also helps with hot reload during development.
    let editorInstance = null;

    return window.ClassicEditor.create(editorHost, {
        // Add Table support.
        extraPlugins: [Table, TableToolbar],
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
