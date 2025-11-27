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
    <div class="p-6 bg-gray-800 rounded-lg w-1/2">
        <h1 class="text-2xl font-bold mb-2">Joining: {{ $meeting->class_topic }}</h1>
        <p id="status" class="mb-4">Preparing...</p>
        <p class="text-sm text-gray-400">Open console to follow debug logs.</p>

        <!-- Zoom container (نص الصفحة) -->
        <div id="zoomContainer" class="w-full h-[500px] bg-black rounded"></div>
    </div>

    <script>
        async function loadSDKAndJoin() {
            try {
                window.ZoomMtg.preLoadWasm();
                window.ZoomMtg.prepareWebSDK();
                window.ZoomMtg.i18n.load('en-US');
                window.ZoomMtg.i18n.onLoad(() => {
                    window.ZoomMtg.init({
                        zoomAppRoot: '#zoomContainer',
                        leaveUrl: window.location.origin + '{{ url('/dashboard') }}',
                        disableCORP: !window.crossOriginIsolated,
                        success() {
                            console.log('init ok, join now');
                            window.ZoomMtg.join({
                                meetingNumber: sigResp.json.meetingNumber,
                                userName: "{{ Auth::user()->name }}",
                                signature: sigResp.json.signature,
                                passWord: sigResp.json.password || '',
                                success(res) {
                                    console.log('join success', res);
                                },
                                error(err) {
                                    console.error('join error', err);
                                }
                            });
                        }
                    });
                });
            } catch (e) {
                console.error(e);
            }
        }

        loadSDKAndJoin();
    </script>

</body>

</html>
