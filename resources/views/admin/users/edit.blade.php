@extends('layouts.admin')

@section('title', 'Edit Administrator')
@section('page_title', 'Edit Administrator')
@section('page_subtitle', 'Update account settings for ' . $user->name)

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-800 transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Admin Users
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden max-w-2xl">
    <div class="p-6 sm:p-8 border-b border-slate-100">
        <h3 class="text-xl font-bold text-slate-800">Account Details</h3>
        <p class="text-sm text-slate-500 mt-1">Update the profile or set a new password. Leave password empty to keep current.</p>
    </div>

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6 sm:p-8 space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('name') ? 'border-red-300 focus:ring-red-500' : 'border-slate-300 focus:border-indigo-500 focus:ring-indigo-500/20' }} focus:ring-2 focus:outline-none transition-colors" required>
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('email') ? 'border-red-300 focus:ring-red-500' : 'border-slate-300 focus:border-indigo-500 focus:ring-indigo-500/20' }} focus:ring-2 focus:outline-none transition-colors" required>
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 border-t border-slate-100">
                <h4 class="text-sm font-medium text-slate-800 mb-4">Change Password</h4>
                
                <div class="space-y-4">
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">New Password <span class="font-normal text-slate-400">(Optional)</span></label>
                        <input type="password" name="password" id="password" class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('password') ? 'border-red-300 focus:ring-red-500' : 'border-slate-300 focus:border-indigo-500 focus:ring-indigo-500/20' }} focus:ring-2 focus:outline-none transition-colors">
                        @error('password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-colors">
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6 flex justify-end">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl font-semibold transition-colors shadow-sm focus:ring-2 focus:ring-indigo-500/50">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
