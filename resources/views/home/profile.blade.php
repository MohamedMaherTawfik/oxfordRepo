@php
    use App\Models\Enrollments;
    use App\Models\Courses;
    $enrollments = Enrollments::where('user_id', Auth::user()->id)->pluck('courses_id');
    $courses = Courses::whereIn('id', $enrollments)->get();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" x-data="{ activeTab: 'profile' }">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modern Profile Page</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Cairo Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        
        /* RTL Support */
        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }
        
        [dir="rtl"] .space-x-8 > * + * {
            margin-left: 0 !important;
            margin-right: 2rem !important;
        }
        
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body class="antialiased text-gray-800 bg-gray-50">

    <!-- Navbar -->
    <x-navbar />

    <div class="mt-10">.</div>
    <div class="mt-10">.</div>
    <!-- Navigation Tabs -->
    <div class="bg-white shadow-lg w-full z-40 py-3">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <h2 class="text-xl font-bold text-blue-600">MyProfile</h2>
            <div class="space-x-8 hidden md:flex">
                <a href="#" @click.prevent="activeTab = 'profile'"
                    :class="activeTab === 'profile' ? 'text-blue-600' : 'text-gray-700'"
                    class="hover:text-blue-600 font-medium transition">
                    My Profile
                </a>
                <a href="#" @click.prevent="activeTab = 'password'"
                    :class="activeTab === 'password' ? 'text-blue-600' : 'text-gray-700'"
                    class="hover:text-blue-600 font-medium transition">
                    Change Password
                </a>
                @if (Auth::user()->role == 'teacher')
                    <a href="#" @click.prevent="activeTab = 'courses'"
                        :class="activeTab === 'courses' ? 'text-blue-600' : 'text-gray-700'"
                        class="hover:text-blue-600 font-medium transition">
                        My Courses
                    </a>
                @endif
                @if (Auth::user()->role == 'user')
                    <a href="#" @click.prevent="activeTab = 'enrolled'"
                        :class="activeTab === 'enrolled' ? 'text-blue-600' : 'text-gray-700'"
                        class="hover:text-blue-600 font-medium transition">
                        {{ __('messages.MyCourses') }}
                    </a>
                @endif
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-800 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 px-4 py-3 rounded bg-red-100 text-red-800 border border-red-300">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 px-4 py-3 rounded bg-red-100 text-red-800 border border-red-300">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- Main Content -->
    <main class="container mx-auto px-4 pt-16 pb-12">

        <!-- My Profile Section -->
        <section x-show="activeTab === 'profile'"
            class="mb-16 bg-white p-8 rounded-xl shadow-lg border border-gray-200 transition-opacity duration-300 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-user text-blue-500 mr-2"></i> My Profile
            </h2>
            <form class="space-y-6" action="{{ route('settings.update') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" placeholder="{{ Auth::user()->name }}" name="name"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" placeholder="{{ Auth::user()->email }}" name="email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition" />
                    </div>
                </div>
                <!-- Hidden file input + label as button -->
                <div class="flex items-center space-x-4">
                    <div>
                        <label for="photo"
                            class="cursor-pointer px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition inline-flex items-center">
                            <i class="fas fa-upload mr-1"></i> Change Photo
                        </label>
                        <input type="file" id="photo" name="photo" class="hidden" accept="image/*" />
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition transform hover:scale-105 focus:ring-4 focus:ring-blue-300">
                        Save Changes
                    </button>
                </div>
            </form>
        </section>

        <!-- Change Password Section -->
        <section x-show="activeTab === 'password'"
            class="mb-16 bg-white p-8 rounded-xl shadow-lg border border-gray-200 transition-opacity duration-300 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-lock text-blue-500 mr-2"></i> Change Password
            </h2>
            <form class="space-y-6 max-w-lg" action="{{ route('password.update') }}" method="POST">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                    <input type="password" placeholder="Enter current password" name="current_password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                    <input type="password" placeholder="Enter new password" name="new_password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                    <input type="password" placeholder="Confirm new password" name="new_password_confirmation"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                </div>
                <div class="pt-4">
                    <button type="submit"
                        class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition transform hover:scale-105 focus:ring-4 focus:ring-green-300">
                        Update Password
                    </button>
                </div>
            </form>
        </section>

        <!-- My Courses Section -->
        <section x-show="activeTab === 'courses'"
            class="bg-white p-8 rounded-xl shadow-lg border border-gray-200 transition-opacity duration-300 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-graduation-cap text-blue-500 mr-2"></i> My Courses
            </h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Course Card 1 -->
                <div x-data="{ expanded: false }"
                    class="card-hover border border-gray-200 rounded-lg overflow-hidden bg-white shadow-md">
                    <img src="https://source.unsplash.com/random/300x200/?course,web" alt="Course"
                        class="w-full h-40 object-cover" />
                    <div class="p-5">
                        <h3 class="font-bold text-lg text-gray-800">Web Development Bootcamp</h3>
                        <p class="text-sm text-gray-500 mt-1">Learn HTML, CSS, JS, React & more</p>
                        <div :class="{ 'hidden': !expanded }" x-collapse.duration.400ms
                            class="mt-3 text-gray-700 text-sm">
                            <p>This course covers full-stack web development with real projects and lifetime access.</p>
                            <p class="mt-2"><strong>Duration:</strong> 12 weeks</p>
                            <p><strong>{{ __('messages.level') }}:</strong> {{ __('messages.Beginner') }} {{ __('messages.to') ?? 'إلى' }} {{ __('messages.advanced') }}</p>
                        </div>
                        <button @click="expanded = !expanded"
                            class="mt-3 text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center transition">
                            <span x-text="expanded ? '{{ __('messages.hide') }}' : '{{ __('messages.show') }}'"></span>
                            <i :class="expanded ? 'fa-chevron-up ml-1' : 'fa-chevron-down ml-1'"
                                class="fas text-xs"></i>
                        </button>
                    </div>
                </div>

                <!-- Course Card 2 -->
                <div x-data="{ expanded: false }"
                    class="card-hover border border-gray-200 rounded-lg overflow-hidden bg-white shadow-md">
                    <img src="https://source.unsplash.com/random/300x200/?design,ui" alt="Course"
                        class="w-full h-40 object-cover" />
                    <div class="p-5">
                        <h3 class="font-bold text-lg text-gray-800">UI/UX Design Mastery</h3>
                        <p class="text-sm text-gray-500 mt-1">Figma, Adobe XD, User Research</p>
                        <div :class="{ 'hidden': !expanded }" x-collapse.duration.400ms
                            class="mt-3 text-gray-700 text-sm">
                            <p>Master the art of designing intuitive and beautiful user interfaces.</p>
                            <p class="mt-2"><strong>Duration:</strong> 8 weeks</p>
                            <p><strong>{{ __('messages.level') }}:</strong> {{ __('messages.mid') }}</p>
                        </div>
                        <button @click="expanded = !expanded"
                            class="mt-3 text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center transition">
                            <span x-text="expanded ? '{{ __('messages.hide') }}' : '{{ __('messages.show') }}'"></span>
                            <i :class="expanded ? 'fa-chevron-up ml-1' : 'fa-chevron-down ml-1'"
                                class="fas text-xs"></i>
                        </button>
                    </div>
                </div>

                <!-- Course Card 3 -->
                <div x-data="{ expanded: false }"
                    class="card-hover border border-gray-200 rounded-lg overflow-hidden bg-white shadow-md">
                    <img src="https://source.unsplash.com/random/300x200/?ai,machine-learning" alt="Course"
                        class="w-full h-40 object-cover" />
                    <div class="p-5">
                        <h3 class="font-bold text-lg text-gray-800">AI & Machine Learning</h3>
                        <p class="text-sm text-gray-500 mt-1">Python, TensorFlow, NLP</p>
                        <div :class="{ 'hidden': !expanded }" x-collapse.duration.400ms
                            class="mt-3 text-gray-700 text-sm">
                            <p>Get hands-on with AI models, data science, and deep learning frameworks.</p>
                            <p class="mt-2"><strong>Duration:</strong> 16 weeks</p>
                            <p><strong>{{ __('messages.level') }}:</strong> {{ __('messages.advanced') }}</p>
                        </div>
                        <button @click="expanded = !expanded"
                            class="mt-3 text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center transition">
                            <span x-text="expanded ? '{{ __('messages.hide') }}' : '{{ __('messages.show') }}'"></span>
                            <i :class="expanded ? 'fa-chevron-up ml-1' : 'fa-chevron-down ml-1'"
                                class="fas text-xs"></i>
                        </button>
                    </div>
                </div>

            </div>
        </section>

        {{-- Enrolled Courses --}}
        <section x-show="activeTab === 'enrolled'"
            class="bg-white p-8 rounded-xl shadow-lg border border-gray-200 transition-opacity duration-300 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-graduation-cap text-blue-500 mr-2"></i> {{ __('messages.MyCourses') }}
            </h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Course Card 1 -->
                @foreach ($courses as $item)
                    <div x-data="{ expanded: false }"
                        class="card-hover border border-gray-200 rounded-lg overflow-hidden bg-white shadow-md">
                        <img src="https://source.unsplash.com/random/300x200/?course,web" alt="Course"
                            class="w-full h-40 object-cover" />
                        <div class="p-5">
                            <h3 class="font-bold text-lg text-gray-800">{{ $item->title }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $item->description }}</p>

                            <div :class="{ 'hidden': !expanded }" x-collapse.duration.400ms
                                class="mt-3 text-gray-700 text-sm">
                                <p class="mt-2"><strong>Duration:</strong> {{ $item->duration }} hours</p>
                                <p><strong>{{ __('messages.level') }}:</strong> {{ $item->level === 'Beginner' ? __('messages.Beginner') : ($item->level === 'Mid' ? __('messages.mid') : ($item->level === 'Advanced' ? __('messages.advanced') : $item->level)) }}</p>
                            </div>

                            <div class="mt-4 flex items-center justify-between">
                                <!-- Expand/Collapse -->
                                <button @click="expanded = !expanded"
                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center transition">
                                    <span x-text="expanded ? '{{ __('messages.hide') }}' : '{{ __('messages.show') }}'"></span>
                                    <i :class="expanded ? 'fa-chevron-up ml-1' : 'fa-chevron-down ml-1'"
                                        class="fas text-xs"></i>
                                </button>

                                <!-- View Course Button -->
                                <a href="{{ route('myCourse', $item->slug) }}"
                                    class="px-4 py-2 rounded-lg text-white text-sm font-medium hover:opacity-90 transition"
                                    style="background-color: #79131d;">
                                    View Course
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>

    </main>

    <!-- Footer -->
    <x-footer />

</body>

</html>
