import Quill from 'quill';
import QuillBetterTable from 'quill-better-table';

import 'quill/dist/quill.snow.css';
import 'quill-better-table/dist/quill-better-table.css';

// quill-better-table uses Quill.register internally in examples.
Quill.register({ 'modules/better-table': QuillBetterTable }, true);

function initQuillForTextarea(textarea) {
    if (!textarea) return;
    if (textarea.dataset.quillInitialized === '1') return;
    textarea.dataset.quillInitialized = '1';

    // Hide textarea and create editor wrapper.
    const wrapper = document.createElement('div');
    wrapper.className = 'quill-editor-wrapper';

    textarea.style.display = 'none';
    textarea.insertAdjacentElement('afterend', wrapper);

    // Build a small toolbar with a custom "Table" button.
    const toolbarId = `quill-toolbar-${Math.random().toString(16).slice(2)}`;
    wrapper.innerHTML = `
        <div id="${toolbarId}" class="mb-2 flex flex-wrap gap-2 items-center">
            <span class="ql-formats">
                <button type="button" class="ql-bold" aria-label="Bold"></button>
                <button type="button" class="ql-italic" aria-label="Italic"></button>
                <button type="button" class="ql-underline" aria-label="Underline"></button>
                <button type="button" class="ql-strike" aria-label="Strike"></button>
            </span>
            <span class="ql-formats">
                <button type="button" class="ql-link" aria-label="Link"></button>
                <button type="button" class="ql-clean" aria-label="Clear formatting"></button>
            </span>
            <span class="ql-formats">
                <button type="button" class="ql-insertTable px-3 py-1.5 text-xs font-semibold bg-indigo-50 hover:bg-indigo-100 text-indigo-700 rounded border border-indigo-100">
                    Insert Table
                </button>
            </span>
        </div>
        <div class="rounded-xl border border-slate-300 bg-white"></div>
    `;

    const toolbarEl = wrapper.querySelector(`#${toolbarId}`);
    const editorEl = wrapper.querySelector('div.rounded-xl');

    const form = textarea.closest('form');

    const quill = new Quill(editorEl, {
        theme: 'snow',
        modules: {
            toolbar: {
                container: toolbarEl,
                handlers: {
                    insertTable: () => {
                        const mod = quill.getModule('better-table');
                        // Create a default 3x3 table.
                        mod.insertTable(3, 3);
                    },
                },
            },
            table: false, // better-table handles table operations, not Quill's built-in module
            'better-table': {
                operationMenu: {
                    items: {
                        unmergeCells: { text: 'Unmerge cells' },
                    },
                },
            },
            keyboard: {
                bindings: QuillBetterTable.keyboardBindings,
            },
        },
    });

    // Paste initial HTML into the editor.
    const initial = textarea.value || '';
    if (initial.trim().length > 0) {
        quill.clipboard.dangerouslyPasteHTML(initial);
    }

    const syncToTextarea = () => {
        textarea.value = quill.root.innerHTML;
    };

    quill.on('text-change', () => {
        // Keep textarea updated so submit always sends latest HTML.
        syncToTextarea();
    });

    if (form) {
        form.addEventListener('submit', () => {
            syncToTextarea();
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const textarea = document.querySelector('textarea#content');
    if (!textarea) return;
    initQuillForTextarea(textarea);
});

