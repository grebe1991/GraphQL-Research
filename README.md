## What is GraphQL

GraphQL is a query language for your API, and a server-side runtime for executing queries by using a type system you define for your data. GraphQL isn't tied to any specific database or storage engine and is instead backed by your existing code and data.

A GraphQL service is created by defining types and fields on those types, then providing functions for each field on each type. For example, a GraphQL service that tells us who the logged in user is (me) as well as that user's name might look something like this:

>“ Send a GraphQL query to your API and get exactly what you need, nothing more and nothing less. GraphQL queries always return predictable results. Apps 
using GraphQL are fast and stable because they control the data they get, not the server.”

   
  ```
    type Query {
        me: User
    }
   
    type User {
        id: ID
        name: String
    }
  ```
  
  Along with functions for each field on each type:
  ```javascript
 function Query_me(request) {
   return request.auth.user;
 }
 
 function User_name(user) {
   return user.getName();
 }
 ```
Once a GraphQL service is running (typically at a URL on a web service), it can be sent GraphQL queries to validate and execute. A received query is first checked to ensure it only refers to the types and fields defined, then runs the provided functions to produce a result.

For example the query:

```
{
  me {
    name
  }
}
```
  
## A Quote

  >We believe that GraphQL represents a novel way of structuring the client-server contract. Servers publish a type system specific to their application, and
   GraphQL provides a unified language to query data within the constraints of that type system. That language allows product developers to express data requirements in a form natural to them: a declarative and hierarchal one.
  This is a liberating platform for product developers. With GraphQL, no more contending with ad hoc endpoints or object retrieval with multiple roundtrips 
  to access server data; instead an elegant, hierarchical, declarative query dispatched to a single endpoint. No more frequent jumps between client and server development environments to do experimentation or to change or create views of existing data; instead experiments are done and new views built within a native, client development environment exclusively. No more shuffling unstructured data from ad hoc endpoints into business objects; instead a powerful, introspective type system that serves as a platform for tool building.
  Product developers are free to focus on their client software and requirements while rarely leaving their development environment; they can more 
  confidently support shipped clients as a system evolves; and they are using a protocol designed to operate well within the constraints of mobile applications. Product developers can query for exactly what they want, in the way they think about it, across their entire application’s data model. 
  
## Resources
  
  [Introduction](https://graphql.org/learn/)
  
  [Video Tuts](https://www.howtographql.com/)
  
  [Must Read](https://reactjs.org/blog/2015/05/01/graphql-introduction.html)
  
  [GraphQL and Laravel](https://medium.com/skyshidigital/easy-build-api-using-laravel-and-graphql-67e2c5c5e150)
  
  [Review and opinion](https://codeburst.io/up-and-running-with-graphql-laravel-and-vue-js-698000248448)
  
  [GitHub graphql/laravel package](https://github.com/Folkloreatelier/laravel-graphql)
  
## Examples

A typical facebook request

```
{
  user(id: 3500401) {
    id,
    name,
    isViewerFriend,
    profilePicture(size: 50)  {
      uri,
      width,
      height
    }
  }
}
```

And the response

```
{
  "user" : {
    "id": 3500401,
    "name": "Jing Chen",
    "isViewerFriend": true,
    "profilePicture": {
      "uri": "http://someurl.cdn/pic.jpg",
      "width": 50,
      "height": 50
    }
  }
}
```

## Cons




This biggest problem that I see with graphQL i.e if you are using with relational database is with joins.

   1. The fact that you can allow/disallow a few fields makes joins non-trivial(not simple). Which leads to extra queries.

   2. Also Nested queries in graphql leads to circular queries and can crash the server

   3. Rate limiting of calls becomes difficult coz now the user can fire multiple queries in one call.

TIP: There is facebook's dataloader to reduce the number of queries in case of javascript/node

>Query In Indefinite Depth: GraphQL cannot query in indefinite depth, so if you have a tree and want to 
return a branch without knowing the depth, you’ll 
have to do some pagination.

>Specific Response Structure: In GraphQL the response matches the shape of the query, so if you need to 
respond in a very specific structure, you'll have to 
add a transformation layer to reshape the response.

>Cache at Network Level: Because of the commonly way GraphQL is used over HTTP (A POST in a single 
endpoint), cache at network level becomes hard. A way to 
solve it is to use Persisted Queries.
[Persisted Queries explained here](https://docs.scaphold.io/tutorials/persisted-queries/)

>Handling File Upload: There is nothing about file upload in the GraphQL specification and mutations 
doesn’t accept files in the arguments. To solve it you 
can upload files using other kind of APIs (like REST) and pass the URL of the uploaded file to the GraphQL 
mutation, or inject the file in the execution context, so you’ll have the file inside the resolver functions.

>Unpredictable Execution: The nature of GraphQL is that you can query combining whatever fields you want 
but, this flexibility is not for free. There are 
some concerns that are good to know like Performance and N+1 Queries.

>Super Simple APIs: In case you have a service that exposes a really simple API, GraphQL will only add an 
extra complexity, so a simple REST API can be better.

## SOAP vs REST vs GraphQL

![](https://cdn.ttgtmedia.com/rms/onlineImages/microservices-rest_vs_graphql.jpg)

[Read more here](https://www.quora.com/What-are-advantages-and-disadvantages-of-GraphQL-SOAP-and-REST)

