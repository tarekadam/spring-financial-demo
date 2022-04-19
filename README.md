# SETUP
1. Adjust DB connection credentials in the .env file
2. Run the following commands from the project root

> composer install

> php artisan migrate

> php artisan db:seed

# TEST
> phpunit

# USAGE

## createPlayer
- name must be unique, max 10 chars.
- street max 100 chars
- city max 100 chars
- state max 2 chars
- zip max 5 chars
```
mutation {
  createPlayer(
    name: "Ralphie"
    address: {
      create: {
        street: "1232 ABC Street"
        city: "Victoria"
        state: "BC"
        zip: "12345"
      }
    }
  ) {
    id
    name
    score
    address {
      street
      city
      state
      zip
    }
  }
}

```

## getPlayers
```
query {
  players {
    id
    name
    score
  }
}

```

## getPlayer X
```
query {
  player(id: 5) {
    id
    name
    score
    address {
      street
      city
      state
      zip
    }
  }
}
```

## incrementScore
```
mutation {
  play(id: 5, operation: "increment") {
    id,
    name,
    score
  }
}
```

## decrementScore
```
mutation {
  play(id: 5, operation: "decrement") {
    id
    name
    score
  }
}
```

## deletePlayer
```
mutation {
  deletePlayer(id: 3) {
    id
  }
}
```
# PostMan
Please download and import this PostMan collection to play with the API.

> http://sfd-graphql.thebackoffice.io/SpringFinancial.postman_collection.json.zip

# Dev Demo
Please use the queries provided above in this UI.
> http://sfd-graphql.thebackoffice.io/graphql-playground
