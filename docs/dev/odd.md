# Object oriented design
Tuy nhiên, các nguyên lý này chỉ mới chỉ ra cho chúng ta biết, thiết kế nào là đúng, thiết kế nào là sai chứ chưa giúp chúng ta giải quyết được vấn đề.

## Open closed
- Để “đóng” các entity của chương trình, có thể sử dụng giải pháp abstraction, data driven, ..
- Hãy tách những thành phần dễ thay đổi ra khỏi những phần khó thay đổi
- 
## Dependency inversion
- Việc áp dụng hai nguyên lí open-closed và Liskov substitute một cách chặt chẽ có thể tổng quát hóa thành nguyên lí depndency inversion
- Nguyên lý này chỉ ra rằng các lớp high-level không được phụ thuộc vào các lớp low-level. 
- Thay vì để các lớp high-level sẽ sử dụng các interface do các lớp low-level định nghĩa và thực thi, thì nguyên lý này chỉ ra rằng các lớp high-level sẽ định nghĩa ra các interface, sau đó các lớp low-level sẽ thực thi các interface đó. (ĐẢO NGƯỢC ở chỗ đó)

### Not DI
![not DI](https://edwardthienhoang.files.wordpress.com/2013/11/dip2.jpg)
 Lớp cấp cao phải biết tất cả các interface của các lớp con. Khi có thêm một lớp cấp thấp thêm vào, chúng ta phải tiến hành thay đổi trong lớp cấp cao để nó có thể hiểu được các interface của lớp mới thêm vào

### DI
![DI](https://edwardthienhoang.files.wordpress.com/2013/11/dip3.jpg) 

Thay vì để các lớp cấp cao phải phụ thuộc vào các lớp cấp thấp, ta sẽ đặt các interface ở lớp cấp cao, và buộc các lớp con phải định nghĩa lại
 
 
## Interface segregation (Nguyên lý phân tách interface)
- Khi một client bị ép phải phụ thuộc vào những interface mà nó không sử dụng(polluted interface) thì nó sẽ bị lệ thuộc vào những thay đổi của interface đó.
- Không nên buộc các thực thể phần mềm phụ thuộc vào những interface mà chúng không sử dụng đến.
- Chúng ta cần phải tránh điều này nhiều nhất có thể bằng cách chia nhỏ interface.
- Nó giúp giảm sự cồng kềnh, dư thừa không cần thiết cho phần mềm và quan trọng hơn là giảm sự kết dính làm hạn chế tính linh động (flexibility) của phần mềm

## LISKOV SUBSTITUTION (LSP)
- Nguyên lý này nói rằng các lớp dẫn xuất phải có thể được thay thế bởi lớp cha
- Lớp D được gọi là kế thừa từ lớp B khi và chỉ khi với mọi hàm F thao tác trên các đối tượng của B, cách cư xử (behavior) của F không đổi khi thay thế các đối tượng của B bằng các đối tượng của D
-  Hãy chắc rằng bạn chỉ nên override lại các thuộc tính hay hành vi trừu tượng ở lớp cha vả đảm bảo việc override đó không ảnh hưởng đến các hành vi và phương thức còn lại của lớp cha
## Single responsibility
- Một lớp chỉ nên đảm trách duy nhất một nhiệm vụ, chức năng duy nhất
![Single responsibility](https://edwardthienhoang.files.wordpress.com/2013/11/srp.png?w=756&h=390)
