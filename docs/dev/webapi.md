
## SOAP VS REST
| #  | SOAP | REST |
|----|------|------|
| 1  |một giao thức    |một cách thiết kế kiến trúc   |
| 2  |Simple Object Access Protocol(Giao thức truy cập đối tượng đơn giản)    |REpresentational State Transfer    |
| 3  |SOAP can't use REST because it is a protocol      |REST có thể dùng các web services sử dụng SOAP vì nó có thể dùng bất kỳ giao thức nào như HTTP, SOAP      |
| 4  |SOAP cung cấp các giao diện dịch vụ(services interfaces) cho các thành phần bên ngoài sử dụng      |REST sủ dụng đỉa chỉ URI để cung cấp các dịch vụ      |
| 5  |cài đặt web services theo giao thức SOAP      |cài đặt web services theo kiến trúc RESTful      |
| 6  |định nghĩa các chuẩn và quy tắc chặt chẽ      | không định nghĩa nhiều chuẩn như SOAP      |
| 7  |sử dụng băng thông và tài nguyên nhiều hơn REST      |sử dụng băng thông và tài nguyên ít hơn SOAP      |
| 8  |định nghĩa chuẩn bảo mật của riêng nó      | kế thừa chuẩn bảo mật tầng vận tải của giao thức mạng      |
| 9  |chỉ hỗ trợ định dạng dữ liệu XML      |hỗ trợ các định dạng dữ liệu khác nhau như text, HTML, XML, JSON      |
| 10 |Được thiết kế để dùng trong tính toán phân tán      |Thương không được dùng trong môi trường tính toán phân tán      |
| 11 |Tin cậy hơn      |Ít tin cậy hơn – chẳng hạn, HTTP DELETE có thể trả về trạng thái OK ngay cả khi tài nguyên không được xóa      |
| 12 |Hỗ trợ hầu hết các chuẩn bảo mật, tin cậy và giao dịch      |Sử dụng tốt với các giao thức như: HTTP, SSL. Các phương thức DELETE và PUT thường bị vô hiệu hóa bởi tường lửa hoặc vấn đề bảo mật      |
| 13 |SOAP hỗ trợ cả hai giao thức SMTP và HTTP      |REST gắn với giao thức HTTP      |


# Rest API
## Web API technical vision
![Components Dependencies](https://devdocs.magento.com/common/images/coding-standards/webapi-components-dependencies.png)

## High-level Architecture

![Higt level architecture](https://devdocs.magento.com/common/images/coding-standards/webapi-request-processing-high-level-overview.png)

## SOAP Reference
### Soap WSDL Endpoint Format
```
http://<magento_host>/soap/<store_code>?wsdl&services=<serviceName1,serviceName2,..>
```
### Test 
```
<?php
$opts = [
            'http'=> [
                'header' => 'Authorization: Bearer 36849300bca4fbff758d93a3379f1b8e'
            ]
        ];
$wsdlUrl = 'http://magento.ll/soap/default?wsdl=1&services=testModule1AllSoapAndRestV1';
$serviceArgs = ["id" => 1];

$context = stream_context_create($opts);
$soapClient = new SoapClient($wsdlUrl, ['version' => SOAP_1_2, 'stream_context' => $context]);

$soapResponse = $soapClient->testModule1AllSoapAndRestV1Item($serviceArgs); ?>
```

## REST Reference
### Generate the admin token
Log in to Admin and go to Stores > Settings > Configuration > Services > OAuth > Access Token Expiration > Admin Token Lifetime (hours).

### Endpoint:
```
POST <host>/rest/<store_code?>/V1/integration/admin/token
```

### Headers:
```
Content-Type application/json
```

Payload:
```
{
"username": "admin",
"password": "123123"
}
```
Response:
```
bqu7bdsquyo3ngx3j06tsl7vid8wgi93
```

## Use api admin
Headers:

Content-Type: application/json
Authorization: Bearer <customer token>
