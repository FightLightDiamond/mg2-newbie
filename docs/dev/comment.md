# Comment trong PHP
Comment là cách để chúng ta có thể ghi chú các dòng code và đoạn code nhằm giúp chúng ta đọc lại code và bàn giao code dễ dàng hơn

## CÁC CÁCH COMMENT CODE
Comment dòng
```
# line comment
//line another comment
```

Comment khối
```
/* Lorem Ipsum is simply dummy text of the printing and *typesetting industry. Lorem Ipsum has been the industry's *standard dummy text ever since the 1500s

*/
```

## KINH NGHIỆM COMMENT
Comment tiêu đề khối lớn
```
//=======================================================
// CATEGORY LARGE FONT
//=======================================================
```

Comment tiêu đề phụ
```
//-----------------------------------------------------
// Sub-Category Smaller Font
//-----------------------------------------------------
```

Comment trường hợp
```
# Option 1
# Option 2
# Option 3
```

Comment đoạn
```
/*
* This is a detailed explanation
* of something that should require
* several paragraphs of information.
*/
```

Comment dòng
```
// This is a single line quote.
```

## Comment in PHPStorm
syntax /** (rồi enter)

## PHPDoc basicX

| Keyword     | Description                                                                                                                                       |
|-----------------|:------------------------------------------------------------------------------------------------------------------------------:|
| @param      | Đầu vào của function                                                                                                                      |
| @return     | Kiểu thông tin trả về của function                                                                                                     |
| @var        | Thông tin variable và kiểu dữ liệu. Sử dụng cho property trong class và variables trong functions  |
| @package    | Thông tin về Namespace của Class                                                                                              |
| @author     | Tác giả                                                                                                                                             |
| @method     | Thông tin về method trong class. Thông thường hay define cho 1 dynamic method                    |
| @property   | Thông tin về 1 property trong class Dynamic property                                                                   |
| @deprecated | Thông tin về deprecated của class hay function                                                                          |
| @todo       | Note lại ở khúc nào đó những việc phải làm trong hiện tại hoặc tương lai                                      |

## Ví dụ
Comment Function đơn giản
```
<?php
/**
 * Plus 2 integers
 * @param integer $a
 * @param integer $b
 * @return integer
 */
function plus($a, $b) {
    return $a + $b;
}
```

Function nhiều kiểu trả về
```
<?php

/**
 * Get user from ID
 * @param integer $user_id
 * @return \App\Models\User|null
 */
function getUser($user_id) {
    return \App\Models\User::find($user_id);
}
```

Array of Objects
```
/**
 * Get all users in the db
 * @return User[]
 */
function getAllUsers() {
    $users = User::all();
    return $users;
}
```

Laravel Eloquent
```
/**
 * Class User
 * About the User Entity
 * @package App\Models
 *
 * ==== Properties - Fields
 * @property integer id
 * @property string name
 * @property string email
 * @property string password Encrypted Password
 * ... (you can also define your accessor here)
 *
 * === Relationships
 * @property UserComment[] comments - HasMany - All Comments of User
 * @property UserSubscribe[] subscribes - HasMany - All Subscribers of User
 * @property UserPermission permission - BelongTo - User Permission (simple)
 */
class User extends Authenticatable
{
```

## Viết coment tạo tài liệu API 
```
composer require sami/sami

php vendor/sami/sami/sami.php
```

[Đọc thêm]( http://vi.uwenku.com/tag/phpdoc)
