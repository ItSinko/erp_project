<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'title' => 'AdminLTE 3',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'logo' => '<b>Sinko Prima</b> Alloy',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'AdminLTE',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => 'bg-gradient-dark',
    'classes_auth_body' => 'bg-gradient-dark',
    'classes_auth_footer' => 'bg-gradient-dark',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar2' => 'sidebar-dark-primary royal-bg  elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
    |
    */
    'menu' => [
        [
            'header' => '',
        ],
        [
            'text'        => 'Beranda',
            'url'         => 'home',
            'icon'        => 'nav-icon fa fa-home',
        ],
        [
            'header' => 'MASTER DATA',
            'auth' => [14, 17, 26, 23, 24, 1]
        ],
        [
            'text' => 'Penjualan Produk',
            'url'  => '/penjualan_produk',
            'icon' => 'fas fa-table',
            'auth' => [26]
        ],
        [
            'text' => 'Nama & Alamat',
            'url'  => '/nama_alamat',
            'icon' => 'fas fa-table',
            'auth' => [26]
        ],
        [
            'text' => 'Jasa Ekspedisi',
            'url'  => '/jasa_eks',
            'icon' => 'fas fa-table',
            'auth' => [26]
        ],
        [
            'text' => 'Kesehatan',
            'icon' => 'fas fa-book-medical',
            'auth' => [28],
            'submenu' => [
                [
                    'icon' => 'fas fa-user-md',
                    'text' => 'Awal',
                    'auth' => [28],
                    'submenu' => [
                        [
                            'icon' => 'fas fa-table',
                            'text' => 'Data',
                            'auth' => [28],
                            'url'  => '/kesehatan',
                        ],
                        [
                            'icon' => 'fas fa-info-circle',
                            'text' => 'Detail',
                            'auth' => [28],
                            'url'  => '/kesehatan/detail',
                        ]
                    ],
                ],
                [
                    'icon' => 'fas fa-heartbeat',
                    'text' => 'Harian',
                    'auth' => [28],
                    'submenu' => [
                        [
                            'icon' => 'fas fa-table',
                            'text' => 'Data',
                            'auth' => [28],
                            'url'  => '/kesehatan_harian',
                        ],
                        [
                            'icon' => 'fas fa-info-circle',
                            'text' => 'Detail',
                            'auth' => [28],
                            'url'  => '/kesehatan_harian/detail',
                        ],
                        [
                            'icon' => 'fas fa-file-medical',
                            'text' => 'Laporan',
                            'auth' => [28],
                            'url'  => '/laporan_harian',
                        ]
                    ],
                ],
                [
                    'icon' => 'fas fa-vial',
                    'text' => 'Mingguan',
                    'auth' => [28],
                    'submenu' => [
                        [
                            'icon' => 'fas fa-table',
                            'text' => 'Data',
                            'auth' => [28],
                            'url'  => '/kesehatan_mingguan',
                        ],
                        [
                            'icon' => 'fas fa-info-circle',
                            'text' => 'Detail',
                            'auth' => [28],
                            'url'  => '/kesehatan_mingguan/detail',
                        ],  [
                            'icon' => 'fas fa-file-medical',
                            'text' => 'Laporan',
                            'auth' => [28],
                            'url'  => '/laporan_mingguan',
                        ]
                    ],
                ],
                [
                    'icon' => 'fas fa-weight',
                    'text' => 'Bulanan',
                    'auth' => [28],
                    'submenu' => [
                        [
                            'icon' => 'fas fa-table',
                            'text' => 'Data',
                            'auth' => [28],
                            'url'  => '/kesehatan_bulanan',
                        ],
                        [
                            'icon' => 'fas fa-info-circle',
                            'text' => 'Detail',
                            'auth' => [28],
                            'url'  => '/kesehatan_bulanan/detail',
                        ],
                        [
                            'icon' => 'fas fa-file-medical',
                            'text' => 'Laporan',
                            'auth' => [28],
                            'url'  => '/laporan_bulanan',
                        ]
                    ],
                ],
                [
                    'icon' => 'fas fa-eye',
                    'text' => 'Tahunan',
                    'auth' => [28],
                    'submenu' => [
                        [
                            'icon' => 'fas fa-table',
                            'text' => 'Data',
                            'auth' => [28],
                            'url'  => '/kesehatan_tahunan',
                        ],
                        [
                            'icon' => 'fas fa-info-circle',
                            'text' => 'Detail',
                            'auth' => [28],
                            'url'  => '/kesehatan_tahunan/detail',
                        ],  [
                            'icon' => 'fas fa-file-medical',
                            'text' => 'Laporan',
                            'auth' => [28],
                            'url'  => '/laporan_tahunan',
                        ]
                    ],
                ],
                [
                    'icon' => 'fas fa-people-arrows',
                    'text' => 'Khusus',
                    'auth' => [28],
                    'submenu' => [
                        [
                            'icon' => 'fas fa-person-booth',
                            'text' => 'Karyawan Sakit',
                            'auth' => [28],
                            'url'  => '/karyawan_sakit',
                        ],
                        [
                            'icon' => 'fas fa-walking',
                            'text' => 'Karyawan Masuk',
                            'url'  => '/karyawan_masuk',
                            'auth' => [28],

                        ]
                    ],
                ],
                [
                    'icon' => 'fas fa-tablets',
                    'text' => 'Obat',
                    'auth' => [28],
                    'url'  => '/obat',
                ]
            ],
        ],
        [
            'header' => 'TRANSAKSI',
            'auth'   => [26]
        ],
        [
            'text'    => 'Daftar Pesanan',
            'icon'    => 'fas fa-table',
            'auth' => [26],
            'submenu' => [
                [
                    'text' => 'E-Katalog',
                    'url'  => '/penjualan_online',
                ],
                [
                    'text' => 'E-Commerce',
                    'url'  => '/penjualan_online_ecom',
                ],
                [
                    'text' => 'Offline',
                    'url'  => '/penjualan_offline',
                ]
            ],
        ],
        [
            'text'    => 'Surat Penawaran',
            'icon'    => 'fas fa-table',
            'auth' => [26],
            'submenu' => [
                [
                    'text' => 'E-Commerce',
                    'url'  => '/penawaran_ecom',
                ],
                [
                    'text' => 'Offline',
                    'url'  => '/penawaran_offline',
                ]
            ],
        ],
        [
            'text'    => 'PO / DO',
            'icon'    => 'fas fa-table',
            'auth' => [26],
            'submenu' => [
                [
                    'text' => 'E-Katalog',
                    'url'  => '/podo_online',
                ],
                [
                    'text' => 'Offline',
                    'url'  => '/podo_offline',
                ]
            ],
        ],
        [
            'text'  =>  'Stok',
            'icon'  =>  'fas fa-boxes',
            'auth'  => [24, 1],
            'submenu'   =>  [
                [
                    'text'  =>  'Gudang',
                    'icon'  =>  'far fa-circle',
                    'url'   =>  '#'
                ],
                [
                    'text'  =>  'RND',
                    'icon'  =>  'far fa-circle',
                    'url'   =>  '#'
                ],
            ]
        ],
        [
            'text'  =>  'Laporan',
            'icon'  =>  'fas fa-file',
            'auth'  => [24, 1],
            'submenu'   =>  [
                [
                    'text'  =>  'Pembelian',
                    'icon'  =>  'far fa-circle',
                    'url'   =>  '#'
                ],
                [
                    'text'  =>  'Perakitan dan Pengemasan',
                    'icon'  =>  'far fa-circle',
                    'url'   =>  '#'
                ],
                [
                    'text'  =>  'Pemeriksaan, Pengujian, dan Pemeriksaan Pengemasan QA',
                    'icon'  =>  'far fa-circle',
                    'url'   =>  '#'
                ],

                [
                    'text'  =>  'Kerja GK',
                    'icon'  =>  'far fa-circle',
                    'url'   =>  '#'
                ],

                [
                    'text'  =>  'Penjualan',
                    'icon'  =>  'far fa-circle',
                    'url'   =>  '#'
                ],

                [
                    'text'  =>  'Marketing',
                    'icon'  =>  'far fa-circle',
                    'url'   =>  '#'
                ],
            ]
        ],
        [
            'text' => 'Produk',
            'url'  => '/produk',
            'icon' => 'fas fa-table',
            'auth' => [14, 17, 26]
        ],
        [
            'text' => 'Data Karyawan',
            'icon' => 'fas fa-users',
            'auth' => [14, 17, 23],
            'submenu' => [
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Jadwal Kerja Operator',
                    'url'  => '/karyawan',
                ],
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Daftar Staff',
                    'url'  => '/karyawan',
                ],
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Permohonan Penugasan',
                    'url'  => '/karyawan/peminjaman',
                ],
            ],
        ],
        [
            'text'    => 'Inventory',
            'icon'    => 'fas fa-boxes',
            'auth' => [14, 17],
            'submenu' => [
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Master Inventory',
                    'auth' => [14],
                    'url'  => '/inventory/divisi',
                ],
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Inventory',
                    'url'  => '/inventory',
                ],
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Permintaan Peminjaman',
                    'url'  => '/inventory/peminjaman',
                ],
            ],
        ],
        [
            'text'    => 'Peminjaman',
            'icon'    => 'fas fa-boxes',
            'auth' => [14],
            'submenu' => [
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Alat',
                    'url'  => '/peminjaman/alat',
                ],
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Karyawan',
                    'url'  => '/peminjaman/karyawan',
                ],

            ],
        ],
        [
            'header' => 'PPIC',
            'auth' => [24, 1]
        ],
        [
            'text' => 'Jadwal Produksi',
            'icon' => 'fas fa-calendar-alt',
            'auth' => [24, 1],
            'submenu'   =>  [
                [
                    'text'  =>  'Penyusunan',
                    'icon'  =>  'far fa-circle',
                    'url'   =>  '/ppic/schedule?penyusunan=true'
                ],
                [
                    'text'  =>  'Pelaksanaan',
                    'icon'  =>  'far fa-circle',
                    'url'   =>  '/ppic/schedule?pelaksanaan=true',
                ],
                [
                    'text'  =>  'Selesai',
                    'icon'  =>  'far fa-circle',
                    'url'   =>  '/ppic/schedule?selesai=true'
                ],
            ]
        ],
        [
            'text' => 'BOM',
            'url'  => '/ppic/bom',
            'icon' => 'fas fa-list-alt',
            'auth' => [24, 1]
        ],
        [
            'text'    => 'BPPB',
            'icon'    => 'fas fa-project-diagram',
            'url' => '/bppb',
            'auth' => [24, 1],
            'submenu'   =>  [
                [
                    'text'  =>  'Penyusunan',
                    'icon'  =>  'far fa-circle',
                    'url'   =>  '/ppic/bppb/?penyusunan=true'
                ],
                [
                    'text'  =>  'Pelaksanaan',
                    'icon'  =>  'far fa-circle',
                    'url'   =>  '/ppic/bppb/?pelaksanaan=true',
                ],
                [
                    'text'  =>  'Selesai',
                    'icon'  =>  'far fa-circle',
                    'url'   =>  '/ppic/bppb/?selesai=true'
                ],
            ]
        ],
        [
            'header' => 'PERSIAPAN',
            'auth' => [17]
        ],
        [
            'text'    => 'Packing Produk',
            'icon'    => 'fas fa-calendar-alt',
            'url'  => '/persiapan_packing_produk',
            'auth' => [17],
        ],
        [
            'header' => 'PRODUKSI',
            'auth' => [17, 10, 16]
        ],
        [
            'text'    => 'Jadwal Kerja Produksi',
            'icon'    => 'fas fa-calendar-alt',
            'url'  => '/jadwal_kerja_produksi',
            'auth' => [17],
        ],
        [
            'text'    => 'BPPB',
            'icon'    => 'fas fa-project-diagram',
            'url' => '/bppb',
            'auth' => [17],
        ],
        [
            'text'    => 'Perakitan',
            'icon'    => 'fas fa-cogs',
            'auth' => [17],
            'submenu' => [
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Laporan',
                    'url'  => '/perakitan',
                    'auth' => [17],
                ],
            ],
        ],
        [
            'text'    => 'Perakitan',
            'icon'    => 'fas fa-cogs',
            'url'  => '/perakitan/mtc',
            'auth' => [16],
        ],
        [
            'text'    => 'Perakitan',
            'icon'    => 'fas fa-cogs',
            'url'  => '/perakitan/eng',
            'auth' => [10],
        ],
        [
            'text'    => 'Pengujian',
            'icon'    => 'fab fa-searchengin',
            'auth' => [17],
            'submenu' => [
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Laporan',
                    'url'  => '/pengujian/prd',
                    'auth' => [17],
                ],
            ],
        ],
        [
            'text' => 'Pengujian',
            'icon' => 'fab fa-searchengin',
            'url'  => '/pengujian/mtc',
            'auth' => [16],
        ],
        [
            'text' => 'Pengujian',
            'icon' => 'fab fa-searchengin',
            'url'  => '/pengujian/eng',
            'auth' => [10],
        ],
        [
            'text' => 'Pengemasan',
            'icon' => 'fas fa-box-open',
            'url'  => '/pengemasan/mtc',
            'auth' => [16],
        ],
        [
            'text' => 'Pengemasan',
            'icon' => 'fas fa-box-open',
            'auth' => [17],
            'submenu' => [
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Laporan',
                    'url'  => '/pengemasan',
                    'auth' => [17],
                ],
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Form Produk',
                    'url'  => '/pengemasan/form',
                    'auth' => [17],
                ],
            ],
        ],
        [
            'text'    => 'Pengemasan',
            'icon'    => 'fas fa-box-open',
            'url'  => '/pengemasan/eng',
            'auth' => [10],
        ],
        [
            'text'    => 'Perbaikan',
            'icon'    => 'fas fa-wrench',
            'url' => '/perbaikan/produksi',
            'auth' => [17],
        ],
        [
            'header' => 'INCOMING',
            'auth' => [23]
        ],
        [
            'text' => 'Kedatangan',
            'icon' => 'fas fa-dolly-flatbed',
            'auth' => [23],
            'submenu' => [
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Packing List',
                    'url'  => '/kedatangan/packing_list',
                    'auth' => [23],
                ],
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Analisa',
                    'url'  => '/kedatangan/analisa',
                    'auth' => [23],
                ],
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Sampling',
                    'url'  => '/kedatangan/sampling',
                    'auth' => [23],
                ],
            ],
        ],
        [
            'text' => 'BPPB',
            'icon' => 'fas fa-project-diagram',
            'url' => '/bppb',
            'auth' => [23],
        ],
        [
            'header' => 'INPROCESS',
            'auth' => [23]
        ],
        [
            'text'    => 'Perakitan',
            'icon'    => 'fas fa-cogs',
            'auth' => [23],
            'submenu' => [
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Laporan',
                    'url'  => '/perakitan/pemeriksaan',
                    'auth' => [23],
                ],
                [
                    'icon' => 'far fa-circle',
                    'text' => 'IK Pemeriksaan',
                    'url'  => '/perakitan/ik_pemeriksaan',
                    'auth' => [23],
                ],
            ],
        ],
        [
            'text'    => 'Pengujian',
            'icon'    => 'fab fa-searchengin',
            'auth' => [23],
            'submenu' => [
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Laporan',
                    'url'  => '/pengujian',
                    'auth' => [23],
                ],
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Kalibrasi',
                    'url'  => '/',
                    'auth' => [23],
                ],
                [
                    'icon' => 'far fa-circle',
                    'text' => 'IK Pemeriksaan',
                    'url'  => '/pengujian/ik_pemeriksaan',
                    'auth' => [23],
                ],
            ],
        ],
        [
            'text'    => 'Pengemasan',
            'icon'    => 'fas fa-box-open',
            'auth' => [23],
            'submenu' => [
                [
                    'icon' => 'far fa-circle',
                    'text' => 'Laporan',
                    'url'  => '/pengemasan/qc',
                    'auth' => [23],
                ],
                [
                    'icon' => 'far fa-circle',
                    'text' => 'IK Pemeriksaan',
                    'url'  => '/pengemasan/ik_pemeriksaan',
                    'auth' => [23],
                ],
            ],
        ],

        ['header' => 'LOGOUT'],
        [
            'text' => 'Logout',
            'url' => '/logout',
            'icon' => 'fas fa-sign-out-alt',
            'form' => true,
        ],

        [
            'text' => 'test',
            'isNavbarRightItem' => true,
            'icon' => 'fas fa-sign-out-alt',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],
    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    |
    */
    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/dataTables.responsive.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/select2/js/select2.full.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2/css/select2.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/charts/chart.js',
                ]
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    */
    'livewire' => false,
];
