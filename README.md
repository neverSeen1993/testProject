# testProject
<br>
1. Создать виртуальный хост <br>
2. Скопировать содержимое в папку по адресу виртуального хоста <br>
3. В файле app/config/database.php в 58,59 и 60 строке указать имя базы, пользователя и пароль <br>
4. Перейти в корень папки виртуального хоста и прописать в терминале следующие команды
<ul>
    <li>php artisan migrate</li>
    <li>php db:seed</li>
</ul>
В корне папки выполнить следующие команды
<ul>
    <li>chown -R :www-data app/storage</li>
    <li>chmod -R 775 app/storage</li>
</ul>
    
