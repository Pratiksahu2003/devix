@extends('layouts.admin')

@section('title', 'Create Post')
@section('page_title', 'Draft New Article')
@section('page_subtitle', 'Write and publish a new post to your blog.')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Posts
    </a>
</div>

<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start" x-data="{ 
    title: '{{ old('title') }}', 
    slug: '{{ old('slug') }}', 
    autoSync: {{ old('slug') ? 'false' : 'true' }},
    generateSlug(text) {
        return text.toString().trim().toLowerCase()
            .replace(/\s+/g, '-')           
            .replace(/[^\w\-]+/g, '')       
            .replace(/\-\-+/g, '-')         
            .replace(/^-+/, '')             
            .replace(/-+$/, '');            
    }
}">
    @csrf

    <!-- Main Editor Column -->
    <div class="lg:col-span-2 space-y-6">
        
        <!-- Core Content Details -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
            <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Article Content
            </h3>
            
            <div class="space-y-5">
                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-700 mb-1.5">Article Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" x-model="title" @input="if(autoSync) slug = generateSlug(title)" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors" required>
                    @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-1.5">Category</label>
                    <select name="category_id" id="category_id" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors bg-white">
                        <option value="">Select a Category...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ newTag: '', tags: {{ old('tags') ? old('tags') : '[]' }} }">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Article Tags</label>
                    <div class="flex flex-wrap gap-2 mb-2" x-show="tags.length > 0">
                        <template x-for="(tag, index) in tags" :key="index">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-sm font-medium border border-indigo-100">
                                <span x-text="tag"></span>
                                <button type="button" @click="tags.splice(index, 1)" class="hover:text-indigo-900 focus:outline-none focus:text-indigo-900 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </span>
                        </template>
                    </div>
                    <div class="flex gap-2">
                        <input type="text" x-model="newTag" @keydown.enter.prevent="if(newTag.trim() !== '' && !tags.includes(newTag.trim())) { tags.push(newTag.trim()); newTag = ''; }" class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors text-sm" placeholder="Type a tag and press Add or Enter">
                        <button type="button" @click="if(newTag.trim() !== '' && !tags.includes(newTag.trim())) { tags.push(newTag.trim()); newTag = ''; }" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 font-semibold rounded-xl text-slate-600 transition-colors text-sm shadow-sm border border-slate-200">Add</button>
                    </div>
                    <input type="hidden" name="tags" :value="JSON.stringify(tags)">
                </div>

                <div>
                    <label for="excerpt" class="block text-sm font-semibold text-slate-700 mb-1.5">Short Excerpt (Optional)</label>
                    <textarea name="excerpt" id="excerpt" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors placeholder:text-slate-400" placeholder="A brief summary of the article for blog listings...">{{ old('excerpt') }}</textarea>
                    @error('excerpt') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="content" class="block text-sm font-semibold text-slate-700 mb-1.5">Full Content <span class="text-red-500">*</span></label>
                    <textarea name="content" id="content" rows="15" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors">{{ old('content') }}</textarea>
                    @error('content') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- SEO Parameters -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
            <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Search Engine Optimization
            </h3>
            
            <div class="space-y-5">
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="slug" class="block text-sm font-semibold text-slate-700">URL Slug</label>
                        <label class="flex items-center gap-1.5 text-xs text-slate-500 cursor-pointer hover:text-indigo-600 transition-colors">
                            <input type="checkbox" x-model="autoSync" class="w-3.5 h-3.5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                            Auto-sync with title
                        </label>
                    </div>
                    <div class="flex">
                        <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-slate-300 bg-slate-50 text-slate-500 text-sm">/blog/</span>
                        <input type="text" name="slug" id="slug" x-model="slug" @input="autoSync = false" class="w-full px-4 py-2.5 rounded-r-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors placeholder:text-slate-400" placeholder="my-awesome-article">
                    </div>
                    @error('slug') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="meta_title" class="block text-sm font-semibold text-slate-700 mb-1.5">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('meta_title') ? 'border-red-500 ring-1 ring-red-500' : 'border-slate-300' }} focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors" placeholder="SEO Title">
                        @error('meta_title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="meta_keywords" class="block text-sm font-semibold text-slate-700 mb-1.5">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}" class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('meta_keywords') ? 'border-red-500 ring-1 ring-red-500' : 'border-slate-300' }} focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors" placeholder="news, article, blog">
                        @error('meta_keywords') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="meta_description" class="block text-sm font-semibold text-slate-700 mb-1.5">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="2" class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('meta_description') ? 'border-red-500 ring-1 ring-red-500' : 'border-slate-300' }} focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors">{{ old('meta_description') }}</textarea>
                    @error('meta_description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

    </div>

    <!-- Right Sidebar Content Controls -->
    <div class="lg:col-span-1 space-y-6 lg:sticky lg:top-8">
        
        <!-- Publishing Control -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Publishing
            </h3>
            
            <label class="flex items-center gap-3 p-4 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-100 transition-colors mb-6">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} class="w-5 h-5 text-emerald-600 rounded bg-white border-slate-300 focus:ring-emerald-500 focus:ring-2">
                <div>
                    <div class="font-semibold text-slate-700 text-sm">Publish Immediately</div>
                    <div class="text-xs text-slate-500">Make this article live on the blog.</div>
                </div>
            </label>

            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-indigo-500/30 transition-all active:scale-[0.98]">
                Save Article
            </button>
        </div>

        <!-- Hero Media Integration -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Hero Media
            </h3>
            
            <div class="space-y-4">
                <div>
                    <label for="cover_image" class="block text-sm font-semibold text-slate-700 mb-1.5">Cover Image (Banner)</label>
                    <input type="file" name="cover_image" id="cover_image" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-colors">
                    @error('cover_image') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="video_url" class="block text-sm font-semibold text-slate-700 mb-1.5">Or Hero Video URL</label>
                    <input type="url" name="video_url" id="video_url" value="{{ old('video_url') }}" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors text-sm" placeholder="https://youtube.com/...">
                    <p class="text-xs text-slate-500 mt-1">If provided, this overrides the cover image banner with a cinematic video player.</p>
                    @error('video_url') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

    </div>
</form>

<style>
/* CKEditor 5 custom styles */
.ck-editor__editable_inline {
    min-height: 500px;
    max-height: 700px;
    overflow-y: auto;
    border-bottom-left-radius: 0.75rem !important;
    border-bottom-right-radius: 0.75rem !important;
    font-size: 1rem;
    line-height: 1.7;
    padding: 1.25rem 1.5rem !important;
}
.ck-toolbar {
    border-top-left-radius: 0.75rem !important;
    border-top-right-radius: 0.75rem !important;
    background: #f8fafc !important;
    border-color: #e2e8f0 !important;
    flex-wrap: wrap !important;
    padding: 6px !important;
}
.ck-editor__main .ck-editor__editable {
    border-color: #e2e8f0 !important;
}
.ck-editor__main .ck-editor__editable:focus {
    border-color: #6366f1 !important;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.12) !important;
}
.ck-editor--has-error .ck-editor__editable,
.ck-editor--has-error .ck-toolbar {
    border-color: #ef4444 !important;
}
.ck-editor--has-error .ck-toolbar {
    box-shadow: 0 0 0 1px #ef4444 !important;
}
</style>

@vite(['resources/js/ckeditor.js'])
<script>
document.addEventListener("DOMContentLoaded", function () {
    const contentTextarea = document.querySelector('#content');

    function Base64UploadAdapter(loader) { this.loader = loader; }
    Base64UploadAdapter.prototype.upload = function () {
        return this.loader.file.then(file => new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = () => resolve({ default: reader.result });
            reader.onerror = err => reject(err);
            reader.readAsDataURL(file);
        }));
    };
    Base64UploadAdapter.prototype.abort = function () {};
    function Base64UploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = loader => new Base64UploadAdapter(loader);
    }

    ClassicEditor
        .create(contentTextarea, {
            plugins: [
                window.CKEditorPlugins.Essentials,
                window.CKEditorPlugins.Autoformat,
                window.CKEditorPlugins.Bold,
                window.CKEditorPlugins.Italic,
                window.CKEditorPlugins.Underline,
                window.CKEditorPlugins.Strikethrough,
                window.CKEditorPlugins.FontSize,
                window.CKEditorPlugins.FontColor,
                window.CKEditorPlugins.FontBackgroundColor,
                window.CKEditorPlugins.Heading,
                window.CKEditorPlugins.Link,
                window.CKEditorPlugins.List,
                window.CKEditorPlugins.ListProperties,
                window.CKEditorPlugins.TodoList,
                window.CKEditorPlugins.Indent,
                window.CKEditorPlugins.IndentBlock,
                window.CKEditorPlugins.BlockQuote,
                window.CKEditorPlugins.HorizontalLine,
                window.CKEditorPlugins.Image,
                window.CKEditorPlugins.ImageCaption,
                window.CKEditorPlugins.ImageStyle,
                window.CKEditorPlugins.ImageToolbar,
                window.CKEditorPlugins.ImageUpload,
                window.CKEditorPlugins.ImageResize,
                window.CKEditorPlugins.LinkImage,
                window.CKEditorPlugins.Base64UploadAdapter,
                window.CKEditorPlugins.MediaEmbed,
                window.CKEditorPlugins.Table,
                window.CKEditorPlugins.TableToolbar,
                window.CKEditorPlugins.TableCellProperties,
                window.CKEditorPlugins.TableProperties,
                window.CKEditorPlugins.TableColumnResize,
                window.CKEditorPlugins.Code,
                window.CKEditorPlugins.CodeBlock,
                window.CKEditorPlugins.FindAndReplace,
                window.CKEditorPlugins.RemoveFormat,
                window.CKEditorPlugins.SourceEditing,
                window.CKEditorPlugins.Alignment,
                window.CKEditorPlugins.PasteFromOffice,
                window.CKEditorPlugins.Paragraph,
            ],
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'fontSize', 'fontColor', 'fontBackgroundColor', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'insertTable', 'mediaEmbed', 'blockQuote', 'horizontalLine', '|',
                    'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent', '|',
                    'code', 'codeBlock', '|',
                    'undo', 'redo', 'findAndReplace', '|',
                    'removeFormat', 'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            image: {
                toolbar: ['imageStyle:inline', 'imageStyle:block', 'imageStyle:side', '|', 'toggleImageCaption', 'imageTextAlternative', '|', 'resizeImage']
            },
            table: {
                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableCellProperties', 'tableProperties']
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
                ]
            },
            placeholder: 'Write your full article content here...',
            language: 'en'
        })
        .then(editor => {
            window._postEditor = editor;

            @if($errors->has('content'))
            editor.ui.view.element.classList.add('ck-editor--has-error');
            @endif

            const form = contentTextarea.closest('form');
            if (form) {
                form.addEventListener('submit', function () {
                    contentTextarea.value = editor.getData();
                });
            }
        })
        .catch(error => { console.error('CKEditor init error:', error); });
});
</script>
@endsection
