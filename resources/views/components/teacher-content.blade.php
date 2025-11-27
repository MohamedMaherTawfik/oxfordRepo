<?php
use App\Models\Courses;
use App\Models\Enrollments;
$course = Courses::where('slug', request('slug'))->first();
$enrollments = Enrollments::where('courses_id', $course->id)->count();
$price = $enrollments * $course->price;
?>
<!-- Main Content -->
<div class="flex flex-col flex-1 overflow-hidden">

    <!-- Main Content Area -->
    <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
                    <p class="text-gray-600">
                        Welcome back, <span class="font-bold">{{ Auth::user()->name }}</span>. Here's what's happening
                        today.
                    </p>
                </div>
                <a class="bg-[#79131DC0] text-white px-4 py-2 rounded-lg shadow hover:bg-[#79131d]" href="">Add New
                    Lesson +</a>
            </div>
        </div>


        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Revenue</p>
                        <p class="text-2xl font-semibold text-gray-800">${{ $price }}</p>
                    </div>
                    <div class="p-3 bg-indigo-100 rounded-lg text-indigo-600">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Enrollments</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $enrollments }}</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-lg text-green-600">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- lessons -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($course->lessons as $lesson)
                <div class="max-w-sm rounded-2xl overflow-hidden shadow-lg bg-white">
                    <img class="w-full h-48 object-cover" src="https://via.placeholder.com/400x200" alt="Card Image">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2 text-gray-800">{{ Str::limit($lesson->title, 25) }}</h2>
                        <p class="text-gray-600">{{ Str::limit($lesson->description, 30) }}</p>
                    </div>
                    {{-- button with href and customized color --}}
                    <div class="p-4">
                        <a href=""
                            class="inline-block px-4 py-2 bg-[#79131DC0] text-white rounded-lg hover:bg-[#79131DFF] transition duration-200">View
                            Lesson</a>
                    </div>
                </div>
            @endforeach
        </div>


</div>
</main>
