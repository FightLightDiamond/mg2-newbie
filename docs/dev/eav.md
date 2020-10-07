# EAV trong Magento 2

Mô hình Entity-Attribute-Value là một mô hình dữ liệu nhằm mô tả các entity(thực thể) trong đó số lượng attribute dự kiến ​​sẽ rất lớn, nhưng trên thực tế, số lượng các attribute được sử dụng trong thực thể là ít.

- Entity lưu trữ thông tin về loại dữ liệu đang được lưu trữ(product, customer…)
- Attribute là thuộc tính riêng của từng thực thể (name, weight, email address).
- Value là giá trị của một thực thể và thuộc tính nhất định.

![eav](https://vi-magento.com/wp-content/uploads/2020/09/magento-2-xcommerce-11-728.jpg)

Những table chính 
![env_*tables](https://belvg.com/blog/wp-content/uploads/2018/01/EAV-in-Magento-2.png)

## Những Entity trong Magento
Bạn có thể xem danh sách cách EAV trong Magento 2 tại bảng eav_entity_type. 

![eav_type](https://blog.magestore.com/wp-content/uploads/2014/01/eav-entity-type.png)

Xem clolum entity_type_code có thể thấy nhiều hơn 4 dòng dữ liệu nhưng thực chất chỉ có 4 entity theo mô hình EAV thôi:
- customer
- customer_address
- catalog_category
- catalog_product

Một số type khác
- order
- invoice
- creditmemo
- shipment

## Những EAV entity types trong Magento 2
- eav_entity_int
- eav_entity_varchar
- eav_entity_text
- eav_entity_decimal
- eav_entity_datetime

## Lợi ích của EAV trong Magento 2
Mô hình EAV giúp giải quyết rất nhiều vấn đề liên quan đến thiết kế cơ sở dữ liệu cho trang web, đặc biệt khi bạn muốn quản lý, sửa đổi hoặc tạo các thuộc tính mới cho các thực thể:

- Trong Flat table khi 1 column không có dữ liệu chúng sẽ tự động lưu giá trị là null gây tốn tài nguyên. Trong khi đó, EAV khi không có dữ liệu nó sẽ chẳng có gì cả. Mình thấy đây cũng là lợi ích lớn nhất của EAV trong Magento 2.
- Dễ dàng tạo các thuộc tính mới và quản lý sự thay đổi. Nếu bạn muốn thêm thuộc tính mới cho thực thể, không cần phải sửa đổi cấu trúc bảng, nhưng điều duy nhất bạn nên làm là thêm dữ liệu mới vào các bảng có sẵn.
- Hỗ trợ quản lý và lưu trữ dữ liệu thuộc tính dựa trên đa quốc gia, đa ngôn ngữ, tương ứng với Store hoặc Website.
- Có khả năng tùy biến cao hơn cấu trúc dữ liệu của Flat table

## EAV product 
![eav product](https://belvg.com/blog/wp-content/uploads/2018/07/image5.jpg)
- eav_attribute_table - Lưu attribute table (attribute_code, attribute_id etc)
- catalog_eav_attribute - additional attribute table, specific to product attributes only (is_used_in_promo_rule, is_searchable etc.)
- catalog_product_entity - Lưu product table
- backend_type một trong các loại int|decimal|varchar|text|datetime

### Entity
Hãy lấy bảng `catalog_product_entity` làm ví dụ. Đây là bảng chính của `catalog product`. Nếu bạn để ý bạn sẽ thấy khi chúng ta dùng `Collection` để `get` dữ liệu của `product` thì chúng ta chỉ lấy được những `column` của `table` này. Nếu muốn lấy thêm các `column` khác các bạn phải sử dụng `addAttributeToSelect()` để làm điều đó.

### Attribute
Bảng `eav_attribute` nơi lưu trữ những `attribute`. Nếu bạn thêm một `product attribute` hay `customer attribute` thì `attribute` bạn thêm vào sẽ được lưu ở đây cùng các tham số của chúng.

![eav_attribute](https://blog.magestore.com/wp-content/uploads/2014/01/eav-entity.png)

Những column cần chú ý :
- attribute_id
- entity_type_id
- attribute_code
- store_id

### Attribute group
Nhiều attribute được chia thành các group.

![attribute group](https://blog.magestore.com/wp-content/uploads/2014/01/eav-attribute.png)

### Value
EAV trong Magento 2, các kiểu dữ liệu sẽ được lưu vào các bảng tương ứng, vẫn lấy catalog_product_entity làm ví dụ:

![value](https://blog.magestore.com/wp-content/uploads/2014/01/eav-entity-value.png)

- catalog_product_entity_datetime
- catalog_product_entity_decimal
- catalog_product_entity_gallery
- catalog_product_entity_int
- catalog_product_entity_text
- catalog_product_entity_varchar

## Attribute với input trong Magento
- Text Field
- Text Area
- Date
- Yes/No
- Multiple Select
- Dropdown
- Price
- Media Image
- Fixed Product Tax
- Visual Swatch
- Text Swatch

### Text Field
Phần hiển thị lable được lưu trong bảng `eav_attribute_lable`. Column cần chú ý
- attribute_lable_id
- attribute_id
- store_id
- value

### Dropdown
Phần hiển thị này được lưu tại bảng `eav_attribute_option`
![dropdown](https://belvg.com/blog/wp-content/uploads/2018/07/image4.png)
Sự khác biệt với `Text Field`
- eav_attribute.frontend_input = “select”;
- eav_attribute.source_model = “Magento\Eav\Model\Entity\Attribute\Source\Table”;
- eav_attribute.backend_type = “int”;
- eav_attribute.default_value = eav_attribute_option.option_id by default;

### Price
Sự khác biệt với `Text Field`
- eav_attribute.frontend_input = “price”
- eav_attribute.backend_model = “Magento\Catalog\Model\Product\Attribute\Backend\Price”
- eav_attribute.backend_type = “decimal”

### Media image
Sự khác biệt với `Text Field`
- eav_attribute.frontend_input = “media_image”

### Text swatch
Phần hiển thị này được lưu tại bảng `eav_attribute_option_swatch`
![Text swatch](https://belvg.com/blog/wp-content/uploads/2018/07/image6.png)
Sự khác biệt với `Dropdown`
- catalog_eav_attribute.additional_data have an approximate form {“swatch_input_type”:”text”,”update_product_preview_image”:”0″,”use_product_image_for_swatch”:0}

## Cách để xem giá trị của 1 attribute
- Đầu tiên các bạn vào bảng `eav_attribute` và tìm `attribute` bạn muốn thông qua `attribute_code`.
- Dựa vào bước trên bạn sẽ biết được `attribute_id`, `entity_type_id` và `backend_type`. Các bạn mới tìm hiểu có thể ghi ra một tờ giấy cho dễ nhớ nhé.
- Dựa vào `entity_type_id` chúng ta sẽ tìm được bảng chứa dữ liệu của `attribute` thông qua bảng `eav_entity_type`. Ví dụ `entity_type_id` = 1 là bảng `customer_entity`, `entity_type_id = 4` là bảng `catalog_product_entity`…
- Sau đó dựa vào backend_type chúng ta biết được kiểu dữ liệu của attribute. Ví dụ: entity_type_id = 4 và backend_type = varchar thì chúng ta sẽ tìm dữ liệu của chúng ta bên trong bảng catalog_product_entity_varchar.
- Sau khi đã tìm được bảng chứa dữ liệu rồi chúng ta sẽ tìm kiếm theo attribute_id đã được xác định ở bước thứ 2. Thế là chúng ta đã biết được dữ liệu của chúng ta thêm vào được nằm ở đâu trong EAV rồi.


Tài liệu tham khảo thêm 
- [blog magestore](https://blog.magestore.com/entity-attribute-value-in-magento/)
- [vimageto](https://vi-magento.com/eav-trong-magento-2)
- [belvg](https://belvg.com/blog/how-eav-data-storage-works-in-magento-2.html)
