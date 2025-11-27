<form id="autoForm" action="{{ route('pay.later', $course) }}" method="POST">
    @csrf
</form>

<script>
    document.getElementById('autoForm').submit();
</script>
