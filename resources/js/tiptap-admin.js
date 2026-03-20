import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import TextAlign from '@tiptap/extension-text-align';
import Underline from '@tiptap/extension-underline';
import Link from '@tiptap/extension-link';
import { TextStyle } from '@tiptap/extension-text-style';
import Color from '@tiptap/extension-color';
import Image from '@tiptap/extension-image';
import Superscript from '@tiptap/extension-superscript';
import Subscript from '@tiptap/extension-subscript';
import HorizontalRule from '@tiptap/extension-horizontal-rule';

import Placeholder from '@tiptap/extension-placeholder';
import CharacterCount from '@tiptap/extension-character-count';

function fileToDataURL(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = () => resolve(reader.result);
        reader.onerror = reject;
        reader.readAsDataURL(file);
    });
}

function findFirstImageFileFromPaste(event) {
    const items = event.clipboardData?.items;
    if (!items) return null;
    for (const item of items) {
        if (item.type && item.type.startsWith('image/')) {
            const file = item.getAsFile();
            if (file) return file;
        }
    }
    return null;
}

function insertImageFromFile(editor, file) {
    return fileToDataURL(file).then((dataUrl) => {
        editor
            .chain()
            .focus()
            .insertContent({
                type: 'image',
                attrs: { src: dataUrl, alt: file.name || 'Image' },
            })
            .run();
    });
}

function ensureToolbar(editor, mountEl) {
    // Basic formatting toolbar (free/open source editor config).
    const toolbar = document.createElement('div');
    toolbar.className =
        'tiptap-toolbar flex flex-wrap gap-2 items-center mb-3 px-3 py-2 rounded-t-xl bg-slate-50 border border-slate-200';

    const makeBtn = (label, onClick) => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className =
            'text-xs font-semibold text-slate-700 hover:text-indigo-700 transition-colors px-2.5 py-1 rounded-lg border border-slate-200 hover:bg-indigo-50';
        btn.textContent = label;
        btn.addEventListener('click', onClick);
        return btn;
    };

    const addInputButton = makeBtn('Image', () => {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        input.addEventListener('change', () => {
            const file = input.files && input.files[0];
            if (!file) return;
            insertImageFromFile(editor, file).catch((e) =>
                console.error('Tiptap image insert error:', e)
            );
        });
        input.click();
    });

    const buttons = [
        makeBtn('Bold', () => editor.chain().focus().toggleBold().run()),
        makeBtn('Italic', () => editor.chain().focus().toggleItalic().run()),
        makeBtn('Underline', () => editor.chain().focus().toggleUnderline().run()),
        makeBtn('Strike', () => editor.chain().focus().toggleStrike().run()),
        makeBtn('Link', () => {
            const href = window.prompt('Enter URL');
            if (!href) return;
            editor
                .chain()
                .focus()
                .extendMarkRange('link')
                .setLink({ href })
                .run();
        }),
        makeBtn('Unlink', () => editor.chain().focus().unsetLink().run()),
        addInputButton,
        makeBtn('Paragraph', () => editor.chain().focus().setParagraph().run()),
        makeBtn('H1', () => editor.chain().focus().setHeading({ level: 1 }).run()),
        makeBtn('H2', () => editor.chain().focus().setHeading({ level: 2 }).run()),
        makeBtn('H3', () => editor.chain().focus().setHeading({ level: 3 }).run()),
        makeBtn('H4', () => editor.chain().focus().setHeading({ level: 4 }).run()),
        makeBtn('Blockquote', () => editor.chain().focus().toggleBlockquote().run()),
        makeBtn('Code Block', () => editor.chain().focus().toggleCodeBlock().run()),
        makeBtn('HR', () => editor.chain().focus().setHorizontalRule().run()),
        // List controls (free OSS).
        makeBtn('List', () => {
            const choice =
                (window.prompt('List type: bullets or numbered', 'bullets') || '')
                    .trim()
                    .toLowerCase();
            if (!choice) return;
            if (choice.startsWith('n')) {
                editor.chain().focus().toggleOrderedList().run();
            } else {
                editor.chain().focus().toggleBulletList().run();
            }
        }),
        makeBtn('UL', () => {
            editor.chain().focus().toggleBulletList().run();
            // Ensure a list item is created immediately.
            setTimeout(() => {
                editor.view.dom.dispatchEvent(
                    new KeyboardEvent('keydown', {
                        key: 'Enter',
                        code: 'Enter',
                        bubbles: true,
                    })
                );
            }, 0);
        }),
        makeBtn('LI', () => {
            editor.chain().focus().run();
            editor.view.dom.dispatchEvent(
                new KeyboardEvent('keydown', {
                    key: 'Enter',
                    code: 'Enter',
                    bubbles: true,
                })
            );
        }),
        makeBtn('OL', () => editor.chain().focus().toggleOrderedList().run()),
        makeBtn('Indent', () => {
            editor.chain().focus().run();
            editor.view.dom.dispatchEvent(
                new KeyboardEvent('keydown', {
                    key: 'Tab',
                    code: 'Tab',
                    bubbles: true,
                })
            );
        }),
        makeBtn('Outdent', () => {
            editor.chain().focus().run();
            editor.view.dom.dispatchEvent(
                new KeyboardEvent('keydown', {
                    key: 'Tab',
                    code: 'Tab',
                    shiftKey: true,
                    bubbles: true,
                })
            );
        }),
        makeBtn('Superscript', () => editor.chain().focus().toggleSuperscript().run()),
        makeBtn('Subscript', () => editor.chain().focus().toggleSubscript().run()),
        makeBtn('Color', () => {
            const color = (window.prompt('Text color (hex), e.g. #ff0000', '#1f2937') || '')
                .trim();
            if (!color) return;
            editor.chain().focus().setColor(color).run();
        }),
        makeBtn('Clear Color', () => editor.chain().focus().unsetColor().run()),
        makeBtn('Align Left', () => editor.chain().focus().setTextAlign('left').run()),
        makeBtn('Align Center', () => editor.chain().focus().setTextAlign('center').run()),
        makeBtn('Align Right', () => editor.chain().focus().setTextAlign('right').run()),
        makeBtn('Align Justify', () => editor.chain().focus().setTextAlign('justify').run()),
        makeBtn('Clear Formatting', () => editor.chain().focus().unsetAllMarks().run()),
        makeBtn('Undo', () => editor.chain().focus().undo().run()),
        makeBtn('Redo', () => editor.chain().focus().redo().run()),
    ];

    buttons.forEach((b) => toolbar.appendChild(b));
    mountEl.prepend(toolbar);

    const counter = document.createElement('div');
    counter.className =
        'tiptap-counter text-[11px] text-slate-500 mt-2 px-3 pb-1';
    counter.textContent = '0 chars';
    mountEl.appendChild(counter);

    // CharacterCount is enabled, so we can update it from editor.storage.
    const updateCounter = () => {
        // extension-character-count puts values in editor.storage.characterCount
        const storage = editor.storage && editor.storage.characterCount;
        const chars = storage && typeof storage.characters === 'number' ? storage.characters : 0;
        const words = storage && typeof storage.words === 'number' ? storage.words : 0;
        counter.textContent = `${words} words • ${chars} chars`;
    };
    editor.on('update', updateCounter);
    updateCounter();
}

function debounce(fn, wait) {
    let t = null;
    return (...args) => {
        if (t) clearTimeout(t);
        t = setTimeout(() => fn(...args), wait);
    };
}

function initTiptapForTextarea(textarea) {
    // Create editor host (contenteditable) and hide original textarea.
    const wrapper = document.createElement('div');
    wrapper.className = 'tiptap-wrapper';

    const editorHost = document.createElement('div');
    editorHost.className =
        'tiptap-editor rounded-xl border border-slate-300 focus-within:border-indigo-500 focus-within:ring-2 focus-within:ring-indigo-500/20 bg-white p-3 min-h-[320px] max-h-[650px] overflow-y-auto prose prose-slate';

    textarea.style.display = 'none';
    textarea.insertAdjacentElement('afterend', wrapper);
    wrapper.appendChild(editorHost);

    const editor = new Editor({
        element: editorHost,
        extensions: [
            StarterKit.configure({
                // Keep to basic formatting; avoid premium CKEditor-style features.
                // (Tiptap is OSS-based here: StarterKit + basic extensions only.)
                heading: {
                    levels: [1, 2, 3, 4],
                },
            }),
            TextAlign.configure({
                types: ['heading', 'paragraph'],
            }),
            Underline,
            Link.configure({ openOnClick: false, HTMLAttributes: { rel: 'noopener noreferrer' } }),
            TextStyle,
            Color,
            Superscript,
            Subscript,
            Placeholder.configure({
                placeholder: 'Write here...'
            }),
            Image.configure({ inline: false }),
            HorizontalRule,
            CharacterCount.configure({
                // No hard limit; just shows counts.
                limit: 0,
            }),
        ],
        content: textarea.value || '',
        editorProps: {
            handlePaste: (view, event) => {
                const file = findFirstImageFileFromPaste(event);
                if (!file) return false;
                insertImageFromFile(editor, file).catch((e) =>
                    console.error('Tiptap paste image insert error:', e)
                );
                return true;
            },
            handleDrop: (view, event) => {
                const file =
                    event.dataTransfer?.files && event.dataTransfer.files.length
                        ? event.dataTransfer.files[0]
                        : null;
                if (!file || !file.type.startsWith('image/')) return false;
                insertImageFromFile(editor, file).catch((e) =>
                    console.error('Tiptap drop image insert error:', e)
                );
                return true;
            },
        },
    });

    ensureToolbar(editor, wrapper);

    // Live sync (debounced) so content is never lost before submit.
    const syncToTextarea = debounce(() => {
        textarea.value = editor.getHTML();
    }, 200);

    editor.on('update', syncToTextarea);

    const form = textarea.closest('form');
    if (form) {
        form.addEventListener('submit', () => {
            textarea.value = editor.getHTML();
        });
    }

    return editor;
}

document.addEventListener('DOMContentLoaded', () => {
    const textarea = document.querySelector('#content');
    if (!textarea) return;
    initTiptapForTextarea(textarea);
});

