## Service Contract
- Một bộ các `interfaces` định nghĩa các `core services` cung cấp bởi `framework`.
- Dịnh nghĩa các phương thức cần thiết để làm việc như: `queue`, `job`, `api`, `db` ... 
- Mỗi `contract` đều có sẵn một `corresponding implementation`( `implementation` với các `drivers` khác nhau) tương ứng được cung cấp bởi `framework`
- Như bộ documentation ngắn gọn về các chức năng của Framework

![Service contract](https://devdocs.magento.com/common/images/msc.jpg)

## Các loại service contracts 
### 1. Data interfaces
Define data interfaces in the Api/Data subdirectory for a module.

Vi du:
```
 amespace Magento\Customer\Api\Data;
  
 /**
  * Customer interface.
  * @api
  */
 interface CustomerInterface extends \Magento\Framework\Api\CustomAttributesDataInterface
 {
     /**#@+
      * Constants defined for keys of the data array. Identical to the name of the getter in snake case
      */
     const ID = 'id';
     const CONFIRMATION = 'confirmation';
     const CREATED_AT = 'created_at';
     const UPDATED_AT = 'updated_at';
     const CREATED_IN = 'created_in';
     const DOB = 'dob';
     const EMAIL = 'email';
     const FIRSTNAME = 'firstname';
     const GENDER = 'gender';
     const GROUP_ID = 'group_id';
   
     /**
      * Set created at time
      *
      * @param string $createdAt
      * @return $this
      */
     public function setCreatedAt($createdAt);
  
     /**
      * Get updated at time
      *
      * @return string|null
      */
     public function getUpdatedAt();
  
     /**
      * Set updated at time
      *
      * @param string $updatedAt
      * @return $this
      */
     public function setUpdatedAt($updatedAt);
  
     /**
      * Retrieve existing extension attributes object or create a new one.
      *
      * @return \Magento\Customer\Api\Data\CustomerExtensionInterface|null
      */
     public function getExtensionAttributes();
  
     /**
      * Set an extension attributes object.
      *
      * @param \Magento\Customer\Api\Data\CustomerExtensionInterface $extensionAttributes
      * @return $this
      */
     public function setExtensionAttributes(\Magento\Customer\Api\Data\CustomerExtensionInterface $extensionAttributes);
 }
```

### 2. Service interfaces
1.Repository interfaces
Repository interfaces provide access to persistent data entities.
Repository interfaces should implement the following methods:
```
save
get
getList
delete
deleteById
```

2. Management interfaces
Management interfaces provide management functions that are not related to repositories
(Management interfaces cung cấp các chức năng quản lý functions không liên quan đến repositories)

3. Metadata interfaces
Metadata interfaces provide methods for retrieving metadata, the interfaces are not related to repositories
(Metadata interfaces cung cấp các phương pháp để truy xuất metadata, các interfaces không liên quan đến repositories)

## Nguyên lý thiết kế 
### Dependency inversion
- Việc áp dụng hai nguyên lí open-closed và Liskov substitute một cách chặt chẽ có thể tổng quát hóa thành nguyên lí depndency inversion
- Nguyên lý này chỉ ra rằng các lớp high-level không được phụ thuộc vào các lớp low-level. 
- Thay vì để các lớp high-level sẽ sử dụng các interface do các lớp low-level định nghĩa và thực thi, thì nguyên lý này chỉ ra rằng các lớp high-level sẽ định nghĩa ra các interface, sau đó các lớp low-level sẽ thực thi các interface đó. (ĐẢO NGƯỢC ở chỗ đó)

### OPP
- Trừu tượng (Abstraction): Thiết kế chúng ta sẽ tập trung vào việc đưa ra “what” – cái mà một module hoặc 1 class sẽ làm chứ không tập trung vào “how” (mô tả hành vi hoặc khả năng của một class mà không đưa ra cách thực hiện cụ thể)  

### Thuộc tính trong thiết kế 
- Low coupling: Giảm sự kết dính các thành phần 

## Lợi ích 
- Dịch vụ đảm bảo tính toàn vẹn của dữ liệu.
- Rất dễ dàng cho các nhà phát triển bên thứ ba và các mô-đun sử dụng các dịch vụ được cung cấp trong hợp đồng dịch vụ.
- Có thể dễ dàng chuyển đổi các dịch vụ sang các ứng dụng web mạnh mẽ.
- Sử dụng hợp đồng dịch vụ đảm bảo tính ổn định của mô-đun ngay cả khi nâng cấp magento2.

[Document extra]
- [Mageto devdoc](https://devdocs.magento.com/guides/v2.4/extension-dev-guide/service-contracts/service-contracts.html)
- [Muc tieu thiet ke](https://edwardthienhoang.wordpress.com/2018/01/08/low-coupling-and-high-cohesion/)
- [Nguyên lý thiết kế ](https://edwardthienhoang.wordpress.com/2013/11/09/cac-nguyen-ly-thiet-ke-huong-doi-tuong/)
- [OPP](https://topdev.vn/blog/oop-la-gi/)
