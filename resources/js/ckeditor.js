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
import { Table } from '@ckeditor/ckeditor5-table';
import { Plugin } from '@ckeditor/ckeditor5-core';
import { ButtonView } from '@ckeditor/ckeditor5-ui';

import 'ckeditor5/ckeditor5.css';

function debounce(fn, wait) {
    let t = null;
    return (...args) => {
        if (t) clearTimeout(t);
        t = setTimeout(() => fn(...args), wait);
    };
}

function openTablePicker(editor) {
    // Small modal UI so user can choose table rows/columns (CKEditor-like behavior).
    // After confirm, we execute the real `insertTable` command with dimensions.
    const existing = document.getElementById('ck-table-picker-modal');
    if (existing) existing.remove();

    const overlay = document.createElement('div');
    overlay.id = 'ck-table-picker-modal';
    overlay.style.position = 'fixed';
    overlay.style.inset = '0';
    overlay.style.background = 'rgba(15, 23, 42, 0.35)';
    overlay.style.display = 'flex';
    overlay.style.alignItems = 'center';
    overlay.style.justifyContent = 'center';
    overlay.style.zIndex = '99999';

    const modal = document.createElement('div');
    modal.style.width = '360px';
    modal.style.background = '#fff';
    modal.style.border = '1px solid #e2e8f0';
    modal.style.borderRadius = '12px';
    modal.style.padding = '14px';
    modal.style.boxShadow = '0 20px 60px rgba(0,0,0,0.15)';

    modal.innerHTML = `
        <div style="font-weight:700; margin-bottom:10px; color:#0f172a;">Insert Table</div>
        <div style="display:flex; gap:10px; margin-bottom:12px;">
            <label style="flex:1;">
                <div style="font-size:12px; font-weight:600; color:#475569; margin-bottom:6px;">Rows</div>
                <select id="ck-table-rows" style="width:100%; padding:8px 10px; border:1px solid #e2e8f0; border-radius:10px;">
                </select>
            </label>
            <label style="flex:1;">
                <div style="font-size:12px; font-weight:600; color:#475569; margin-bottom:6px;">Columns</div>
                <select id="ck-table-cols" style="width:100%; padding:8px 10px; border:1px solid #e2e8f0; border-radius:10px;">
                </select>
            </label>
        </div>
        <div style="display:flex; justify-content:flex-end; gap:10px;">
            <button id="ck-table-cancel" type="button" style="padding:8px 12px; border:1px solid #e2e8f0; border-radius:10px; background:#fff; cursor:pointer; color:#334155;">Cancel</button>
            <button id="ck-table-insert" type="button" style="padding:8px 12px; border:1px solid #4f46e5; border-radius:10px; background:#4f46e5; cursor:pointer; color:#fff; font-weight:600;">Insert</button>
        </div>
    `;

    overlay.appendChild(modal);
    document.body.appendChild(overlay);

    const rowsSelect = modal.querySelector('#ck-table-rows');
    const colsSelect = modal.querySelector('#ck-table-cols');
    const cancelBtn = modal.querySelector('#ck-table-cancel');
    const insertBtn = modal.querySelector('#ck-table-insert');

    const max = 10;
    for (let i = 1; i <= max; i++) {
        const rOpt = document.createElement('option');
        rOpt.value = String(i);
        rOpt.textContent = String(i);
        rowsSelect.appendChild(rOpt);

        const cOpt = document.createElement('option');
        cOpt.value = String(i);
        cOpt.textContent = String(i);
        colsSelect.appendChild(cOpt);
    }
    rowsSelect.value = '2';
    colsSelect.value = '2';

    const close = () => overlay.remove();

    cancelBtn.addEventListener('click', close);
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) close();
    });

    insertBtn.addEventListener('click', () => {
        const rows = Number(rowsSelect.value);
        const columns = Number(colsSelect.value);
        if (!Number.isFinite(rows) || !Number.isFinite(columns) || rows < 1 || columns < 1) {
            close();
            return;
        }

        close();
        // Insert table at current selection.
        editor.execute('insertTable', { rows, columns });
    });
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
        // Add Table support + our safe toolbar button.
        extraPlugins: [
            Table,
            class TableInsertButtonPlugin extends Plugin {
                init() {
                    const editor = this.editor;
                    editor.ui.componentFactory.add('tableInsert', (locale) => {
                        const view = new ButtonView(locale);
                        view.set({
                            label: 'Table',
                            tooltip: true,
                        });

                        view.on('execute', () => {
                            // Let user choose row/column count before inserting.
                            openTablePicker(editor);
                        });

                        return view;
                    });
                }
            },
        ],
        toolbar: {
            items: [
                'heading',
                'bold',
                'italic',
                'underline',
                'strikethrough',
                'link',
                'bulletedList',
                'numberedList',
                'tableInsert',
                'undo',
                'redo',
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
