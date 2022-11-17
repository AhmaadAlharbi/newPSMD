<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <img class="m-2 p-2" src="{{ URL::asset('image/logo.png') }}" alt="logo">
    </div>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">

                @if (Auth::check())
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ Auth::user()->name }}</h4>
                    <span class="mb-0 text-muted">{{ Auth::user()->email }}</span>
                    <a class="btn btn-outline-success p-3 d-block"
                        href="/dashboard/user/query_section_id={{ Auth::user()->section_id }}">{{ Auth::user()->name }}
                        page</a>

                </div>
                @endif
            </div>
        </div>
        @auth
        @php
        $is_admin = Auth::user()->is_admin ? 'admin' : 'user';
        @endphp
        @endauth
        <ul class="side-menu">
            <li class="side-item side-item-category">Main</li>
            <li class="slide">
                <a class="side-menu__item"
                    href="{{ '/dashboard/' . $is_admin . '/query_section_id=' . Auth::user()->section_id }}"><svg
                        xmlns=" http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                        <path
                            d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
                    </svg><span class="side-menu__label">الرئيسية</span>
                </a>
                @if(Auth::user()->role === 'admin')
            <li class="slide">
                <a class="side-menu__item"
                    href="{{ '/dashboard/' . $is_admin . '/query_section_id=' . Auth::user()->section_id .'/general-check' }}"><svg
                        xmlns=" http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                        <path
                            d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
                    </svg><span class="side-menu__label">صفحة استلام المحطات</span>
                </a>
            </li>
            @endif
            </li>
            @auth
            {{--TS Role--}}
            @if ($is_admin == 'admin' && Auth::user()->role=='TS' || Auth::user()->role=='admin' )
            <li class="side-item side-item-category">متابعة الأعطال</li>
            <li class="slide">
                <a class="side-menu__item"
                    href="{{ '/dashboard/' . $is_admin . '/query_section_id=' . Auth::user()->section_id . '/add_task' }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M12 4c-4.42 0-8 3.58-8 8s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8zm3.5 4c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm-7 0c.83 0 1.5.67 1.5 1.5S9.33 11 8.5 11 7 10.33 7 9.5 7.67 8 8.5 8zm3.5 9.5c-2.33 0-4.32-1.45-5.12-3.5h1.67c.7 1.19 1.97 2 3.45 2s2.76-.81 3.45-2h1.67c-.8 2.05-2.79 3.5-5.12 3.5z"
                            opacity=".3" />
                        <circle cx="15.5" cy="9.5" r="1.5" />
                        <circle cx="8.5" cy="9.5" r="1.5" />
                        <path
                            d="M12 16c-1.48 0-2.75-.81-3.45-2H6.88c.8 2.05 2.79 3.5 5.12 3.5s4.32-1.45 5.12-3.5h-1.67c-.69 1.19-1.97 2-3.45 2zm-.01-14C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z" />
                    </svg><span class="side-menu__label">إصدار أمر العمل</span></a>
            </li>
            <li class="slide">
                <a class="side-menu__item"
                    href="{{ '/dashboard/' . $is_admin . '/query_section_id=' . Auth::user()->section_id . '/add_task_to_be_assigned' }}"><span
                        class="side-menu__label">إصدار امر عمل للإنتطار</span></a>
            </li>
            <li class="slide">

                <a class="side-menu__item"
                    href="{{ '/dashboard/' . $is_admin . '/query_section_id=' . Auth::user()->section_id . '/engineers-report-request' }}"><span
                        class="side-menu__label"> متابعة طلبات تعديل التقارير</span></a>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3" />
                        <path
                            d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z" />
                    </svg><span class="side-menu__label">متابعة المهمات</span><i
                        class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item"
                            href="{{ '/dashboard/' . $is_admin . '/query_section_id=' . Auth::user()->section_id . '/All-tasks' }}">كل
                            المهمات </a></li>
                    <li><a class="slide-item"
                            href="{{ '/dashboard/' . $is_admin . '/query_section_id=' . Auth::user()->section_id . '/completed-tasks' }}">المهمات
                            المنجزة </a></li>
                    <li><a class="slide-item"
                            href="{{ '/dashboard/' . $is_admin . '/query_section_id=' . Auth::user()->section_id . '/pending-tasks' }}">المهمات
                            الغير منجزة</a></li>

                </ul>
            </li>
            @endif
            {{--General Check Role--}}
            @if ($is_admin == 'admin' && Auth::user()->role=='GC' || Auth::user()->role=='admin' )
            <li class="side-item side-item-category">استلام المحطات الجديدة</li>

            <li class="slide">
                <a class="side-menu__item"
                    href="{{ '/dashboard/' . $is_admin . '/query_section_id=' . Auth::user()->section_id . '/send-general-check' }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M12 4c-4.42 0-8 3.58-8 8s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8zm3.5 4c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm-7 0c.83 0 1.5.67 1.5 1.5S9.33 11 8.5 11 7 10.33 7 9.5 7.67 8 8.5 8zm3.5 9.5c-2.33 0-4.32-1.45-5.12-3.5h1.67c.7 1.19 1.97 2 3.45 2s2.76-.81 3.45-2h1.67c-.8 2.05-2.79 3.5-5.12 3.5z"
                            opacity=".3" />
                        <circle cx="15.5" cy="9.5" r="1.5" />
                        <circle cx="8.5" cy="9.5" r="1.5" />
                        <path
                            d="M12 16c-1.48 0-2.75-.81-3.45-2H6.88c.8 2.05 2.79 3.5 5.12 3.5s4.32-1.45 5.12-3.5h-1.67c-.69 1.19-1.97 2-3.45 2zm-.01-14C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z" />
                    </svg><span class="side-menu__label">إصدار أمر الاستلام</span></a>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3" />
                        <path
                            d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z" />
                    </svg><span class="side-menu__label">متابعة المهمات</span><i
                        class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item"
                            href="{{ '/dashboard/' . $is_admin . '/query_section_id=' . Auth::user()->section_id . '/All-tasks' }}">كل
                            المهمات </a></li>
                    <li><a class="slide-item"
                            href="{{ '/dashboard/' . $is_admin . '/query_section_id=' . Auth::user()->section_id . '/completed-tasks' }}">المهمات
                            المنجزة </a></li>
                    <li><a class="slide-item"
                            href="{{ '/dashboard/' . $is_admin . '/query_section_id=' . Auth::user()->section_id . '/pending-tasks' }}">المهمات
                            الغير منجزة</a></li>

                </ul>
            </li>
            @endif

            <li class="side-item side-item-category">متابعة الموظفيين </li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M4 12c0 4.08 3.06 7.44 7 7.93V4.07C7.05 4.56 4 7.92 4 12z" opacity=".3" />
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86zm2-15.86c1.03.13 2 .45 2.87.93H13v-.93zM13 7h5.24c.25.31.48.65.68 1H13V7zm0 3h6.74c.08.33.15.66.19 1H13v-1zm0 9.93V19h2.87c-.87.48-1.84.8-2.87.93zM18.24 17H13v-1h5.92c-.2.35-.43.69-.68 1zm1.5-3H13v-1h6.93c-.04.34-.11.67-.19 1z" />
                    </svg><span class="side-menu__label">المهندسين</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item"
                            href="{{ '/dashboard/' . $is_admin . '/query_section_id=' . Auth::user()->section_id . '/engineers_list' }}">
                            إضافة مهندس / جدول المهندسين</a>
                    </li>
                    <li><a class="slide-item"
                            href="{{ '/dashboard/' . $is_admin . '/query_section_id=' . Auth::user()->section_id . '/users_list' }}">
                            إضافة موطف / جدول الموظفين</a>
                    </li>


            </li>
            <li class="side-item side-item-category">متابعة المحطات</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" class="side-menu__icon"
                        viewBox="0 0 24 24">
                        <g>
                            <rect fill="none" />
                        </g>
                        <g>
                            <g />
                            <g>
                                <path
                                    d="M21,5c-1.11-0.35-2.33-0.5-3.5-0.5c-1.95,0-4.05,0.4-5.5,1.5c-1.45-1.1-3.55-1.5-5.5-1.5S2.45,4.9,1,6v14.65 c0,0.25,0.25,0.5,0.5,0.5c0.1,0,0.15-0.05,0.25-0.05C3.1,20.45,5.05,20,6.5,20c1.95,0,4.05,0.4,5.5,1.5c1.35-0.85,3.8-1.5,5.5-1.5 c1.65,0,3.35,0.3,4.75,1.05c0.1,0.05,0.15,0.05,0.25,0.05c0.25,0,0.5-0.25,0.5-0.5V6C22.4,5.55,21.75,5.25,21,5z M3,18.5V7 c1.1-0.35,2.3-0.5,3.5-0.5c1.34,0,3.13,0.41,4.5,0.99v11.5C9.63,18.41,7.84,18,6.5,18C5.3,18,4.1,18.15,3,18.5z M21,18.5 c-1.1-0.35-2.3-0.5-3.5-0.5c-1.34,0-3.13,0.41-4.5,0.99V7.49c1.37-0.59,3.16-0.99,4.5-0.99c1.2,0,2.4,0.15,3.5,0.5V18.5z" />
                                <path
                                    d="M11,7.49C9.63,6.91,7.84,6.5,6.5,6.5C5.3,6.5,4.1,6.65,3,7v11.5C4.1,18.15,5.3,18,6.5,18 c1.34,0,3.13,0.41,4.5,0.99V7.49z"
                                    opacity=".3" />
                            </g>
                            <g>
                                <path
                                    d="M17.5,10.5c0.88,0,1.73,0.09,2.5,0.26V9.24C19.21,9.09,18.36,9,17.5,9c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,10.69,16.18,10.5,17.5,10.5z" />
                                <path
                                    d="M17.5,13.16c0.88,0,1.73,0.09,2.5,0.26V11.9c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,13.36,16.18,13.16,17.5,13.16z" />
                                <path
                                    d="M17.5,15.83c0.88,0,1.73,0.09,2.5,0.26v-1.52c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,16.02,16.18,15.83,17.5,15.83z" />
                            </g>
                        </g>
                    </svg><span class="side-menu__label">المحطات</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('stationsList') }}">جدول المحطات / إضافة محطة</a>
                    </li>

                </ul>
            </li>
            @endauth

            {{-- <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M10.9 19.91c.36.05.72.09 1.1.09 2.18 0 4.16-.88 5.61-2.3L14.89 13l-3.99 6.91zm-1.04-.21l2.71-4.7H4.59c.93 2.28 2.87 4.03 5.27 4.7zM8.54 12L5.7 7.09C4.64 8.45 4 10.15 4 12c0 .69.1 1.36.26 2h5.43l-1.15-2zm9.76 4.91C19.36 15.55 20 13.85 20 12c0-.69-.1-1.36-.26-2h-5.43l3.99 6.91zM13.73 9h5.68c-.93-2.28-2.88-4.04-5.28-4.7L11.42 9h2.31zm-3.46 0l2.83-4.92C12.74 4.03 12.37 4 12 4c-2.18 0-4.16.88-5.6 2.3L9.12 11l1.15-2z"
                            opacity=".3" />
                        <path
                            d="M12 22c5.52 0 10-4.48 10-10 0-4.75-3.31-8.72-7.75-9.74l-.08-.04-.01.02C13.46 2.09 12.74 2 12 2 6.48 2 2 6.48 2 12s4.48 10 10 10zm0-2c-.38 0-.74-.04-1.1-.09L14.89 13l2.72 4.7C16.16 19.12 14.18 20 12 20zm8-8c0 1.85-.64 3.55-1.7 4.91l-4-6.91h5.43c.17.64.27 1.31.27 2zm-.59-3h-7.99l2.71-4.7c2.4.66 4.35 2.42 5.28 4.7zM12 4c.37 0 .74.03 1.1.08L10.27 9l-1.15 2L6.4 6.3C7.84 4.88 9.82 4 12 4zm-8 8c0-1.85.64-3.55 1.7-4.91L8.54 12l1.15 2H4.26C4.1 13.36 4 12.69 4 12zm6.27 3h2.3l-2.71 4.7c-2.4-.67-4.35-2.42-5.28-4.7h5.69z" />
                    </svg><span class="side-menu__label">Utilities</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ url('/' . $page='background') }}">Background</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='border') }}">Border</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='display') }}">Display</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='flex') }}">Flex</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='height') }}">Height</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='margin') }}">Margin</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='padding') }}">Padding</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='position') }}">Position</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='width') }}">Width</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='extras') }}">Extras</a></li>
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" opacity=".3" />
                        <path
                            d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z" />
                    </svg><span class="side-menu__label">Custom Pages</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ url('/' . $page='signin') }}">Sign In</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='signup') }}">Sign Up</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='forgot') }}">Forgot Password</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='reset') }}">Reset Password</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='lockscreen') }}">Lockscreen</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='underconstruction') }}">UnderConstruction</a>
                    </li>
                    <li><a class="slide-item" href="{{ url('/' . $page='404') }}">404 Error</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='500') }}">500 Error</a></li>
                </ul>
            </li>
            <li class="slide ">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M5 9h14V5H5v4zm2-3.5c.83 0 1.5.67 1.5 1.5S7.83 8.5 7 8.5 5.5 7.83 5.5 7 6.17 5.5 7 5.5zM5 19h14v-4H5v4zm2-3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5z"
                            opacity=".3" />
                        <path
                            d="M20 13H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1zm-1 6H5v-4h14v4zm-12-.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zM20 3H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1zm-1 6H5V5h14v4zM7 8.5c.83 0 1.5-.67 1.5-1.5S7.83 5.5 7 5.5 5.5 6.17 5.5 7 6.17 8.5 7 8.5z" />
                    </svg><span class="side-menu__label">Submenus</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li class="sub-slide">
                        <a class="sub-side-menu__item" data-toggle="sub-slide" href="{{ url('/' . $page='#') }}"><span
                                class="sub-side-menu__label">Level1</span><i
                                class="sub-angle fe fe-chevron-down"></i></a>
                        <ul class="sub-slide-menu">
                            <li><a class="sub-slide-item" href="{{ url('/' . $page='#') }}">Level01</a></li>
                            <li><a class="sub-slide-item" href="{{ url('/' . $page='#') }}">Level02</a></li>
                        </ul>
                    </li>
                </ul>
            </li> --}}

        </ul>
    </div>
</aside>
<!-- main-sidebar -->