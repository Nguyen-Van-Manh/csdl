# TripsVN
Online plane ticket and hotel booking
# front-end: HTML5, CSS3, Javascript, Jquery library, Bootstrap 4.
# back-end: MySQL database, php.
# Các chức năng của website:
1. Đăng nhập hệ thống:
Người dùng đăng ký bằng số điện thoại, mỗi số điện thoại chỉ được đăng ký 1 lầm / username

2. Tìm kiếm và đặt vé máy bay
Người dùng nhập điểm khởi hành, điểm đến, ngày bay. Hệ thống sẽ sử dụng cơ sở dữ liệu của các chuyến bay (được cập nhật theo tháng) bao gồm các chi tiết: Hãng bay, mã chuyến bay, ngày bay, giá vé, tình trạng thanh toán. Từ đó chọn được chuyến bay phù hợp nhất.

3. Tìm kiếm và đặt phòng khách sạn
Người dùng lựa chọn thành phố gần mình nhất, ngày nhận phòng, ngày trả phòng, số lượng khách hàng. Hệ thống sẽ truy vấn cơ sở dữ liệu từ đó hiển thị cho người dùng danh sách các khách sạn,địa điểm cụ thể, giá phòng và các ưu đãi giảm giá.

4. Chức năng tìm kiếm các thành phố nổi bật
Người dùng có thể tìm kiếm các thành phố hot (được cập nhật thường xuyên), hệ thống sẽ đưa ra các blog review về thành phố đó.

# database
Tổ chức cơ sở dữ liệu theo mô hình EER, các bảng được dùng: users(dùng để lưu trữ thông tin người dùng), timchuyenbay(lưu trữ thông tin các chặng bay), chuyenbay(lưu trữ thông tin các chuyến bay), datve(lưu trữ thông tin đặt vé máy bay của người dùng), timkhachsan(lưu trữ thông tin tất cả các khách sạn), datphong(lưu trữ thông tin đặt phòng của người dùng).
