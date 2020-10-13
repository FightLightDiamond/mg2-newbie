## The current state of Magento GraphQL
As of Magento 2.4.0, GraphQL provides the following features:

- Support for all product types, payment methods, and shipping methods
- Redesigned a feature rich layered navigation
- Reorders
- Inventory Management store pickups

## How to access GraphQL
Extension Chrome
- [ Altair GraphQL Client](https://chrome.google.com/webstore/detail/altair-graphql-client/flnheeellpciglgpaodhkhmapeljopja)
![Altair](https://devdocs.magento.com/guides/v2.4/graphql/images/graphql-browser.png)

## GraphQL requests

| HEADER NAME      | VALUE                                                                                                                                                                                                                               | DESCRIPTION                                                                                                                                |
|------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------|
| Authorization    | Bearer <authorization_token>                                                                                                                                                                                                        | A customer or admin token.   Authorization tokens  describes how to generate tokens.                                                       |
| Content-Currency | A valid currency code, such as   USD                                                                                                                                                                                                | This header is required only if the currency is not the store view’s default currency. Content-Type application/json                       |
| Content-Type     | application/json                                                                                                                                                                                                                    | Required for all requests.                                                                                                                 |
| Preview-Version  | A timestamp (seconds since January 1, 1970). Use this header to query products, categories, price rules, and other entities that are scheduled to be in a campaign (staged content). Staging is supported in Magento Commerce only. |                                                                                                                                            |
| Store            | <store_view_code>                                                                                                                                                                                                                   | The store view code on which to perform the request. The value can be   default  or the code that is defined when a store view is created. |

## Authorization tokens
### User tokens
Request
```
mutation {
  generateCustomerToken(email: "mshaw@example.com", password: "Password1") {
    token
  }
}
```

Response
```
{
  "data": {
    "generateCustomerToken": {
      "token": "wjwbpzzbki50d2s6039dii1tulji7hcn"
    }
  }
}
```

### Admin tokens
- [Generate here](https://devdocs.magento.com/guides/v2.4/rest/tutorials/prerequisite-tasks/create-admin-token.html)

## GraphQL caching
Magento caches the following queries:

- category (deprecated)
- categoryList
- cmsBlocks
- cmsPage
- products
- urlResolver
Magento explicitly disallows caching the following queries.

- cart
- country
- countries
- currency
- customAttributeMetadata
- customer
- customerDownloadableProducts
- customerOrders
- customerPaymentTokens
- storeConfig
- wishlist

## Development 
### GraphQL schema
The <module_name>/etc/schema.graphqls file:

- Defines the structure of queries and mutations.
- Determines which attributes can be used for input and output in GraphQL queries and mutations. Requests and responses contain separate lists of valid attributes.
- Points to the resolvers that verify and process the input data and response.
- Serves as the source for displaying the schema in a GraphQL browser.
- Defines which objects are cached.
### Filter
```
<type name="Magento\CatalogGraphQl\Model\Resolver\Products\FilterArgument\ProductEntityAttributesForAst" >
  <arguments>
    <argument name="additionalAttributes" xsi:type="array">
      <item name="field_to_sort" xsi:type="string">field</item>
      <item name="other_field_to_sort" xsi:type="string">other_field</item>
    </argument>
  </arguments>
</type>

```

### Resolvers
Implement 
- [BatchResolverInterface](https://github.com/magento/magento2/blob/2.4/lib/internal/Magento/Framework/GraphQl/Query/Resolver/BatchResolverInterface.php)
- [BatchServiceContractResolverInterface](https://github.com/magento/magento2/blob/2.4/lib/internal/Magento/Framework/GraphQl/Query/Resolver/BatchServiceContractResolverInterface.php)
- [ResolverInterface](https://github.com/magento/magento2/blob/2.4/lib/internal/Magento/Framework/GraphQl/Query/ResolverInterface.php)

### Debugging with PHPStorm and Xdebug

```
http://<magento2-3-server>/graphql?XDEBUG_SESSION_START=PHPSTORM
```

### Exception handling
| Class                          | EXCEPTION CATEGORY     | DESCRIPTION                                    |
|--------------------------------|------------------------|------------------------------------------------|
| GraphQlAlreadyExistsException  | graphql-already-exists | Thrown when data already exists                |
| GraphQlAuthenticationException | graphql-authentication | Thrown when an authentication fails            |
| GraphQlAuthorizationException  | graphql-authorization  | Thrown when an authorization error occurs      |
| GraphQlInputException          | graphql-input          | Thrown when a query contains invalid input     |
| GraphQlNoSuchEntityException   | graphql-no-such-entity | Thrown when an expected resource doesn’t exist |

## Using GraphQL Magento Default
- [Query](https://devdocs.magento.com/guides/v2.4/graphql/queries/index.html)
- [Mutations](https://devdocs.magento.com/guides/v2.4/graphql/mutations/index.html)

## Tutorial 
- Click [here](https://devdocs.magento.com/guides/v2.4/graphql/tutorials/checkout/index.html) 
