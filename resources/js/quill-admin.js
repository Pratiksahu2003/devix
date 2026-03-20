import Quill from 'quill';
import QuillBetterTable from 'quill-better-table';

import 'quill/dist/quill.snow.css';
import 'quill-better-table/dist/quill-better-table.css';

// quill-better-table uses Quill.register internally in examples.
Quill.register({ 'modules/better-table': QuillBetterTable }, true);

function patchQuillBetterTableWidth() {
    // Important: patch the SAME TableContainer class that Quill registers at runtime.
    // In Quill, the module formats are registered under `formats/<blotName>`.
    try {
        const TableContainerReal = Quill.import('formats/table-container');
        if (!TableContainerReal || !TableContainerReal.prototype) return;
        if (TableContainerReal.prototype.__ckTableWidthPatched) return;

        TableContainerReal.prototype.__ckTableWidthPatched = true;
        TableContainerReal.prototype.updateTableWidth = function () {
            setTimeout(() => {
                const colGroup = this.colGroup && this.colGroup();
                if (!colGroup || !colGroup.children) return;

                const tableWidth = colGroup.children.reduce((sumWidth, col) => {
                    const formats =
                        typeof col.formats === 'function' ? col.formats() : {};

                    // quill-better-table expects `formats[table-col].width`,
                    // but in practice `col.formats()` is `{ width: <number> }`.
                    const widthRaw = formats?.width ?? formats?.['table-col']?.width;
                    const width = parseInt(widthRaw, 10);
                    return sumWidth + (Number.isFinite(width) ? width : 0);
                }, 0);

                if (this.domNode && this.domNode.style) {
                    this.domNode.style.width = `${tableWidth}px`;
                }
            }, 0);
        };
    } catch (e) {
        // If the blot isn't registered yet, we just skip; table insertion may still work.
        console.warn('patchQuillBetterTableWidth skipped:', e);
    }
}

function initQuillForTextarea(textarea) {
    if (!textarea) return;
    if (textarea.dataset.quillInitialized === '1') return;
    textarea.dataset.quillInitialized = '1';

    // Style the Quill toolbar + editor to look closer to your CKEditor 5 UI.
    // This is injected once per page load.
    const styleId = 'quill-ckeditor-like-style';
    if (!document.getElementById(styleId)) {
        const style = document.createElement('style');
        style.id = styleId;
        style.innerHTML = `
            .quill-editor-wrapper .ql-toolbar.ql-snow {
                background: #f8fafc !important;
                border-color: #e2e8f0 !important;
                display: flex !important;
                flex-wrap: wrap !important;
                padding: 6px !important;
                border-top-left-radius: 0.75rem !important;
                border-top-right-radius: 0.75rem !important;
                align-items: center !important;
                gap: 6px 10px !important;
            }
            .quill-editor-wrapper .ql-toolbar.ql-snow .ql-formats {
                margin-right: 8px !important;
                display: flex !important;
                align-items: center !important;
                gap: 6px !important;
                margin-right: 0 !important;
            }
            .quill-editor-wrapper .ql-toolbar.ql-snow .ql-header {
                max-width: 210px !important;
            }
            .quill-editor-wrapper .ql-toolbar.ql-snow .ql-size {
                max-width: 120px !important;
            }
            .quill-editor-wrapper .ql-toolbar.ql-snow select,
            .quill-editor-wrapper .ql-toolbar.ql-snow button {
                height: 28px !important;
            }
            .quill-editor-wrapper .ql-toolbar.ql-snow button.ql-insertTable {
                white-space: nowrap !important;
                padding: 3px 10px !important;
                border-radius: 8px !important;
                background: #eef2ff !important;
                border: 1px solid #e0e7ff !important;
                color: #4f46e5 !important;
                font-weight: 600 !important;
                line-height: 1.2 !important;
            }
            .quill-editor-wrapper .ql-toolbar.ql-snow button.ql-insertTable:hover {
                background: #e0e7ff !important;
            }
            .quill-editor-wrapper .ql-editor {
                min-height: 320px !important;
                max-height: 650px !important;
                overflow-y: auto !important;
                font-size: 1rem !important;
                line-height: 1.7 !important;
                padding: 1.25rem 1.5rem !important;
            }
        `;
        document.head.appendChild(style);
    }

    // Hide textarea and create editor wrapper.
    const wrapper = document.createElement('div');
    wrapper.className = 'quill-editor-wrapper';

    textarea.style.display = 'none';
    textarea.insertAdjacentElement('afterend', wrapper);

    // Build a CKEditor-like toolbar:
    // - Heading dropdown (Paragraph + H1..H4)
    // - Lists (bullet + numbered)
    // - Basic formatting + link + clear all formatting
    // - Custom "Insert Table" button
    const toolbarId = `quill-toolbar-${Math.random().toString(16).slice(2)}`;
    wrapper.innerHTML = `
        <div id="${toolbarId}" class="ql-toolbar ql-snow mb-3">
            <span class="ql-formats">
                <select class="ql-header" aria-label="Paragraph heading">
                    <option selected value="">Paragraph</option>
                    <option value="1">Heading 1</option>
                    <option value="2">Heading 2</option>
                    <option value="3">Heading 3</option>
                    <option value="4">Heading 4</option>
                </select>
            </span>

            <span class="ql-formats">
                <select class="ql-size" aria-label="Font size">
                    <option selected value="normal">Normal</option>
                    <option value="small">Small</option>
                    <option value="large">Large</option>
                    <option value="huge">Huge</option>
                </select>
            </span>

            <span class="ql-formats">
                <button type="button" class="ql-bold" aria-label="Bold"></button>
                <button type="button" class="ql-italic" aria-label="Italic"></button>
                <button type="button" class="ql-underline" aria-label="Underline"></button>
                <button type="button" class="ql-strike" aria-label="Strike"></button>
            </span>

            <span class="ql-formats">
                <button type="button" class="ql-list" value="bullet" aria-label="Bulleted list"></button>
                <button type="button" class="ql-list" value="ordered" aria-label="Numbered list"></button>
            </span>

            <span class="ql-formats">
                <button type="button" class="ql-blockquote" aria-label="Blockquote"></button>
                <button type="button" class="ql-code-block" aria-label="Code block"></button>
            </span>

            <span class="ql-formats">
                <button type="button" class="ql-align" value="" aria-label="Align left"></button>
                <button type="button" class="ql-align" value="center" aria-label="Align center"></button>
                <button type="button" class="ql-align" value="right" aria-label="Align right"></button>
                <button type="button" class="ql-align" value="justify" aria-label="Align justify"></button>
            </span>

            <span class="ql-formats">
                <button type="button" class="ql-link" aria-label="Link"></button>
                <button type="button" class="ql-image" aria-label="Insert image"></button>
                <button type="button" class="ql-clean" aria-label="Clear all formatting"></button>
            </span>

            <span class="ql-formats">
                <button
                    type="button"
                    class="ql-table"
                >
                   table
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

    // Apply the fix right after Quill + better-table loads,
    // so the next click on "Insert Table" can't crash.
    patchQuillBetterTableWidth();

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

