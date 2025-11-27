<x-teacher-panel>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white shadow rounded-lg p-6 w-full max-w-lg">
            <h1 class="text-2xl font-bold mb-4">{{ __('teacher.create_meeting') }}</h1>

            <div id="alert" class="mb-4 text-sm"></div>

            <form id="createForm" class="space-y-4">
                <input id="course_id" type="hidden" value="{{ $course->id }}">

                <div>
                    <label class="block text-sm">{{ __('teacher.topic') }}</label>
                    <input id="class_topic" type="text" required class="w-full p-2 border rounded">
                </div>

                <div>
                    <label class="block text-sm">{{ __('teacher.date_time_local') }}</label>
                    <input id="class_date_and_time" type="datetime-local" value="{{ now()->format('Y-m-d\TH:i') }}"
                        class="w-full p-2 border rounded">
                </div>

                <div class="flex gap-2">
                    <button id="createBtn" type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                        {{ __('teacher.create_and_join') }}
                    </button>
                    <a href="{{ route('zoom.index', $course) }}"
                        class="bg-gray-600 text-white px-4 py-2 rounded">{{ __('teacher.back') }}</a>
                </div>
            </form>

            <p class="mt-4 text-xs text-gray-500">
                {{ __('teacher.console_debug') }}
            </p>
        </div>
    </div>

    <script>
        const createForm = document.getElementById('createForm');
        const alertBox = document.getElementById('alert');

        function logToUI(msg, isError = false) {
            console.log(msg);
            alertBox.innerText = msg;
            alertBox.className = isError ? 'text-red-600 mb-4' : 'text-green-600 mb-4';
        }

        // Load SDK scripts in order
        function loadZoomSDK() {
            console.log('loadZoomSDK: start');
            const scripts = [
                'https://source.zoom.us/4.0.0/lib/vendor/react.min.js',
                'https://source.zoom.us/4.0.0/lib/vendor/react-dom.min.js',
                'https://source.zoom.us/4.0.0/lib/vendor/redux.min.js',
                'https://source.zoom.us/4.0.0/lib/vendor/redux-thunk.min.js',
                'https://source.zoom.us/4.0.0/zoom-meeting-4.0.0.min.js'
            ];

            let chain = Promise.resolve();
            scripts.forEach(src => {
                chain = chain.then(() => new Promise((resolve, reject) => {
                    if (document.querySelector(`script[src="${src}"]`)) {
                        console.log('script already loaded', src);
                        return resolve();
                    }
                    const s = document.createElement('script');
                    s.src = src;
                    s.async = false;
                    s.onload = () => {
                        console.log('loaded script', src);
                        resolve();
                    };
                    s.onerror = () => {
                        console.error('failed to load', src);
                        reject(new Error('Failed to load ' + src));
                    };
                    document.head.appendChild(s);
                    setTimeout(() => reject(new Error('Script load timeout: ' + src)), 15000);
                }));
            });

            return chain.then(() => {
                console.log('All Zoom SDK scripts loaded');
            });
        }

        async function fetchJSON(url, options = {}) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const headers = options.headers || {};
            if (!headers['Content-Type'] && !(options.body instanceof FormData)) headers['Content-Type'] =
                'application/json';
            headers['X-CSRF-TOKEN'] = token;
            headers['X-Requested-With'] = 'XMLHttpRequest';
            options.headers = headers;
            const res = await fetch(url, options);
            const text = await res.text();
            try {
                return {
                    ok: res.ok,
                    status: res.status,
                    json: JSON.parse(text),
                    text
                };
            } catch {
                return {
                    ok: res.ok,
                    status: res.status,
                    json: null,
                    text
                };
            }
        }

        createForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            try {
                const course_id = document.getElementById('course_id').value;
                const class_topic = document.getElementById('class_topic').value;
                const localDate = document.getElementById('class_date_and_time').value;
                if (!localDate) return alert('{{ __('teacher.pick_date') }}');

                const iso = new Date(localDate).toISOString();

                logToUI('{{ __('teacher.creating_meeting') }}');

                const createResp = await fetchJSON('{{ url('/dashboard/zoom/' . $course->id . '/store') }}', {
                    method: 'POST',
                    body: JSON.stringify({
                        course_id,
                        class_topic,
                        class_date_and_time: iso
                    })
                });

                console.log('createResp', createResp);
                if (!createResp.ok) {
                    logToUI('{{ __('teacher.failed_create') }}: ' + (createResp.json?.error || createResp
                            .text),
                        true);
                    return;
                }

                const meeting = createResp.json.meeting;
                logToUI('{{ __('teacher.meeting_created') }} ID: ' + meeting.id +
                    ' — {{ __('teacher.loading_sdk') }}');

                await loadZoomSDK();
                logToUI('{{ __('teacher.sdk_loaded') }} {{ __('teacher.requesting_signature') }}');

                const sigResp = await fetchJSON('{{ url('/dashboard/zoom/signature') }}/' + meeting.id);
                console.log('signature response', sigResp);
                if (!sigResp.ok) {
                    logToUI('{{ __('teacher.failed_signature') }}: ' + (sigResp.json?.error || sigResp.text),
                        true);
                    return;
                }

                const {
                    meetingNumber,
                    signature,
                    password,
                    role
                } = sigResp.json;
                logToUI('{{ __('teacher.signature_received') }} {{ __('teacher.joining_meeting') }}');

                if (!window.ZoomMtg) {
                    logToUI('{{ __('teacher.sdk_not_available') }}', true);
                    return;
                }

                try {
                    document.body.style.margin = '0';
                    document.body.style.padding = '0';
                    document.body.style.overflow = 'hidden';
                    document.body.style.height = '100vh';
                    document.body.style.width = '100vw';

                    window.ZoomMtg.preLoadWasm();
                    window.ZoomMtg.prepareWebSDK();
                    window.ZoomMtg.i18n.load('en-US');
                    window.ZoomMtg.i18n.onLoad(() => {
                        window.ZoomMtg.init({
                            leaveUrl: window.location.origin + '{{ url('/dashboard/zoom') }}',
                            disableCORP: !window.crossOriginIsolated,
                            success: function() {
                                console.log('Zoom init success, joining...');
                                window.ZoomMtg.join({
                                    meetingNumber,
                                    userName: 'Student-' + Math.floor(Math
                                        .random() * 1000),
                                    signature,
                                    userEmail: '',
                                    passWord: password || '',
                                    success: function(res) {
                                        console.log('Join success', res);
                                        logToUI(
                                            '{{ __('teacher.joined_meeting') }}'
                                        );
                                    },
                                    error: function(err) {
                                        console.error('join error', err);
                                        logToUI('{{ __('teacher.failed_join') }}: ' +
                                            (err.message || JSON.stringify(
                                                err)), true);
                                    }
                                });
                            },
                            error: function(err) {
                                console.error('init error', err);
                                logToUI('{{ __('teacher.init_error') }}: ' + (err
                                    .message ||
                                    JSON.stringify(err)), true);
                            }
                        });
                    });
                } catch (e) {
                    console.error('zoom init/join exception', e);
                    logToUI('{{ __('teacher.exception') }}: ' + e.message, true);
                }

            } catch (err) {
                console.error('unexpected', err);
                logToUI('{{ __('teacher.unexpected_error') }}: ' + err.message, true);
            }
        });
    </script>
</x-teacher-panel>
