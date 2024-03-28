# ProductFeed

Clone git repository:

```bash
git clone https://github.com/MMustafa53/ProductFeed.git
```

Run docker compose command to start the project:

```bash
docker compose up
```

Example curl request to get the product feed:

```bash
curl --location 'http://localhost:8053/akakce?format=csv' --header 'Api-Token: cpYS5Ix9Ddes52HHxxbXhZsiLmBpKJM8'
curl --location 'http://localhost:8053/akakce?format=yaml' --header 'Api-Token: cpYS5Ix9Ddes52HHxxbXhZsiLmBpKJM8'
curl --location 'http://localhost:8053/google?format=xml' --header 'Api-Token: cpYS5Ix9Ddes52HHxxbXhZsiLmBpKJM8'
curl --location 'http://localhost:8053/google?format=json' --header 'Api-Token: cpYS5Ix9Ddes52HHxxbXhZsiLmBpKJM8'
curl --location 'http://localhost:8053/facebook?format=json' --header 'Api-Token: cpYS5Ix9Ddes52HHxxbXhZsiLmBpKJM8'
curl --location 'http://localhost:8053/facebook?format=yaml' --header 'Api-Token: cpYS5Ix9Ddes52HHxxbXhZsiLmBpKJM8'
curl --location 'http://localhost:8053/cimri?format=csv' --header 'Api-Token: cpYS5Ix9Ddes52HHxxbXhZsiLmBpKJM8'
curl --location 'http://localhost:8053/cimri?format=xml' --header 'Api-Token: cpYS5Ix9Ddes52HHxxbXhZsiLmBpKJM8'
```