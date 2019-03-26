# REST API - resolve city,state,country from raw address

**Postman Collection link**: Extra/Allevents-demo.postman_collection.json

## How to run this API?

- Install apache or ngnix on any machine
- Place it in htdocs or public_html
- Download/open postman and import the json file
- Pass the raw address in the value field and hit

## API documentation

-  **URL**

   ae/

- **Method**

  ```
  POST
  ```

- **Data Params**

  **Required**

  ```
  address=[string]
  ```

- **Success Response**

  - **Code:** 200

    **Content:**  

    ```
    {
        "street": "104 West Market Street",
        "city": "Mount Carroll",
        "state": "Illinois",
        "country": "United States",
        "postcode": "61053"
    }
    ```

- **Error Response**

  - **Code:** 404 NOT FOUND 

    **Content:** 

    ```
    {
        "message": "Address not found"
    }
    ```
