Sau khi đã clone project từ github, làm theo những bước sau:<br>
	+ Mở terminal và chạy lệnh "composer install" hoặc "composer update"<br>
	+ Tạo file .env bằng cách copy file .env.example và đổi tên.<br>
	+ Vào file .env chỉnh sửa claij cấu hình database như sau:<br>
		+ DB_DATABASE = tên cơ sở dữ liệu<br>
		+ DB_USERNAME = tên đăng nhập mySql<br>
		+ DB_PASSWORD = mật khẩu đăng nhập mySql<br>
	+ Tiếp đó mở terminal và chạy lệnh "php artisan key:generate".<br>
	+ Tiếp theo nhập vào dòng lệnh "php artisan migrate" để migration cơ sở dữ liệu.<br>
	+ Sau đó chạy tiếp "php artisan db:seed" để seed dữ liệu.<br>
	+ Cuối cùng chạy lệnh "php artisan make:auth" để tạo authentication.<br>

Sau khi hoàn thành các bước trên, chạy lệnh "php artisan serve" rồi truy cập vào địa chỉ<br>
http://127.0.0.1:8000 để xem kết quả.<br>
