
## Nguyen ly can ban lap trinh
### Coupling
- `Coupling` đề cập đến vấn đề phụ thuộc lẫn nhau giữa các `component`. 
- `Low coupling`, loose coupling có nghĩa là các component ít phụ thuộc vào nhau, sự thay đổi trong component này ít khi, hoặc không ảnh hưởng đến component kia. 
- `High coupling` và `tight coupling` cho thấy các `component` phụ thuộc nhiều vào nhau, khi thay đổi 1 `component` thì các `component` kia đều bị ảnh hưởng và có khả năng phải thay đổi theo.
- `Low coupling` là mục tiêu chúng ta cần hướng đến để đảm bảo cho hệ thống ít bị ảnh hưởng khi có thay đổi và do đó, tăng tốc độ thực hiện công việc và bảo trì.

### COHESION
- `Cohesion` chúng ta nghĩ đến nhiệm vụ của từng `module`. 
- Nhiệm vụ của từng `module` càng rõ ràng và tách biệt thì `cohesion` càng cao (`high cohesion`)
- High cohesion thường đạt được nếu ta tuân thủ theo nguyên tắc đơn nhiệm (Single responsibility principle), mỗi module, khi đó chỉ đảm nhiệm một nhiệm vụ duy nhất, không hơn không kém, và không có chuyện 2 module cùng làm một nhiệm vụ, một tính năng.


| COHESION                                                                             | COUPLING                                                                    |
|--------------------------------------------------------------------------------------|-----------------------------------------------------------------------------|
| Cohesion thể hiện mối quan hệ bên trong module                                       | Coupling thể hiển sự liên kết giữa các modules.                             |
| Cohesion thể hiện sức mạnh liên kết giữa các chức năng                               | chức năng Coupling thể hiện quan hệ phụ thuộc vào nhiều modules             |
| Cohesion đánh giá chất lượng mà một component / module tập trung vào một việc đơn lẻ | Coupling là đánh giá mức độ một component / module liên kết với mudule khác |

# COHESION TYPE
### SỰ GẮN KẾT NGẪU NHIÊN (COINCIDENTAL COHESION) 
`Utility` nơi các phần tử hoàn toàn độc lập với nhau lại được `group` lại với nhau

### SỰ GẮN KẾT LOGIC (LOGICAL COHESION)
Sự gắn kết logic là khi các phần của mô-đun được nhóm lại vì chúng được phân loại logic để làm việc tương tự, ngay cả khi chúng khác nhau theo bản chất

### SỰ GẮN KẾT THỜI GIAN (TEMPORAL COHESION)
Sự gắn kết thời gian là khi các phần của mô-đun được nhóm lại khi chúng được xử lý – các phần được xử lý tại một thời điểm cụ thể trong quá trình thực hiện chương trình (ví dụ như một hàm được gọi là sau khi catch một exception khi close file, tạo ra một error log và thông báo đến người dùng).

### SỰ GẮN KẾT THEO THỦ TỤC (PROCEDURAL COHESION)
Sự gắn kết theo thủ tục là khi các phần của mô-đun được nhóm lại bởi vì chúng luôn tuân theo một trình tự thực thi nhất định (ví dụ: một chức năng kiểm tra quyền truy cập tệp và sau đó mở tệp).

### SỰ GẮN KẾT THÔNG TIN / TRAO ĐỔI (COMMUNICATIONAL/INFORMATIONAL COHESION)
Sự liên kết giao tiếp là khi các phần của mô-đun được nhóm lại vì chúng hoạt động trên cùng một dữ liệu (ví dụ như mô-đun hoạt động trên cùng một bản ghi thông tin).

### SỰ LIÊN KẾT TUẦN TỰ (SEQUENTIAL COHESION)
Sự liên kết tuần tự là khi các phần của một mô-đun được nhóm lại bởi vì đầu ra từ một phần là đầu vào đến một phần khác giống như một dây chuyền lắp ráp (ví dụ như một chức năng đọc dữ liệu từ một tệp tin và xử lý dữ liệu).

### SỰ GẮN KẾT VỀ MẶT CHỨC NĂNG (FUNCTIONAL COHESION) *GOOD*
Sự gắn kết chức năng là khi các phần của mô-đun được nhóm lại vì tất cả chúng đóng góp vào một nhiệm vụ duy nhất được định nghĩa rõ ràng của mô-đun (ví dụ, phân tích Lexical của một chuỗi XML).

[Không phải lúc nào cũng có thể đạt được sự gắn kết tuyệt đối cao trong lớp, nhưng biết nó là gì và làm thế nào để nó góp phần vào việc thiết kế tổng thể có thể là một kiến thức tốt. Chúng ta không thể luôn luôn làm cho hoàn hảo, nhưng ít nhất chúng ta có thể phấn đấu để làm tốt hơn].

## MỞ RỘNG
- Một câu hỏi đặt ra là hai tính chất này có cùng lúc đạt được song song với nhau hay không? Hay sẽ loại trừ nhau? Ví dụ như phân rã thành càng nhiều module thì tính low coupling sẽ càng đạt được, ngược lại nếu như một tính năng bị phân rã thành nhiều module thì khi sửa đổi sẽ gặp nhiều khó khăn, do đó lại không đạt được tính high cohesion như mong đợi, và trường hợp ngược lại.
   
- Để trả lời câu hỏi này, chúng ta cần tập trung vào scope (phạm vi) của chúng. Nhìn nhận một cách tổng thể từ ban đầu, low coupling liên quan đến sự phụ thuộc, hiểu biết giữa các module với nhau, còn high cohesion là việc gom nhóm các thành phần có liên quan về cùng một module để dễ dàng quản lý và bảo trì. Vì vậy, chúng không loại trừ nhau và chúng ta có thể đạt được cả 2.
   
- Có trường hợp ta tổ chức các thành phần làm chung một chức năng vào cùng một module rồi, thì vẫn có khả năng xảy ra chuyện các module phụ thuộc chồng chéo lên nhau, khi đó ta gọi nó có tính high cohesion nhưng tight coupling.

### KL
Mục tiêu của thiết kế có thể túm gọn trong 3 từ: low coupling, high cohesion và encalsulation, bằng cách đảm bảo được 3 tính chất này, hệ thống sẽ có khả năng phát triển, mở rộng và bảo trì cực cao (tất nhiên, nói dễ hơn)




