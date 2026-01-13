<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <title>@yield('title', 'Toko bunga') - {{ config('app.name') }}</title>
    <meta name="description"
        content="@yield('meta_description', 'Toko bunga')">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ================= HERO OVERLAY STYLE ================= --}}
    <style>
        .hero-banner {
            position: relative;
            width: 100%;
            height: 560px; /* FOTO BESAR */
            overflow: hidden;
        }

        .hero-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(59, 47, 47, 0.6);
        }

        .hero-content {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            z-index: 2;
            color: #fff;
            max-width: 700px;
        }

        .hero-content h1 {
            font-size: 3.2rem;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .hero-content p {
            font-size: 1.1rem;
            margin-bottom: 28px;
            color: #f1eaea;
        }

        .hero-btn {
            background: #8b5e3c;
            color: #fff;
            padding: 14px 30px;
            border-radius: 10px;
            text-decoration: none;
            width: fit-content;
            font-weight: 600;
        }

        .hero-btn:hover {
            background: #6f4628;
        }

        @media (max-width: 768px) {
            .hero-banner {
                height: 420px;
            }

            .hero-content h1 {
                font-size: 2.2rem;
            }

            .hero-content p {
                font-size: 1rem;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- FLASH MESSAGE --}}
    <div class="container">
        @include('partials.flash-messages')
    </div>

    {{-- CONTENT --}}
    <main class="min-vh-100">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('partials.footer')

    {{-- SCRIPT --}}
    @stack('scripts')

    {{-- WISHLIST --}}
    <script>
        async function toggleWishlist(productId) {
            try {
                const token = document.querySelector('meta[name="csrf-token"]').content;

                const response = await fetch(`/wishlist/toggle/${productId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token,
                    },
                });

                if (response.status === 401) {
                    window.location.href = "/login";
                    return;
                }

                const data = await response.json();

                if (data.status === "success") {
                    updateWishlistUI(productId, data.added);
                    updateWishlistCounter(data.count);
                }
            } catch (error) {
                console.error(error);
            }
        }

        function updateWishlistUI(productId, isAdded) {
            const buttons = document.querySelectorAll(`.wishlist-btn-${productId}`);

            buttons.forEach(btn => {
                const icon = btn.querySelector("i");
                if (isAdded) {
                    icon.classList.remove("bi-heart");
                    icon.classList.add("bi-heart-fill", "text-danger");
                } else {
                    icon.classList.remove("bi-heart-fill", "text-danger");
                    icon.classList.add("bi-heart");
                }
            });
        }

        function updateWishlistCounter(count) {
            const badge = document.getElementById("wishlist-count");
            if (!badge) return;

            badge.innerText = count;
            badge.style.display = count > 0 ? "inline-block" : "none";
        }
    </script>

    {{-- THEME TOGGLE --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const html = document.documentElement;
            const toggleBtn = document.getElementById("themeToggle");
            const icon = document.getElementById("themeIcon");

            if (!toggleBtn) return;

            const savedTheme = localStorage.getItem("theme") || "light";
            setTheme(savedTheme);

            toggleBtn.addEventListener("click", () => {
                const newTheme = html.getAttribute("data-theme") === "dark" ? "light" : "dark";
                setTheme(newTheme);
            });

            function setTheme(theme) {
                html.setAttribute("data-theme", theme);
                localStorage.setItem("theme", theme);

                if (theme === "dark") {
                    icon.classList.replace("bi-moon-stars-fill", "bi-sun-fill");
                } else {
                    icon.classList.replace("bi-sun-fill", "bi-moon-stars-fill");
                }
            }
        });
    </script>

</body>
</html>
