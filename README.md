# diploma
В данном проекте находятся файлы html страниц информационной системы (сайта). Логика сайта написана на языке программирования PHP (обращения к базе данных и другие функции). Резервная копия базы данных так же присутствует в репозитории(test.sql), её можно развернуть у себя на компьютере, чтобы посмотреть как работает сайт. 

Обращаю внимание на документ functions.php, а конкретно на место, которое начинается с комментария "//модель". В данном месте представлена модель распределения заказов топлива по бензовозам, имеющим разное количество секций (объем этих секций тоже разный). Это своеобразная статическая экспертная система.

P.S. Данная система создана в рамках дипломного проекта, знания о языках и работе с базой данных были получены не в университете, а самостоятельно (с нуля, кроме языка запросов SQL) поэтому качество кода очень далеко от совершенства. Тем не менее, проект рабочий, и выполняет все задуманные функции.

Логин/пароль для входа в систему под разными типами аккаунтов:

manager1/manager1 - менеджер по продажам, оператор системы;
login1/login1 - клиент, что заказывает топливо онлайн;
login2@list.ru - еще один клиент для сравнения;
admin/admin - администратор.
