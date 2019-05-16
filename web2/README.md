# 4Eles

# ĐỌC HẾT README ĐỂ CÓ THỂ CHẠY CHƯƠNG TRÌNH
- Lưu folder web2 bên trong **xampp/htdocs**  
- Sau đó chạy chương trình là localhost/web2
- Tiếp theo là sẽ vào web2/public/js/js_config.js và sửa lại dòng code này `const URLROOT = 'http://localhost:8080/web2';` (sửa lại port phù hợp với máy của bạn)
- Và tương tự cũng vào web2/app/config/config.php sửa lại DB_HOST (tên host), DB_USER (user của bạn trên phpmyadmin), DB_PASS (password của bạn trên phpmyadmin), DB_NAME (database ở máy của bạn), URLROOT (sửa  lại cho phù hợp máy của bạn)
- Tạo database với file 4eles.sql, nhớ tạo database tên là 4eles và thêm dòng use 4eles vào đầu file sql sau đó import file sql vào 
