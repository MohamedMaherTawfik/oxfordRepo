<x-panel>

    <h1 class="text-2xl font-bold mb-4">
        {{ __('main.lessons_for') }}: {{ $diploma->name }}
    </h1>

    <a href="{{ route('diplomas.create.lesson', $diploma->id) }}"
        class="px-4 py-2 w-[10%] ml-2 bg-[#79131d] hover:bg-[#5F0912FF] text-white rounded mb-4 inline-block">
        + {{ __('main.add_lesson') }}
    </a>

    <table class="w-full bg-white shadow rounded mt-4">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-3">{{ __('main.title') }}</th>
                <th class="p-3">{{ __('main.description') }}</th>
                <th class="p-3">{{ __('main.video') }}</th>
                <th class="p-3">{{ __('main.image') }}</th>
                <th class="p-3">{{ __('main.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($diploma->lessons as $lesson)
                <tr class="border-b">
                    <td class="p-3">{{ $lesson->title }}</td>
                    <td class="p-3">{{ $lesson->description }}</td>
                    <td class="p-3">
                        @if ($lesson->video_url)
                            <video width="150" controls class="rounded shadow">
                                <source src="{{ asset('storage/' . $lesson->video_url) }}" type="video/mp4">
                                {{ __('main.browser_not_support') }}
                            </video>
                        @else
                            <span class="text-gray-400">{{ __('main.no_video') }}</span>
                        @endif
                    </td>

                    <td class="p-3">
                        @if ($lesson->image)
                            <img src="{{ asset('storage/' . $lesson->image) }}" class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="text-gray-400">{{ __('main.no_image') }}</span>
                        @endif
                    </td>
                    <td class="p-3">
                        <form action="{{ route('diplomas.delete.lesson', $diploma->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                            <button class="px-3 py-1 bg-red-600 text-white rounded"
                                onclick="return confirm('{{ __('main.delete_confirm') }}')">
                                {{ __('main.delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-panel>
