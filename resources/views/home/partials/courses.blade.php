@php
    use App\Models\Courses;

    $courses = Courses::all()
        ->map(function ($course) {
            return [
                'id' => $course->id,
                'title' => $course->title,
                'slug' => $course->slug,
                'description' => $course->description,
                'duration' => $course->duration,
                'level' => $course->level,
                'instructor' => $course->instructor,
                'cover_url' => $course->cover_photo
                    ? asset('storage/' . $course->cover_photo)
                    : 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=',
            ];
        })
        ->toArray();

    $perPage = 6;
    $totalPages = ceil(count($courses) / $perPage);
@endphp

<!-- Our Courses Section -->
<section class="py-16 bg-gray-50 border-t border-blue-200">
    <div class="container mx-auto px-6">

        <!-- Courses Grid -->
        <div id="courses-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8"></div>

        <!-- Tabs + Prev/Next -->
        <div class="flex justify-center mt-8 items-center space-x-2" id="pagination-tabs">
            <!-- Prev Button -->
            <button onclick="prevPage()"
                class="px-4 py-2 rounded-lg border border-blue-300 text-blue-600 hover:bg-blue-100 transition"
                id="prev-btn">
                ⬅ Prev
            </button>

            <!-- Dynamic Tabs -->
            @for ($i = 1; $i <= $totalPages; $i++)
                <button onclick="showPage({{ $i }})"
                    class="px-4 py-2 rounded-lg border border-blue-300 text-blue-600 hover:bg-blue-100 transition"
                    id="tab-{{ $i }}">
                    {{ $i }}
                </button>
            @endfor

            <!-- Next Button -->
            <button onclick="nextPage()"
                class="px-4 py-2 rounded-lg border border-blue-300 text-blue-600 hover:bg-blue-100 transition"
                id="next-btn">
                Next ➡
            </button>
        </div>
    </div>
</section>

<script>
    const courses = @json($courses);
    const perPage = {{ $perPage }};
    const totalPages = {{ $totalPages }};
    let currentPage = 1;

    function renderCourses(page) {
        const container = document.getElementById('courses-container');
        container.innerHTML = '';

        const start = (page - 1) * perPage;
        const end = start + perPage;
        const items = courses.slice(start, end);

        items.forEach(course => {
            container.innerHTML += `
                <div class="bg-white rounded-xl shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="relative h-48 overflow-hidden">
                        <img src="${course.cover_url}"
                            alt="${course.title}"
                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" />

                    </div>
                    <div class="p-6">
                        <div class="flex flex-wrap gap-2 text-xs text-gray-500 mb-2">
                            <span class="bg-gray-100 px-2 py-1 rounded">${course.duration} Weeks</span>
                            <span class="bg-gray-100 px-2 py-1 rounded">${course.level}</span>
                            <span class="bg-gray-100 px-2 py-1 rounded">By ${course.instructor}</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">${course.title}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            ${course.description}
                        </p>
                        <a href="/course/${course.slug}"
                            class="block text-center text-blue-600 font-medium hover:text-blue-800 transition-colors duration-300">
                            Get it Now
                        </a>
                    </div>
                </div>`;
        });

        // تحديث التابات
        document.querySelectorAll('#pagination-tabs button[id^="tab-"]').forEach(btn => {
            btn.classList.remove('bg-blue-600', 'text-white');
            btn.classList.add('text-blue-600');
        });
        document.getElementById('tab-' + page).classList.add('bg-blue-600', 'text-white');

        // تفعيل/تعطيل الأزرار
        document.getElementById('prev-btn').disabled = page === 1;
        document.getElementById('next-btn').disabled = page === totalPages;
    }

    function showPage(page) {
        if (page < 1 || page > totalPages) return;
        currentPage = page;
        renderCourses(page);
    }

    function nextPage() {
        if (currentPage < totalPages) {
            showPage(currentPage + 1);
        }
    }

    function prevPage() {
        if (currentPage > 1) {
            showPage(currentPage - 1);
        }
    }

    // أول ما الصفحة تفتح
    document.addEventListener("DOMContentLoaded", () => {
        renderCourses(1);
    });
</script>
