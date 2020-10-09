##  SINGLE RESPONSIBILITY PRINCIPLE (SRP) - High coupling
- Một lớp chỉ nên đảm trách duy nhất một nhiệm vụ, chức năng duy nhất
- Nếu chúng ta gom nhiều chức năng cho một lớp, thì khi chúng ta thay đổi một chức năng nào đó, thì toàn bộ lớp đó phải thay đổi. Và khi có nhiều thay đổi, điều đó cũng có nghĩa là sẽ phát sinh ra nhiều vấn đề khác như lỗi, buộc ta phải test lại hết toàn bộ lớp đó
- Các thành phần không bị phụ thuộc quá nhiều vào nhau, để thuận tiện cho việc bảo trì và mở rộng sau này
- Bạn có thể phải thay đổi một vài function trong đám hỗn độn đó. Thay vì bạn chỉ phải vào 1 lớp cụ thể nào đó để sửa và test lại lớp đó nếu bạn tách các chức năng khác nhau ra những lớp khác nhau
