<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Join Meeting</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-900 min-h-screen flex items-center justify-center text-white">
    <div class="p-6 bg-gray-800 rounded-lg w-full max-w-2xl text-center">
        <h1 class="text-2xl font-bold mb-2">Joining: {{ $meeting->class_topic }}</h1>
        <p id="status" class="mb-4">Preparing...</p>
        <p class="text-sm text-gray-400">Open console to follow debug logs.</p>
    </div>

    <script>
        const meetingId = "{{ $meeting->id }}";

        async function fetchJSON(url, options = {}) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const headers = options.headers || {};
            if (!headers['Content-Type'] && !(options.body instanceof FormData))
                headers['Content-Type'] = 'application/json';
            headers['X-CSRF-TOKEN'] = token;
            headers['X-Requested-With'] = 'XMLHttpRequest';
            options.headers = headers;
            const res = await fetch(url, options);
            const txt = await res.text();
            try {
                return {
                    ok: res.ok,
                    status: res.status,
                    json: JSON.parse(txt),
                    text: txt
                };
            } catch {
                return {
                    ok: res.ok,
                    status: res.status,
                    json: null,
                    text: txt
                };
            }
        }

        // Function to set status message and style
        function setStatus(msg, err = false) {
            console.log(msg);
            document.getElementById('status').innerText = msg;
            document.getElementById('status').className = err ? 'mb-4 text-red-400' : 'mb-4 text-green-300';
        }

        async function loadSDKAndJoin() {
            try {
                setStatus('Requesting signature from server...');
                const sigResp = await fetchJSON('{{ url('/dashboard/zoom/signature-student') }}/' + meetingId);
                console.log('sigResp student', sigResp);

                if (!sigResp.ok) {
                    setStatus('Failed to get student signature: ' + (sigResp.json?.error || sigResp.text), true);
                    return;
                }

                setStatus('Loading Zoom SDK scripts...');
                // Load the required Zoom SDK scripts
                const scripts = [
                    'https://source.zoom.us/4.0.0/lib/vendor/react.min.js',
                    'https://source.zoom.us/4.0.0/lib/vendor/react-dom.min.js',
                    'https://source.zoom.us/4.0.0/lib/vendor/redux.min.js',
                    'https://source.zoom.us/4.0.0/lib/vendor/redux-thunk.min.js',
                    'https://source.zoom.us/4.0.0/zoom-meeting-4.0.0.min.js'
                ];

                for (const src of scripts) {
                    if (!document.querySelector(`script[src="${src}"]`)) {
                        await new Promise((resolve, reject) => {
                            const script = document.createElement('script');
                            script.src = src;
                            script.async = false; // Load sequentially to ensure dependencies
                            script.onload = () => {
                                console.log('Loaded:', src);
                                resolve();
                            };
                            script.onerror = () => {
                                console.error('Failed to load:', src);
                                reject(new Error('Failed to load ' + src));
                            };
                            document.head.appendChild(script);
                            // Add a timeout to prevent hanging
                            setTimeout(() => {
                                reject(new Error('Timeout loading ' + src));
                            }, 15000);
                        });
                    } else {
                        console.log('Already loaded:', src);
                    }
                }

                setStatus('SDK loaded — initializing Zoom...');
                const {
                    meetingNumber,
                    signature,
                    password
                } = sigResp.json;

                // Prepare the body for Zoom (optional, but recommended)
                document.body.style.margin = '0';
                document.body.style.padding = '0';
                document.body.style.overflow = 'hidden';
                document.body.style.height = '100vh';
                document.body.style.width = '100vw';

                // Initialize and join
                window.ZoomMtg.preLoadWasm();
                window.ZoomMtg.prepareWebSDK();
                window.ZoomMtg.i18n.load('en-US');

                window.ZoomMtg.i18n.onLoad(() => {
                    window.ZoomMtg.init({
                        leaveUrl: window.location.origin + '{{ url('/dashboard') }}',
                        disableCORP: !window.crossOriginIsolated,
                        success() {
                            console.log('Zoom init successful');
                            setStatus('Joining meeting...');
                            window.ZoomMtg.join({
                                meetingNumber,
                                userName: 'student',
                                signature,
                                passWord: password || '',
                                userEmail: '',
                                success(res) {
                                    console.log('Student join success', res);
                                    setStatus('Joined — Zoom took over the page');
                                },
                                error(err) {
                                    console.error('Student join error', err);
                                    setStatus('Join error: ' + JSON.stringify(err), true);
                                }
                            });
                        },
                        error(err) {
                            console.error('Zoom init error', err);
                            setStatus('Init error: ' + JSON.stringify(err), true);
                        }
                    });
                });

            } catch (error) {
                console.error('Unexpected error in loadSDKAndJoin:', error);
                setStatus('Unexpected error: ' + error.message, true);
            }
        }

        // Start the process
        loadSDKAndJoin();
    </script>

</body>

</html>
