<?php
use App\Models\User;
use App\Models\Courses;
use App\Models\applyTeacher;
use App\Models\diplomas;
use App\Models\Staff;

$totalUsers = User::where('role', 'user')->count();
$totalTeachers = User::where('role', 'teacher')->count();
$totalStaff = User::where('role', 'staff')->count();
$totalCourses = Courses::count();
$totalDiplomas = Diplomas::count();
$pendings = applyTeacher::where('status', 'pending')->count();
$accepted = applyTeacher::where('status', 'accepted')->count();
$rejected = applyTeacher::where('status', 'rejected')->count();
$users = User::orderBy('created_at', 'desc')->take(10)->get();
$recentCourses = Courses::orderBy('created_at', 'desc')->take(5)->get();
?>
@include('components.messages')

<!-- Main Content Area -->
<main class="flex-1 overflow-y-auto p-6 bg-gradient-to-br from-gray-50 via-white to-gray-50">
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">
            {{ __('main.welcome_back') }}، {{ Auth::user()->name }} 👋
        </h1>
        <p class="text-gray-600">{{ __('main.system_overview') }}</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Students Card -->
        <div
            class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <span class="text-blue-100 text-sm font-medium">{{ __('main.students') }}</span>
            </div>
            <h3 class="text-4xl font-bold mb-2">{{ $totalUsers }}</h3>
            <p class="text-blue-100 text-sm flex items-center">
                <i class="fas fa-arrow-up mr-2"></i>
                <span>{{ __('main.total_students') }}</span>
            </p>
        </div>

        <!-- Total Courses Card -->
        <div
            class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                    <i class="fas fa-book-open text-2xl"></i>
                </div>
                <span class="text-green-100 text-sm font-medium">{{ __('main.courses') }}</span>
            </div>
            <h3 class="text-4xl font-bold mb-2">{{ $totalCourses }}</h3>
            <p class="text-green-100 text-sm flex items-center">
                <i class="fas fa-book mr-2"></i>
                <span>{{ __('main.total_courses_available') }}</span>
            </p>
        </div>

        <!-- Total Teachers Card -->
        <div
            class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                    <i class="fas fa-chalkboard-teacher text-2xl"></i>
                </div>
                <span class="text-purple-100 text-sm font-medium">{{ __('main.teachers') }}</span>
            </div>
            <h3 class="text-4xl font-bold mb-2">{{ $totalTeachers }}</h3>
            <p class="text-purple-100 text-sm flex items-center">
                <i class="fas fa-user-tie mr-2"></i>
                <span>{{ __('main.total_active_teachers') }}</span>
            </p>
        </div>

        <!-- Pending Applications Card -->
        <div
            class="bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                    <i class="fas fa-hourglass-half text-2xl"></i>
                </div>
                <span class="text-orange-100 text-sm font-medium">{{ __('main.pending') }}</span>
            </div>
            <h3 class="text-4xl font-bold mb-2">{{ $pendings }}</h3>
            <p class="text-orange-100 text-sm flex items-center">
                <i class="fas fa-clock mr-2"></i>
                <span>{{ __('main.pending_teacher_applications') }}</span>
            </p>
        </div>
    </div>

    <!-- Secondary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Staff Card -->
        @if (auth()->user()->role === 'admin')
            <div
                class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-[#79131d] hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">{{ __('main.staff') }}</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $totalStaff }}</h3>
                    </div>
                    <div class="bg-[#79131d]/10 rounded-full p-4">
                        <i class="fas fa-user-tie text-[#79131d] text-2xl"></i>
                    </div>
                </div>
            </div>
        @endif

        <!-- Diplomas Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-indigo-500 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">{{ __('main.diplomas') }}</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $totalDiplomas }}</h3>
                </div>
                <div class="bg-indigo-100 rounded-full p-4">
                    <i class="fas fa-certificate text-indigo-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Applications Summary -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <p class="text-gray-500 text-sm font-medium">{{ __('main.applications_summary') }}</p>
                <i class="fas fa-clipboard-list text-yellow-500"></i>
            </div>
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">{{ __('main.accepted') }}</span>
                    <span
                        class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">{{ $accepted }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">{{ __('main.rejected') }}</span>
                    <span
                        class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold">{{ $rejected }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Recent Users Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-[#79131d] to-[#5a0f16] px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <i class="fas fa-users mr-3"></i>
                        {{ __('teacher.recent_users') }}
                    </h3>
                    <a href="{{ route('admin.users') }}" class="text-[#e4ce96] hover:text-white text-sm font-medium">
                        {{ __('main.view_all') }} <i class="fas fa-arrow-left mr-1"></i>
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-700 uppercase">
                                {{ __('main.name') }}</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-700 uppercase">
                                {{ __('main.email') }}</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase">
                                {{ __('main.role') }}</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase">
                                {{ __('main.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=79131d&color=fff' }}"
                                            alt="{{ $user->name }}" class="w-8 h-8 rounded-full mr-3">
                                        <span class="text-sm font-medium text-gray-900">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $user->email }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-center">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if ($user->role === 'admin') bg-red-100 text-red-800
                                        @elseif($user->role === 'teacher') bg-blue-100 text-blue-800
                                        @elseif($user->role === 'staff') bg-purple-100 text-purple-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="text-[#79131d] hover:text-[#5a0f16] mr-3">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800"
                                            onclick="return confirm('{{ __('main.confirm_delete') }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                    <i class="fas fa-users text-4xl mb-2 text-gray-300"></i>
                                    <p>{{ __('main.no_users') }}</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Courses -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <i class="fas fa-book-open mr-3"></i>
                        {{ __('main.recent_courses') }}
                    </h3>
                    <a href="{{ route('admin.courses.all') }}"
                        class="text-white hover:text-gray-100 text-sm font-medium">
                        {{ __('main.view_all') }} <i class="fas fa-arrow-left mr-1"></i>
                    </a>
                </div>
            </div>
            <div class="p-4">
                <div class="space-y-3">
                    @forelse($recentCourses as $course)
                        <div
                            class="flex items-center gap-4 p-3 rounded-lg hover:bg-gray-50 transition-colors border border-gray-100">
                            <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-200 flex-shrink-0">
                                <img src="{{ $course->cover_photo_url ?? asset('images/coursePlace.png') }}"
                                    alt="{{ $course->title }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-semibold text-gray-900 truncate">{{ $course->title }}</h4>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-user mr-1"></i>
                                    {{ $course->user->name ?? __('main.general') }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">
                                    <i class="fas fa-calendar mr-1"></i>
                                    {{ $course->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <a href="{{ route('admin.courses.show', $course->slug) }}"
                                class="text-[#79131d] hover:text-[#5a0f16]">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-book text-4xl mb-2 text-gray-300"></i>
                            <p>{{ __('main.no_courses') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-bolt text-[#79131d] mr-3"></i>
            {{ __('main.quick_actions') }}
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.users.create') }}"
                class="flex flex-col items-center justify-center p-4 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 transition-all transform hover:scale-105">
                <i class="fas fa-user-plus text-2xl text-blue-600 mb-2"></i>
                <span class="text-sm font-semibold text-blue-900">{{ __('main.add_user') }}</span>
            </a>
            <a href="{{ route('admin.courses.create') }}"
                class="flex flex-col items-center justify-center p-4 rounded-xl bg-gradient-to-br from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 transition-all transform hover:scale-105">
                <i class="fas fa-plus-circle text-2xl text-green-600 mb-2"></i>
                <span class="text-sm font-semibold text-green-900">{{ __('main.add_course') }}</span>
            </a>
            <a href="{{ route('admin.applies') }}"
                class="flex flex-col items-center justify-center p-4 rounded-xl bg-gradient-to-br from-orange-50 to-orange-100 hover:from-orange-100 hover:to-orange-200 transition-all transform hover:scale-105">
                <i class="fas fa-clipboard-list text-2xl text-orange-600 mb-2"></i>
                <span class="text-sm font-semibold text-orange-900">{{ __('main.applications') }}</span>
            </a>
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('admin.staff.create') }}"
                    class="flex flex-col items-center justify-center p-4 rounded-xl bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 transition-all transform hover:scale-105">
                    <i class="fas fa-user-tie text-2xl text-purple-600 mb-2"></i>
                    <span class="text-sm font-semibold text-purple-900">{{ __('main.add_staff') }}</span>
                </a>
            @endif
        </div>
    </div>
</main>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeInUp 0.5s ease-out;
    }
</style>
