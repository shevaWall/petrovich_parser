<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Меню</li>

                <li>
                    <a href="{{route('admin.index')}}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.users')}}">
                        <i data-feather="layout"></i>
                        <span data-key="t-horizontal">Пользователи</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Программы</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="apps-calendar.php">
                                <span data-key="t-calendar">Календарь</span>
                            </a>
                        </li>
                        <li>
                            <a href="apps-chat.php">
                                <span data-key="t-chat">Чат</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-email">Электронная почта</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="apps-email-inbox.php" data-key="t-inbox">Входящие</a></li>
                                <li><a href="apps-email-read.php" data-key="t-read-email">Читать электронную почту</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-invoices">Счета</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="apps-invoices-list.php" data-key="t-invoice-list">Список счетов</a></li>
                                <li><a href="apps-invoices-detail.php" data-key="t-invoice-detail">Детали счета</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <span data-key="t-contacts">Контакты</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="apps-contacts-grid.php" data-key="t-user-grid">Сетка пользователя</a></li>
                                <li><a href="apps-contacts-list.php" data-key="t-user-list">Список пользователей</a></li>
                                <li><a href="apps-contacts-profile.php" data-key="t-profile">Профиль</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-authentication">Аутентификация</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-login.php" data-key="t-login">Авторизоваться</a></li>
                        <li><a href="pages-register.php" data-key="t-register">регистр</a></li>
                        <li><a href="pages-recoverpw.php" data-key="t-recover-password">Восстановить пароль</a></li>
                        <li><a href="auth-lock-screen.php" data-key="t-lock-screen">Экран блокировки</a></li>
                        <li><a href="auth-confirm-mail.php" data-key="t-confirm-mail">Подтвердить почту</a></li>
                        <li><a href="auth-email-verification.php" data-key="t-email-verification">подтверждение адреса электронной почты</a></li>
                        <li><a href="auth-two-step-verification.php" data-key="t-two-step-verification">Двухэтапная проверка</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="file-text"></i>
                        <span data-key="t-pages">Страницы</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter.php" data-key="t-starter-page">Стартовая страница </a></li>
                        <li><a href="pages-maintenance.php" data-key="t-maintenance">Обслуживание</a></li>
                        <li><a href="pages-comingsoon.php" data-key="t-coming-soon">Скоро будет</a></li>
                        <li><a href="pages-timeline.php" data-key="t-timeline">График</a></li>
                        <li><a href="pages-faqs.php" data-key="t-faqs">FAQs</a></li>
                        <li><a href="pages-pricing.php" data-key="t-pricing">Ценообразование</a></li>
                        <li><a href="pages-404.php" data-key="t-error-404">Ошибка 404</a></li>
                        <li><a href="pages-500.php" data-key="t-error-500">Ошибка 500</a></li>
                    </ul>
                </li>

                <li>
                    <a href="layouts-horizontal.php">
                        <i data-feather="layout"></i>
                        <span data-key="t-horizontal">По горизонтали</span>
                    </a>
                </li>

                <li class="menu-title mt-2" data-key="t-components">Элементы</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="briefcase"></i>
                        <span data-key="t-components">Составные части</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ui-alerts.php" data-key="t-alerts">Оповещения</a></li>
                        <li><a href="ui-buttons.php" data-key="t-buttons">Кнопки</a></li>
                        <li><a href="ui-cards.php" data-key="t-cards">Открытки</a></li>
                        <li><a href="ui-carousel.php" data-key="t-carousel">Карусель</a></li>
                        <li><a href="ui-dropdowns.php" data-key="t-dropdowns">Выпадающие списки</a></li>
                        <li><a href="ui-grid.php" data-key="t-grid">Сетка</a></li>
                        <li><a href="ui-images.php" data-key="t-images">Изображений</a></li>
                        <li><a href="ui-modals.php" data-key="t-modals">Модальные окна</a></li>
                        <li><a href="ui-offcanvas.php" data-key="t-offcanvas">Offcanvas</a></li>
                        <li><a href="ui-progressbars.php" data-key="t-progress-bars">Индикаторы прогресса</a></li>
                        <li><a href="ui-tabs-accordions.php" data-key="t-tabs-accordions">Вкладки & аккордеоны</a></li>
                        <li><a href="ui-typography.php" data-key="t-typography">Типография</a></li>
                        <li><a href="ui-video.php" data-key="t-video">видео</a></li>
                        <li><a href="ui-general.php" data-key="t-general">Общий</a></li>
                        <li><a href="ui-colors.php" data-key="t-colors">Цвета</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="gift"></i>
                        <span data-key="t-ui-elements">Расширенный</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="extended-lightbox.php" data-key="t-lightbox">Лайтбокс</a></li>
                        <li><a href="extended-rangeslider.php" data-key="t-range-slider">Ползунок диапазона</a></li>
                        <li><a href="extended-sweet-alert.php" data-key="t-sweet-alert">SweetAlert 2</a></li>
                        <li><a href="extended-session-timeout.php" data-key="t-session-timeout">Тайм-аут сеанса</a></li>
                        <li><a href="extended-rating.php" data-key="t-rating">Рейтинг</a></li>
                        <li><a href="extended-notifications.php" data-key="t-notifications">Уведомления</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);">
                        <i data-feather="box"></i>
                        <span class="badge rounded-pill bg-soft-danger text-danger float-end">7</span>
                        <span data-key="t-forms">Формы</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="form-elements.php" data-key="t-form-elements">Основные элементы</a></li>
                        <li><a href="form-validation.php" data-key="t-form-validation">Проверка</a></li>
                        <li><a href="form-advanced.php" data-key="t-form-advanced">Расширенные плагины</a></li>
                        <li><a href="form-editors.php" data-key="t-form-editors">Редакторы</a></li>
                        <li><a href="form-uploads.php" data-key="t-form-upload">Файл загружен</a></li>
                        <li><a href="form-wizard.php" data-key="t-form-wizard">волшебник</a></li>
                        <li><a href="form-mask.php" data-key="t-form-mask">Маска</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="sliders"></i>
                        <span data-key="t-tables">Таблицы</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="tables-basic.php" data-key="t-basic-tables">Bootstrap Basic</a></li>
                        <li><a href="tables-datatable.php" data-key="t-data-tables">Таблицы данных</a></li>
                        <li><a href="tables-responsive.php" data-key="t-responsive-table">Отзывчивый</a></li>
                        <li><a href="tables-editable.php" data-key="t-editable-table">Редактируемый</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="pie-chart"></i>
                        <span data-key="t-charts">Диаграммы</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="charts-apex.php" data-key="t-apex-charts">Apexcharts</a></li>
                        <li><a href="charts-echart.php" data-key="t-e-charts">Электронные диаграммы</a></li>
                        <li><a href="charts-chartjs.php" data-key="t-chartjs-charts">Chartjs</a></li>
                        <li><a href="charts-knob.php" data-key="t-knob-charts">jQuery</a></li>
                        <li><a href="charts-sparkline.php" data-key="t-sparkline-charts">Спарклайн</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="cpu"></i>
                        <span data-key="t-icons">Иконки</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="icons-boxicons.php" data-key="t-boxicons">Боксиконы</a></li>
                        <li><a href="icons-materialdesign.php" data-key="t-material-design">Материальный дизайн</a></li>
                        <li><a href="icons-dripicons.php" data-key="t-dripicons">Дрипиконы</a></li>
                        <li><a href="icons-fontawesome.php" data-key="t-font-awesome">Шрифт Awesome 5</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="map"></i>
                        <span data-key="t-maps">Карты</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="maps-google.php" data-key="t-g-maps">Google</a></li>
                        <li><a href="maps-vector.php" data-key="t-v-maps">Вектор</a></li>
                        <li><a href="maps-leaflet.php" data-key="t-l-maps">Листовка</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="share-2"></i>
                        <span data-key="t-multi-level">Многоуровневый</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="javascript: void(0);" data-key="t-level-1-1">Уровень 1 1</a></li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" data-key="t-level-1-2">Уровень 1 2</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);" data-key="t-level-2-1">Уровень 2 1</a></li>
                                <li><a href="javascript: void(0);" data-key="t-level-2-2">Уровень 2 2</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
