<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('components.style')
    <title>{{ $title }}</title>
</head>
<body>
    @include('components.navbar')
    <div class="container">
        @include('components.toast')
        @yield('content')
    </div>
    @include('components.footer')
    @include('components.script')

    <script>
        function logout() {
            Swal.fire({
                icon: 'question',
                title: 'Are you sure?',
                text: 'Are you sure you want to logout?',
                showCancelButton: true,
                confirmButtonText: 'Logout',
                customClass: {
                    popup: 'bg-modal',
                    title: 'text-color',
                    htmlContainer: 'text-color fw-normal',
                    icon: 'border-primary primary-color',
                    closeButton: 'bg-secondary border-0 shadow-none',
                    confirmButton: 'bg-danger border-0 shadow-none',
                },
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
</body>
</html>