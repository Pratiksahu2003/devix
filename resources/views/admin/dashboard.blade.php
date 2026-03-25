@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Overview')
@section('page_subtitle', 'Welcome back, ' . auth('admin')->user()->name)

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stat Card 1 -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center justify-between group hover:shadow-md transition-shadow">
        <div>
            <p class="text-sm font-semibold text-slate-500 mb-1">Total Users</p>
            <h3 class="text-3xl font-bold text-slate-800 transform group-hover:scale-105 transition-transform origin-left">1,248</h3>
            <p class="text-xs text-emerald-500 font-medium mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                +12% this week
            </p>
        </div>
        <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-500 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300 shadow-inner">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </div>
    </div>
    
    <!-- Stat Card 2 -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center justify-between group hover:shadow-md transition-shadow">
        <div>
            <p class="text-sm font-semibold text-slate-500 mb-1">Active Admins</p>
            <h3 class="text-3xl font-bold text-slate-800 transform group-hover:scale-105 transition-transform origin-left">{{ \App\Models\Admin::count() }}</h3>
            <p class="text-xs text-slate-400 font-medium mt-2 flex items-center gap-1">
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                Current system admins
            </p>
        </div>
        <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-500 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300 shadow-inner">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
        </div>
    </div>

    <!-- Stat Card 3 -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center justify-between group hover:shadow-md transition-shadow">
        <div>
            <p class="text-sm font-semibold text-slate-500 mb-1">Revenue</p>
            <h3 class="text-3xl font-bold text-slate-800 transform group-hover:scale-105 transition-transform origin-left">$48.2k</h3>
            <p class="text-xs text-emerald-500 font-medium mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                +8.4% vs last month
            </p>
        </div>
        <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300 shadow-inner">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
    </div>

    <!-- Stat Card 4 -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center justify-between group hover:shadow-md transition-shadow">
        <div>
            <p class="text-sm font-semibold text-slate-500 mb-1">Sessions</p>
            <h3 class="text-3xl font-bold text-slate-800 transform group-hover:scale-105 transition-transform origin-left">5.4k</h3>
            <p class="text-xs text-red-500 font-medium mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                -2% today
            </p>
        </div>
        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300 shadow-inner">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
        </div>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden relative overflow-hidden">
    <!-- Abstract glowing gradient background element inside card -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>

    <div class="p-8 border-b border-slate-100 relative z-10 text-left">
        <h3 class="text-xl font-bold text-slate-800">Admin User Management</h3>
        <p class="text-sm text-slate-500 mt-1.5 max-w-2xl">Effortlessly add, manage, or remove administrator access to your platform. Maintaining a tight security perimeter begins here.</p>
    </div>
    <div class="p-8 bg-slate-50/50 relative z-10 flex lg:justify-start">
        <div class="flex items-center gap-4">
            @if(Route::has('admin.users.index'))
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white px-6 py-3 rounded-xl font-semibold transition-all transform hover:-translate-y-0.5 shadow-lg shadow-indigo-500/30 focus:ring-2 focus:ring-indigo-500/50 focus:ring-offset-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Manage Admin Users
            </a>
            @else
            <span class="text-sm text-slate-400 italic">User Management Module is being installed...</span>
            @endif
        </div>
    </div>
</div>

@endsection
