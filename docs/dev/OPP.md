## Tính đóng gói (Encapsulation)
Tính đóng gói (Encapsulation) chỉ đơn giản là việc kết hợp một bộ các dữ liệu (data) liên quan đến nhau cùng với một bộ các hàm/phương thức (functions/methods) hoạt động trên các dữ liệu đó, “gói” tất cả vào trong một cái gọi là class.  Các thực thể của các class thì được gọi là các đối tượng (objects) trong khi class giống như một công thức được sử dụng để tạo ra các đối tượng đó.

![Encapsulation](https://cppdeveloper.com/wp-content/uploads/2019/01/encapsulation_.png)

### Hidden data
Che dấu dữ liệu  (Data Hiding) là việc một số dữ liệu (data) và hàm/phương thức (functions/methods) được class che giấu đi (ở dạng private) để đảm bảo rằng các dữ liệu đó sẽ được truy cập và sử dụng đúng mục đích, đúng cách thông qua các hàm/phương thức (functions/methods) ở dạng public mà class cung cấp. Bạn không thể truy cập đến các private data hoặc gọi đến private methods của class từ bên ngoài class đó.

## Tính trừu tượng (Abstraction) trong lập trình hướng đối tượng
Mục tiêu chính của nó là làm giảm sự phức tạp bằng cách ẩn các chi tiết không liên quan trực tiếp tới người dùng (người dùng ở đây không phải người dùng cuối mà là lập trình viên). Điều đó cho phép người dùng vẫn thực hiện được các công việc cần thiết dựa trên một thực thể trừu tượng được cung cấp mà không cần hiểu hoặc thậm chí không nghĩ về tất cả sự phức tạp ẩn giấu bên trong.

1. Abstraction = Encapsulation + Data Hiding 
2. Thiết kế chúng ta sẽ tập trung vào việc đưa ra “what” – cái mà một module hoặc 1 class sẽ làm chứ không tập trung vào “how”. VD: Service Contracts

## Tính kế thừa – Inheritance
- Sử dụng lại các đoạn code đã có trong chương trình 1 cách hiệu quả. 
- Khi tạo 1 class, thay vì việc viết 1 class mới hoàn toàn, người lập trình viên có thể kế thừa một số thuộc tính và phương thức từ 1 class đã có trong project. 
- Class đã có trước đấy gọi là lớp cơ sở (Base Class), class kế thừa từ Base Class (hay superclass) gọi là lớp dẫn xuất (Derived Class).
 
## Tính đa hình – Polymorphism
Cùng là một người nhưng tuỳ từng ngữ cảnh sẽ đóng vai trò khác nhau, một người đàn ông vừa là nhân viên (khi đi làm), vừa là một người chồng (đối với vợ) và là người cha (đối với con),… nói chung là anh ta sẽ biến hình thành con người khác nhau tuỳ từng ngữ cảnh.
###  Compile time Polymorphism
Một class có nhiều hàm cùng tên nhưng khác nhau về số lượng tham số hoặc kiểu dữ liệu của tham số
### Runtime Polymorphism
Cùng một class có thể cho ra nhiều biến thể, không phải được định nghĩa bởi lớp đó, mà bởi các lớp con của nó. Đây là một phương pháp để định nghĩa lại hành vi của lớp cơ sở mà không phải sửa code của lớp cơ sở. Nếu call hàm của đối tượng của lớp dẫn xuất thông qua con trỏ của lớp cơ sở thì việc hàm nào được call sẽ được quyết định lúc Runtime. Runtime Polymorphism được thực hiện bằng phương pháp overriding – ghi đè phương thức
