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
};
