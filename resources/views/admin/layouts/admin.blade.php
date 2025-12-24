<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modern Bootstrap 5 Admin Template - Clean, responsive dashboard">
    <meta name="keywords" content="bootstrap, admin, dashboard, template, modern, responsive">
    <meta name="author" content="Bootstrap Admin Template">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Modern Bootstrap Admin Template">
    <meta property="og:description" content="Clean and modern admin dashboard template built with Bootstrap 5">
    <meta property="og:type" content="website">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/favicon-CvUZKS4z.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap4-duallistbox@4.0.2/dist/bootstrap-duallistbox.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Select2 ni form-control bilan moslashtirish */
        .select2-container .select2-selection--multiple {
            min-height: 55px;
            padding: 6px 12px;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            background-color: #fff;
            font-size: 1rem;
            line-height: 1.5;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #0d6efd;
            color: #fff;
            border: none;
            padding: 2px 8px;
            margin-top: 4px;
            margin-right: 4px;
            border-radius: 0.25rem;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
            margin-right: 4px;
        }

        /* Tanlangan ro‘l badge */
        .select2-selection__choice {
            position: absolute;
            padding: 4px 28px 4px 8px !important; /* o‘ng tomonda x belgiga joy */
            margin: 4px 4px 4px 4px !important;;
            background-color: #0d6efd;
            color: #fff;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            line-height: 1.5;
        }


        .ud-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            background: #fff;
            border: 1px solid #e6eef7;
            border-radius: 8px;
            cursor: pointer;
            color: #0f172a;
            font-weight: 600;
            box-shadow: 0 1px 0 rgba(2, 6, 23, 0.02);
        }

        .ud-btn:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.08);
        }

        .ud-avatar {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            object-fit: cover;
            background: linear-gradient(135deg, #9f7aea, #60a5fa);
            color: #fff;
            flex: 0 0 24px;
        }

        .ud-name {
            display: inline-block;
            white-space: nowrap;
            max-width: 160px;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 14px;
        }

        /* Chevron */
        .ud-chev {
            color: #6b7280;
            margin-left: 2px;
        }

        /* Dropdown menu */
        .ud-menu {
            position: absolute;
            right: 0;
            margin-top: 8px;
            min-width: 200px;
            background: #fff;
            border-radius: 10px;
            border: 1px solid #eef2f7;
            box-shadow: 0 10px 24px rgba(2, 6, 23, 0.08);
            padding: 6px;
            display: none;
            z-index: 1200;
            transform-origin: top right;
        }

        .ud-menu.open {
            display: block;
            animation: udpop .12s ease-out;
        }

        @keyframes udpop {
            from {
                opacity: 0;
                transform: translateY(-6px) scale(.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .ud-item {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            background: transparent;
            color: #0f172a;
            text-decoration: none;
            font-size: 14px;
            border: 0;
            cursor: pointer;
            text-align: left;
        }

        .ud-item:hover, .ud-item:focus {
            background: #f8fafc;
            outline: none;
        }

        .ud-icon {
            color: #6b7280;
            flex: 0 0 18px;
        }

        .ud-divider {
            height: 1px;
            background: #eef2f7;
            margin: 6px 0;
        }

        /* Logout style tweak to ensure it's displayed like other items */
        .ud-logout {
            width: 100%;
            background: transparent;
            border: 0;
            padding: 10px 12px;
            text-align: left;
        }

        /* Responsive: hide username on small screens */
        @media (max-width: 540px) {
            .ud-name {
                display: none;
            }
        }

        .menu-collapse {
            max-height: 0;
            overflow: hidden;
            transition: max-height .3s ease;
        }

        .menu-collapse.open {
            max-height: 500px;
        }

        .menu-toggle {
            width: 100%;
            background: transparent;
            border: none;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .menu-link.active {
            color: #0d6efd;
            font-weight: 600;
        }

        .modal-backdrop {
            z-index: 1040;
        }

        .modal {
            z-index: 1050;
        }

        /* agar kerak bo'lsa: */
        .modal {
            z-index: 2000 !important;
        }

        .modal-backdrop {
            z-index: 1990 !important;
        }

        .menu-collapse {
            display: none;
        }

        .menu-collapse.show {
            display: block;
        }

        .rotate-icon {
            transform: rotate(180deg);
            transition: 0.3s;
        }

        .menu-collapse {
    max-height: 0;
    overflow: hidden;
    transition: max-height .3s ease;
}

.menu-collapse.show {
    max-height: 500px; /* submenu balandligiga qarab */
}


    </style>

    <!-- Title -->
    <title>{{ config('app.name') }}</title>

    <!-- Theme Color -->
    {{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    <meta name="theme-color" content="#6366f1">

    <!-- PWA Manifest -->
    <link rel="manifest" href="{{ asset('assets/manifest-DTaoG9pG.json') }}">
    <script type="module" crossorigin src="{{ asset('assets/main-f0Mg-34g.js') }}"></script>
    <link rel="stylesheet" crossorigin href="{{ asset('css/my.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('assets/main-DLfE7m78.css') }}">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".menu-toggle").forEach(function (btn) {
                btn.addEventListener("click", function () {

                    let menuId = this.getAttribute("data-menu");
                    let menu = document.getElementById(menuId);

                    menu.classList.toggle("show");

                    let icon = this.querySelector(".bi-chevron-down");
                    if (icon) icon.classList.toggle("rotate-icon");
                });
            });
        });

    </script>


    <script>
        // Base URL to construct dynamic form actions (no trailing slash)
        window.appBase = "{{ url('applications') }}";


        document.addEventListener('DOMContentLoaded', function () {
            // ACCEPT modal
            var acceptModal = document.getElementById('acceptModal');
            if (acceptModal) {
                acceptModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget;
                    if (!button) return;
                    var id = button.getAttribute('data-id') || '';
                    var idInput = acceptModal.querySelector('#accept-application-id');
                    if (idInput) idInput.value = id;

                    // Form actionni dinamik o'zgartirish
                    var form = acceptModal.querySelector('#accept-form');
                    if (form) form.action = `/applications/${id}/accept`;

                    // Select tozalash
                    var sel = acceptModal.querySelector('#accept-agent-select');
                    if (sel) {
                        Array.from(sel.options).forEach(o => o.selected = false);
                    }
                });
            }

            // EDIT modal
            var editModal = document.getElementById('editModal');
            if (editModal) {
                editModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget;
                    if (!button) return;
                    var id = button.getAttribute('data-id') || '';
                    var agentsCsv = button.getAttribute('data-agents') || '';
                    var idInput = editModal.querySelector('#edit-application-id');
                    if (idInput) idInput.value = id;

                    var form = editModal.querySelector('#edit-form');
                    if (form) form.action = `/applications/${id}/accept`;

                    // Select agentlarni tanlash
                    var sel = editModal.querySelector('#edit-agent-select');
                    if (sel) {
                        var selectedIds = agentsCsv ? agentsCsv.split(',').map(s => s.trim()) : [];
                        Array.from(sel.options).forEach(function (opt) {
                            opt.selected = selectedIds.includes(opt.value);
                        });
                    }
                });
            }
        })


        (function () {
            var KEY = 'sidebar-collapsed';
            var MOBILE_MAX_WIDTH_PX = 767;

            try {
                if (typeof window !== 'undefined' && localStorage.getItem(KEY) === null) {
                    var isMobile = (window.matchMedia && window.matchMedia('(max-width: ' + MOBILE_MAX_WIDTH_PX + 'px)').matches)
                        || window.innerWidth <= MOBILE_MAX_WIDTH_PX;

                    var defaultValue = isMobile ? 'true' : 'false';
                    localStorage.setItem(KEY, defaultValue);

                    console.log('Default set:', KEY, '=', localStorage.getItem(KEY), '(isMobile=' + isMobile + ')');
                } else {
                    console.log('Already present or no window:', KEY, '=', (typeof localStorage !== 'undefined' ? localStorage.getItem(KEY) : null));
                }
            } catch (e) {
                console.warn('localStorage not available:', e);
            }
        })();

        document.addEventListener('alpine:init', () => {
            Alpine.data('themeSwitch', () => ({
                currentTheme: null,
                init() {
                    // 1) localStorage bor-yo'qligini tekshir, so'ng hujjatga dark klassini qo'y
                    const saved = localStorage.getItem('theme');
                    if (saved) {
                        this.currentTheme = saved;
                    } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        this.currentTheme = 'dark';
                    } else {
                        this.currentTheme = 'light';
                    }
                    this.applyTheme();
                },
                toggle() {
                    this.currentTheme = this.currentTheme === 'light' ? 'dark' : 'light';
                    localStorage.setItem('theme', this.currentTheme);
                    this.applyTheme();
                },
                applyTheme() {
                    if (this.currentTheme === 'dark') {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
            }));
        });

        // Fullscreen toggle
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[data-fullscreen-toggle]').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    // e.stopPropagation(); // agar kerak bo'lsa, uncomment qiling
                    if (!document.fullscreenElement) {
                        document.documentElement.requestFullscreen?.().catch(() => {
                        });
                    } else {
                        document.exitFullscreen?.().catch(() => {
                        });
                    }
                });
            });
        });

        // Custom dropdown handler (tozalangan va to'liq):
        // Agar siz Bootstrap dropdown'larini ishlatayotgan bo'lsangiz, aslida buni qo'lda qilishning hojati yo'q — bootstrap.bundle all-in-one avtomatik boshqaradi.
        // Quyidagi misol qo'lda dropdown boshqarishni xohlasangiz ishlaydi va yarim qolgan funksiya sababli konsol xatolarini keltirib chiqarmaydi.
        // Alpine faqat BIR MARTA initialize bo‘ladi
        document.addEventListener('alpine:init', () => {
            Alpine.data('themeSwitch', () => ({
                currentTheme: null,
                init() {
                    const saved = localStorage.getItem('theme');
                    if (saved) {
                        this.currentTheme = saved;
                    } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        this.currentTheme = 'dark';
                    } else {
                        this.currentTheme = 'light';
                    }
                    this.applyTheme();
                },
                toggle() {
                    this.currentTheme = this.currentTheme === 'light' ? 'dark' : 'light';
                    localStorage.setItem('theme', this.currentTheme);
                    this.applyTheme();
                },
                applyTheme() {
                    document.documentElement.classList.toggle('dark', this.currentTheme === 'dark');
                }
            }));
        });

        //
        // // Dropdown — faqat 1 ta handler
        // document.addEventListener('click', function (e) {
        //     const btn = e.target.closest('.dropdown .btn[data-bs-toggle="dropdown"]');
        //
        //     if (!btn) {
        //         document.querySelectorAll('.dropdown .dropdown-menu.show').forEach(m => {
        //             m.classList.remove('show');
        //             const drop = m.closest('.dropdown');
        //             drop?.classList.remove('show');
        //             const b = drop?.querySelector('button[data-bs-toggle="dropdown"]');
        //             if (b) {
        //                 b.classList.remove('show');
        //                 b.setAttribute('aria-expanded', 'false');
        //             }
        //         });
        //         return;
        //     }
        //
        //     e.preventDefault();
        //     e.stopPropagation();
        //
        //     const drop = btn.closest('.dropdown');
        //     const menu = drop.querySelector('.dropdown-menu');
        //     const isShown = menu.classList.contains('show');
        //
        //     document.querySelectorAll('.dropdown .dropdown-menu.show').forEach(m => {
        //         if (m !== menu) {
        //             m.classList.remove('show');
        //             const d = m.closest('.dropdown');
        //             d?.classList.remove('show');
        //             const b = d?.querySelector('button[data-bs-toggle="dropdown"]');
        //             if (b) {
        //                 b.classList.remove('show');
        //                 b.setAttribute('aria-expanded', 'false');
        //             }
        //         }
        //     });
        //
        //     menu.classList.toggle('show', !isShown);
        //     drop.classList.toggle('show', !isShown);
        //     btn.classList.toggle('show', !isShown);
        //     btn.setAttribute('aria-expanded', isShown ? 'false' : 'true');
        // });
        //
        //
        // // Fullscreen BIR MARTA yoziladi
        // document.addEventListener('DOMContentLoaded', () => {
        //     document.querySelectorAll('[data-fullscreen-toggle]').forEach(btn => {
        //         btn.addEventListener('click', () => {
        //             if (!document.fullscreenElement) {
        //                 document.documentElement.requestFullscreen?.();
        //             } else {
        //                 document.exitFullscreen?.();
        //             }
        //         });
        //     });
        // });


        ///end of toogle

        document.addEventListener('alpine:init', () => {
            Alpine.data('themeSwitch', () => ({
                currentTheme: 'light',
                storageKey: 'theme',

                init() {
                    // 1) Load saved preference
                    const saved = localStorage.getItem(this.storageKey);
                    if (saved === 'light' || saved === 'dark') {
                        this.currentTheme = saved;
                    } else {
                        // 2) Fall back to system preference
                        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                            this.currentTheme = 'dark';
                        } else {
                            this.currentTheme = 'light';
                        }
                    }

                    // Apply initially
                    this.applyTheme();

                    // If user has NOT explicitly set preference, update on system changes
                    // (Only if no saved preference)
                    if (!saved && window.matchMedia) {
                        const mql = window.matchMedia('(prefers-color-scheme: dark)');
                        // Listener updates theme only when user hasn't chosen one (no saved)
                        mql.addEventListener('change', (e) => {
                            // re-check saved in case user set it in the meantime
                            const laterSaved = localStorage.getItem(this.storageKey);
                            if (!laterSaved) {
                                this.currentTheme = e.matches ? 'dark' : 'light';
                                this.applyTheme();
                            }
                        });
                    }
                },

                toggle() {
                    this.currentTheme = this.currentTheme === 'dark' ? 'light' : 'dark';
                    localStorage.setItem(this.storageKey, this.currentTheme);
                    this.applyTheme();
                },

                applyTheme() {
                    // Toggle html.dark class
                    if (this.currentTheme === 'dark') {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }

                    // Optional: set data-theme attribute
                    document.documentElement.setAttribute('data-theme', this.currentTheme);

                    // Optional: update theme-color meta for mobile browsers
                    const meta = document.querySelector('meta[name="theme-color"]');
                    if (meta) {
                        meta.setAttribute('content', this.currentTheme === 'dark' ? '#0b1220' : '#ffffff');
                    }
                }
            }));
        });


        document.addEventListener("DOMContentLoaded", () => {

            const currentUrl = window.location.pathname;

            // 1. ACTIVE linkni topish va parent collapse ni ochish
            document.querySelectorAll(".menu-link").forEach(link => {
                if (link.getAttribute("href") === currentUrl) {
                    link.classList.add("active");

                    // Parent collapse ni ochish
                    const parent = link.closest(".menu-collapse");
                    if (parent) {
                        parent.classList.add("open");
                        localStorage.setItem(parent.id, "open");
                    }
                }
            });

            // 2. Toggle tugmasi bosilganda collapse ochish/yopish
            document.querySelectorAll(".menu-toggle").forEach(btn => {
                btn.addEventListener("click", () => {
                    const id = btn.getAttribute("data-menu");
                    const block = document.getElementById(id);

                    block.classList.toggle("open");

                    // localStorage holatini saqlash
                    localStorage.setItem(id, block.classList.contains("open") ? "open" : "closed");
                });
            });

            // 3. Reload qilganda localStorage bo‘yicha holatni tiklash
            document.querySelectorAll(".menu-collapse").forEach(block => {
                const state = localStorage.getItem(block.id);
                if (state === "open") {
                    block.classList.add("open");
                }
            });

        });


    </script>

</head>

<body data-page="dashboard" class="admin-layout">
<!-- Loading Screen -->
<div id="loading-screen" class="loading-screen">
    <div class="loading-spinner">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<!-- Main Wrapper -->
<div class="admin-wrapper " id="admin-wrapper">

    <!-- Header -->
    <header class="admin-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <div class="container-fluid">
                <!-- Logo/Brand - Now first on the left -->
                <a class="navbar-brand d-flex align-items-center" href="{{ route('index') }}">
                    {{--                    <img--}}
                    {{--                        src="data:image/svg+xml,%3csvg%20width='32'%20height='32'%20viewBox='0%200%2032%2032'%20fill='none'%20xmlns='http://www.w3.org/2000/svg'%3e%3c!--%20Background%20circle%20for%20the%20M%20--%3e%3ccircle%20cx='16'%20cy='16'%20r='16'%20fill='url(%23logoGradient)'/%3e%3c!--%20Centered%20Letter%20M%20--%3e%3cpath%20d='M10%2024V8h2.5l2.5%206.5L17.5%208H20v16h-2V12.5L16.5%2020h-1L14%2012.5V24H10z'%20fill='white'%20font-weight='700'/%3e%3c!--%20Gradient%20definition%20--%3e%3cdefs%3e%3clinearGradient%20id='logoGradient'%20x1='0%25'%20y1='0%25'%20x2='100%25'%20y2='100%25'%3e%3cstop%20offset='0%25'%20style='stop-color:%236366f1;stop-opacity:1'%20/%3e%3cstop%20offset='100%25'%20style='stop-color:%238b5cf6;stop-opacity:1'%20/%3e%3c/linearGradient%3e%3c/defs%3e%3c/svg%3e"--}}
                    {{--                        alt="Logo" height="32" class="d-inline-block align-text-top me-2">--}}
                    <h1 class="h4 mb-0 fw-bold text-primary">{{ config('app.name') }}</h1>
                </a>

                <!-- Search Bar with Alpine.js -->

                <!-- Right Side Icons -->
                <div class="navbar-nav flex-row">
                    <!-- Theme Toggle with Alpine.js -->

                    <!-- Update your HTML: call the factory with parentheses -->
                    {{--                    <div>--}}
                    {{--                        <button class="btn btn-outline-secondary me-2"--}}
                    {{--                                type="button"--}}
                    {{--                                onclick="themeSwitch() "--}}
                    {{--                                data-bs-toggle="tooltip"--}}
                    {{--                                data-bs-placement="bottom"--}}
                    {{--                                title="Toggle theme">--}}
                    {{--                            <!-- Lightda faqat quyosh -->--}}
                    {{--                            <i class="bi bi-sun-fill" x-show="currentTheme === 'light'"></i>--}}
                    {{--                            <!-- Darkda faqat oy -->--}}
                    {{--                            <i class="bi bi-moon-fill" x-show="currentTheme === 'dark'"></i>--}}
                    {{--                        </button>--}}
                    {{--                    </div>--}}
                    <div x-data="themeSwitch">
                        <button class="btn btn-outline-secondary me-2"
                                type="button"
                                @click="toggle()"
                                data-bs-toggle="tooltip"
                                data-bs-placement="bottom"
                                title="Toggle theme">
                            <i class="bi bi-sun-fill" x-show="currentTheme === 'light'"></i>
                            <i class="bi bi-moon-fill" x-show="currentTheme === 'dark'"></i>
                        </button>
                    </div>

                    <!-- Fullscreen button — keep as-is, ensure your fullscreen handler is bound after DOMContentLoaded -->
                    <button class="btn btn-outline-secondary me-2"
                            type="button"
                            data-fullscreen-toggle
                            data-bs-toggle="tooltip"
                            data-bs-placement="bottom"
                            title="Toggle fullscreen">
                        <i class="bi bi-arrows-fullscreen icon-hover"></i>
                    </button>


                    <div class="ud-container" style="display:inline-block; position:relative;">
                        <button id="userDropdown"
                                class="ud-btn"
                                type="button"
                                aria-haspopup="true"
                                aria-expanded="false"
                                aria-controls="userMenu">
                            <i class="fa fa-user"></i>
                            <span class="ud-name">{{ optional(Auth::user())->name ?? __('Guest') }}</span>
                            <svg class="ud-chev" viewBox="0 0 20 20" width="16" height="16" aria-hidden="true">
                                <path d="M6 8l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.6"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>

                        <div id="userMenu" class="ud-menu" role="menu" aria-labelledby="userDropdown" tabindex="-1">


                            <div class="ud-divider" role="separator"></div>

                            <form method="POST" action="{{ route('logout') }}" class="ud-logout-form" role="none">
                                @csrf
                                <button type="submit" class="ud-item ud-logout" role="menuitem">
                                    <svg class="ud-icon" viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">
                                        <path d="M16 17l5-5-5-5" fill="none" stroke="currentColor" stroke-width="1.4"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M21 12H9" fill="none" stroke="currentColor" stroke-width="1.4"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M13 5H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7" fill="none"
                                              stroke="currentColor" stroke-width="1.4" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </nav>
    </header>

    <!-- Sidebar -->
    @include('admin.layouts.sidebar')
    <!-- Sidebar -->

    <!-- Floating Hamburger Menu -->
    <button class="hamburger-menu"
            type="button"
            data-sidebar-toggle
            aria-label="Toggle sidebar">
        <i class="bi bi-list"></i>
    </button>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="container-fluid p-4 p-lg-5">

            @yield('content')


        </div>
    </main>

    <!-- Footer -->
    <footer class="admin-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0 text-muted">© <?= date('Y'); ?> LoiqDev & design by Boostrapt group </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0 text-muted"><b>V </b>1.0.0</p>
                </div>
            </div>
        </div>
    </footer>
</div> <!-- /.admin-wrapper -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap4-duallistbox@4.0.2/dist/jquery.bootstrap-duallistbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<!-- Export formats -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>--}}
<script src="{{ asset('js/my.js') }}"></script>


<script>
    /* Self-contained JS to handle dropdown interaction without Bootstrap JS.
       - Toggles on button click
       - Closes on outside click or Escape
       - Keyboard navigation: ArrowUp / ArrowDown / Enter / Space / Tab cycling
    */
    (function () {
        const btn = document.getElementById('userDropdown');
        const menu = document.getElementById('userMenu');
        const container = btn?.closest('.ud-container');
        if (!btn || !menu) return;

        let open = false;
        const itemsSelector = '.ud-item';

        function openMenu() {
            open = true;
            menu.classList.add('open');
            btn.setAttribute('aria-expanded', 'true');
            // focus first item
            const items = menu.querySelectorAll(itemsSelector);
            if (items.length) items[0].focus();
            document.addEventListener('click', onDocClick);
            document.addEventListener('keydown', onKeyDown);
        }

        function closeMenu() {
            open = false;
            menu.classList.remove('open');
            btn.setAttribute('aria-expanded', 'false');
            btn.focus();
            document.removeEventListener('click', onDocClick);
            document.removeEventListener('keydown', onKeyDown);
        }

        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            if (open) closeMenu(); else openMenu();
        });

        // toggle with keyboard when button focused
        btn.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ' || e.key === 'ArrowDown') {
                e.preventDefault();
                openMenu();
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                openMenu();
                // focus last
                const items = menu.querySelectorAll(itemsSelector);
                if (items.length) items[items.length - 1].focus();
            }
        });

        function onDocClick(e) {
            if (!container.contains(e.target)) {
                closeMenu();
            }
        }

        function onKeyDown(e) {
            const items = Array.from(menu.querySelectorAll(itemsSelector));
            const active = document.activeElement;
            const idx = items.indexOf(active);

            if (e.key === 'Escape') {
                closeMenu();
            } else if (e.key === 'ArrowDown') {
                e.preventDefault();
                const next = (idx + 1) % items.length;
                items[next].focus();
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                const prev = (idx - 1 + items.length) % items.length;
                items[prev].focus();
            } else if (e.key === 'Tab') {
                // keep focus inside menu when open (simple trapping)
                if (e.shiftKey) {
                    if (idx === 0) {
                        e.preventDefault();
                        items[items.length - 1].focus();
                    }
                } else {
                    if (idx === items.length - 1) {
                        e.preventDefault();
                        items[0].focus();
                    }
                }
            } else if ((e.key === 'Enter' || e.key === ' ') && active && active.matches(itemsSelector)) {
                // let normal click/submit happen
                active.click();
                e.preventDefault();
            }
        }

        // close on resize/scroll to be safe
        window.addEventListener('resize', closeMenu);
        window.addEventListener('scroll', closeMenu, true);
    })();
</script>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            // placeholder: "Rollarni tanlang",
            allowClear: true,
            width: '100%' // bu muhim!
        });
    });


</script>


<script>
    $(document).ready(function () {
        $('.statistics').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [[5, 10, 20], [5, 10, 20]],
            ordering: true,
            columnDefs: [
                {orderable: false, targets: 0} // birinchi ustunni tartiblashni o'chiramiz
            ],
            language: {
                search: "Qidirish:",
                lengthMenu: "Ko'rsatish: _MENU_",
                info: "Ko‘rsatilmoqda _START_ dan _END_ gacha — jami _TOTAL_ yozuv",
                paginate: {
                    previous: "Oldingi",
                    next: "Keyingi"
                },
                zeroRecords: "Mos yozuvlar topilmadi"
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
