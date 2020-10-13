# GraphQL
- Cung cấp một interface chung giữa client và server cho việc lấy và thao tác với dữ liệu

## Tiện ích cung cấp
- Declarative: Với GraphQL, bạn tự định nghĩa ra những dữ liệu bạn cần.
- Hierarchical: Với mỗi request, bạn có thể lấy được một object và cả những object liên quan với object đó, ví dụ một Author cùng với các Posts mà người đó tạo ra, mà các Comments trên mỗi Post.
- Strongly-typed: Với hệ thống GraphQL, ta có thể mô tả dữ liệu có thể truy vấn từ server dựa trên kiểu của object và dữ liệu trả về sẽ phù hợp với kiểu object chỉ định trong câu truy vấn.
- Not Language specific:** GraphQL không gắn với một ngôn ngữ lập trình cụ thể nào cả.
- Compatible with any backend: GraphQL không bị giới hạn bởi một data storage cụ thể; bạn có thể sử dụng data và code có sẵn, kể cả kết nối đến third-party APIs.
- Introspective: một GraphQL server có thể được truy vấn về schema cụ thể của nó.
### Query
Query - `getProduct` được sử dụng để thực thi hành động đọc, lấy dữ liệu từ server. 

#### Example
```
query getProduct {
  products(pageSize:10, currentPage:1, filter:{
    category_id: {eq: "2"}
  }) {
    total_count
    items {
      id
      name
      image {
        url
      }
      price_range {
        minimum_price {
          final_price {
            value
            currency
          }
        }
      }
      description {
       html  
      }
    }
  }
}
  
```

Response
```
{
  "data": {
    "products": {
      "total_count": 1,
      "items": [
        {
          "id": 1,
          "name": "Darklord",
          "image": {
            "url": "https://mage.to.vn/media/catalog/product/cache/8cc982c6a756a757ce448f36a072948c/s/c/screenshot_20200109-220548.jpeg"
          },
          "price_range": {
            "minimum_price": {
              "final_price": {
                "value": 20000,
                "currency": "USD"
              }
            }
          },
          "description": {
            "html": ""
          }
        }
      ]
    }
  }
}
```

#### Fields
Thành phần cơ bản của một object mà ta muốn thu được từ server. 
Như ở ví dụ trên là 
- id
- name 
- image
- price_rage
- description

#### Arguments
Một query có thể nhận tham số truyền vào.
Như ở ví dụ trên là 
- pageSize
- currentPage
- filter
```
products(pageSize:10, currentPage:1, filter:{
      category_id: {eq: "2"}
    }) 
```

#### Heads up
GraphQL requires strings to be wrapped in double quotes.

#### Variables
Bên cạnh tham số, một query cũng có thể có các biến. Các biến được đặt trước bởi dấu $ và theo sau là kiểu của nó.
```
query getProduct($pageSize: Int! = 10)  {
  products(pageSize:$pageSize, currentPage:1, filter:{
    category_id: {eq: "2"}
  })
```

### Aliases
Ta đổi tên total_count bằng cách đặt alies count 
```
count: total_count
```
Response thay đổi tương ứng
```
"count": 1,
```

#### Fragments
Fragments là một tập hợp các fields có thể sử dụng lại và include vào query khi cần thiết. Ví dụ:
```
{
      chimezie: author(id: 5) {
        ...authorDetails
      }
      neo: author(id: 7) {
        ...authorDetails
      }
    }

    fragment authorDetails on Author {
      name
      twitterHandle
    }
```
Với query trên, khi cần thêm một field nào đó, ta chỉ cần thêm vào fragment.

#### Directives
Directives cho phép ta thay đổi cấu trúc query một cách linh hoạt sử dụng các biến. GraphQL có 2 directive:

- @include sẽ include một field hay fragment khi tham số if là true.
- @skip sẽ bỏ qua một field hay fragment khi tham số if là false.
```
query GetAuthor($authorID: Int!, $notOnTwitter: Boolean!, $hasPosts: Post) {
      author(id: $authorID) {
        name
        twitterHandle @skip(if: $notOnTwitter)
        posts @include(if: $hasPosts) {
          title
        }
      }
    }
```

### Mutation
Mutations được sử dụng để thực hiện hành động write.

#### Example
```
mutation myCreateCustomerNoVariables {
  createCustomer(
    input: {
      firstname: "Melanie"
      lastname: "Shaw"
      email: "mshaw@example.com"
      password: "Password1"
    }
  ) {
    customer {
      email
    }
  }
}
```

Response
```
{
  "data": {
    "createCustomer": {
      "customer": {
        "email": "mshaw@example.com"
      }
    }
  }
}
```

Một điểm khác biệt quan trọng giữa mutation và query là mutation thực hiện một cách tuần tự còn query có thể thực thi song song.

### Schemas
Schemas được xây dựng sử dụng GraphQL schema language
```
type Author {
      name: String!
      posts: [Post]
    }
```
#### Arguments
các field trong schema chấp nhận tham số. Các tham số này có thể tùy chọn hoặc bắt buộc (xác định bởi ký hiệu !).
```
type Post {
      allowComments(comments: Boolean!)
    }
```
#### Scalar Types
- Int
- Float
- String
- Boolean
- ID

. Ta cũng có thể chỉ định kiểu scalar custom sử dụng từ khóa scalar. Ví dụ ta có thể định nghĩa kiểu Date:
```
scalar Date
```

#### Enumeration types
Giới hạn trong một tập các giá trị cho phép. Nó cho phép `validate` các tham số của kiểu này phải là một trong các giá trị trong tập cho phép, quy định giá trị của một field sẽ luôn là một trong các giá trị của một tập hữu hạn.
```
enum Media {
      Image
      Video
    }
```

#### Input types
```
input CommentInput {
      body: String!
    }
```
Những field của object kiểu input cũng có thể là những object kiểu input. Object kiểu input không thể chứa tham số trong các field của nó



- Document detail
[GraphQL Introduction](https://reactjs.org/blog/2015/05/01/graphql-introduction.html)
[getting-up-and-running-with-graphql](https://blog.pusher.com/getting-up-and-running-with-graphql/)
