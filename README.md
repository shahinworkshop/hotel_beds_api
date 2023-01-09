# Introduce

With thi application you can book a room in the selected hotel with the selected date.

### Architecture
For this application I used the Hexagonal architecture and Symfony 6.2 with PHP 8.1
I try to implement CQRS and DDD.


# How to run

1. Clone the repository
2. Run `docker-compose up --build`
3. create `.env` file in the root directory and manipulate based on the `.env.sample` file

# How to use
Currently, the application is available at `http://localhost:6002/`
for the hotel availability search you can use the following endpoint:

`http://localhost:6002/hotels/availability/` => `POST' method

```
{
  "checkIn": "2023-06-15",
  "checkOut": "2023-06-16",
  "rooms": 1,
  "adults": 2,
  "children": 0,
  "hotels": [
    77,
    168,
    264,
    265
  ]
}
```

# How to test
### Ui tests
Run `make test-ui`

### Unit tests
Run `make test-unit`

# Cleaning code
Run `make cs-fix`
