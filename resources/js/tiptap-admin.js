import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Underline from '@tiptap/extension-underline';
import Link from '@tiptap/extension-link';
import Image from '@tiptap/extension-image';

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
        addInputButton,
        makeBtn('Bullets', () => editor.chain().focus().toggleBulletList().run()),
        makeBtn('Numbered', () => editor.chain().focus().toggleOrderedList().run()),
        makeBtn('Undo', () => editor.chain().focus().undo().run()),
        makeBtn('Redo', () => editor.chain().focus().redo().run()),
    ];

    buttons.forEach((b) => toolbar.appendChild(b));
    mountEl.prepend(toolbar);
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
            }),
            Underline,
            Link.configure({ openOnClick: false, HTMLAttributes: { rel: 'noopener noreferrer' } }),
            Image.configure({ inline: false }),
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

