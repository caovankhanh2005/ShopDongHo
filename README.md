# Watch_Shop
# ⌚ Watch Shop - Website Bán Đồng Hồ Trực Tuyến

> Một dự án web bán hàng sử dụng PHP thuần, phát triển nhằm mục tiêu học tập và thực hành quy trình kỹ thuật phần mềm.

---

## 📌 Giới Thiệu Dự Án

**Watch Shop** là một nền tảng thương mại điện tử cho phép người dùng mua bán các loại đồng hồ đeo tay. Hệ thống hỗ trợ người dùng đăng ký, đăng nhập, xem chi tiết sản phẩm, thêm vào giỏ hàng, đặt hàng và theo dõi đơn. Quản trị viên có thể quản lý sản phẩm, đơn hàng và người dùng.

Dự án được phát triển theo mô hình SDLC (Waterfall), có đầy đủ phân tích yêu cầu (SRS), và tuân theo chuẩn làm việc nhóm qua GitHub.

---

## 💡 Các Tính Năng Chính

### 👥 Phía Người Dùng:
- Đăng ký / Đăng nhập / Đăng xuất
- Xem danh sách sản phẩm theo danh mục
- Xem chi tiết từng sản phẩm
- Thêm vào giỏ hàng / yêu thích
- Đặt hàng 
- Tìm kiếm sản phẩm

### 🔐 Phía Quản Trị:
- Đăng nhập Admin
- Thêm / sửa / xoá sản phẩm
- Quản lý đơn hàng khách hàng
- Theo dõi tình trạng kho & đơn hàng

---

## 🛠️ Công Nghệ Sử Dụng

| Thành phần | Công nghệ         |
|------------|-------------------|
| Giao diện  | HTML, CSS, JavaScript |
| Backend    | PHP thuần         |
| Cơ sở dữ liệu | MySQL           |
| Server     | XAMPP / LAMP (Apache) |
| Quản lý mã nguồn | Git + GitHub |

---

## 🗂️ Cấu Trúc Thư Mục
<pre> Wacth_shop/
├── config/         # Cấu hình kết nối cơ sở dữ liệu (MySQL)
├── public/         # Chứa các tài nguyên công khai: ảnh, CSS, JavaScript
├── templates/      # Các mẫu giao diện dùng lại (header, footer, layout)
├── pages/          # Các trang nội dung (home, about, contact,...)
├── auth/           # Xử lý chức năng đăng nhập, đăng ký, đăng xuất
├── user/           # Các tính năng dành cho người dùng (mua hàng, xem đơn,...)
├── admin/          # Quản lý sản phẩm, đơn hàng, người dùng (dành cho Admin)
├── database/       # Chứa file .sql và script kết nối, xử lý CSDL
├── docs/           # Tài liệu dự án: SRS, sơ đồ, kế hoạch SDLC,...
 </pre>

## ⚙️ Hướng dẫn cài đặt

### 🧩 Yêu cầu hệ thống

- PHP >= 7.x
- MySQL hoặc MariaDB
- Apache hoặc phần mềm tích hợp như XAMPP, Laragon

---

### 🛠️ Các bước cài đặt

#### 1. 📦 Tải mã nguồn

Bạn có thể clone hoặc tải dự án về:

```bash
git clone https://github.com/<tên-người-dùng>/culuho.git

```
#### 2🗃️ Tạo cơ sở dữ liệu
##### Truy cập phpMyAdmin hoặc dùng dòng lệnh MySQL
     Tạo database mới, ví dụ:
 
     CREATE DATABASE ecommerce_closthes;;

##### Sau đó import file SQL:
 
     Từ phpMyAdmin → Import → chọn file: database/ecommerce_closthes.sql
#### 3⚙️ Cấu hình kết nối cơ sở dữ liệu
##### Mở file cấu hình:
    config/config.php

##### Sửa thông tin kết nối như sau:
     $host = '127.0.0.1';
   
     $dbname = 'ecommerce_closthes';
   
     $user = 'root';
   
     $pass = '';  // nếu có mật khẩu thì điền vào
   
     $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
#### 4. 🚀 Chạy ứng dụng
##### Nếu dùng XAMPP → truy cập:
    http://localhost/culuho/home.php

###### ✅ Giao diện sẽ hiển thị trang chính, bạn có thể:
###### - Đăng ký tài khoản người dùng
###### - Đăng nhập để mua hàng
###### - Vào trang admin để quản lý (đăng nhập tài khoản admin) 
#### 5. Hướng dẫn đăng nhập tài khoản admin
##### - Vào trang đăng nhập.
##### - Tích vào dòng "Đăng nhập như admin".
##### - Đăng nhập theo tài khoản sau:
######    . account: admin@gmail.com
######    . password: 123456
